import "reflect-metadata";
import "express-async-errors";

import express from "express";
import dotenv from "dotenv";
import cors from "cors";

import { AppError } from "./errors/AppError.js";
import { ValidationError } from "express-validation";

import { router } from "./routes.js";

dotenv.config();

const port = process.env.PORT || 3000;

const app = express();

app.use(cors());

app.use(express.json());
app.use(router);

app.use((err, request, response, next) => {
  if (err instanceof AppError) {
    return response.status(err.statusCode).json({
      message: err.message,
    });
  }

  if (err instanceof ValidationError) {
    return response.status(err.statusCode).json(err);
  }

  return response.status(500).json({
    status: "error",
    message: `Internal server error - ${err.message}`,
  });
});

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
