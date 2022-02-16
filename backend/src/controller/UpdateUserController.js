import { UpdateUserService } from "../service/UpdateUserService.js";

class UpdateUserController {
  async handle(request, response) {
    const { name, password } = request.body;

    const { id } = request.user;

    const updateUserService = new UpdateUserService();

    const user = await updateUserService.execute({
      name,
      id,
      password,
    });

    return response.status(200).json(user);
  }
}

export { UpdateUserController };
