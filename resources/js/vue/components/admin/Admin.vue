<template>
  <div class="container" style="height: 400px; text-align: center;">
    <h1 class="fw-bold pt-5">Plataforma de administración.</h1>
    <o-button @click="goTo('PersonList')" variant="info"
      >Administrar Personas</o-button
    >
    <o-button @click="goTo('SpaceList')" variant="info"
      >Administrar Espacios</o-button
    >
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
