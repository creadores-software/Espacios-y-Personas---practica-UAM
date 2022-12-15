<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="mt-4">¡Edita tus reservas!</h1>
        <h3 class="m-0 p-0">{{ space.name }}</h3>
        <small class="text-muted">
          Primero selecciona la reserva que deseas editar.
        </small>
      </div>

      <div class="col-3 pt-1 mb-4" v-if="dates.length > 0">
        <div class="card shadow-lg">
          <div class="card-body" style="text-align: justify">
            <div class="card-text row">
              <div class="col text-center">
                <h4 class="fw-bold">Reservas de este espacio</h4>
                <div class="card reserve_card">
                  <div class="card-header">
                    <div class="row text-center">
                      <div
                        class="col-auto back_button"
                        @click="goBack(reserveCard.index)"
                      >
                        <i class="bi bi-chevron-left"></i>
                      </div>
                      <div class="col">
                        <h5 class="card-title fw-bold m-0 p-0">
                          {{ reserveCard.title }}
                        </h5>
                      </div>
                      <div class="col-auto go_button" @click="goAhead(reserveCard.index)">
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
              <!-- <div class="col">
                    <h4 class="fw-bold">Date Picker</h4>
                    <v-date-picker
                      mode="date"
                      v-model="date"
                      :model-config="modelConfig"
                      is-required
                      :step="1"
                    />
                    <v-date-picker class="d-none" mode="time" v-model="date" />
                  </div> -->
            </div>
          </div>
        </div>
      </div>

      <div class="row pt-1 mb-4" v-if="dates.length > 0">
        <div class="col-3 text-center">
          <o-button variant="danger" @click="deleteBooking()">Eliminar reserva</o-button>
        </div>
      </div>
      <div v-else>
        <h5 class="m-0 p-0">
          Este espacio no tiene reservas activas, prueba crear una
          <a class="nav booking" @click="goTo('Bookings')">aquí.</a>
        </h5>
      </div>
    </div>
  </div>
</template>

<script>
import { useProgrammatic } from "@oruga-ui/oruga-next";
const { oruga } = useProgrammatic();
export default {
  data() {
    return {
      space: {},
      dates: [],
      attrs: [],
      reserveCard: {
        index: null,
        id: null,
        title: null,
        date: null,
        description: null,
        reserve: null
      },
      booking_id: null,
    };
  },

  async mounted() {
    this.$route.params.slug;
    console.log(this.$route.params.slug);
    this.getSpace();
  },

  methods: {
    goTo(ruta) {
      this.$router.push({ name: ruta });
    },

    deleteBooking() {
      this.$axios

        .post("/api/space_reserves/deleteSpaceReserve", {
          reserve_id: this.booking_id,
        })
        .then((res) => {
          console.log(res);
          this.getSpace();
          oruga.notification.open("¡Reserva eliminada de forma exitosa!");
        });
    },
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
        if (anterior == date.index) {
          console.log("Este debería ser el anterior");
          console.log(date.index);
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
        if (siguiente == date.index) {
          console.log("Este debería ser el siguiente");
          console.log(date.id);
          this.setReserveCard(date);
        }
      });
    },
    setReserveCard(date) {
      console.log(this.dates);
      this.reserveCard.title = date.title;
      var dateNoParsed = date.date.substring(0, this.dates[0].date.indexOf("T"));
      this.reserveCard.date = dateNoParsed;
      this.reserveCard.description = date.description;
      this.reserveCard.index = date.index;
      this.reserveCard.id = date.id;
      this.booking_id = date.id;
    },
    getSpace() {
      this.$axios.get("/api/space/slug/" + this.$route.params.slug).then((res) => {
        this.space = res.data;
        console.log(this.space);
        this.getReserves();
      });
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
        date.index = index;
      });
      console.log("ordenados");
      console.log(this.dates);
    },

    createReserves() {
      console.log(this.dates);
      this.dates.forEach((date, index) => {
        console.log("index" + index + " " + date);
        // if (typeof date.dates === "object") {
        //   var calendarDate = {
        //     key: date.id,
        //     highlight: true,
        //     popover: { label: date.tittle },
        //     dates: {  date.date},
        //   };
        //   this.attrs.push(calendarDate);
        // }

        console.log(typeof date.date);
        if (typeof date.date === "string") {
          console.log("entro");
          var calendarDate = {
            key: date.index,
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

    setReserveCardMounted() {
      console.log(this.dates);
      this.reserveCard.title = this.dates[0].title;
      var dateNoParsed = this.dates[0].date.substring(0, this.dates[0].date.indexOf("T"));
      this.reserveCard.date = dateNoParsed;
      this.reserveCard.description = this.dates[0].description;
      this.reserveCard.id = this.dates[0].id;
      this.reserveCard.index = 0;
      this.booking_id = this.dates[0].id;
    },
  },
};
</script>

<style .scoped>
.booking {
  cursor: pointer;
}
</style>
