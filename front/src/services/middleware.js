import tokenValidated from "./validToken"

export default {

    auth(to, from, next) {
        tokenValidated.checkToken(to, from, next);
    }
}