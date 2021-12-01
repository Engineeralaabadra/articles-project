<template>
  <v-app>
    <router-view></router-view>
  </v-app>
</template>

<script>
import HelloWorld from "./components/HelloWorld";

export default {
  name: "App",

  components: {
    HelloWorld,
  },

  data: () => ({
    //
  }),
  created(){
  }
};
</script>
<style>
@font-face {
  font-family: kufy;
  src: url("./assets/fonts/18 Khebrat Musamim Bold.ttf");
}
#app {
  font-family: kufy !important;
}
</style>
