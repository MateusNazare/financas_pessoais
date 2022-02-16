import { Joi } from "express-validation";

const transactionValidation = {
    body: Joi.object({ 
        title: Joi.string().required(),
        value: Joi.number().required(),
        type: Joi.number().required(),
        category: Joi.string().required(),
    })
};

export { transactionValidation };