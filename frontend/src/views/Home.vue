<template>
  <div class="container-fluid">
      <v-snackbar v-model="snackbar" :color="color">
      {{ text }}
      <template v-slot:action="{ attrs }">
        <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">
          Close
        </v-btn>
      </template>
    </v-snackbar>
    <v-row>
      <v-overlay :value="overlay">
        <v-progress-circular indeterminate size="64"></v-progress-circular>
      </v-overlay>
      <v-card
        class="col-sm-4 ml-auto elevation-3 custom-card mt-3"
        style="height: 100vh"
        color="primary darken-3"
      >
        <v-card-title class="white--text text-center">
          <v-icon dark x-large class="w-100" style="font-size: 10rem"
            >mdi-coffee</v-icon
          >
          <span style="font-size: 2.5rem" class="w-100">تسجيل الدخول</span>
        </v-card-title>
        <v-card-text>
          <v-row>
            <v-text-field
              class="col-sm-12 mx-auto mt-15"
              prepend-inner-icon="mdi-email"
              rounded
              outlined
              dense
              filled
              label="البريد الإلكتروني"
              v-model="email"
              dark
            ></v-text-field>
            <v-text-field
              class="col-sm-12 mx-auto mt-5"
              prepend-inner-icon="mdi-eye"
              rounded
              outlined
              dense
              filled
              type="password"
              label="كلمة المرور"
              v-model="password"
              dark
            ></v-text-field>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <v-btn
            color="primary"
            dark
            to="/dashboard"
            style="text-decoration: none !important"
            class="col-sm-12 mx-auto"
            @click="login()"
          >
            <v-icon dark class="mr-3">mdi-login</v-icon>
            تسجيل الدخول
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-row>
  </div>
</template>
<script>
export default {
  data() {
    return {
      winHeight: window.innerHeight,
      email: "",
      password: null,
      overlay: false,
    };
  },
  methods: {
    login() {
      this.overlay = true;
      axios.post("http://127.0.0.1:8080/login",{ 
        userName: this.email,
        Password: this.password
      }).then(res=>{
        console.log('iiiii', res)
          console.log('token', res.data.token)
          localStorage.setItem('token', res.data.token)
          localStorage.setItem('ReturnUrl', 'http://127.0.0.1:8080/login')
        if(res.status==200){
          setTimeout(() => {
    this.$router.push("dashboard");
  }, 3000);
        }
      }).catch(err=>{
        console.log('6666', err)
      })
    },
  },
  mounted() {},
};
</script>
<style scoped>
/* .custom-card {
  background-image: url("../../assets/login-background.jpg");
  background-position: center center;
  background-size: 100% 100%;
} */
</style>
