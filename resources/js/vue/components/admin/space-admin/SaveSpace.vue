<template>
  <div class="row pt-5">
    <div class="col"></div>
    <div class="col" style="text-align: center">
      <div class="card text-dark bg-light mb-5">
        <div class="card-body">
          <h4 class="fw-bold pb-2">{{ titleForm }}</h4>
          <form @submit.prevent="submit">
            <o-field
              label="Nombre"
              :variant="errors.name ? 'danger' : 'primary'"
              :message="errors.name"
              maxlength="100"
            >
              <o-input v-model="form.name" value=""> </o-input>
            </o-field>
            <o-field
              label="Descripción"
              :variant="errors.description ? 'danger' : 'primary'"
              :message="errors.description"
              maxlength="200"
            >
              <o-input v-model="form.description" value=""> </o-input>
            </o-field>
            <o-field
              label="Capacidad"
              type="number"
              :variant="errors.capacity ? 'danger' : 'primary'"
              :message="errors.capacity"
            >
              <o-input v-model="form.capacity" value=""> </o-input>
            </o-field>
            <o-field
              label="Zona"
              :variant="errors.zone ? 'danger' : 'primary'"
              :message="errors.zone"
            >
              <o-input v-model="form.zone" value=""> </o-input>
            </o-field>
            <o-field
              label="Latitud"
              :variant="errors.latitude ? 'danger' : 'primary'"
              :message="errors.latitude"
            >
              <o-input v-model="form.latitude" value=""> </o-input>
            </o-field>
            <o-field
              type="text"
              label="Longitud"
              :variant="errors.longitude ? 'danger' : 'primary'"
              :message="errors.longitude"
            >
              <o-input v-model="form.longitude" value=""> </o-input>
            </o-field>
            <o-button class="mt-2" variant="primary" native-type="submit">{{
              labelSubmit
            }}</o-button>
            <br />
            <small style="color: red">{{ this.generalError }}</small>
            <small style="color: green">{{ this.generalInfo }}</small>
            <small style="color: black">{{ this.selected }}</small>
          </form>
        </div>
      </div>
    </div>
    <div class="col"></div>
  </div>
</template>

