<template>
  <div class="container ">
    <div class="row content ">
      <div class="col"></div>
      <div class="col ">
        <h1>Buscador</h1>
        <div class="align-middle">
          <o-field label="">
          <o-input v-model="search"></o-input>
        </o-field>
        <div v-if="people" >
          <span>resultado:</span>
          <ul class="list-group" v-for="(result, index) in people" :key="index">
            
            <li class="list-group-item">{{ result.title}}</li>
          </ul>
        </div>
        <o-button variant="info" @click="buscar(search)">buscar</o-button>
        </div>
        
      </div>
      <div class="col pb-3"></div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    search: "Bloque F",
    people: "",
  }),
  methods: {
    buscar(search) {
      this.$axios
        .get("/api/seeker/buscar/" + search)
        .then((res) => {
          this.people = res.data;
          oruga.notification.open("Sucess");
          console.log(res);
        })
        .catch((error) => {
          if (error.response.data) {
            console.log(error)
          }
        });
    },
  },
};
</script>
<style lang="scss" scoped>
  .content{
    height: 400px;
  }
</style>>

