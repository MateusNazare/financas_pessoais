import prismaClient from "../prisma/index.js";
import Bcryptjs from "bcryptjs";
import { AppError } from "../errors/AppError.js";

class CreateUserService {
  async execute({ name, email, password }) {
    const userAlreadyExists = await prismaClient.user.findUnique({
      where: {
        email: email,
      },
    });

    if (userAlreadyExists) {
      throw new AppError("User already exists");
    }

    const passwordHash = await Bcryptjs.hash(password, 8);

    const user = await prismaClient.user.create({
      data: {
        name,
        email,
        password: passwordHash,
      },
    });

    delete user.password;

    return user;
  }
}

export { CreateUserService };
