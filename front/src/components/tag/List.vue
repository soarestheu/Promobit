<template>
  <div class="list">
    <div class="row">
      <div class="col-md-6">
        <h4>
          Listagem de Tags
        </h4>
        <ul class="list-group">
          <li class="list-group-item"
            :class="{ active: index == currentIndex }"
            v-for="(tag, index) in tags"
            :key="index"
            @click="setActiveTag(tag, index)"
          >
            {{ tag.name }} 
          </li>
        </ul>
      </div>
      <div class="col-md-6">
        <div v-if="currentTag">
          <h4>Tag</h4>
          <div>
            <label><strong>Nome:</strong></label> {{ currentTag.name }}
            <br/>
            <label><strong>Produtos:</strong></label>
            <div v-for="product in currentTag.product" :key="product.id">
              <div v-for="name in product" :key="name.id">
                <li>
                  {{name.name}}
                </li>
              </div>
            </div>
          </div>
          <router-link :to="'/tag/' + currentTag.id" class="badge badge-warning">Editar <font-awesome-icon icon="user-edit" /></router-link>
        </div>
      </div>
    </div>
    <div class="row">
          &nbsp;
    </div>
    <div class="row col-md-6">
          <router-link to="/tag/new" class="btn btn-primary">
            Cadasatrar Tag 
            <font-awesome-icon icon="user-plus" />
          </router-link>

          <div class="clean">&nbsp;</div>
          <button v-if="tags" @click="exportart()" class="btn btn-warning float-right">
            Exportar
          </button>
    </div>
  </div>
</template>

<script>
import CrudDataService from "../../services/CrudDataService";

export default {
  name: "list",
  data() {
    return {
      tags: [],
      currentTag: null,
      currentIndex: -1,
      name: "",
    };
  },
  methods: {
    exportart() {
        CrudDataService.exportart()
            .then(response => {
                console.log(response.data);
                window.open("http://promobitapi.test" + response.data, '_blank');
            });
    },
    getTags() {
      CrudDataService.getAll("tag")
        .then(response => {
          console.log(response.data);
          this.tags = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },

    refreshList() {
      this.getTags();
      this.currentTag = null;
      this.currentIndex = -1;
    },

    setActiveTag(tag, index) {
      this.currentTag = tag;
      this.currentIndex = tag ? index : -1;
    },

  },
  mounted() {
    this.getTags();
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
