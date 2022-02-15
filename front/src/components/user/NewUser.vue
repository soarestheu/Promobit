<template>
  <div class="submit-form">
    <div v-if="!submitted">
      <div class="form-group">
        <label @click="showToast()" for="name">Nome completo:</label>
        <input
          type="text"
          class="form-control"
          id="name"
          required
          v-model="user.name"
          name="name"
        />
      </div>

      <div class="form-group">
        <label for="email">E-mail</label>
        <input
          class="form-control"
          id="email"
          required
          v-model="user.email"
          name="email"
        />
      </div>

      <div class="form-group">
        <label for="password">Senha</label>
        <input
            type="password"
            class="form-control"
            id="password"
            required
            v-model="user.password"
            name="password"
        />
      </div>

      <router-link class="btn btn-warning " to="/user/list">Voltar</router-link>
      &nbsp;
      <button @click="saveUser" class="btn btn-success">Cadastrar</button>
      

    </div>

    <div v-else>
      <h4>Usuário cadastrado com sucesso!</h4>
          <router-link class="btn btn-warning" to="/user/list">Voltar</router-link>

      <button class="btn btn-success" @click="newUser">Criar Novo</button>
    </div>
  </div>
</template>

<script>
import CRUDDataService from "../../services/CrudDataService";
import { useToast } from "vue-toastification";

export default {
  name: "novo-usuario",
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
      submitted: false
    };
  },
  methods: {
    saveUser() {
      var data = {
        name: this.user.name,
        email: this.user.email,
        password: this.user.password
      };

      CRUDDataService.create('user', data)
        .then(response => {
          this.toast.success(response.data['success'],{
            timeout: 2000
          });
          this.user.id = response.data.id;
          this.submitted = true;
        })
        .catch(e => {
          console.log(e);
        });
    },
    
    newUser() {
      this.submitted = false;
      this.user = {};
    }
  }
};
</script>

<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>