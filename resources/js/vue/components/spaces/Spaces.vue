<template>
  <header>
    <div class="absolute">
      <h1 class="fw-bold">Espacios UAM</h1>
    </div>
    <video
      src="./videos/student.mp4"
      id="video"
      autoplay="true"
      muted="true"
      loop="true"
      class="fluid"
    ></video>
  </header>
  <div class="pt-5">
    <section class="row align-items-center pt-5">
      <div class="col-2"></div>
      <div class="col">
        <div class="container-img pt-5">
          <img class="img-uam" src="./img/uam.png" alt="" />
        </div>
        <div class="card text-center">
          <div class="card-body">
            <h3 class="card-title">Bienvenido al buscador de espacios</h3>
            <p class="card-text">
              ¿Necesitas encontrar un espacio de la comunidad UAM en
              específico?, usa nuestro buscador personalizado.
            </p>
            <a href="#" class="btn btn-primary">Buscar</a>
          </div>
        </div>
      </div>
      <div class="col-2"></div>
    </section>
  </div>

  <div style="text-align: center" class="container">
    <section>
      <div class="row pt-5">
        <h2 class="pt-5 mb-5 fw-bold">Directorio espacios UAM</h2>
        <div
          :loading="isLoading"
          :data="
            spaces.current_page && spaces.data.lenght == 0 ? [] : spaces.data
          "
          class="col mt-5"
          v-for="s in spaces.data"
          :key="s.id"
        >
          <div class="card card-title" v-if="spaces.data" style="width: 20rem">
            <div class="card-body">
              <h3 class="card-text fs-4 fw-bold mb-0">
                {{ s.name }}
              </h3>
            </div>
            <img
              border="3"
              src="https://cdn.pixabay.com/photo/2015/07/10/15/13/building-839362_960_720.jpg"
              class="card-img-top img-fluid img-card mb-3"
              alt="Espacios + Personas UAM"
            />
            <div>
              <a>
                <router-link
                  :to="{ name: 'SpaceProfile', params: { slug: s.slug } }"
                  >Mirar perfil</router-link
                >
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <o-pagination
    @change="updatePage"
    v-if="spaces.current_page && spaces.data.length > 0"
    :total="spaces.total"
    v-model:current="currentPage"
    :range-before="2"
    :range-after="2"
    order="centered"
    :size="small"
    :simple="false"
    :rounded="true"
    :per-page="spaces.per_page"
    :icon-prev="prevIcon"
    :icon-next="nextIcon"
    aria-next-label="Siguiente página"
    aria-previous-label="Página anterior"
    aria-page-label="Página"
    aria-current-label="Página actual"
    class="pt-5 pb-5"
  >
  </o-pagination>
</template>

<script>
export default {
  data() {
    const data = [];
    return {
      spaces: [],
      isLoading: true,
      currentPage: 1,
      currentSpaces: null,
    };  
  },
  methods: {
    updatePage() {
      setTimeout(this.listPage, 100);
    },
    listPage(p) {
      this.isLoading = true;
      this.$axios.get("/api/space/indexPublic?page=" + this.currentPage).then((res) => {
        this.spaces = res.data;
        console.log(this.spaces.data);
        this.isLoading = false;
      });
    },
    goTo: function (ruta) {
      this.$router.push({ name: ruta });
    },
  },
  async mounted() {
    this.listPage();
  },
};
</script>
    
    <style scoped>
.absolute {
  width: 100%;
  height: 100%;
  top: 0;
  right: 0;
  position: absolute;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
}

header {
  width: 100%;
  height: auto;
  position: relative;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

video {
  width: 100%;
  height: auto;
  position: relative;
}

h1 {
  font-size: 80px;
  font-weight: 900;
  z-index: 100;
  color: white;
  margin-bottom: 30px;
}

h1::after {
  display: block;
  width: 30%;
  height: 10px;
  content: "";
  margin: auto;
  background: white;
}

.img-uam {
  height: 70%;
  width: 60%;
}

.container-img {
  text-align: center;
}
.img-card {
  width: 200px;
  height: 200px;
  border-radius: 100px;
  margin: auto;
}
</style>
    
    