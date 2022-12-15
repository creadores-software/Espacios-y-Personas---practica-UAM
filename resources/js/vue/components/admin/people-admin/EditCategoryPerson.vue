<template>
  <div class="content">
    <section class="row">
      <div class="col-2"></div>
      <div class="col row pt-4">
        <h3 class="p-0 m-0">Editar Categorías</h3>
        <p class="text-muted">
          Admin <i class="bi bi-chevron-right size-icon"></i> {{ person.firstname }}
          {{ person.secondname }}
        </p>
        <div class="col-7">
          <h5 class="categoria" @click="cat_personal = !cat_personal">Categoría Personal</h5>
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
                    <o-input v-model="personCategoriesForm.phone" type="number"></o-input>
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
        <div class="col-5">
          <h5 class="categoria" @click="cat_laboral = !cat_laboral">Categoría Laboral</h5>
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
              
                <div class="col-auto pe-0">Oficina</div>
                <div class="col-2 ps-1"  >
                  <o-field>
                    <o-select v-model="workCategoriesForm.office" placeholder="Selecciona un espacio">
                      <option v-for="space in spaces" :value="space.id">{{space.name}}</option>
                    </o-select>
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
      </div>
    </section>
  </div>
</template>

<script>
import { useProgrammatic } from "@oruga-ui/oruga-next";
export default {
  data() {
    return {
      config: {
        headers: { Authorization: ` Bearer ${this.$root.token}` },
      },
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
        office: "",
      },
      lbuttonPersonCategory: "Guardar",
      lbuttonWorkCategory: "Guardar",
      spaces: "",
    };
  },
  async mounted() {
    this.$route.params.slug;
    console.log(this.$route.params.slug);
    this.getPerson();
    this.consultarEspacios();
  },
  methods: {
    consultarEspacios() {
      this.$axios
        .get("/api/space/", this.config)
        .then((res) => {
          this.spaces = res.data.data;
          console.log(this.spaces);
        });
    },
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
            this.savePersonCategory("Telefono", this.personCategoriesForm.phone);
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
            this.editPersonCategory("Telefono", this.personCategoriesForm.phone);
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
    deletePersonCategories() {
      const { oruga } = useProgrammatic();
      this.$axios
        .delete("/api/eliminarCategoriasPersonal/" + this.person.id, this.config)
        .then((res) => {
          console.log(res);
          oruga.notification.open("Categoría personal eliminada con éxito");
          this.$router.push({ name: "PersonList" });
        });
    },
    deleteWorkCategories() {
      const { oruga } = useProgrammatic();
      this.$axios
        .delete("/api/eliminarCategoriasLaboral/" + this.person.id, this.config)
        .then((res) => {
          console.log(res);
          oruga.notification.open("Categoría laboral eliminada con éxito");
          this.$router.push({ name: "PersonList" });
        });
    },
    saveWorkCategories() {
      const { oruga } = useProgrammatic();
      if (this.lbuttonWorkCategory == "Guardar") {
        //oruga.notification.open("Entro a guardar WORK");
        if (
          this.workCategoriesForm.empresa == "" ||
          this.workCategoriesForm.office == ""
        ) {
          oruga.notification.open("Rellena todos los campos");
        } else {
          try {
            this.saveWorkCategory("Empresa", this.workCategoriesForm.empresa);
            this.saveWorkCategory("Latitud", this.workCategoriesForm.latitud);
            this.saveWorkCategory("Longitud", this.workCategoriesForm.longitud);
            this.saveWorkCategory("Oficina", this.workCategoriesForm.office);
            oruga.notification.open("Exito");
            this.$router.push({ name: "PersonList" });
          } catch (error) {
            oruga.notification.open(error);
          }
        }
      } else {
        //oruga.notification.open("Este usuario ya tiene categorias: editar");
        if (
          this.workCategoriesForm.empresa == "" ||
          this.workCategoriesForm.office == ""
        ) {
          oruga.notification.open("Rellena todos los campos");
        } else {
          try {
            this.editWorkCategory("Empresa", this.workCategoriesForm.empresa);
            this.editWorkCategory("Oficina", this.workCategoriesForm.office);
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
        .post(
          "/api/categoryPersonFields",
          {
            name: name,
            value: value,
            category_person_id: 1,
            owner: this.person.id,
          },
          this.config
        )
        .then((res) => {
          console.log(res);
        });
    },
    saveWorkCategory(name, value) {
      //personCategoriesForm
      this.$axios
        .post(
          "/api/categoryPersonFields",
          {
            name: name,
            value: value,
            category_person_id: 2,
            owner: this.person.id,
          },
          this.config
        )
        .then((res) => {
          console.log(res);
        });
    },
    editWorkCategory(name, value) {
      this.$axios
        .patch(
          "/api/categoryPersonFields/" + this.person.id,
          {
            name: name,
            value: value,
            category_person_id: 2,
            owner: this.person.id,
          },
          this.config
        )
        .then((res) => {
          console.log(res);
        });
    },
    editPersonCategory(name, value) {
      this.$axios
        .patch(
          "/api/categoryPersonFields/" + this.person.id,
          {
            name: name,
            value: value,
            category_person_id: 1,
            owner: this.person.id,
          },
          this.config
        )
        .then((res) => {
          console.log(res);
        });
    },
    getPerson() {
      this.$axios
        .get("/api/person/slug/" + this.$route.params.slug, this.config)
        .then((res) => {
          this.person = res.data;
          console.log(this.person);
          this.getWorkCategoriesFields();
          this.getPersonCategoriesFields();
        });
    },
    getPersonCategoriesFields() {
      this.$axios
        .get("/api/category/getPersonCategoriesFields/" + this.person.id, this.config)
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
        .get("/api/category/getWorkCategoriesFields/" + this.person.id, this.config)
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
              if (element.name == "Oficina") {
                this.workCategoriesForm.office = element.value;
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

.categoria{
  cursor:pointer;
}
</style>
