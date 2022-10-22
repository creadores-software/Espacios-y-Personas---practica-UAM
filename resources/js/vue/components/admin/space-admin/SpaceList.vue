<template>
    <div class="container">
      <h1> Lista de Espacios </h1>
      <div class="row">
        <o-table
          :loading="isLoading"
          :data="
            spaces.current_page && spaces.data.lenght == 0 ? [] : spaces.data
          "
        >
          <o-table-column field="id" label="ID" numeric v-slot="p">
            {{ p.row.id }}
          </o-table-column>
          <o-table-column field="firstname" label="Nombre" v-slot="p">
            {{ p.row.name }}
          </o-table-column>
          <o-table-column field="secondname" label="Descripcion" v-slot="p">
            {{ p.row.description }}
          </o-table-column>
          <o-table-column field="lastname" label="Capacidad" v-slot="p">
            {{ p.row.capacity }} personas
          </o-table-column>
          <o-table-column
            field="secondLastname"
            label="Zona"
            v-slot="p"
          >
            {{ p.row.zone }}
          </o-table-column>
          <o-table-column field="public_email" label="Latitud" v-slot="p">
            {{ p.row.latitude }}
          </o-table-column>
          <o-table-column field="birthday" label="Longitud" v-slot="p">
            {{ p.row.longitude }}
          </o-table-column>
          <o-table-column field="slug" label="Acciones" v-slot="p">
            <o-button variant="info"
              ><router-link
                class="pe-2"
                :to="{ name: 'SaveSpace', params: { slug: p.row.slug } }"
                >Editar</router-link
              ></o-button
            >
            <o-button variant="danger" @click="eliminar(p.row.slug, p)"
              >Eliminar</o-button
            >
          </o-table-column>
        </o-table>
        <div class="row">
        <div class="col-4 pt-3 m-0 p-0">
          <o-button variant="info"
            ><router-link class="m-0 p-0" :to="{ name: 'SaveSpace' }"
              ><p>Crear un nuevo espacio</p></router-link
            ></o-button
          >
        </div>
        <div class="col"></div>
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
        >
        </o-pagination>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      const data = [];
      return {
        spaces: [],
        isLoading: true,
        currentPage: 1,
      };
    },
    methods: {
      eliminar($slug, row) {
        this.$axios.delete("/api/space/" + $slug).then((res) => {});
        this.spaces.data.splice(row.index, 1);
      },
      updatePage() {
        setTimeout(this.listPage, 100);
      },
      listPage(p) {
        this.isLoading = true;
        this.$axios.get("/api/space?page=" + this.currentPage).then((res) => {
          this.spaces = res.data;
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
  a {
    color: white;
    text-decoration: none;
  }
  </style>