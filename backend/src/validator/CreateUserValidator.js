import { Joi } from "express-validation";

const userValidation = {
    body: Joi.object({ 
        name: Joi.string().required(),
        email: Joi.string().required(),
        password: Joi.string().required(),
    })
};

export { userValidation };