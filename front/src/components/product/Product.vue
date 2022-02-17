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
import { useToast } from "vue-toastification";

export default {
  name: "product",
  setup() {
    // Pegando a interface do  toast
    const toast = useToast();
    return { toast }
  },
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
          this.currentProduct = response.data;
          console.log(this.currentProduct.tag);
          // this.nTags = this.currentProduct.tag;
        })
        .catch(e => {
          this.toast.error(e.message,{
            timeout: 2000
          });
        });
    },
    getTags() {
      CrudDataService.getAll('tag')
        .then(response => {
          this.tags = response.data;
        })
        .catch(e => {
          this.toast.error(e.message,{
            timeout: 2000
          });
        });
    },
    updateProduct() {
      this.currentProduct.tag = this.nTags;
      CrudDataService.update('product', this.currentProduct.id, this.currentProduct)
        .then(response => {
         this.toast.success(response.data['success'],{
              timeout: 2000
          });
          this.$router.replace({
                  name: 'product-list',
                });
        })
        .catch(e => {
          this.toast.error(e.message,{
            timeout: 2000
          });
        });
    },

    deleteProduct() {
      CrudDataService.delete('product', this.currentProduct.id)
        .then(response => {
          this.toast.success(response.data['success'],{
              timeout: 2000
          });
          this.$router.replace({
            name: 'product-list',
          });
        })
        .catch(() => {
          this.toast.error("Erro ao excluir produto, entre em contato com o Adm",{
            timeout: 2000
          });
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