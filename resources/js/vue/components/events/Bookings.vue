<template>
  <div class="container">
    <div class="row container-booking">
      <div class="col-12">
        <h1 class="mt-4">¡Crea reservas para tus espacios!</h1>

        <h3 class="m-0 p-0">Espacio</h3>
        <small class="text-muted">
          Primero selecciona el espacio que quieres reservar
        </small>

        <o-field>
          <o-select v-model="spacesForm.space" placeholder="Selecciona un espacio">
            <option v-for="space in spaces" :value="space.id">{{ space.name }}</option>
          </o-select>
        </o-field>

        <div v-if="spacesForm.space">
          <h3 class="m-0 p-0">Nombre de la reserva</h3>
          <small class="text-muted"> Elije un nombre para tu reserva </small>
          <o-field label="Name">
            <o-input v-model="spacesForm.title"></o-input>
          </o-field>
        </div>
        <div v-if="spacesForm.title">
          <h3 class="m-0 p-0">Reserva</h3>
          <small class="text-muted">
          Selecciona la fecha en la que deseas reservar el espacio.
        </small>
        <div class="col-12 p-0 m-0">
             <v-date-picker v-model="date" :min-date="new Date()" />
        </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      spaces: null,
      spacesForm: {
        space: null,
        title: null,
      },
    };
  },
  methods: {
    consultarEspacios() {
      this.$axios.get("/api/space/").then((res) => {
        this.spaces = res.data.data;
        console.log(this.spaces);
      });
    },
  },
  mounted() {
    this.consultarEspacios();
  },
};
</script>

<style>
.container-booking {
  height: 700px;
}
</style>
