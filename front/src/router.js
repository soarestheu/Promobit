import { createWebHistory, createRouter } from "vue-router";
import Login from "./services/middleware"
//Rotas do projeto
/**
 * path: caminho onde a rota pode ser encontrada
 * name:
 * path: o caminho url onde esta rota pode ser encontrada.
 * name: nome opcional para usar quando vincularmos a esta rota.
 * component: componente para carregar quando esta rota é chamada.
 */
const routes = [{
        path: "/",
        alias: "/login",
        name: "login",
        component: () =>
            import ("./components/Login")
    },
    {
        path: "/user/list",
        name: "list",
        beforeEnter: Login.auth,
        component: () =>
            import ("./components/user/List")

    },
    {
        path: "/user/:id",
        name: "user-detail",
        beforeEnter: Login.auth,
        component: () =>
            import ("./components/user/User")
    },
    {
        path: "/user/new",
        name: "new-user",
        beforeEnter: Login.auth,
        component: () =>
            import ("./components/user/NovoUser")
    },

    {
        path: "/tag/list",
        name: "list",
        beforeEnter: Login.auth,
        component: () =>
            import ("./components/tag/List")

    },
    {
        path: "/tag/:id",
        name: "tag-detail",
        beforeEnter: Login.auth,
        component: () =>
            import ("./components/tag/Tag")
    },
    {
        path: "/tag/novo",
        name: "new-tag",
        beforeEnter: Login.auth,
        component: () =>
            import ("./components/tag/NewTag")
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;