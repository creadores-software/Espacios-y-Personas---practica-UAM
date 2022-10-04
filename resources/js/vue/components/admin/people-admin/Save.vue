<template>
  <div class="row pt-5">
    <div class="col"></div>
    <div class="col" style="text-align: center">
      <div class="card text-dark bg-light mb-5">
        <div class="card-body">
          <h4 class="fw-bold pb-2">Crea una nueva persona</h4>
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
              label="Email público"
              :variant="errors.public_email ? 'danger' : 'primary'"
              :message="errors.public_email"
            >
              <o-input v-model="form.public_email" value=""> </o-input>
            </o-field>

            <o-field>
              <o-switch
                v-model="c_personal"
                variant="info"
                @click="cleanCategoryPersonForm"
              >
                Categoría personal
              </o-switch>
            </o-field>
            <div v-if="c_personal">
              <div class="ml-5 mr-5">
                <o-field
                  label="rh"
                  :variant="
                    categoryPersonFieldsErrors.rh ? 'danger' : 'primary'
                  "
                  :message="categoryPersonFieldsErrors.rh"
                >
                  <o-select
                    placeholder="Selecciona el tipo de sangre"
                    v-model="form_category_person.rh"
                  >
                    <option value="A-">
                      {{ this.person_categories_options.rh[0] }}
                    </option>
                    <option value="A">
                      {{ this.person_categories_options.rh[1] }}
                    </option>
                    <option value="B">
                      {{ this.person_categories_options.rh[2] }}
                    </option>
                    <option value="B-">
                      {{ this.person_categories_options.rh[3] }}
                    </option>
                    <option value="O">
                      {{ this.person_categories_options.rh[4] }}
                    </option>
                    <option value="O-">
                      {{ this.person_categories_options.rh[5] }}
                    </option>
                    <option value="AB">
                      {{ this.person_categories_options.rh[6] }}
                    </option>
                  </o-select>
                </o-field>
                <o-field
                  label="Telefono"
                  :variant="
                    categoryPersonFieldsErrors.telefono ? 'danger' : 'primary'
                  "
                  :message="categoryPersonFieldsErrors.telefono"
                >
                  <o-input v-model="form_category_person.telefono" value="">
                  </o-input>
                </o-field>
                <o-field
                  label="Cedula"
                  :variant="
                    categoryPersonFieldsErrors.cedula ? 'danger' : 'primary'
                  "
                  :message="categoryPersonFieldsErrors.cedula"
                >
                  <o-input v-model="form_category_person.cedula" value="">
                  </o-input>
                </o-field>
                <o-field
                  label="Ciudad de nacimiento"
                  :variant="
                    categoryPersonFieldsErrors.ciudad_natal
                      ? 'danger'
                      : 'primary'
                  "
                  :message="categoryPersonFieldsErrors.ciudad_natal"
                >
                  <o-input v-model="form_category_person.ciudad_natal" value="">
                  </o-input>
                </o-field>
              </div>
            </div>

            <o-field>
              <o-switch
                v-model="c_laboral"
                variant="info"
                @click="cleanCategoryWorkForm"
              >
                Categoría laboral
              </o-switch>
            </o-field>

            <div v-if="c_laboral">
              <div class="ml-5 mr-5">
                <o-field
                  label="Empresa"
                  :variant="
                    categoryWorkFieldsErrors.empresa ? 'danger' : 'primary'
                  "
                  :message="categoryWorkFieldsErrors.empresa"
                >
                  <o-select
                    placeholder="Selecciona la empresa"
                    v-model="form_category_work.empresa"
                  >
                    <option value="UAM">
                      {{ this.work_categories_options.Empresa[0] }}
                    </option>
                  </o-select>
                </o-field>
              </div>
            </div>

            <o-button class="mt-2" variant="primary" native-type="submit">{{
              labelSubmit
            }}</o-button>
            <br />
            <small style="color: red">{{ this.generalError }}</small>
            <small style="color: green">{{ this.generalInfo }}</small>
            <small style="color: black">{{ this.selected }}</small>
            <small>{{this.form.slug}}</small>
          </form>
        </div>
      </div>
    </div>
    <div class="col"></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      category_error: false,
      categories: [],
      form: {
        firstname: "Julian",
        secondname: "David",
        lastname: "Navia",
        secondLastname: "Niño",
        public_email: "julianmensajes@hotmail.es",
        birthday: "04/12/1999",
        slug: "",
      },
      form_category_person: {
        rh: "",
        cedula: "",
        telefono: "",
        ciudad_natal: "",
      },
      form_category_work: {
        empresa: "",
        latitud: "",
        longitud: "",
      },
      errors: {
        firstname: "",
        secondname: "",
        lastname: "",
        secondLastname: "",
        public_email: "",
        birthday: "",
      },
      categoryPersonFieldsErrors: {
        rh: "",
        telefono: "",
        cedula: "",
        ciudad_natal: "",
      },
      categoryWorkFieldsErrors: {
        empresa: "",
      },
      c_personal: false,
      c_laboral: false,
      person: "",
      existPerson: "",
      new_slug: "",
      person_categories: "",
      person_categories_options: "",
      work_categories: "",
      work_categories_options: "",
      label_telefono: "",
      label_cedula: "",
      label_ciudad: "",
      personWithPersonCategories: "",
      field_to_post: {
        owner: "",
        category_person_id: "",
        name: "",
        value: "",
      },
      workCategoriesFields: "",
      personCategoriesFields: "",
      labelSubmit: "Guardar",
      generalError: "",
      full_name: "",
      personSlug: "",
      hasErrors: false,
      generalInfo: "",
      anotherPerson: "",
    };
  },

  mounted() {
    this.$route.params.slug;
    this.getPerson();
    this.getPersonCategories();
    this.getWorkCategories();
  },
  methods: {
    eliminar($slug) {
      this.$axios.delete("/api/person/" + $slug).then((res) => {});
    },
    cleanCategoryWorkForm() {
      this.form_category_work = {
        empresa: "",
      };
    },
    cleanCategoryPersonForm() {
      this.form_category_person = {
        rh: "",
        telefono: "",
        cedula: "",
        ciudad_natal: "",
      };
    },
    cleanErrorsForm() {
      this.errors.firstname = "";
      this.errors.secondname = "";
      this.errors.lastname = "";
      this.errors.secondLastname = "";
      this.errors.public_email = "";
      this.errors.birthday = "";
      this.generalError = "";
      this.category_error = false;
      (this.categoryPersonFieldsErrors = {
        rh: "",
        telefono: "",
        cedula: "",
        ciudad_natal: "",
      }),
        (this.categoryWorkFieldsErrors = {
          empresa: "",
        });
      this.generalInfo = "";
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
                    this.generalError =
                      "La persona que intentas agregar ya existe.";
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
                          //console.log(this.personId);

                          if (this.c_personal) {
                            if (this.form_category_person.rh == "") {
                              this.categoryPersonFieldsErrors.rh =
                                "primero define rh";
                              this.category_error = true;
                            }
                            if (this.form_category_person.telefono == "") {
                              this.categoryPersonFieldsErrors.telefono =
                                "primero define telefono";
                              this.category_error = true;
                            }
                            if (this.form_category_person.cedula == "") {
                              this.categoryPersonFieldsErrors.cedula =
                                "primero define cedula";
                              this.category_error = true;
                            }
                            if (this.form_category_person.ciudad_natal == "") {
                              this.categoryPersonFieldsErrors.ciudad_natal =
                                "primero define tu ciudad de nacimiento.";
                              this.category_error = true;
                            }
                            if (this.category_error == false) {
                              //console.log("entro a categoria personal.");
                              this.setFieldPersonCategory(
                                "rh",
                                this.form_category_person.rh
                              );
                              this.setFieldPersonCategory(
                                "telefono",
                                this.form_category_person.telefono
                              );
                              this.setFieldPersonCategory(
                                "cedula",
                                this.form_category_person.cedula
                              );
                              this.setFieldPersonCategory(
                                "ciudad_natal",
                                this.form_category_person.ciudad_natal
                              );
                            }
                          }

                          if (this.c_laboral) {
                            if (this.form_category_work.empresa == "") {
                              this.categoryWorkFieldsErrors.empresa =
                                "primero define el campo empresa.";
                              this.category_error = true;
                            }
                            if (this.category_error == false) {
                              this.setFieldWorkCategory(
                                "Empresa",
                                this.form_category_work.empresa
                              );
                            }
                          }

                          if (!this.c_laboral && !this.c_personal) {
                            this.generalInfo = "Persona creada exitosamente.";
                            oruga.notification.open("Sucess");
                          }

                          if (this.category_error == true) {
                            this.generalError =
                              "Error al vincular categorías con el usuario2.";
                            this.eliminar(this.personSlug);
                          } else {
                            oruga.notification.open("Sucess");
                          }
                        })
                        .catch((err) => {
                          // this.generalError =
                          //   "Error al vincular categorías con el usuario.";
                          // this.eliminar(this.personSlug); //console.log("Error al obtener el último usuario registrado.");
                        });

                      //this.personWithPersonCategories = res.data;
                      //console.log(this.personWithPersonCategories);
                    })
                    .catch((err) => {
                      //console.log(err.response.data);
                      if (err.response.data.firstname)
                        this.errors.firstname = err.response.data.firstname[0];

                      if (err.response.data.secondname)
                        this.errors.secondname =
                          err.response.data.secondname[0];

                      if (err.response.data.lastname)
                        this.errors.lastname = err.response.data.lastname[0];

                      if (err.response.data.secondLastname)
                        this.errors.secondLastname =
                          err.response.data.secondLastname[0];

                      if (err.response.data.public_email)
                        this.errors.public_email =
                          err.response.data.public_email[0];

                      if (err.response.data.birthday)
                        this.errors.birthday = err.response.data.birthday[0];

                      if (err.response.data.slug)
                        this.generalError = "Error Slug.";
                    });
                });
            });
        } else {
          this.generalError = "Te faltan campos por llenar.";
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

        if (!this.hasErrors) {
          if (this.person) {
            this.$axios
              .patch("/api/person/" + this.person.id, this.form)
              .then((res) => {
                console.log(res);
              })
              .catch((err) => {
                console.log(err);
              });
          }
        } else {
          this.generalError = "Te faltan campos por llenar.";
        }
      }

      //console.log(this.existPerson);
    },
    getPerson() {
      this.$axios
        .get("/api/person/slug/" + this.$route.params.slug)
        .then((res) => {
          this.person = res.data;
          if (this.person) {
            this.labelSubmit = "Editar";
          }
          this.form.firstname = this.person.firstname;
          this.form.secondname = this.person.secondname;
          this.form.lastname = this.person.lastname;
          this.form.secondLastname = this.person.secondLastname;
          this.form.birthday = this.person.birthday;
          this.form.public_email = this.person.public_email;
          this.form.slug = this.person.slug;
          this.getWorkCategoriesFields();
          this.getPersonCategoriesFields();
          //console.log(this.person);
          this.$axios.get("/api/person/id/" + this.person.slug).then((res) => {
            this.person.id = res.data;
          });
        });
    },
    getPersonCategories() {
      this.$axios.get("/api/category/getPersonCategories").then((res) => {
        this.person_categories = res.data;
        this.person_categories_options = JSON.parse(
          this.person_categories[0].options
        );
        //console.log(this.person_categories_options);
      });
    },
    getWorkCategories() {
      this.$axios.get("/api/category/getWorkCategories").then((res) => {
        this.work_categories = res.data;
        this.work_categories_options = JSON.parse(
          this.work_categories[0].options
        );
        //console.log(this.work_categories_options);
      });
    },
    setFieldWorkCategory(name, value) {
      this.field_to_post.owner = this.personId;
      this.field_to_post.category_person_id = 2;
      this.field_to_post.name = name;
      this.field_to_post.value = value;
      //console.log(this.field_to_post);
      this.$axios
        .post("/api/categoryPersonFields", this.field_to_post)
        .then((res) => {
          //console.log("categoría asignada con éxito!!!!");
        })
        .catch((err) => {
          this.category_error = true;
          //console.log("Error al vincular la categoría");
          if (name == "Empresa")
            this.categoryWorkFieldsErrors.empresa =
              "Error valor campo categoría " + name;
        });
    },
    setFieldPersonCategory(name, value) {
      this.field_to_post.owner = this.personId;
      this.field_to_post.category_person_id = 1;
      this.field_to_post.name = name;
      this.field_to_post.value = value;
      //console.log(this.field_to_post);
      this.$axios
        .post("/api/categoryPersonFields", this.field_to_post)
        .then(() => {
          //console.log("categoría asignada con éxito!!!!");
        })
        .catch(() => {
          this.category_error = true;
          //console.log(name);

          if (name == "cedula")
            this.categoryPersonFieldsErrors.cedula =
              "digita una cédula válida.";

          if (name == "telefono")
            this.categoryPersonFieldsErrors.telefono =
              "digita un número telefónico válido.";
          if (name == "rh")
            this.categoryPersonFieldsErrors.rh = "rh debe estar definido.";
          if (name == "ciudad_natal")
            this.categoryPersonFieldsErrors.ciudad_natal =
              "digita una ciudad de nacimiento entre 3 y 20 caracteres.";
        });
    },
    getWorkCategoriesFields() {
      this.$axios
        .get("/api/category/getWorkCategoriesFields/" + this.person.id)
        .then((res) => {
          //console.log(res.data);
          //console.log(this.person.id);
          this.workCategoriesFields = res.data;
          if (this.workCategoriesFields.length > 0) {
            this.c_laboral = true;
          }
          if (this.workCategoriesFields[0].name == "Empresa") {
            this.form_category_work.empresa =
              this.workCategoriesFields[0].value;
          }
        });
    },
    getPersonCategoriesFields() {
      this.$axios
        .get("/api/category/getPersonCategoriesFields/" + this.person.id)
        .then((res) => {
          console.log(res);
          //console.log(this.person.id);
          this.personCategoriesFields = res.data;
          if (this.personCategoriesFields.length > 0) {
            this.c_personal = true;
          }
          this.personCategoriesFields.forEach((personCategorie) => {
            if (personCategorie.name == "telefono") {
              this.form_category_person.telefono = personCategorie.value;
            }
            if (personCategorie.name == "ciudad_natal") {
              this.form_category_person.ciudad_natal = personCategorie.value;
            }
            if (personCategorie.name == "cedula") {
              this.form_category_person.cedula = personCategorie.value;
            }
            if (personCategorie.name == "rh") {
              this.form_category_person.rh = personCategorie.value;
            }
          });
        });
    },
  },
};
</script>