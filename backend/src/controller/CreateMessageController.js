import { CreateMessageService } from "../service/CreateMessageService.js";

class CreateMessageController {
  async handle(request, response) {
    const { name, email, message } = request.body;

    const createMessageService = new CreateMessageService();

    const messages = await createMessageService.execute({
      name,
      email,
      mess: message,
    });

    return response.status(201).json(messages);
  }
}

export { CreateMessageController };
