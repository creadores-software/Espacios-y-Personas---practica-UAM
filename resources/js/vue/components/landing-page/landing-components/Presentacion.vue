<template>
  <div class="container presentacion p-0">
    <section class="row align-items-center pt-5">
      <div class="col-2"></div>
      <div class="col">
        <div class="container-img pt-5">
          <img class="img-uam" src="./img/uam.png" alt="" />
        </div>
        <div class="card text-center">
          <div class="card-body">
            <h3 class="card-title">Bienvenido a espacios y personas UAM</h3>
            <p class="card-text">
              ¿Necesitas encontrar un espacio o un miembro de la comunidad UAM en
              específico?, usa nuestro buscador personalizado.
            </p>
            <a @click="goTo('Seeker')" class="btn btn-primary">Buscar</a>
          </div>
        </div>
      </div>
      <div class="col-2"></div>
    </section>
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
      currentPage: 1,
    };
  },
  components: {
    ServiciosVue,
  },
  methods: {
    goTo: function (ruta) {
      this.$router.push({ name: ruta });
    },
    updatePage() {
      setTimeout(this.listPage, 100);
    },
    listPage(p) {
      this.isLoading = true;
      this.$axios.get("/api/person?page=" + this.currentPage).then((res) => {
        this.people = res.data;
        this.isLoading = false;
      });
    },
  },
  async mounted() {
    this.listPage();
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

.container-img {
  text-align: center;
}

.img-uam {
  height: 70%;
  width: 60%;
}
</style>
