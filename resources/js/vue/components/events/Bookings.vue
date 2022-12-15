<template>
  <div class="container">
    <div class="row container-booking">
      <div class="col-12">
        <h1 class="mt-4">¡Crea reservas para tus espacios!</h1>

        <h3 class="m-0 p-0">Espacio</h3>
        <small class="text-muted">
          Primero selecciona el espacio que quieres reservar
        </small>

        <o-field @click="cambio">
          <o-select v-model="spacesForm.space" placeholder="Selecciona un espacio">
            <option v-for="space in spaces" :value="space.id">{{ space.name }}</option>
          </o-select>
        </o-field>

        <div v-if="spacesForm.space">
          <h3 class="m-0 p-0">Nombre de la reserva</h3>
          <small class="text-muted"> Elije un nombre para tu reserva </small>
          <o-field>
            <o-input @click="obtenerReservas" v-model="spacesForm.title"></o-input>
          </o-field>
        </div>
        <div v-if="spacesForm.title">
          <h3 class="m-0 p-0">Descripción de la reserva</h3>
          <small class="text-muted"> Elije una descripción para tu reserva. </small>
          <o-field>
            <o-input type="textarea" v-model="spacesForm.description"></o-input>
          </o-field>
        </div>
        <div v-if="spacesForm.description">
          <h3 class="m-0 p-0">Reserva</h3>
          <small class="text-muted">
            Selecciona la fecha en la que deseas reservar el espacio.
          </small>
          <div class="col-12 p-0 m-0">
            <div class="row">
              <div class="col-auto">
                <v-date-picker v-model="date" :min-date="new Date()" />
              </div>
              <div class="col">
                <select
                  v-model="spacesForm.reserve"
                  class="form-select"
                  aria-label="Default select example"
                >
                  <option selected>Selecciona una hora para tu reserva</option>
                  <option value="8-10">8 AM - 10 AM</option>
                  <option value="10-12">10 AM - 12 PM</option>
                  <option value="2-4">2 PM - 4 PM</option>
                  <option value="4-6">4 PM - 6 PM</option>
                </select>
                <o-button class="mt-2" @click="crearReserva" variant="info"
                  >Crear reserva</o-button
                >
              </div>
            </div>
            <div class="row">
              <h3 class="mb-0 pb-0">Reservas de este espacio</h3>
              <small class="text-muted" v-if="dates.length == 0"> Este espacio no tiene reservas </small>
              <div class="col-3 pt-1 pb-4 mb-4" v-if="dates.length > 0">
                <v-calendar :attributes="attrs"> </v-calendar>
              </div>
              <div class="col-auto pt-1" v-if="dates.length > 0">
                    
                    <div class="card-text row">
                  <div class="col text-center">
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
                </div>
              </div>
            </div>
          </div>
        </div>
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
      date: new Date(),
      dates: [],
      attrs: [],

      reserveCard: {
        id: null,
        title: null,
        date: null,
        description: null,
        reserve: null,
      },
      spaces: null,
      spacesForm: {
        space: null,
        title: null,
        description: null,
        reserve: "Selecciona una hora para tu reserva",
      },
      timezone: "",
      modelConfig: {
        type: "string",
        mask: "iso",
      },
    };
  },
  methods: {
    cambio(){
      this.spacesForm.title = null;
      this.spacesForm.description = null;
    },
    obtenerReservas() {
      console.log(this.spacesForm.space);
      this.getReserves();
    },
    getReserves() {
      this.$axios
        .get("/api/space_reserves/getSpacesReserves/" + this.spacesForm.space)
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
    setReserveCardMounted() {
      console.log(this.dates);
      this.reserveCard.title = this.dates[0].title;
      var dateNoParsed = this.dates[0].date.substring(0, this.dates[0].date.indexOf("T"));
      this.reserveCard.date = dateNoParsed;
      //this.reserveCard.date = this.dates[0].date;

      this.reserveCard.description = this.dates[0].description;
      this.reserveCard.id = this.dates[0].id;
      this.reserveCard.reserve = this.dates[0].reserve;
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
    setReserveCard(date) {
      console.log(this.dates);
      this.reserveCard.title = date.title;
      var dateNoParsed = date.date.substring(0, this.dates[0].date.indexOf("T"));
      this.reserveCard.date = dateNoParsed;
      //this.reserveCard.date = date.date;

      this.reserveCard.description = date.description;
      this.reserveCard.id = date.id;
      this.reserveCard.reserve = date.reserve;
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
    getSpaces() {
      this.$axios.get("/api/space/").then((res) => {
        this.spaces = res.data.data;
        console.log(this.spaces);
      });
    },
    crearReserva() {
      this.$axios
        .post("/api/space_reserves/setSpacesReserves", {
          date: this.date,
          title: this.spacesForm.title,
          description: this.spacesForm.description,
          space_id: this.spacesForm.space,
          reserve: this.spacesForm.reserve,
        })
        .then((res) => {
          console.log(res.data);
          if (typeof res.data == "string" && res.data.includes("ERROR")) {
            oruga.notification.open(res.data);
          } else {
            oruga.notification.open("Reserva " + res.data.title + " creada exitosamente");
            this.$router.push({ name: "Admin" });
          }
        });
    },
  },
  mounted() {
    this.getSpaces();
  },
};
</script>

<style>
.container-booking {
  height: 1900px;
}
.reserve_card {
  height: 268px;
  width: 250px;
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
