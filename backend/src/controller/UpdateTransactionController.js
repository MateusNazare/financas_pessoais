import { UpdateTransactionService } from "../service/UpdateTransactionService.js";

class UpdateTransactionController {
  async handle(request, response) {
    const { title, value, type, category } = request.body;
    const { id } = request.params;
    const { id: user_id } = request.user;

    const updateTransactionService = new UpdateTransactionService();

    const transaction = await updateTransactionService.execute({
      id,
      user_id,
      title,
      value,
      type,
      category,
    });

    return response.status(200).json(transaction);
  }
}

export { UpdateTransactionController };
