<template>
  <div id="app">
    <nav-bar/>

    <div class="container mt-3">
      <router-view />
    </div>
  </div>
</template>

<style>
.logout {
  float: rigth;
   margin-left: auto;
}
</style>

<script>
import CRUDDataService from "./services/CrudDataService";

export default {
  name: "app",
  methods: {
    getAll() {
        CRUDDataService.getAll("user")
        .then(response => {
          console.log(response.data);
          this.submitted = true;
        })
        .catch(e => {
          console.log(e);
        });
    }
  }
};
</script>