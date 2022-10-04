<template>
  <div class="container presentacion p-0">
    <div class="head row align-items-center">
      <!-- Texto centrado con el párrafo -->
      <div class="col fondo-texto">
        <h1 class="titulo-p fw-bold">Conoce lo que la UAM tiene para ti</h1>
        <p class="texto-p">
          A través de esta plataforma tú podrás acceder a información de los
          espaciós, personas y eventos que tiene la universidad.
        </p>
        <o-button variant="info">Mirar buscador</o-button>
        <o-button inverted>Docs</o-button>
      </div>
      <div class="col"></div>
    </div>
    <ServiciosVue />
    <FooterVue />
  </div>
</template>

<script>
import ServiciosVue from "./Servicios.vue";

export default {
  data() {
    const data = [];
    return {
      people: [],
      isLoading: true,
      currentPage :1,
    };
  },
  components: {
    ServiciosVue,
  },
  methods: {

    updatePage(){
      setTimeout(this.listPage, 100);
    },
    listPage(p){
      this.isLoading = true;
      this.$axios.get("/api/person?page=" + this.currentPage ).then((res) => {
      this.people = res.data;
      this.isLoading = false;
    });
    }
  },
  async mounted() {
    this.listPage()
  },
};
</script>


<style scoped>
.presentacion {
  background-color: white;
  height: 1400px;
}

.head {
  background-color: rgb(219, 219, 219);
  height: 550px;
  margin: 0px;
}

.titulo-p {
  font-size: 60px;
  color: white;
}

.texto-p {
  font-size: 21px;
  color: white;
  font-weight: bold;
}

.fondo-texto {
  background-color: rgba(0, 0, 0, 0.3);
}
</style>