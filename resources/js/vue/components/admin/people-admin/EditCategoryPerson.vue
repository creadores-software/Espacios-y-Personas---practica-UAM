<template>
  {{personCategories}}
  <!-- <div class="container person-container">
    <div class="row pt-4">
      <div class="col-4">
        <div class="head">
          <div class="row">
            <div class="col"></div>
            <div class="col">
              <h3 class="fw-bold pt-4">
                {{ person.firstname }} {{ person.secondname }}
              </h3>
              <div>
                <o-collapse :open="false" aria-id="contentIdForA11y1">
                  <template #trigger>
                    <o-button
                      variant="info"
                      aria-controls="contentIdForA11y1"
                      outlined
                    >
                      Añadir categoría personal
                    </o-button>
                  </template>
                  <div class="notification">
                    <h3>Categoría personal</h3>
                    <div class="row">
                      <div class="col-auto">
                        <o-field>
                          <o-switch v-model="active">Rh</o-switch>
                        </o-field>
                      </div>
                      <div v-if="active" class="col">
                        <pre>{{ personCategoriesForm.rh }}</pre>
                      </div>
                    </div>
                  </div>
                </o-collapse>
              </div>
              <div>
                <o-button variant="success">
                  Añadir categoría laboral
                </o-button>
              </div>

              <div class="col"></div>
            </div>
          </div>
        </div>
        <div class="body row" style="height: 400px">
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
  </div> -->
  <div class="content">
    <section class="row">
      <div class="col-2"></div>
      <div class="col row pt-4">
        <h3 class="p-0 m-0">Editar Categorías</h3>
        <p class="text-muted">
          Admin <i class="bi bi-chevron-right size-icon"></i>
          {{ person.firstname }} {{ person.secondname }}
        </p>
        <div class="col-7">
          <h5 @click="cat_personal = !cat_personal">Categoría Personal</h5>
          <div v-if="cat_personal">
            <form @submit.prevent="submit">
              <div class="row">
                <div class="col-auto">RH</div>
                <div class="col">
                  <o-field>
                    <o-select
                      v-model="personCategoriesForm.rh"
                      placeholder="Rh"
                      rounded
                      size="sm"
                    >
                      <option value="A-">A-</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="B-">B-</option>
                      <option value="O">O</option>
                      <option value="O-">O-</option>
                      <option value="AB">AB</option>
                    </o-select>
                  </o-field>
                </div>
              </div>
              <div class="row">
                <div class="col-auto pe-0">Telefono</div>
                <div class="col-2 ps-1">
                  <o-field>
                    <o-input
                      v-model="personCategoriesForm.phone"
                      type="number"
                    ></o-input>
                  </o-field>
                </div>
              </div>
              <div class="row">
                <div class="col-auto pe-0">Cedula</div>
                <div class="col-2 ps-1">
                  <o-field>
                    <o-input
                      maxlength="14"
                      v-model="personCategoriesForm.cc"
                      type="number"
                    ></o-input>
                  </o-field>
                </div>
              </div>
              <div class="row">
                <div class="col-auto pe-0">Ciudad nacimiento</div>
                <div class="col-2 ps-1">
                  <o-field>
                    <o-input
                      type="date"
                      v-model="personCategoriesForm.born_city"
                    ></o-input>
                  </o-field>
                </div>
              </div>
              <o-button @click="savePersonCategories">
                {{ lbuttonPersonCategory }}
              </o-button>
              <o-button variant="danger" @click="deletePersonCategories">
                Eliminar
              </o-button>
              

            </form>
          </div>
        </div>
        <div class="col">
          <h5 @click="cat_laboral = !cat_laboral">Categoría Laboral</h5>
          <div v-if="cat_laboral">
            <form @submit.prevent="submit">
              <div class="row">
                <div class="col-auto">Empresa</div>
                <div class="col">
                  <o-field>
                    <o-select
                      v-model="workCategoriesForm.empresa"
                      placeholder="Rh"
                      rounded
                      size="sm"
                    >
                      <option value="UAM">UAM</option>
                    </o-select>
                  </o-field>
                </div>
              </div>
              <div class="row">
                <div class="col-auto pe-0">Latitud</div>
                <div class="col-2 ps-1">
                  <o-field>
                    <o-input
                      v-model="workCategoriesForm.latitud"
                      type="number"
                    ></o-input>
                  </o-field>
                </div>
              </div>
              <div class="row">
                <div class="col-auto pe-0">Longitud</div>
                <div class="col-2 ps-1">
                  <o-field>
                    <o-input
                      v-model="workCategoriesForm.longitud"
                      type="number"
                    ></o-input>
                  </o-field>
                </div>
              </div>
              <o-button @click="saveWorkCategories">
                {{ lbuttonWorkCategory }}
              </o-button>
              <o-button variant="danger" @click="deleteWorkCategories">
                Eliminar
              </o-button>
            </form>
          </div>
        </div>
        <!-- 
        
        
         -->

        <!-- <h5 @click="cat_personal = !cat_personal">Categoría Personal</h5>
        <div class="row" v-if="cat_personal">
          <div class="col"></div>
        </div>

        <h5 @click="cat_laboral = !cat_laboral">Categoría Laboral</h5>
        <div class="row" v-if="cat_laboral">
          <div class="col">
            <form @submit.prevent="submit">
              <div class="row">
                <div class="col-auto">Empresa</div>
                <div class="col">
                  <o-field>
                    <o-select
                      v-model="workCategoriesForm.empresa"
                      placeholder="Rh"
                      rounded
                      size="sm"
                    >
                      <option value="UAM">UAM</option>
                    </o-select>
                  </o-field>
                </div>
              </div>
              <div class="row">
                <div class="col-auto pe-0">Latitud</div>
                <div class="col-2 ps-1">
                  <o-field>
                    <o-input
                      v-model="workCategoriesForm.latitud"
                      type="number"
                    ></o-input>
                  </o-field>
                </div>
              </div>
              <div class="row">
                <div class="col-auto pe-0">Longitud</div>
                <div class="col-2 ps-1">
                  <o-field>
                    <o-input
                      v-model="workCategoriesForm.longitud"
                      type="number"
                    ></o-input>
                  </o-field>
                </div>
              </div>
              <o-button @click="saveWorkCategories">
                {{ lbuttonWorkCategory }}
              </o-button>
            </form>
          </div>
        </div> -->
      </div>
    </section>
  </div>
