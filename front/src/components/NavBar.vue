<template>
    <div id="navBar">
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <router-link to="/" class="navbar-brand">Inicio</router-link>
            <div v-if="Logado"  class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        Tags
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li class="nav-item">
                            <router-link to="/tag/list" style="color:black;" class="nav-link">Listar</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/tag/new" style="color:black;" class="nav-link">Cadasatro de Tag</router-link>
                        </li>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Produtos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li class="nav-item">
                            <router-link to="/product/list" style="color:black;" class="nav-link">Listar</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/product/new" style="color:black;" class="nav-link">Cadastro de Produtos</router-link>
                        </li>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        Usuarios
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <li class="nav-item">
                            <router-link to="/user/list" style="color:black;" class="nav-link">Listar</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/user/new" style="color:black;" class="nav-link">Cadasatro de Usuário</router-link>
                        </li>
                    </div>
                </li>
            </div>
            <li v-if="Logado" class="nav-item navbar-text logout">
                <a href="#" @click="logout" class="nav-link">Logout </a>
            </li>
        </nav>
    </div>
</template>

<script>
import CRUDDataService from "../services/CrudDataService";
import Cookie from "js-cookie";

    export default {
        name: "navBar",
        data() {
            return {
                Logado:false,
            }
        },
        methods: {
            logout() {
                CRUDDataService.logout()
                .then(response =>{
                    console.log(response.data);
                    Cookie.remove("Crud_token");
                    location.reload();
                })
                .catch(e => {
                console.log(e);
                });
            },
            exibeMenu(){
                 CRUDDataService.validatedToken()
                    .then(responseApi => {
                        if (responseApi.data.status) {
                            this.Logado = false;
                        } else {
                            this.Logado = true;
                        }
                    }).catch(e => {
                        console.log(e);
                    });
            },
        },
        mounted() {
            this.exibeMenu();
        },

    }
</script>