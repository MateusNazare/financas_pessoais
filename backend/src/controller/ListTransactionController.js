import {
    ListTransactionService
} from "../service/ListTransactionService.js";

class ListTransactionController {
    async handle(request, response) {
        const { id } = request.user;

        const listTransactionService = new ListTransactionService();

        const transactions = await listTransactionService.execute({ id });

        return response.status(200).json(transactions);
    }
}

export {
    ListTransactionController
};