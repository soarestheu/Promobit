import CrudDataService from './CrudDataService';
import Cookie from 'js-cookie';

class Token {
    checkToken(to, from, next) {
        CrudDataService.validatedToken()
            .then(response => {
                var verifyToken = response.data;
                if (verifyToken.status == "Token is Invalid" || verifyToken.status == "Token is Expired") {
                    Cookie.remove("Crud_token");
                    next('/');
                } else {
                    next();
                }

            }).catch(e => {
                console.log(e);
            });
    }
}

export default new Token();