<script>
import { useProgrammatic } from "@oruga-ui/oruga-next";
const { oruga } = useProgrammatic();
export default {
  data() {
    return {
      titleForm: "Crea un nuevo espacio",
      form: {
        name: "",
        description: "",
        capacity: 0,
        zone: "",
        latitude: "",
        longitude: "",
        //manager: "Don Jaime.",
      },
      errors: {
        name: "",
        description: "",
        capacity: "",
        zone: "",
        latitude: "",
        longitude: "",
      },
      space: "",
      labelSubmit: "Guardar",
      generalError: "",
      full_name: "",
      spaceSlug: "",
      hasErrors: false,
      generalInfo: "",
      anotherSlug: "",
      firstSpaceSlug: "", //Slug of the first space
    };
  },

  mounted() {
    this.$route.params.slug;
    this.getSpace();
  },

  methods: {
    getSpace() {
      this.$axios
        .get("/api/space/slug/" + this.$route.params.slug)
        .then((res) => {
          this.space = res.data;
          if (this.space) {
            this.labelSubmit = "Editar";
            
          }
          this.form.name = this.space.name;
          this.titleForm = "Editando a " + this.form.name;
          this.form.description = this.space.description;
          this.form.capacity = this.space.capacity;
          this.form.zone = this.space.zone;
          this.form.latitude = this.space.latitude;
          this.form.longitude = this.space.longitude;

          this.firstSpaceSlug = this.space.slug;

          //console.log(this.person);
          // this.$axios.get("/api/person/id/" + this.person.slug).then((res) => {
          //   this.person.id = res.data;
          // });
        });
    },
    cleanErrorsForm() {
      this.errors.name = "";
      this.errors.description = "";
      this.errors.capacity = "";
      this.errors.zone = "";
      this.errors.latitude = "";
      this.errors.longitude = "";
      this.generalError = "";
      this.generalInfo = "";
    },
    comprobarCadena(cadena, name) {
      if (name == "name") {
        for (let i = 0; i < cadena.length; i++) {
          let caracter = cadena.charAt(i);

          if (this.isNumeric(caracter)) {
            console.log(caracter);
            this.errors.name = "Este campo no puede contener números.";
            this.hasErrors = true;
          }
        }
      }
      if (name == "description") {
        console.log("OK");
      }
      if (name == "capacity") {
        for (let i = 0; i < cadena.length; i++) {
          let caracter = cadena.charAt(i);

          if (!this.isNumeric(caracter)) {
            console.log(caracter);
            this.errors.capacity = "Este campo debe contener números.";
            this.hasErrors = true;
          }
        }
      }
      if (name == "zone") {
        for (let i = 0; i < cadena.length; i++) {
          let caracter = cadena.charAt(i);

          if (this.isNumeric(caracter)) {
            console.log(caracter);
            this.errors.zone = "Este campo no puede contener números.";
            this.hasErrors = true;
          }
        }
      }
      if (name == "latitude") {
        console.log("OK");
      }
      if (name == "longitude") {
        console.log("OK");
      }
      console.log(cadena);
    },
    submit() {
      this.cleanErrorsForm();
      this.hasErrors = false;
      if (this.labelSubmit == "Guardar") {
        if (this.form.name == "") {
          this.errors.name = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.description == "") {
          this.errors.description = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.capacity == "") {
          this.errors.capacity = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.zone == "") {
          this.errors.zone = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.latitude == "") {
          this.errors.latitude = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.longitude == "") {
          this.errors.longitude = "Debes llenar este campo";
          this.hasErrors = true;
        }

        this.comprobarCadena(this.form.name, "name");
        this.comprobarCadena(this.form.description, "description");
        this.comprobarCadena(this.form.capacity, "capacity");
        this.comprobarCadena(this.form.zone, "zone");
        this.comprobarCadena(this.form.latitude, "latitude");
        this.comprobarCadena(this.form.longitude, "longitude");

        if (!this.hasErrors) {
          this.$axios
            .get("/api/person/buildSlug/" + this.form.name)
            .then((res) => {
              this.spaceSlug = res.data;
              this.$axios
                .get("/api/space/slug/" + this.spaceSlug)
                .then((res) => {
                  this.space = res.data;
                  if (this.space) {
                    oruga.notification.open({
                      duration: 5000,
                      message: `"El espacio que intentas agregar <b>ya existe</b>, prueba buscarlo en el administrador de espacios."`,
                      position: "bottom-right",
                      variant: "danger",
                      closable: true,
                    });
                  }
                })
                .catch((err) => {
                  this.form.slug = this.spaceSlug;
                  this.$axios
                    .post("/api/space", this.form)
                    .then((res) => {
                      oruga.notification.open("Espacio creado exitosamente.");
                    })
                    .catch((err) => {
                      //console.log(err.response.data);
                      if (err.response.data.name)
                        this.errors.name =
                          "El nombre que ingresaste no es válido.";

                      if (err.response.data.description)
                        this.errors.description =
                          "El nombre que ingresaste no es válido.";

                      if (err.response.data.zone)
                        this.errors.zone =
                          "El apellido que ingresaste no es válido.";

                      if (err.response.data.latitude)
                        this.errors.latitude =
                          "El apellido que ingresaste no es válido.";

                      if (err.response.data.latitude)
                        this.errors.latitude =
                          "El email que ingresaste no es válido.";

                      if (err.response.data.capacity)
                        this.errors.capacity =
                          "La fecha ingresada no es válida.";

                      if (err.response.data.slug)
                        oruga.notification.open(
                          "El espacio que intentas agregar ya existe, prueba buscarlo en el administrador de espacios."
                        );
                    });
                });
            });
        } else {
          this.generalError = "Algo no anda bien...";
        }
      }
      if (this.labelSubmit == "Editar") {
        if (this.form.name == "") {
          this.errors.name = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.description == "") {
          this.errors.description = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.capacity == "") {
          this.errors.capacity = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.zone == "") {
          this.errors.zone = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.latitude == "") {
          this.errors.latitude = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.longitude == "") {
          this.errors.longitude = "Debes llenar este campo";
          this.hasErrors = true;
        }

        this.comprobarCadena(this.form.name, "name");
        this.comprobarCadena(this.form.description, "description");
        this.comprobarCadena(this.form.capacity, "capacity");
        this.comprobarCadena(this.form.zone, "zone");
        this.comprobarCadena(this.form.latitude, "latitude");
        this.comprobarCadena(this.form.longitude, "longitude");

        if (!this.hasErrors) {
          this.$axios
            .get("/api/person/buildSlug/" + this.form.name)
            .then((res) => {
              this.spaceSlug = res.data;
              this.form.slug = this.spaceSlug;

              this.$axios
                .put("/api/space/" + this.firstSpaceSlug, this.form)
                .then((res) => {
                  oruga.notification.open({
                    duration: 5000,
                    message: `"Espacio editado exitosamente."`,
                    position: "bottom-right",
                    variant: "primary",
                    closable: true,
                  });
                  console.log(res);
                })
                .catch((err) => {
                  //console.log(err.response.data);
                  if (err.response.data.firstname)
                    this.errors.firstname =
                      "El nombre que ingresaste no es válido.";

                  if (err.response.data.secondname)
                    this.errors.secondname =
                      "El nombre que ingresaste no es válido.";

                  if (err.response.data.lastname)
                    this.errors.lastname =
                      "El apellido que ingresaste no es válido.";

                  if (err.response.data.secondLastname)
                    this.errors.secondLastname =
                      "El apellido que ingresaste no es válido.";

                  if (err.response.data.public_email)
                    this.errors.public_email =
                      "El email que ingresaste no es válido.";

                  if (err.response.data.birthday)
                    this.errors.birthday = "La fecha ingresada no es válida.";
                });
            });
        } else {
          this.generalError = "Algo no anda bien...";
        }
      }
    },
    isNumeric(val) {
      if (Number(val)) {
        return true;
      } else {
        return false;
      }
    },
  },
};
</script>