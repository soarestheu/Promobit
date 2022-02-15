<template>
  <div class="list">
    <div class="row">
      <div class="col-md-6">
        <h4>
          Listagem de Produtos
        </h4>
        <ul class="list-group">
          <li class="list-group-item"
            :class="{ active: index == currentIndex }"
            v-for="(product, index) in products"
            :key="index"
            @click="setActiveProduct(product, index)"
          >
            {{ product.name }} 
          </li>
        </ul>
      </div>
      <div class="col-md-6">
        <div v-if="currentProduct">
          <h4>Produto</h4>
          <div>
            <label><strong>Nome:</strong></label> {{ currentProduct.name }} <br/>
            <label> <strong>Tags:</strong></label>
            <div v-for="tag in currentProduct.tag" :key="tag.id">
              <li style="margin-left:10%;"> {{tag.name}} </li>
            </div>
          </div>

          <router-link :to="'/product/' + currentProduct.id" class="badge badge-warning">Editar <font-awesome-icon icon="user-edit" /></router-link>
        </div>
      </div>
    </div>
    <div class="row">
          &nbsp;
    </div>
    <div class="row col-md-6">
          <router-link to="/product/new" class="btn btn-primary">
            Cadasatrar Produto 
            <font-awesome-icon icon="user-plus" />
          </router-link>
    </div>
  </div>
</template>

<script>
import CrudDataService from "../../services/CrudDataService";

export default {
  name: "list",
  data() {
    return {
      products: [],
      currentProduct: null,
      currentIndex: -1,
      name: "",
    };
  },
  methods: {
    getProducts() {
      CrudDataService.getAll("product")
        .then(response => {
          console.log(response.data);
          this.products = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },
    refreshList() {
      this.getProducts();
      this.currentProduct = null;
      this.currentIndex = -1;
    },

    setActiveProduct(product, index) {
      this.currentProduct = product;
      this.currentIndex = product ? index : -1;
    },

  },
  mounted() {
    this.getProducts();
  }
};
</script>

<style>
.list {
  text-align: left;
  max-width: 750px;
  margin: auto;
}
</style>
