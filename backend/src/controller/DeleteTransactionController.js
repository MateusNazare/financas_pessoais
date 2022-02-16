import { DeleteTransactionService } from "../service/DeleteTransactionService.js";

class DeleteTransactionController {
    async handle(request, response) {
        const { id } = request.params;
 
        const { id: user_id } = request.user;

        const deleteTransactionService = new DeleteTransactionService();

        await deleteTransactionService.execute({
            id,
            user_id,
        });

        return response.send();
    }
}

export { DeleteTransactionController };