</template>

<script>
import { useProgrammatic } from "@oruga-ui/oruga-next";
export default {
  data() {
    return {
      personCategories: [],
      cat_laboral: false,
      cat_personal: false,
      active: false,
      person: "",
      hasPersoncategories: false,
      workCategories: "",
      personCategoriesForm: {
        rh: "",
        phone: "",
        cc: "",
        born_city: "",
      },
      workCategoriesForm: {
        empresa: "",
        longitud: "",
        latitud: "",
      },
      lbuttonPersonCategory: "Guardar",
      lbuttonWorkCategory: "Guardar",
    };
  },
  async mounted() {
    this.$route.params.slug;
    console.log(this.$route.params.slug);
    this.getPerson();
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });
  },
  methods: {
    savePersonCategories() {
      const { oruga } = useProgrammatic();
      if (this.lbuttonPersonCategory == "Guardar") {
        oruga.notification.open("Entro a guardar");
        if (
          this.personCategoriesForm.rh == "" ||
          this.personCategoriesForm.phone == "" ||
          this.personCategoriesForm.cc == "" ||
          this.personCategoriesForm.born_city == ""
        ) {
          oruga.notification.open("Rellena todos los campos");
        } else {
          try {
            this.savePersonCategory("Rh", this.personCategoriesForm.rh);
            this.savePersonCategory(
              "Telefono",
              this.personCategoriesForm.phone
            );
            this.savePersonCategory("Cedula", this.personCategoriesForm.cc);
            this.savePersonCategory(
              "Ciudad Nacimiento",
              this.personCategoriesForm.born_city
            );
            oruga.notification.open("Exito");
            this.$router.push({ name: "PersonList" });
          } catch (error) {
            oruga.notification.open("Error al crear categorías");
          }
        }
      } else {
        oruga.notification.open("Editando");
        if (
          this.personCategoriesForm.rh == "" ||
          this.personCategoriesForm.phone == "" ||
          this.personCategoriesForm.cc == "" ||
          this.personCategoriesForm.born_city == ""
        ) {
          oruga.notification.open("Rellena todos los campos");
        } else {
          try {
            this.editPersonCategory("Rh", this.personCategoriesForm.rh);
            this.editPersonCategory(
              "Telefono",
              this.personCategoriesForm.phone
            );
            this.editPersonCategory("Cedula", this.personCategoriesForm.cc);
            this.editPersonCategory(
              "Ciudad Nacimiento",
              this.personCategoriesForm.born_city
            );
            oruga.notification.open("Exito");
            this.$router.push({ name: "PersonList" });
          } catch (error) {
            oruga.notification.open(error);
          }
        }
      }
    },
    deletePersonCategories(){
      const { oruga } = useProgrammatic();
      this.$axios
        .delete("/api/eliminarCategoriasPersonal/1" + this.person.id)
        .then((res) => {
          console.log(res);
          oruga.notification.open("Categoría personal eliminada con éxito");
            this.$router.push({ name: "PersonList" });
        });
    },
    deleteWorkCategories(){
      const { oruga } = useProgrammatic();
      this.$axios
        .delete("/api/eliminarCategoriasLaboral/1" + this.person.id)
        .then((res) => {
          console.log(res);
          oruga.notification.open("Categoría laboral eliminada con éxito");
            this.$router.push({ name: "PersonList" });
        });
    },
    saveWorkCategories() {
      const { oruga } = useProgrammatic();
      if (this.lbuttonWorkCategory == "Guardar") {
        oruga.notification.open("Entro a guardar WROK");
        if (
          this.workCategoriesForm.empresa == "" ||
          this.workCategoriesForm.latitud == "" ||
          this.workCategoriesForm.longitud == ""
        ) {
          oruga.notification.open("Rellena todos los campos");
        } else {
          try {
            this.saveWorkCategory("Empresa", this.workCategoriesForm.empresa);
            this.saveWorkCategory("Latitud", this.workCategoriesForm.latitud);
            this.saveWorkCategory("Longitud", this.workCategoriesForm.longitud);
            oruga.notification.open("Exito");
            this.$router.push({ name: "PersonList" });
          } catch (error) {
            oruga.notification.open(error);
          }
        }
      } else {
        oruga.notification.open("Este usuario ya tiene categorias: editar");
        if (
          this.workCategoriesForm.empresa == "" ||
          this.workCategoriesForm.latitud == "" ||
          this.workCategoriesForm.longitud == ""
        ) {
          oruga.notification.open("Rellena todos los campos");
        } else {
          try {
            this.editWorkCategory("Empresa", this.workCategoriesForm.empresa);
            this.editWorkCategory("Latitud", this.workCategoriesForm.latitud);
            this.editWorkCategory("Longitud", this.workCategoriesForm.longitud);
            oruga.notification.open("Exito");
            this.$router.push({ name: "Admin" });
          } catch (error) {
            oruga.notification.open(error);
          }
        }
      }
    },
    savePersonCategory(name, value) {
      //personCategoriesForm
      this.$axios
        .post("/api/categoryPersonFields", {
          name: name,
          value: value,
          category_person_id: 1,
          owner: this.person.id,
        })
        .then((res) => {
          console.log(res);
        });
    },
    saveWorkCategory(name, value) {
      //personCategoriesForm
      this.$axios
        .post("/api/categoryPersonFields", {
          name: name,
          value: value,
          category_person_id: 2,
          owner: this.person.id,
        })
        .then((res) => {
          console.log(res);
        });
    },
    editWorkCategory(name, value) {
      this.$axios
        .patch("/api/categoryPersonFields/" + this.person.id, {
          name: name,
          value: value,
          category_person_id: 2,
          owner: this.person.id,
        })
        .then((res) => {
          console.log(res);
        });
    },
    editPersonCategory(name, value) {
      this.$axios
        .patch("/api/categoryPersonFields/" + this.person.id, {
          name: name,
          value: value,
          category_person_id: 1,
          owner: this.person.id,
        })
        .then((res) => {
          console.log(res);
        });
    },
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
            this.cat_personal = true;
            this.lbuttonPersonCategory = "Editar";
            // for(let i = 0; i < this.personCategories.lenght; i++){
            //   if(this.personCategories[i].name == "Telefono"){

            //   }
            // }
            this.personCategories.forEach((element) => {
              if (element.name == "Rh") {
                this.personCategoriesForm.rh = element.value;
              }
              if (element.name == "Telefono") {
                this.personCategoriesForm.phone = element.value;
              }
              if (element.name == "Ciudad Nacimiento") {
                this.personCategoriesForm.born_city = element.value;
              }
              if (element.name == "Cedula") {
                this.personCategoriesForm.cc = element.value;
              }
            });
            // this.personCategoriesForm.rh = personCategories[0]
            //   this.personCategoriesForm.phone =
            //   this.personCategoriesForm.cc =
            //   this.personCategoriesForm.born_city =
          }
        });
    },
    getWorkCategoriesFields() {
      this.$axios
        .get("/api/category/getWorkCategoriesFields/" + this.person.id)
        .then((res) => {
          console.log(res.data);
          this.workCategories = res.data;
          console.log("Cargando categorías laborales");
          console.log(this.workCategories);
          if (this.workCategories != "") {
            this.cat_laboral = true;
            this.lbuttonWorkCategory = "Editar";
            this.workCategories.forEach((element) => {
              if (element.name == "Empresa") {
                this.workCategoriesForm.empresa = element.value;
              }
              if (element.name == "Longitud") {
                this.workCategoriesForm.longitud = element.value;
              }
              if (element.name == "Latitud") {
                this.workCategoriesForm.latitud = element.value;
              }
            });
          }
        });
    },
  },
};
</script>

<style>
.content {
  background-color: #f5f7fa;
}

.size-icon {
  font-size: 0.75em;
}
</style>