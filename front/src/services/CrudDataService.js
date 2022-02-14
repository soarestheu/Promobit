import http from "../http-common";

class CrudDataService {
    login(data) {
        return http.post('/auth/login', data);
    }

    getAll(type) {
        return http.get("/" + type);
    }

    get(id) {
        return http.get(`/user/${id}`);
    }

    create(type, data) {
        return http.post("/" + type, data);
    }

    update(id, data) {
        return http.put(`/user/${id}`, data);
    }

    delete(id) {
        return http.delete(`/user/${id}`);
    }

    logout() {
        return http.post('auth/logout');
    }

    validatedToken() {
        return http.get('me');
    }
}

export default new CrudDataService();