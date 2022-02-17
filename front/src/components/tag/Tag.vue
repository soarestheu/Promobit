<template>
  <div v-if="currentTag" class="edit-form">
    <h4>Tag</h4>
    <form>
      <div class="form-group">
        <label for="title">Nome</label>
        <input type="text" class="form-control" id="title"
          v-model="currentTag.name"
        />
      </div>

    </form>
    <router-link  to="/tag/list"><font-awesome-icon icon="arrow-left" /></router-link>
      &nbsp; 
    <button class="badge badge-danger mr-2"
      @click="deleteTag"
    >
      Excluir <font-awesome-icon icon="minus-circle" />
    </button>

    <button type="submit" class="badge badge-success"
      @click="updateTag"
    >
      Atualizar  <font-awesome-icon icon="sync-alt" />
    </button>
    
  </div>

  <div v-else>
    <br />
    <router-link  to="/tag/list"><font-awesome-icon icon="arrow-left" /></router-link>
  </div>
</template>

<script>
import CrudDataService from "../../services/CrudDataService";
import { useToast } from "vue-toastification";

export default {
  
  name: "tag",
  setup() {
    // Pegando a interface do  toast
    const toast = useToast();
    return { toast }
  },
  data() {
    return {
      currentTag: null,
    };
  },
  methods: {
    getTag(id) {
      CrudDataService.get('tag', id)
        .then(response => {
          this.currentTag = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },

    updateTag() {
      CrudDataService.update('tag', this.currentTag.id, this.currentTag)
        .then(response => {
          this.toast.success(response.data['success'],{
            timeout: 2000
          });
          this.$router
                .replace({
                  name: 'tag-list',
                });
        })
        .catch(e => {
          this.toast.error(e.message,{
            timeout: 2000
          });
        });
    },

    deleteTag() {
      CrudDataService.delete('tag', this.currentTag.id)
        .then(response => {
          this.toast.success(response.data['success'],{
            timeout: 2000
          });
          this.$router.replace({
              name: 'tag-list',
          });
        })
        .catch(() => {
          this.toast.error("Erro ao excluir a tag, exclua todos os produtos associados a ela e tente novamente!",{
            timeout: 2000
          });
        });
    }
  },
  mounted() {
    this.message = '';
    this.getTag(this.$route.params.id);
  }
};
</script>

<style>
.edit-form {
  max-width: 300px;
  margin: auto;
}
</style>