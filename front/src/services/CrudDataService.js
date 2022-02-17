import http from "../http-common";

class CrudDataService {
    login(data) {
        return http.post('/auth/login', data);
    }

    getAll(type) {
        return http.get("/" + type);
    }

    get(type, id) {
        return http.get(`/${type}/${id}`);
    }

    create(type, data) {
        return http.post("/" + type, data);
    }

    update(type, id, data) {
        return http.put(`/${type}/${id}`, data);
    }

    delete(type, id) {
        return http.delete(`/${type}/${id}`);
    }

    logout() {
        return http.post('auth/logout');
    }

    validatedToken() {
        return http.get('me');
    }

    verifyTag(data) {
        return http.post('/product/verify', data);
    }

    exportart() {
        return http.get('/exportar');
    }
}

export default new CrudDataService();