import axios from "axios";
import Cookie from 'js-cookie';

export default axios.create({
    //URL do endpoint (minha API)
    baseURL: "http://promobitapi.test/api/base",
    headers: {
        "Content-type": "application/json",
        "Authorization": "Bearer " + Cookie.get('Crud_token'),
    }
});