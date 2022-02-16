import prismaClient from "../prisma/index.js";

class ListTransactionService {
    async execute({ id }) {
        const transactions = await prismaClient.transaction.findMany({
           where: { user_id: id }
        });

        return transactions;
    }
}

export { ListTransactionService };
