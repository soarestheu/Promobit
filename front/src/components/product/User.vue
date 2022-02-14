<template>
  <div v-if="currentUser" class="edit-form">
    <h4>Usuário </h4>
    <form>
      <div class="form-group">
        <label for="title">Nome</label>
        <input type="text" class="form-control" id="title"
          v-model="currentUser.name"
        />
      </div>
      <div class="form-group">
        <label for="description">E-mail</label>
        <input type="text" class="form-control" id="description"
          v-model="currentUser.email"
        />
      </div>

    </form>
    <router-link  to="/list"><font-awesome-icon icon="arrow-left" /></router-link>
      &nbsp; 
    <button class="badge badge-danger mr-2"
      @click="deleteUser"
    >
      Excluir <font-awesome-icon icon="minus-circle" />
    </button>

    <button type="submit" class="badge badge-success"
      @click="updateUser"
    >
      Atualizar  <font-awesome-icon icon="sync-alt" />
    </button>
    
  </div>

  <div v-else>
    <br />
    <router-link  to="/list"><font-awesome-icon icon="arrow-left" /></router-link>
  </div>
</template>

<script>
import CrudDataService from "../../services/CrudDataService";

export default {
  name: "user",
  data() {
    return {
      currentUser: null,
    };
  },
  methods: {
    getUser(id) {
      CrudDataService.get(id)
        .then(response => {
          this.currentUser = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },

    updateUser() {
      CrudDataService.update(this.currentUser.id, this.currentUser)
        .then(response => {
          alert(response.data.sucess)
          this.$router
                .replace({
                  name: 'list',
                });
        })
        .catch(e => {
          console.log(e);
        });
    },

    deleteUser() {
      CrudDataService.delete(this.currentUser.id)
        .then(response => {
          alert(response.data.sucess)
          this.$router.replace({
                            name: 'list',
                        });
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    this.message = '';
    this.getUser(this.$route.params.id);
  }
};
</script>

<style>
.edit-form {
  max-width: 300px;
  margin: auto;
}
</style>