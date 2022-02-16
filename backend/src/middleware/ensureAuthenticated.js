import prismaClient from "../prisma/index.js";
import Jwt from "jsonwebtoken";
import {
    AppError
} from "../errors/AppError.js";

export async function ensureAuthenticated(
    request,
    response,
    next
) {
    const authHeader = request.headers.authorization;

    if (!authHeader) {
        throw new AppError("Token missing", 401);
    }

    const [, token] = authHeader.split(" ");

    try {
        const {
            sub: user_id
        } = Jwt.verify(
            token,
            "b90d6f8c1aad386e6eaee688facc6ba1"
        );

        const user = await prismaClient.user.findFirst({
            where: {
                id: user_id
            }
        });

        if (!user) {
            throw new AppError("User does not exists!", 401);
        }

        request.user = {
            id: user_id,
        };

        return next();
    } catch (err) {
        throw new AppError("Invalid token!", 401);
    }
}