<template>
  <div>
    <LandingPage></LandingPage>
  </div>
</template>

<script>
import LandingPage from "./components/landing-page/Landing-page.vue";

export default {
  data() {
    return {
      isLoggedIn: false,
      token: "",
      user: "",
    };
  },
  components: {
    LandingPage,
  },
  methods: {
    setCookieAuth(data) {
      if (data) {
        console.log("entro");
        this.$cookies.set("auth", data);
        this.isLoggedIn = data.isLoggedIn;
        this.token = data.token;
        this.user = data.user;
        console.log(data);
        console.log(this.isLoggedIn);
        console.log(this.token);
        console.log(this.user);
        console.log(this.$cookies.get("auth"));
      }
    },
  },
};
</script>
