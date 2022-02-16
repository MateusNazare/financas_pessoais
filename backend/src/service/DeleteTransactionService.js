import prismaClient from "../prisma/index.js";

import {
    AppError
} from "../errors/AppError.js";

class DeleteTransactionService {
    async execute({ id, user_id }) {
        const transactionExists = await prismaClient.transaction.findFirst({
            where: {
                id: id,
                user_id: user_id
            }
        });

        if (!transactionExists) {
            throw new AppError("Transaction does not exist!");
        }

        await prismaClient.transaction.delete({
            where: {
                id: id
            },
        });

        return;
    }
}

export {
    DeleteTransactionService
};