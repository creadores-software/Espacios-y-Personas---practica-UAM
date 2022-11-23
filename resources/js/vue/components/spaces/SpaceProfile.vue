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
          <div class="col-12 pt-5">
            <div class="card shadow-lg">
              <div class="card-body" style="text-align: justify">
                <h4 class="fw-bold">Información:</h4>
                <p class="m-0 p-0">Descripción: {{ space.description }}</p>
                <p class="m-0 p-0">Capacidad: {{ space.capacity }}</p>
                <p class="m-0 p-0">Latitud: {{ space.latitude }}</p>
                <p class="m-0 p-0">Longitud: {{ space.longitude }}</p>
              </div>
            </div>
          </div>
          <div class="col-12 pt-1" v-if="owner">
            <div class="card shadow-lg">
              <div class="card-body" style="text-align: justify">
                <h4 class="fw-bold">Encargado del espacio</h4>
                <div class="card-text">
                  {{ owner.firstname }} {{ owner.secondname }} {{ owner.lastname }}
                </div>
                <div class="card-text">
                  <o-button inverted>
                    <router-link
                      :to="{ name: 'PersonProfile', params: { slug: owner.slug } }"
                      >Mirar perfil</router-link
                    >
                    
                  </o-button>
                  <o-button @click="printDate">
               Clickme
              </o-button>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 pt-1 mb-4">
            <div class="card shadow-lg">
              <div class="card-body" style="text-align: justify">
                <h4 class="fw-bold">Calendario</h4>
                <div class="card-text row">
                  <div class="col"></div>
                  <div class="col">
                    <v-calendar color="red" :attributes='attrs' is-dark />
                    
                  </div>
                  <div class="col">
                  <v-date-picker mode="date" v-model="date" is-range :model-config="modelConfig"/>
                  {{date}}
                  {{attrs[4]}}
                  
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>

      <div class="col-12" style="height: 500px">
        <pre></pre>
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
      owner: null,
      date: new Date(),
      dates: [],
      attrs: [
        {
          key: 0,
          highlight: true,
          dates: 'Wed Nov 30 2022 17:35:23 GMT-0500 (hora estándar de Colombia)',
        },
        {
          key: 1,
          highlight: true,
          dates: 'Wed Nov 29 2022 17:35:23 GMT-0500 (hora estándar de Colombia)',
        },
        {
          key: 4,
          bar: true,
          content: 'red',
          popover: { label: "Fecha importante 1", }, 
          dates: {start: '2022-11-09', end: '2022-11-11'},
        },
      ],
      modelConfig: {
        type: 'string',
        mask: 'YYYY-MM-DD', // Uses 'iso' if missing
      },
    };
  },
  mounted() {
    this.$route.params.slug;
    console.log(this.$route.params.slug);
    this.getSpace();
  },
  methods: {
    printDate() {
      console.log(this.date);
    },
    goProfile() {},
    getReserves(){
      this.$axios.get("/api/space_reserves/getSpacesReserves/" + this.space.id).then((res) => {
        this.dates = res.data;
        console.log(res.data);
      });
    },
    getSpace() {
      this.$axios.get("/api/space/slug/" + this.$route.params.slug).then((res) => {
        this.space = res.data;
        console.log(this.space);
        this.getOwner();
        this.getReserves();
      });
    },
    getOwner() {
      this.$axios.get("/api/person/publicPerson/" + this.space.manager).then((res) => {
        console.log(res.data);
        this.owner = res.data;
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
