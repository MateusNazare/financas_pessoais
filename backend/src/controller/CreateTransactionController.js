import { CreateTransactionService } from "../service/CreateTransactionService.js";

class CreateTransactionController {
    async handle(request, response) {
        const {
            title,
            value,
            type,
            category
        } = request.body;

        const { id } = request.user;

        const createTransactionService = new CreateTransactionService();

        const course = await createTransactionService.execute({
            user_id: id,
            title,
            value,
            type,
            category
        });

        return response.status(201).json(course);
    }
}

export {
    CreateTransactionController
};