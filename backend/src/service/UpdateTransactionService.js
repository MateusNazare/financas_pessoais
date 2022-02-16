import prismaClient from "../prisma/index.js";
import { AppError } from "../errors/AppError.js";

class UpdateTransactionService {
  async execute({ id, user_id, title, value, type, category }) {
    const transactionExists = await prismaClient.transaction.findFirst({
      where: {
        id: id,
        user_id: user_id,
      },
    });

    if (!transactionExists) {
      throw new AppError("Transaction does not exist!");
    }

    const transaction = await prismaClient.transaction.update({
      where: { id: id },
      data: {
        title,
        value,
        type,
        category,
      },
    });

    return transaction;
  }
}

export { UpdateTransactionService };
