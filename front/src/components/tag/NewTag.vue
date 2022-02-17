<template>
  <div class="submit-form">
    <div v-if="!submitted">
      <div class="form-group">
        <label for="name">Tag:</label>
        <input
          type="text"
          class="form-control"
          id="name"
          required
          v-model="tag.name"
          name="name"
        />
      </div>

      <router-link class="btn btn-warning " to="/tag/list">Voltar</router-link>
      &nbsp;
      <button @click="saveTag" class="btn btn-success">Cadastrar</button>
      

    </div>

    <div v-else>
      <h4>Tag cadastrado com sucesso!</h4>
          <router-link class="btn btn-warning" to="/tag/list">Voltar</router-link>

      <button class="btn btn-success" @click="newTag">Criar Novo</button>
    </div>
  </div>
</template>

<script>
import CRUDDataService from "../../services/CrudDataService";
import { useToast } from "vue-toastification";

export default {
  name: "nova-tag",
  setup() {
    // Pegando a interface do  toast
    const toast = useToast();
    return { toast }
  },
  data() {
    return {
      tag: {
        id: null,
        name: "",
      },
      submitted: false
    };
  },
  methods: {
    saveTag() {
      var data = {
        name: this.tag.name,
      };

      CRUDDataService.create("tag", data)
        .then(response => {
          this.toast.success(response.data['success'],{
              timeout: 2000
          });
          this.tag.id = response.data.id;
          this.submitted = true;
        })
        .catch(e => {
          console.log(e);
        });
    },
    
    newTag() {
      this.submitted = false;
      this.tag = {};
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