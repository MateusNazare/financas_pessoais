import { Joi } from "express-validation";

const updateUserValidation = {
    body: Joi.object({ 
        name: Joi.string().required(),
        password: Joi.string().required(),
    })
};

export { updateUserValidation };