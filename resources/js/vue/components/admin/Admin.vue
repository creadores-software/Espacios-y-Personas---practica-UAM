<template>
  <div class="container" style="height: 400px; text-align: center">
    <div class="row">
      <div class="col-12">
        <h1 class="fw-bold pt-5">Plataforma de administración.</h1>
      </div>
      <div class="col-12 mb-2">
        <o-button @click="goTo('PersonList')" variant="info"
          >Administrar Personas</o-button
        >
      </div>
      <div class="col-12 mb-2">
        <o-button @click="goTo('SpaceList')" variant="danger"
          >Administrar Espacios</o-button
        >
      </div>
      <div class="col-12">
        <o-button @click="goTo('Bookings')" variant="primary"
          >Administrar Reservas</o-button
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
