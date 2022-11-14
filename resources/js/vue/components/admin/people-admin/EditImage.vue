<template>
  <div class="row container">
    <div class="col"></div>
    <div class="col box pb-4" v-if="person.image">
      <div style="text-align: center">
        {{ person.firstname }} {{ person.lastname }}
      </div>
      <img
        :src="`http://127.0.0.1:5173/public/image/people/` + person.image"
        alt=""
        class="pb-4"
      />
      
      <span class="file-name" v-if="file">
        {{ file.name }}
      </span>
    </div>
    <div class="col box" v-if="person.image == null">
      <img
        border="3"
        src="https://cdn.pixabay.com/photo/2022/08/09/19/27/people-7375689_960_720.png"
        class="card-img-top img-fluid img-card mb-3 mt-5"
        alt="Espacios + Personas UAM"
      />
    </div>
    <div class="col"></div>
    <o-field class="file">
        <o-upload v-model="file">
          <o-button tag="a" variant="primary">
            <o-icon icon="upload"></o-icon>
            <span>Cambiar imagen</span>
          </o-button>
        </o-upload>
      </o-field>
    <o-button v-if="file" @click="cargarImagen">Subir</o-button>
  </div>
</template>
<script>
import { useProgrammatic } from "@oruga-ui/oruga-next";
const { oruga } = useProgrammatic();
export default {
  mounted() {
    this.$route.params.slug;
    this.getPerson();
  },
  data() {
    return {
      config : {
          headers : { Authorization : ` Bearer ${this.$root.token}` }
      },
      person: "",
      file: null,
      personImage: "",
    };
  },

  methods: {
    cargarImagen() {
      const formData = new FormData();
      formData.append("image", this.file);
      this.$axios
        .post("/api/person/upload/" + this.$route.params.slug, formData,{
          headers: {
            "Content-Type": "multipart/form-data",
          },
        },this.config)
        .then((res) => {
          oruga.notification.open("Imagen creada con éxito.");
          this.getPerson();
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getPerson() {
      this.$axios
        .get("/api/person/slug/" + this.$route.params.slug,this.config)
        .then((res) => {
          this.person = res.data;
          this.personImage = "public/image/people/" + this.person.image;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style scoped>
.box {
  width: 300px;
  height: 300px;
}

.box img {
  width: 100%;
  height: 100%;
}

@supports (object-fit: cover) {
  .box img {
    height: 100%;
    object-fit: cover;
    object-position: center center;
  }
}
</style>