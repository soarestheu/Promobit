<template>
  <div class="submit-form">
    <div v-if="!submitted">
      <div class="form-group">
        <label for="name">Produto:</label>
        <input
          type="text"
          class="form-control"
          id="name"
          required
          v-model="product.name"
          name="name"
        />
      </div>

        <div v-for="tag in tags" :key="tag.id">
            <div class="form-group">
                <input class="rounded border-gray-300" type="checkbox" name="newTags[]" v-model="product.newTags" :value="tag.id" />
                <label class="pl-3 block text-sm">{{ tag.name }}</label>
            </div>
        </div>

      <router-link class="btn btn-warning " to="/product/list">Voltar</router-link>
      &nbsp;
      <button @click="saveProduct" class="btn btn-success">Cadastrar</button>
      

    </div>

    <div v-else>
      <h4>Produto cadastrado com sucesso!</h4>
      <router-link class="btn btn-warning" to="/product/list">Voltar</router-link>
      &nbsp;
      <button class="btn btn-success" @click="newProduct">Criar Novo</button>
    </div>
  </div>
</template>

<script>
import CRUDDataService from "../../services/CrudDataService";

export default {
  name: "novo-produto",
  data() {
    return {
      product: {
        id: null,
        name: "",
        newTags: []
      },
      tags: [],
      submitted: false
    };
  },
  methods: {
    getTags() {
      CRUDDataService.getAll('tag')
      .then(response => {
        this.tags = response.data;
      })
    },
    saveProduct() {
      var data = {
        name: this.product.name,
        tags: this.product.newTags
      };

      CRUDDataService.create('product', data)
        .then(response => {
          console.log(response.data);
          this.product.id = response.data.id;
          this.submitted = true;
        })
        .catch(e => {
          console.log(e);
        });
    },
    
    newProduct() {
      this.submitted = false;
      this.product = {};
    }
  },
  mounted() {
    this.getTags();
  },
};
</script>

<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>