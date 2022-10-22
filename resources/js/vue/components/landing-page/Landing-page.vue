<template>
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" v-on:click="goTo('Presentation')" href="#">Espacios & Personas</a>
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
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-field">
            <li class="nav-item">
              <a class="nav-link" v-on:click="goTo('Presentation')" aria-current="page" href="#">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" v-on:click="goTo('Spaces')"   href="#">Espacios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" v-on:click="goTo('People')"  href="#">Personas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" v-on:click="goTo('Events')"  href="#">Eventos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" v-on:click="goTo('About')"  href="#">Acerca de</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" v-on:click="goTo('Login')"  href="#">Ingresar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" v-on:click="goTo('Admin')"  href="#">Admin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" v-on:click="goTo('Seeker')"  href="#">Buscador</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Busca 'Bloque F'"
              aria-label="Search"
            />
            <button class="btn btn-outline-info" type="submit">Buscar</button>
          </form>
        </div>
      </div>
    </nav>
    <router-view></router-view>
    <FooterVue></FooterVue>
</template>


<script>

import FooterVue from './Footer.vue';

export default {
  components: {
    FooterVue,
  },
  methods: {
    goTo: function(ruta) {
      this.$router.push({name : ruta});
    }
  }
}
</script>

<style>

*{
  font-family: 'Barlow Condensed', sans-serif;
}

</style>