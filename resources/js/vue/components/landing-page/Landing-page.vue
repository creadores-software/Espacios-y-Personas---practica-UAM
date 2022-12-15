<template>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand brand" v-on:click="goTo('Presentation')" href="#"
        ><h2>Espacios & Personas</h2></a
      >
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav nav-link-style me-auto mb-2 mb-lg-0 nav-field">
          <li class="nav-item">
            <a
              class="nav-link"
              v-on:click="goTo('Presentation')"
              aria-current="page"
              href="#"
              >Inicio</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" v-on:click="goTo('Spaces')" href="#">Espacios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" v-on:click="goTo('People')" href="#">Personas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" v-on:click="goTo('Login')" href="#">Ingresar</a>
          </li>
          <li class="nav-item" v-if="isAdmin">
            <a class="nav-link" v-on:click="goTo('Admin')" href="#">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" v-on:click="goTo('Seeker')" href="#">Buscador</a>
          </li>
        </ul>
        
        <!-- <form class="d-flex" role="search">
        
          <input
            class="form-control me-2"
            type="search"
            placeholder="Busca 'Bloque F'"
            aria-label="Search"
          />
          <button class="btn btn-outline-info" type="submit">Buscar</button>
        </form> -->
      </div>
    </div>
  </nav>
  <router-view></router-view>
  <FooterVue></FooterVue>
</template>

<script>
import FooterVue from "./Footer.vue";

export default {
  data() {
    return {
      isAuth: null,
      roles: null,
      isAdmin: null,
    };
  },
  components: {
    FooterVue,
  },
  methods: {
    goTo: function (ruta) {
      this.$router.push({ name: ruta });
    },
    getRol: function () {
      if (this.$cookies.get("auth")) {
        var idUser = this.$cookies.get("auth").user.id;
        this.$axios.get("/api/permissions/getUserPermissions/" + idUser).then((res) => {
          this.roles = res.data;
          console.log(this.roles);
          this.setRol();
        });
      }
    },
    setRol: function () {
      this.roles.forEach((element) => {
        console.log(element);
        if (element == "admin") {
          this.isAdmin = true;
        }
      });
    },
  },
  mounted() {
    this.isAuth = this.$root.isLoggedIn;
    console.log(this.isAuth);
    console.log(this.$root);
    this.getRol();
  },
};
</script>

<style scoped>
* {
  font-family: "Barlow Condensed", sans-serif;
}

.nav-link {
  color: #4984BD;
}

.nav-link:hover {
  color: #35628c;
}


.brand {
  color: black;
}
</style>
