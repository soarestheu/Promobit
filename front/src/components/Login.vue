<template>
  <div class="list row justify-content-md-center">
    
    <div class="submit-form col-md-4">
        <form @submit.stop.prevent="login">
            <div class="form-group">
            <label for="email"> E-mail </label>
            <input 
                type="text"
                class="form-control"
                id="email"
                required
                v-model="user.email"
                name="email"
            />
            </div>
        
            <div class="form-group">
            <label for="password"> Senha </label>
            <input 
                type="password"
                class="form-control"
                id="password"
                required
                v-model="user.password"
                name="password"
            />
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block"> Login </button>
            </div>
            </form>
    </div>
    </div>
</template>

<script>
import Cookie from "js-cookie";
import CRUDDataService from "../services/CrudDataService";
import { useToast } from "vue-toastification";


export default {
    name: "app",
    setup() {
        // Pegando a interface do  toast
        const toast = useToast();
        return { toast }
    },
    data() {
        return {
            user: {
            id: null,
            name: "",
            description: "",
            password: ""
            },
            submitted: false,
            data: []
        };
    },
    methods: {
        login() {
            this.data = {
                email: this.user.email,
                password: this.user.password,
            };
            CRUDDataService.login(this.data)
                    .then(response =>   {
                        this.toast.success("Login realizado com sucesso!",{
                            timeout: 2000
                        });

                        Cookie.set("Crud_token", response.data.access_token);
                        this.submitted = true;
                        window.location.href = './user/list';
                    })
                    .catch(e => {
                        console.log(e);
                    });
        }

    }
};
</script>