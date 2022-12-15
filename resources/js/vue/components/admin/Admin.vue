<template>
  <div class="container" style="height: 400px; text-align: center">
    <div class="row">
      <div class="col-12">
        <h1 class="fw-bold pt-5">Plataforma de administración.</h1>
      </div>
      <div class="col-12 mb-2">
        <o-button class="btn-menu" @click="goTo('PersonList')" variant="primary"
          >Administrar Personas</o-button
        >
      </div>
      <div class="col-12 mb-2">
        <o-button class="btn-menu" @click="goTo('SpaceList')" variant="primary"
          >Administrar Espacios</o-button
        >
      </div>
      <div class="col-12">
        <o-button class="btn-menu" @click="goTo('Bookings')" variant="primary"
          >Crear Reservas</o-button
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  methods: {
    goTo: function (ruta) {
      this.$router.push({ name: ruta });
    },
  },
};
</script>
<style scoped>

.btn-menu:hover{
  transform: scale(1.1);
}

</style>
