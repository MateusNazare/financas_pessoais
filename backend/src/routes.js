import { Router } from "express";
import { validate } from "express-validation";

import { ensureAuthenticated } from "./middleware/ensureAuthenticated.js";

import { userValidation } from "./validator/CreateUserValidator.js";
import { updateUserValidation } from "./validator/UpdateUserValidator.js";
import { transactionValidation } from "./validator/CreateTransactionValidator.js";

import { CreateUserController } from "./controller/CreateUserController.js";
import { AuthenticateUserController } from "./controller/AuthenticateUserController.js";
import { CreateTransactionController } from "./controller/CreateTransactionController.js";
import { ListTransactionController } from "./controller/ListTransactionController.js";
import { DeleteTransactionController } from "./controller/DeleteTransactionController.js";
import { UpdateTransactionController } from "./controller/UpdateTransactionController.js";
import { UpdateUserController } from "./controller/UpdateUserController.js";
import { CreateMessageController } from "./controller/CreateMessageController.js";

const router = Router();

const createUserController = new CreateUserController();
const authenticateUserController = new AuthenticateUserController();
const createTransactionController = new CreateTransactionController();
const listTransactionController = new ListTransactionController();
const deleteTransactionController = new DeleteTransactionController();
const updateTransactionController = new UpdateTransactionController();
const updateUserController = new UpdateUserController();
const createMessageController = new CreateMessageController();

router.post(
  "/users",
  validate(userValidation, {}, {}),
  createUserController.handle
);

router.put(
  "/users",
  validate(updateUserValidation, {}, {}),
  ensureAuthenticated,
  updateUserController.handle
);

router.post("/sessions", authenticateUserController.handle);

router.post(
  "/transactions",
  validate(transactionValidation, {}, {}),
  ensureAuthenticated,
  createTransactionController.handle
);

router.get(
  "/transactions",
  ensureAuthenticated,
  listTransactionController.handle
);

router.delete(
  "/transactions/:id",
  ensureAuthenticated,
  deleteTransactionController.handle
);

router.put(
  "/transactions/:id",
  validate(transactionValidation, {}, {}),
  ensureAuthenticated,
  updateTransactionController.handle
);

router.post("/message", createMessageController.handle);

export { router };
