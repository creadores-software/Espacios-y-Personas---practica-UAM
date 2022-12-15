<template>
  <div class="container align-items-center">
    <div class="row content">
      <div class="col mt-5"></div>
      <div class="col mt-5">
        <h1>Buscador de espacios y personas</h1>

        <small class="text-muted">Primero ingresa el nombre de una persona o espacio que quieras buscar.</small>
        <div class="align-middle">
          <o-field label="">
          <o-input placeholder="Prueba buscar 'Bloque F'" v-model="search"></o-input>
        </o-field>
        <div v-if="people" >
          <span>resultado:</span>
          <ul class="list-group mb-2" v-for="(result, index) in people" :key="index">
            <li class="list-group-item item-buscador" @click="irAlPerfil(result)">{{ result.title }}</li>
          </ul>
        </div>
        <o-button variant="info" class="" @click="buscar(search)">Buscar</o-button>
        </div>
        
      </div>
      <div class="col pb-3"></div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    search: "",
    people: "",
  }),
  methods: {
    irAlPerfil(result) {
      if(result.type == "spaces"){
        this.goTo('SpaceProfile', { slug: result.searchable.slug});
      }
      if(result.type == "people"){
        this.goTo('PersonProfile', { slug: result.searchable.slug});
      }
    },
    goTo: function (ruta , params) {
      this.$router.push({ name: ruta, params: params });
    },
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
    background: white !important;
  }

  .item-buscador:hover{
    cursor:pointer;
    background: #EAEAEA;
  }
</style>>

