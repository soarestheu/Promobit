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
        name: "user-list",
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
            import ("./components/user/NewUser")
    },

    {
        path: "/tag/list",
        name: "tag-list",
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
        path: "/tag/new",
        name: "new-tag",
        beforeEnter: Login.auth,
        component: () =>
            import ("./components/tag/NewTag")
    },

    {
        path: "/product/list",
        name: "product-list",
        beforeEnter: Login.auth,
        component: () =>
            import ("./components/product/List")

    },
    {
        path: "/product/:id",
        name: "product-detail",
        beforeEnter: Login.auth,
        component: () =>
            import ("./components/product/Product")
    },
    {
        path: "/product/new",
        name: "new-product",
        beforeEnter: Login.auth,
        component: () =>
            import ("./components/product/NewProduct")
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;