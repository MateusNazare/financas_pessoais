import { GetUserService } from "../service/GetUserService.js";

class GetUserController {
  async handle(request, response) {
    const { id } = request.user;

    const getUserService = new GetUserService();

    const user = await getUserService.execute({ id });

    delete user.password;

    return response.status(200).json(user);
  }
}

export { GetUserController };
