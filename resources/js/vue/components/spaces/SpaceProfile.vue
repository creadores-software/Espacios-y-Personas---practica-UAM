<template>
  <div class="container person-container">
    <div class="row">
      <div class="col-12">
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
              <div class="card-body">
                <h6 class="fw-bold m-0 p-0">Descripción</h6>
                <p class="m-0 p-0">{{ space.description }}</p>
                <h6 class="fw-bold m-0 p-0">Capacidad:</h6>
                <p class="m-0 p-0">{{ space.capacity }} personas</p>
                <h6 class="fw-bold m-0 p-0">Coordenadas:</h6>
                <p class="m-0 p-0">( {{ space.latitude }} , {{ space.longitude }} )</p>
              </div>
            </div>
          </div>
          <div class="col-12 pt-1" v-if="owner">
            <div class="card shadow-lg">
              <div class="card-body" style="text-align: justify">
                <h6 class="fw-bold">Este espacio es administrado por:</h6>
                <div class="card-text">
                  {{ owner.firstname }} {{ owner.secondname }} {{ owner.lastname }}
                </div>
                <div class="card-text">
                  <div class="row">
                    <div class="col-auto">
                      <o-button inverted class="mr-4">
                        <router-link
                          :to="{ name: 'PersonProfile', params: { slug: owner.slug } }"
                          >Mirar perfil</router-link
                        >
                      </o-button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 pt-1 mb-4" v-if="dates.length > 0">
            <div class="card shadow-lg">
              <div class="card-body">
                <div class="card-text row">
                  <h4 class="fw-bold">Reservas & Calendario</h4>
                  <div class="col-3">
                    <div class="card reserve_card">
                      <div class="card-header">
                        <div class="row text-center">
                          <div
                            class="col-auto back_button"
                            @click="goBack(reserveCard.id)"
                          >
                            <i class="bi bi-chevron-left"></i>
                          </div>
                          <div class="col">
                            <h5 class="card-title fw-bold m-0 p-0">
                              {{ reserveCard.title }}
                            </h5>
                          </div>
                          <div
                            class="col-auto go_button"
                            @click="goAhead(reserveCard.id)"
                          >
                            <i class="bi bi-chevron-right"></i>
                          </div>
                        </div>
                      </div>

                      <div class="card-body">
                        <p>{{ reserveCard.description }}</p>
                        <p class="card-text"></p>
                      </div>

                      <div class="card-footer fw-bold text-center">
                        <i class="bi bi-calendar-event"></i> {{ reserveCard.date }}
                        <i class="bi bi-clock"></i> {{ reserveCard.reserve }}
                      </div>
                    </div>
                  </div>
                  <div class="col-auto text-center">
                    <v-calendar :attributes="attrs" is-dark> </v-calendar>
                  </div>
                  <div class="col"></div>
                </div>
                <div class="row"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12" style="height: 500px"></div>
    </div>
  </div>
</template>

<script>
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";
export default {
  data() {
    const date = new Date();
    const year = date.getFullYear();
    const month = date.getMonth();
    return {
      settings: {
        itemsToShow: 1,
        snapAlign: "center",
      },
      // breakpoints are mobile first
      // any settings not specified will fallback to the carousel settings
      breakpoints: {
        // 700px and up
        700: {
          itemsToShow: 3.5,
          snapAlign: "center",
        },
        // 1024 and up
        1024: {
          itemsToShow: 5,
          snapAlign: "start",
        },
      },
      reserveCard: {
        id: null,
        title: null,
        date: null,
        description: null,
        reserve: null,
      },
      timezone: "",
      categories: "",
      space: "",
      hasCategories: false,
      owner: null,
      date,
      dates: [],
      attrs: [],
    };
  },
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  async mounted() {
    this.$route.params.slug;
    console.log(this.$route.params.slug);
    this.getSpace();
  },
  methods: {
    goBack(index) {
      console.log(index);
      var anterior = index - 1;
      console.log(index);
      if (index == 0) {
        console.log("desborde abajo");
        anterior = this.dates.length - 1;
      }
      this.dates.forEach((date) => {
        console.log(date);
        if (anterior == date.id) {
          console.log("Este debería ser el anterior");
          console.log(date.id);
          this.setReserveCard(date);
        }
      });
    },
    goAhead(index) {
      var siguiente = index + 1;
      console.log(index);
      console.log(this.dates.length);
      if (index == this.dates.length - 1) {
        console.log("desborde arriba");
        siguiente = 0;
      }
      this.dates.forEach((date) => {
        if (siguiente == date.id) {
          console.log("Este debería ser el siguiente");
          console.log(date.id);
          this.setReserveCard(date);
        }
      });
    },
    printDate() {
      console.log(this.date);
    },
    // configDate(date){
    //   console.log(date.substring(2));
    // },
    setReserveCard(date) {
      console.log(this.dates);
      this.reserveCard.title = date.title;
      var dateNoParsed = date.date.substring(0, this.dates[0].date.indexOf("T"));
      this.reserveCard.date = dateNoParsed;
      this.reserveCard.reserve = date.reserve;

      this.reserveCard.description = date.description;
      this.reserveCard.id = date.id;
    },
    setReserveCardMounted() {
      console.log(this.dates);
      this.reserveCard.title = this.dates[0].title;
      var dateNoParsed = this.dates[0].date.substring(0, this.dates[0].date.indexOf("T"));
      this.reserveCard.date = dateNoParsed;
      this.reserveCard.reserve = this.dates[0].reserve;
      this.reserveCard.description = this.dates[0].description;
      this.reserveCard.id = this.dates[0].id;
    },
    goProfile() {},
    createReserves() {
      console.log(this.dates);
      this.dates.forEach((date, index) => {
        console.log("index" + index + " " + date);
        console.log(typeof date.date);
        if (typeof date.date === "string") {
          console.log("entro");
          var calendarDate = {
            key: date.id,
            highlight: true,
            popover: { label: date.title, visibility: "hover", hideIndicator: true },
            dates: date.date,
          };
          console.log(calendarDate);
          this.attrs.push(calendarDate);
        }
        console.log(this.attrs);
      });
      this.setReserveCardMounted();
    },
    getReserves() {
      this.$axios
        .get("/api/space_reserves/getSpacesReserves/" + this.space.id)
        .then((res) => {
          this.dates = res.data;
          console.log(res.data);
          this.orderIdReserves();
          this.createReserves();
        });
    },
    async orderIdReserves() {
      this.dates.forEach((date, index) => {
        date.id = index;
      });
      console.log("ordenados");
      console.log(this.dates);
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

.carousel__item {
  min-height: 200px;
  width: 100%;
  background-color: var(--vc-clr-primary);
  color: var(--vc-clr-white);
  font-size: 20px;
  border-radius: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.carousel__slide {
  padding: 10px;
}

.carousel__prev,
.carousel__next {
  box-sizing: content-box;
  border: 5px solid white;
}
.reserve_card {
  height: 268px;
}

.back_button {
  color: #718096;
  cursor: pointer;
  font-size: 1.2em;
}
.back_button:hover {
  color: #718096;
  transform: scale(1.3);
}

.go_button {
  color: #718096;
  cursor: pointer;
  font-size: 1.2em;
}
.go_button:hover {
  color: #718096;
  transform: scale(1.3);
}
</style>
