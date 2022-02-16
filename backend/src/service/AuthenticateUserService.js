import prismaClient from "../prisma/index.js";
import Bcryptjs from "bcryptjs";
import Jwt from "jsonwebtoken";
import {
    AppError
} from "../errors/AppError.js";

class AuthenticateUserService {
    async execute({ email, password }) {
        const user = await prismaClient.user.findUnique({
            where: {
                email: email
            }
        });

        if (!user) {
            throw new AppError("Email or password incorrect!");
        }

        const passwordMatch = await Bcryptjs.compare(password, user.password);

        if (!passwordMatch) {
            throw new AppError("Email or password incorrect!");
        }

        const token = Jwt.sign({}, "b90d6f8c1aad386e6eaee688facc6ba1", {
            subject: user.id,
            expiresIn: "1d",
        });

        const tokenReturn = {
            token,
        };

        return tokenReturn;
    }
}

export { AuthenticateUserService };
