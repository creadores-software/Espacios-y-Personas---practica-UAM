<template>
  <div class="container person-container">
    <div class="row">
      <div class="col-8">
        <div class="head">
          <div v-if="person.image">
            <img
              border="3"
              :src="`http://127.0.0.1:5173/public/image/people/` + person.image"
              class="card-img-top img-fluid img-card mb-3 mt-5"
              alt="Espacios + Personas UAM"
            />
          </div>
          <div v-if="person.image == null">
            <img
              border="3"
              src="https://cdn.pixabay.com/photo/2022/08/09/19/27/people-7375689_960_720.png"
              class="card-img-top img-fluid img-card mb-3 mt-5"
              alt="Espacios + Personas UAM"
            />
          </div>

          <h3 class="fw-bold" style="">
            {{ person.firstname }} {{ person.secondname }} {{ person.lastname }}
            {{ person.secondLastname }}
          </h3>
        </div>
        <div class="body row" style="height: 400px">
          <div class="col pt-5">
            <div class="card shadow-lg">
              <div class="card-body" style="text-align: center">
                <h4 class="fw-bold">Información básica</h4>
                <p class="m-0 p-0">email: {{ person.public_email }}</p>
                <p class="m-0 p-0">cumpleaños: {{ person.birthday }}</p>
              </div>
            </div>
          </div>
          <div class="col pt-5" v-if="this.hasPersoncategories">
            <div class="card shadow-lg bg-body rounded">
              <div class="card-body" style="text-align: center">
                <h4 class="fw-bold">Información personal:</h4>
                <div v-for="category in personCategories" :key="category.id">
                  <p class="m-0 p-0">
                    {{ category.name }} : {{ category.value }}
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="col pt-5" v-if="this.hasWorkcategories">
            <div class="card shadow-lg">
              <div class="card-body" style="text-align: center">
                <h4 class="fw-bold">Información laboral:</h4>
                <div v-for="category in workCategories" :key="category.id">
                  <p class="m-0 p-0">
                    {{ category.name }} : {{ category.value }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <pre>
          {{ hasPersoncategories }}
          {{ hasWorkcategories }}
          {{ workcategories }}
        </pre>
      </div>
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
      workCategories: "",
    };
  },
  mounted() {
    this.$route.params.slug;
    console.log(this.$route.params.slug);
    this.getPerson();
  },
  methods: {
    getPerson() {
      this.$axios
        .get("/api/person/slug/" + this.$route.params.slug)
        .then((res) => {
          this.person = res.data;
          console.log(this.person);
          this.getWorkCategoriesFields();
          this.getPersonCategoriesFields();
        });
    },
    getPersonCategoriesFields() {
      this.$axios
        .get("/api/category/getPersonCategoriesFields/" + this.person.id)
        .then((res) => {
          console.log(res.data);
          console.log(this.person.id);
          this.personCategories = res.data;
          if (this.personCategories != "") {
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
          this.hasWorkcategories = true;
        });
    },
  },
};
</script>

<style scoped>
.img-card {
  width: 400px;
  height: 400px;
  border-radius: 200px;
  margin: auto;
}

.head {
  text-align: center;
}
</style>