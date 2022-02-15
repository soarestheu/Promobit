<template>
  <div v-if="currentProduct" class="edit-form">
    <h4>Produto </h4>
    <form>
      <div class="form-group">
        <label for="title">Nome</label>
        <input type="text" class="form-control" id="title"
          v-model="currentProduct.name"
        />
      </div>

    <div v-for="tag in tags" :key="tag.id">
      <div class="form-group">
          <input class="rounded border-gray-300" type="checkbox" name="nTags[]" v-model="nTags" :value="tag.id" />
          <label class="pl-3 block text-sm">{{ tag.name }}</label>
      </div>
    </div>

    </form>
    <router-link  to="/product/list"><font-awesome-icon icon="arrow-left" /></router-link>
      &nbsp; 
    <button class="badge badge-danger mr-2"
      @click="deleteProduct"
    >
      Excluir <font-awesome-icon icon="minus-circle" />
    </button>

    <button type="submit" class="badge badge-success"
      @click="updateProduct"
    >
      Atualizar  <font-awesome-icon icon="sync-alt" />
    </button>
    
  </div>

  <div v-else>
    <br />
    <router-link  to="/product/list"><font-awesome-icon icon="arrow-left" /></router-link>
  </div>
</template>

<script>
import CrudDataService from "../../services/CrudDataService";

export default {
  name: "product",
  data() {
    return {
      currentProduct: null,
      nTags: [],
      tags: {}
    };
  },
  methods: {
    getProduct(id) {
      CrudDataService.get('product', id)
        .then(response => {
          console.log(response.data);
          this.currentProduct = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },
    getTags() {
      CrudDataService.getAll('tag')
      .then(response => {
        this.tags = response.data;
      })
    },
    updateProduct() {
      this.currentProduct.tag = this.nTags;
      CrudDataService.update('product', this.currentProduct.id, this.currentProduct)
        .then(response => {
          console.log(response.data)
          this.$router
                .replace({
                  name: 'product-list',
                });
        })
        .catch(e => {
          console.log(e);
        });
    },

    deleteProduct() {
      CrudDataService.delete('product', this.currentProduct.id)
        .then(response => {
          alert(response.data.sucess)
          this.$router.replace({
            name: 'product-list',
          });
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    this.message = '';
    this.getProduct(this.$route.params.id);
    this.getTags();
  }
};
</script>

<style>
.edit-form {
  max-width: 300px;
  margin: auto;
}
</style>