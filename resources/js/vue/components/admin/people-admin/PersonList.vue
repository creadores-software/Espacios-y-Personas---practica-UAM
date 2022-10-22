<template>
  <div class="container">
    <h1>Lista de personas</h1>
    <div class="row">
      <o-table
        :loading="isLoading"
        :data="
          people.current_page && people.data.lenght == 0 ? [] : people.data
        "
      >
        <o-table-column field="id" label="ID" numeric v-slot="p">
          {{ p.row.id }}
        </o-table-column>
        <o-table-column field="firstname" label="Primer nombre" v-slot="p">
          {{ p.row.firstname }}
        </o-table-column>
        <o-table-column field="secondname" label="Segundo nombre" v-slot="p">
          {{ p.row.secondname }}
        </o-table-column>
        <o-table-column field="lastname" label="Apellido" v-slot="p">
          {{ p.row.lastname }}
        </o-table-column>
        <o-table-column
          field="secondLastname"
          label="Segundo apellido"
          v-slot="p"
        >
          {{ p.row.secondLastname }}
        </o-table-column>
        <o-table-column field="public_email" label="Email" v-slot="p">
          {{ p.row.public_email }}
        </o-table-column>
        <o-table-column field="birthday" label="Fecha nacimiento" v-slot="p">
          {{ p.row.birthday }}
        </o-table-column>
        <o-table-column class="row" field="slug" label="Acciones" v-slot="p">
          <div class="col"><o-button variant="primary"><router-link
              class="pe-2"
              :to="{ name: 'EditCategoryPerson', params: { slug: p.row.slug } }"
              >Editar categorías</router-link
            ></o-button></div>
          <div class="col"><o-button variant="primary"
            ><router-link
              class="pe-2"
              :to="{ name: 'EditImagePerson', params: { slug: p.row.slug } }"
              >Editar imagen</router-link
            ></o-button
          ></div>
          <div class="col">
            <o-button variant="info"
            ><router-link
              class="pe-2"
              :to="{ name: 'Save', params: { slug: p.row.slug } }"
              >Editar</router-link
            ></o-button
          >
          </div>
          <div class="col">
            <o-button variant="danger" @click="eliminar(p.row.slug, p)"
            >Eliminar</o-button
          >
          </div>
          
          
        </o-table-column>
      </o-table>
      <div class="row">
        <div class="col-4 pt-3 m-0 p-0">
          <o-button variant="info"
            ><router-link class="m-0 p-0" :to="{ name: 'Save' }"
              ><p>Crear una nueva persona</p></router-link
            ></o-button
          >
        </div>
        <div class="col"></div>
      </div>
      <o-pagination
        @change="updatePage"
        v-if="people.current_page && people.data.length > 0"
        :total="people.total"
        v-model:current="currentPage"
        :range-before="2"
        :range-after="2"
        order="centered"
        :size="small"
        :simple="false"
        :rounded="true"
        :per-page="people.per_page"
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
      people: [],
      isLoading: true,
      currentPage: 1,
    };
  },
  methods: {
    eliminar($slug, row) {
      this.$axios.delete("/api/person/" + $slug).then((res) => {});
      this.people.data.splice(row.index, 1);
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
a {
  color: white;
  text-decoration: none;
}
</style>