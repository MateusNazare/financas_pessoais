export class AppError {
    constructor(message = "Unexpected error", statusCode = 400) {
        this.message = message;
        this.statusCode = statusCode;
    }
}