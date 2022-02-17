import prismaClient from "../prisma/index.js";

class GetUserService {
    async execute({ id }) {
        const transactions = await prismaClient.user.findFirst({
           where: { id: id }
        });

        return transactions;
    }
}

export { GetUserService };
