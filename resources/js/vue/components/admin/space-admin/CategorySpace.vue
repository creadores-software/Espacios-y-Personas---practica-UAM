<template>
  <div class="container">
    Editar encargado espacio.<i class="bi bi-chevron-right size-icon"></i>
    <div class="row">
      <div class="col-auto pe-0">Encargado</div>
      <div class="col-2 ps-1">
        <o-field>
          <o-select v-model="peopleForm.owner" placeholder="Selecciona una persona">
            <option v-for="person in people" :value="person.id">
              {{ person.firstname + " " + person.secondname }}
            </option>
          </o-select>
        </o-field>
        <o-button @click="setOwner"> Guardar </o-button>
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
      people: null,
      peopleForm: {
        owner: null,
      },
    };
  },
  mounted() {
    this.$route.params.slug;
    this.getPeople();
  },
  methods: {
    getPeople() {
      this.$axios.post("/api/person/getAll").then((res) => {
        this.people = res.data;
        console.log(this.people);
        this.isLoading = false;
      });
    },
    setOwner() {
      if (this.peopleForm.owner) {
        this.$axios
          .put(
            "/api/space/" + this.$route.params.slug,
            { manager: this.peopleForm.owner },
            this.config
          )
          .then((res) => {
            oruga.notification.open({
              duration: 5000,
              message: `"Espacio editado exitosamente."`,
              position: "bottom-right",
              variant: "primary",
              closable: true,
            });
            console.log(res);
            this.$router.push({ name: 'SpaceList'})
          })
          .catch((err) => {
            oruga.notification.open({
              duration: 5000,
              message: err,
              position: "bottom-right",
              variant: "danger",
              closable: true,
            });
          });
      } else {
        oruga.notification.open({
          duration: 5000,
          message: `"Por favor selecciona una persona válida."`,
          position: "bottom-right",
          variant: "danger",
          closable: true,
        });
      }
    },
  },
};
</script>
