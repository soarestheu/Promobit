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

export default {
  name: "tag",
  data() {
    return {
      currentTag: null,
    };
  },
  methods: {
    getTag(id) {
      CrudDataService.get(id)
        .then(response => {
          this.currentTag = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },

    updateUser() {
      CrudDataService.update(this.currentTag.id, this.currentTag)
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