<template>
    <div class="container person-container">
    <div class="row">
      <div class="col-8">
        <div class="head">
          <img
            border="3"
            src="https://cdn.pixabay.com/photo/2015/07/10/15/13/building-839362_960_720.jpg"
            class="card-img-top img-fluid img-card mb-3 mt-5"
            alt="Espacios + Personas UAM"
          />
          <h3 class="fw-bold" style="">
            {{ space.name }}
          </h3>
        </div>
        <div class="body row" style="height: 400px">
          <div class="col pt-5" >
            <div class="card shadow-lg">
              <div class="card-body" style="text-align: center;">
                <h4 class="fw-bold">Información:</h4>
                <p class="m-0 p-0">Descripción: {{ space.description }}</p>
                <p class="m-0 p-0">Capacidad: {{ space.capacity }}</p>
                <p class="m-0 p-0">Latitud: {{ space.latitude }}</p>
                <p class="m-0 p-0">Longitud: {{ space.longitude }}</p>
              </div>
            </div>
          </div>
          <div class="col pt-5" v-if="this.hasCategories">
            <div class="card shadow-lg" >
              <div class="card-body" style="text-align: center;">
                <h4 class="fw-bold">Categoría:</h4>
                <div v-for="category in categories" :key="category.id">
                  <p class="m-0 p-0">{{ category.value }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <pre>

        </pre>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
      data() {
        return {
          categories: "",
          space: "",
          hasCategories: false,
        };
      },
      mounted() {
        this.$route.params.slug;
        console.log(this.$route.params.slug);
        this.getSpace();
      },
      methods: {
        getSpace() {
          this.$axios
            .get("/api/space/slug/" + this.$route.params.slug)
            .then((res) => {
              this.space = res.data;
              console.log(this.space);
              this.getCategoriesFields();   
            });
        },
        getCategoriesFields() {
          this.$axios
            .get("/api/category/getSpaceCategoriesFields/" + this.space.id)
            .then((res) => {
              console.log(res.data);
              console.log(this.space.id);
              this.categories = res.data;
              if(this.categories != ""){
                this.hasCategories = true;
              }
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