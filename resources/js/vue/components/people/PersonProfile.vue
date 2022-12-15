<template>
  <div class="container">
    <div class="col-12 p-0">
      <section class="section-image container-people">
        <div class="row" v-if="person.image">
          <div class="col"></div>
          <div class="col">
            <img
              border="3"
              :src="`http://127.0.0.1:5173/public/image/people/` + person.image"
              class="card-img-top img-fluid img-card mb-3 mt-5"
              alt="Espacios + Personas UAM"
            />
          </div>
          <div class="col"></div>
        </div>
        <div class="row" v-if="person.image == null">
          <div class="col"></div>
          <div class="col">
            <img
              border="3"
              src="https://cdn.pixabay.com/photo/2022/08/09/19/27/people-7375689_960_720.png"
              class="card-img-top img-fluid img-card mb-3 mt-5"
              alt="Espacios + Personas UAM"
            />
          </div>
          <div class="col"></div>
        </div>
      </section>
      <section class="section-info row">
        <div class="col borde ml-2 mt-2 mb-2">
          <div class="card shadow-lg">
            <div class="card-body" style="text-align: center">
              <h4 class="fw-bold">Información básica</h4>
              <p class="m-0 p-0">email: {{ person.public_email }}</p>
              <p class="m-0 p-0">cumpleaños: {{ person.birthday }}</p>
            </div>
          </div>
          <div v-if="hasPersoncategories">
            <div class="card shadow-lg mt-2 bg-body rounded">
              <div class="card-body" style="text-align: center">
                <h4 class="fw-bold">Información personal</h4>
                <div v-for="category in personCategories" :key="category.id">
                  <p class="m-0 p-0">{{ category.name }} : {{ category.value }}</p>
                </div>
              </div>
            </div>
          </div>
          <div v-if="hasWorkcategories">
            <div class="card shadow-lg mt-2">
              <div class="card-body" style="text-align: center">
                <h4 class="fw-bold">Información laboral</h4>
                <div v-for="category in workCategories" :key="category.id">
                  <p class="m-0 p-0">{{ category.name }} : {{ category.value }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col mt-2 mb-2" v-if="office">
          <div class="card shadow-lg">
            <div class="card-body" style="text-align: center">
              <h4 class="fw-bold">Oficina</h4>
              <p>{{ office.name }}</p>
              <p>{{ office.zone }}</p>
              <o-button inverted>
                <router-link :to="{ name: 'SpaceProfile', params: { slug: office.slug } }"
                  >Mirar espacio</router-link
                >
              </o-button>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      person: "",
      personCategories: "",
      hasPersoncategories: false,
      hasWorkcategories: false,
      workCategories: "",
      office: "",
    };
  },
  mounted() {
    this.$route.params.slug;
    console.log(this.$route.params.slug);
    this.getPerson();
  },
  methods: {
    getPerson() {
      this.$axios.get("/api/person/slug/" + this.$route.params.slug).then((res) => {
        this.person = res.data;
        console.log(this.person);
        setTimeout(() => {
          this.getWorkCategoriesFields();
        }, 10);
        setTimeout(() => {
          this.getPersonCategoriesFields();
        }, 10);
      });
    },

    //borrar la categoría oficina del arreglo de categorias laborales y definir la oficina.
    setOffice() {
      let officeId = this.workCategories.find(({ name }) => name === "Oficina").value;

      this.$axios.get("/api/space/" + officeId).then((res) => {
        this.office = res.data;
        console.log(this.office);
      });

      this.workCategories.forEach((element, index) => {
        if (element.name == "Oficina") {
          this.workCategories.splice(index, 1);
        }

        console.log(this.workCategories);
      });

      console.log(officeId);
    },
    getPersonCategoriesFields() {
      this.$axios
        .get("/api/category/getPersonCategoriesFields/" + this.person.id)
        .then((res) => {
          console.log(res.data);
          console.log(this.person.id);
          this.personCategories = res.data;
          if(this.personCategories != ""){
            this.hasPersoncategories = true;
          }
        });
    },
    getWorkCategoriesFields() {
      this.$axios
        .get("/api/category/getWorkCategoriesFields/" + this.person.id)
        .then((res) => {
          console.log(res.data);
          this.workCategories = res.data;
          console.log("Cargando categorías");
          console.log(this.workCategories);
          if (this.workCategories != "") {
            this.hasWorkcategories = true;
          }
          this.setOffice();
        });
    },
  },
};
</script>

<style scoped>
.container-people {
  height: 500px;
  background-color: #e0e0e0;
}

.img-card {
  width: 400px;
  height: 400px;
  border-radius: 200px;
  margin: auto;
  background-color: #a0a0a0;
}

.section-info {
}

.head {
  text-align: center;
}

.person-container {
  background-color: #fff;
}

.card-img-top {
  border-radius: 400px;
}

.contenedor-img-top {
  background-color: black;
}

.container-img {
  text-align: center;
}
.borde {
  border-right-width: 2px;
  border-right-color: #e0e0e0;
  border-right-style: solid;
}
</style>
