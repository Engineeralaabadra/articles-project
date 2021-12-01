<template>
  <div>
    <v-app-bar color="deep-purple accent-4" dense dark>
      <v-app-bar-nav-icon @click="mini = !mini"></v-app-bar-nav-icon>

      <v-toolbar-title>مقالات</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-heart</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <v-menu left bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn icon v-bind="attrs" v-on="on">
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item v-for="n in 5" :key="n" @click="() => {}">
            <v-list-item-title>Option {{ n }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
    <sidebar-menu
      :menu="menu"
      :rtl="true"
      width="250px"
      style="height: 100%; top: 3rem !important; position: absolute"
      :collapsed="mini"
    />
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      mini: true,
      menu: [
        {
          title: "المقالات",
          icon: "fa fa-address-card font-2 white--text",
          child: [
            {
              href: "/",
              title: "إدارة المقالات",
              class: "white--text col-sm-12 p-0",
            }
          ],
        }
      ],
    };
  },
  created() {
    // axios
    //   .get("http://ahmedelgedawy-001-site1.itempurl.com/account/getAllUsers")
    //   .then((res) => {
    //     console.log(res.data);
    //   });
  },
};
</script>
