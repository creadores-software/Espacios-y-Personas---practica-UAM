<template>
  <div class="servicios container">
    <div class="row text-center mt-2">
      <div class="col">
        <h1>Servicios</h1>
        <p>
          Si quieres buscar una persona, un espacio o un evento en específico, utiliza el
          buscador personalizado.
        </p>
      </div>
    </div>
    <div class="row mt-2 text-center">
      <div class="col"></div>

      <div class="col-3">
        <div class="card" style="width: 18rem">
          <img
            src="https://cdn.pixabay.com/photo/2017/07/31/11/21/people-2557396_960_720.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <a href="#" @click="goTo('People')"> <h5 class="card-title text-center">Personas</h5></a>
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="card" style="width: 18rem">
          <img
            src="https://cdn.pixabay.com/photo/2022/06/05/20/24/rome-7244828_960_720.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <a href="#" @click="goTo('Spaces')"> <h5 class="card-title text-center">Espacios</h5></a>
          </div>
        </div>
      </div>
      <div class="col"></div>
      <!-- <div class="col">
        <div class="card" style="width: 18rem">
          <img src="https://cdn.pixabay.com/photo/2016/03/27/18/53/drinks-1283608_960_720.jpg" class="card-img-top" alt="..." />
          <div class="card-body">
            <a href="#"> <h5 class="card-title text-center">Eventos</h5></a>
          </div>
        </div>
      </div> -->
    </div>
  </div>
</template>
<script>
export default {
  data() {
    const data = [];
    return {};
  },

  methods: {
    goTo: function (ruta) {
      this.$router.push({ name: ruta });
    },
  },
};
</script>

<style scoped>
.servicios {
  background-color: white;
  padding: 0;
}
</style>
