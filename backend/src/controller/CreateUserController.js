import { CreateUserService } from "../service/CreateUserService.js";

class CreateUserController {
  async handle(request, response) {
    const { name, email, password } = request.body;

    const createUserService = new CreateUserService();

    const user = await createUserService.execute({
      name,
      email,
      password,
    });

    return response.status(201).json(user);
  }
}

export { CreateUserController };
