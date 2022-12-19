<template>
  <div class="container">
    <div class="login-container row align-items-center">
      <div class="col"></div>

      <div class="col card text-dark bg-light mb-3" style="max-width: 18rem">
        <div class="card-body">
          <h5 class="card-title">Autenticación</h5>
          <form @submit.prevent="login">
            <o-field
              :variant="errors.login ? 'danger' : 'primary'"
              :message="errors.login"
              label="Email"
            >
              <o-input v-model="form.email" type="email"> </o-input>
            </o-field>
            <o-field
              :variant="errors.password ? 'danger' : 'primary'"
              :message="errors.password"
              label="Password"
            >
              <o-input v-model="form.password" type="password"> </o-input>
            </o-field>
            <br />
            <o-button variant="info" native-type="submit">Login</o-button>
          </form>
        </div>
      </div>

      <div class="col"></div>
    </div>
  </div>
</template>

<script>
import { useProgrammatic } from "@oruga-ui/oruga-next";
export default {
  setup() {
    const { oruga } = useProgrammatic();
  },
  data: () => ({
    user: {},
    form: {
      email: "admin@hotmail.com",
      password: "password",
    },
    errors: {
      login: "",
      password: "",
    },
  }),
  methods: {
    goTo: function (ruta) {
      this.$router.push({ name: ruta });
    },
    cleanErrorsForm() {
      this.errors.login = "";
      this.errors.password = "";
    },
    login() {
      const { oruga } = useProgrammatic();
      this.cleanErrorsForm();
      console.log("Enviando formulario", this.form);
      this.$axios.defaults.withCredentials = true;
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
        .post("/api/login", this.form)
        .then((res) => {
          oruga.notification.open("Login Success");
          console.log(res.data);
          this.$root.setCookieAuth(res.data);
          window.location.reload();
        })
        .catch((error) => {
        });
      });
      
    },
  },
};
</script>

<style scoped>
.login-container {
  height: 400px;
}

.login-card {
  height: 200px;
  background-color: red;
}
</style>
