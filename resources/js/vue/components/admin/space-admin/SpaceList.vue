<template>
  <div class="container">
    <h1>Lista de Espacios</h1>
    <div class="row">
      <o-table
        :loading="isLoading"
        :data="spaces.current_page && spaces.data.lenght == 0 ? [] : spaces.data"
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
        <o-table-column field="secondLastname" label="Zona" v-slot="p">
          {{ p.row.zone }}
        </o-table-column>
        <o-table-column field="public_email" label="Latitud" v-slot="p">
          {{ p.row.latitude }}
        </o-table-column>
        <o-table-column field="birthday" label="Longitud" v-slot="p">
          {{ p.row.longitude }}
        </o-table-column>
        <o-table-column field="slug" label="Acciones" v-slot="p">
          <div class="row">
            <div class="col-3 p-0 m-0">
              <o-button variant="info" class="btn-menu"
                ><router-link
                  class="p-0 m-0"
                  :to="{ name: 'SaveSpace', params: { slug: p.row.slug } }"
                  ><i class="bi bi-pencil-square"></i></router-link
                ></o-button
              >
            </div>
            
            <div class="col-3 p-0 m-0">
              <o-button variant="info" class="btn-menu"
                ><router-link
                  class="m-0 p-0"
                  :to="{ name: 'CategorySpace', params: { slug: p.row.slug } }"
                  ><i class="bi bi-file-earmark-person"></i></router-link
                ></o-button
              >
            </div>
            <div class="col-3 p-0 m-0">
              <o-button variant="info" class="btn-menu"
                ><router-link
                  class="p-0 m-0"
                  :to="{ name: 'ReservesSpace', params: { slug: p.row.slug } }"
                  ><i class="bi bi-journal-bookmark"></i></router-link
                ></o-button
              >
            </div>
            <div class="col-3">
              <o-button variant="danger" class="btn-menu" @click="eliminar(p.row.slug, p)"
                ><i class="bi bi-patch-minus"></i></o-button
              >
            </div>
          </div>
        </o-table-column>
      </o-table>
      <div class="row">
        <div class="col-12 pt-3 m-0 p-0 text-center">
          <o-button variant="info" class="btn-menu"
            ><router-link class="m-0 p-0" :to="{ name: 'SaveSpace' }"
              >Crear un nuevo espacio</router-link
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
      console.log(this.$root.token);
      const config = {
        headers: { Authorization: ` Bearer ${this.$root.token}` },
      };

      this.isLoading = true;
      this.$axios.get("/api/space?page=" + this.currentPage, config).then((res) => {
        this.spaces = res.data;
        this.isLoading = false;
      });
    },
  },
  async mounted() {
    console.log(this.$cookies.get("auth"));
    this.listPage();
  },
};
</script>

<style scoped>
a {
  color: white;
  text-decoration: none;
}

.btn-menu:hover{
  opacity: 0.8;
  z-index: 99;
}
</style>
