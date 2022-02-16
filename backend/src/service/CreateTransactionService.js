import prismaClient from "../prisma/index.js";
import { AppError } from "../errors/AppError.js";

class CreateTransactionService {
  async execute({ user_id, title, value, type, category }) {
    const transaction = await prismaClient.transaction.create({
      data: {
        user_id,
        title,
        value,
        type,
        category,
      },
    });

    return transaction;
  }
}

export { CreateTransactionService };
