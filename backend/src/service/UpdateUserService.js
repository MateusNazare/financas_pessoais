import prismaClient from "../prisma/index.js";
import { AppError } from "../errors/AppError.js";
import Bcryptjs from "bcryptjs";

class UpdateUserService {
  async execute({ id, name, password }) {
    const userExists = await prismaClient.user.findUnique({
      where: {
        id: id,
      },
    });

    if (!userExists) {
      throw new AppError("User doesn't exist");
    }

    const passwordHash = await Bcryptjs.hash(password, 8);

    const user = await prismaClient.user.update({
      where: { id: id },
      data: {
        name,
        password: passwordHash,
      },
    });

    delete user.password;

    return user;
  }
}

export { UpdateUserService };
