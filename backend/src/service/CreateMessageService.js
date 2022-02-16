import prismaClient from "../prisma/index.js";

class CreateMessageService {
  async execute({ name, email, mess }) {
    const message = await prismaClient.message.create({
      data: {
        name, email, message: mess
      },
    });

    return message;
  }
}

export { CreateMessageService };
