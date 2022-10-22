<template>
  <div class="row pt-5">
    <div class="col"></div>
    <div class="col" style="text-align: center">
      <div class="card text-dark bg-light mb-5">
        <div class="card-body">
          <h4 class="fw-bold pb-2">{{ titleForm }}</h4>
          <form @submit.prevent="submit">
            <o-field
              label="Primer Nombre"
              :variant="errors.firstname ? 'danger' : 'primary'"
              :message="errors.firstname"
            >
              <o-input v-model="form.firstname" value=""> </o-input>
            </o-field>
            <o-field
              label="Segundo Nombre"
              :variant="errors.secondname ? 'danger' : 'primary'"
              :message="errors.secondname"
            >
              <o-input v-model="form.secondname" value=""> </o-input>
            </o-field>
            <o-field
              label="Apellido"
              :variant="errors.lastname ? 'danger' : 'primary'"
              :message="errors.lastname"
            >
              <o-input v-model="form.lastname" value=""> </o-input>
            </o-field>
            <o-field
              label="Segundo Apellido"
              :variant="errors.secondLastname ? 'danger' : 'primary'"
              :message="errors.secondLastname"
            >
              <o-input v-model="form.secondLastname" value=""> </o-input>
            </o-field>
            <o-field
              label="Cumpleaños"
              :variant="errors.birthday ? 'danger' : 'primary'"
              :message="errors.birthday"
            >
              <o-input v-model="form.birthday" value=""> </o-input>
            </o-field>
            <o-field
              type="email"
              label="Email público"
              :variant="errors.public_email ? 'danger' : 'primary'"
              :message="errors.public_email"
            >
              <o-input v-model="form.public_email" value=""> </o-input>
            </o-field>
            <o-button class="mt-2" variant="primary" native-type="submit">{{
              labelSubmit
            }}</o-button>
            <br />
            <small style="color: red">{{ this.generalError }}</small>
            <small style="color: green">{{ this.generalInfo }}</small>
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
      titleForm: "Crea una nueva persona",
      form: {
        firstname: "Julian",
        secondname: "David",
        lastname: "Navia",
        secondLastname: "Niño",
        public_email: "julianmensajes@hotmail.es",
        birthday: "04/12/1999",
        slug: "",
      },
      errors: {
        firstname: "",
        secondname: "",
        lastname: "",
        secondLastname: "",
        public_email: "",
        birthday: "",
      },
      person: "",
      labelSubmit: "Guardar",
      generalError: "",
      full_name: "",
      personSlug: "",
      hasErrors: false,
      generalInfo: "",
      anotherPerson: "",
      firstPersonSlug: "",
    };
  },

  mounted() {
    this.$route.params.slug;
    this.getPerson();
  },
  methods: {
    eliminar($slug) {
      this.$axios.delete("/api/person/" + $slug).then((res) => {});
    },
    cleanErrorsForm() {
      this.errors.firstname = "";
      this.errors.secondname = "";
      this.errors.lastname = "";
      this.errors.secondLastname = "";
      this.errors.public_email = "";
      this.errors.birthday = "";
      this.generalError = "";
      this.generalInfo = "";
    },
    comprobarCadena(cadena, name) {
      if (name == "firstname") {
        for (let i = 0; i < cadena.length; i++) {
          let caracter = cadena.charAt(i);

          if (this.isNumeric(caracter)) {
            console.log(caracter);
            this.errors.firstname = "Este campo no puede contener números.";
            this.hasErrors = true;
          }
        }
      }
      if (name == "secondname") {
        for (let i = 0; i < cadena.length; i++) {
          let caracter = cadena.charAt(i);

          if (this.isNumeric(caracter)) {
            console.log(caracter);
            this.errors.secondname = "Este campo no puede contener números.";
            this.hasErrors = true;
          }
        }
      }
      if (name == "lastname") {
        for (let i = 0; i < cadena.length; i++) {
          let caracter = cadena.charAt(i);

          if (this.isNumeric(caracter)) {
            console.log(caracter);
            this.errors.lastname = "Este campo no puede contener números.";
            this.hasErrors = true;
          }
        }
      }
      if (name == "secondLastname") {
        for (let i = 0; i < cadena.length; i++) {
          let caracter = cadena.charAt(i);

          if (this.isNumeric(caracter)) {
            console.log(caracter);
            this.errors.secondLastname =
              "Este campo no puede contener números.";
            this.hasErrors = true;
          }
        }
      }
      if (name == "public_email") {
        console.log("OK");
      }
      if (name == "birthday") {
        console.log("OK");
      }
      console.log(cadena);
    },
    submit() {
      this.cleanErrorsForm();
      this.hasErrors = false;
      //console.log(this.form);
      if (this.labelSubmit == "Guardar") {
        if (this.form.firstname == "") {
          this.errors.firstname = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.secondname == "") {
          this.errors.secondname = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.lastname == "") {
          this.errors.lastname = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.secondLastname == "") {
          this.errors.secondLastname = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.birthday == "") {
          this.errors.birthday = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.public_email == "") {
          this.errors.public_email = "Debes llenar este campo";
          this.hasErrors = true;
        }

        this.comprobarCadena(this.form.firstname, "firstname");
        this.comprobarCadena(this.form.secondname, "secondname");
        this.comprobarCadena(this.form.lastname, "lastname");
        this.comprobarCadena(this.form.secondLastname, "secondLastname");
        this.comprobarCadena(this.form.birthday, "birthday");
        this.comprobarCadena(this.form.public_email, "email");

        if (!this.hasErrors) {
          this.full_name =
            this.form.firstname +
            " " +
            this.form.secondname +
            " " +
            this.form.lastname +
            " " +
            this.form.secondLastname;
          this.$axios
            .get("/api/person/buildSlug/" + this.full_name)
            .then((res) => {
              this.personSlug = res.data;
              this.$axios
                .get("/api/person/slug/" + this.personSlug)
                .then((res) => {
                  this.person = res.data;
                  if (this.person) {
                    oruga.notification.open({
                      duration: 5000,
                      message: `"La persona que intentas agregar <b>ya existe</b>, prueba buscarla en el administrador de personas."`,
                      position: "bottom-right",
                      variant: "danger",
                      closable: true,
                      onClose: () => {
                        oruga.notification.open("Custom notification closed!");
                      },
                    });
                  }
                })
                .catch((err) => {
                  this.form.slug = this.personSlug;
                  this.$axios
                    .post("/api/person", this.form)
                    .then((res) => {
                      this.$axios
                        .get("/api/person/id/" + this.personSlug)
                        .then((res) => {
                          this.personId = res.data;
                          oruga.notification.open(
                            "Persona creada exitosamente."
                          );
                        })
                        .catch((err) => {
                          oruga.notification.open(err);
                        });
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
                        this.errors.birthday =
                          "La fecha ingresada no es válida.";

                      if (err.response.data.slug)
                        oruga.notification.open(
                          "La persona que intentas agregar ya existe, prueba buscarla en el administrador de personas."
                        );
                    });
                });
            });
        } else {
          this.generalError = "Algo no anda bien...";
        }
      }
      if (this.labelSubmit == "Editar") {
        if (this.form.firstname == "") {
          this.errors.firstname = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.secondname == "") {
          this.errors.secondname = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.lastname == "") {
          this.errors.lastname = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.secondLastname == "") {
          this.errors.secondLastname = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.birthday == "") {
          this.errors.birthday = "Debes llenar este campo";
          this.hasErrors = true;
        }
        if (this.form.public_email == "") {
          this.errors.public_email = "Debes llenar este campo";
          this.hasErrors = true;
        }

        this.comprobarCadena(this.form.firstname, "firstname");
        this.comprobarCadena(this.form.secondname, "secondname");
        this.comprobarCadena(this.form.lastname, "lastname");
        this.comprobarCadena(this.form.secondLastname, "secondLastname");
        this.comprobarCadena(this.form.birthday, "birthday");
        this.comprobarCadena(this.form.public_email, "email");

        if (!this.hasErrors) {
          this.full_name =
            this.form.firstname +
            " " +
            this.form.secondname +
            " " +
            this.form.lastname +
            " " +
            this.form.secondLastname;
          this.$axios
            .get("/api/person/buildSlug/" + this.full_name)
            .then((res) => {
              this.personSlug = res.data;
              this.form.slug = this.personSlug;
              this.$axios
                .put("/api/person/" + this.firstPersonSlug, this.form)
                .then((res) => {
                  oruga.notification.open({
                    duration: 5000,
                    message: `"Usuario editado exitosamente."`,
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

    getPerson() {
      this.$axios
        .get("/api/person/slug/" + this.$route.params.slug)
        .then((res) => {
          this.person = res.data;
          if (this.person) {
            this.labelSubmit = "Editar";
            this.titleForm = "Editando a " + this.person.firstname;
          }
          this.form.firstname = this.person.firstname;
          this.form.secondname = this.person.secondname;
          this.form.lastname = this.person.lastname;
          this.form.secondLastname = this.person.secondLastname;
          this.form.birthday = this.person.birthday;
          this.form.public_email = this.person.public_email;
          this.form.slug = this.person.slug;
          this.firstPersonSlug = this.person.slug;
          //console.log(this.person);
          // this.$axios.get("/api/person/id/" + this.person.slug).then((res) => {
          //   this.person.id = res.data;
          // });
        });
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