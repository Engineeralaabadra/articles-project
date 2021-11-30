<template>
  <div>
    <v-app-bar color="deep-purple accent-4" dense dark>
      <v-app-bar-nav-icon @click="mini = !mini"></v-app-bar-nav-icon>

      <v-toolbar-title>مطعمك</v-toolbar-title>

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
          title: "المستخدمين",
          icon: "fa fa-address-card font-2 white--text",
          child: [
            {
              href: "/manage-users",
              title: "إدارة المستخدمين",
              class: "white--text col-sm-12 p-0",
            },
            {
              href: "/manage-roles",
              title: "ادارة الادوار",
              class: "white--text col-sm-12 p-0",
            },
            {
              href: "/manage-employees",
              title: "إدارة الموظفين",
              class: "white--text col-sm-12 p-0",
            },
            
          ],
        },

        {
          title: "المشتريات",
          icon: "fa fa-hand-holding-usd font-2 white--text",
          child: [
            {
              href: "/manage-purchases",
              title: "إدارة المشتريات",
              class: "white--text col-sm-12 p-0",
            },            {
              href: "/manage-units-purchases",
              title: "إدارة وحدات المشتريات",
              class: "white--text col-sm-12 p-0",
            },
            {
              href: "/manage-purchases-invoices",
              title: "ادارة فواتير المشتريات",
              class: "white--text col-sm-12 p-0",
            },

            {
              href: "/manage-suppliers",
              title: "ادارة الموردين",
              class: "white--text col-sm-12 p-0",
            },
          ],
        },
        {
          title: "المخازن",
          icon: "fa fa-coins font-2 white--text",
          child: [
            {
              title: "ادارة المخزن",
              href: "/manage-stores",
            },            {
              title: "ادارة منتجات مخزن معين",
              href: "/manage-items-store",
            },
            {
              title: "ادارة المطبخ",
              href: "/manage-items-in-kitchen",
            },
          ],
        },
        {
          title: "الاصناف",
          icon: "fa fa-list font-2 white--text",
          href: "/manage-categories",
        },

        {
          title: "المبيعات",
          icon: "fa fa-donate font-2 white--text",
          child: [
                        {
              href: "/manage-meals",
              title: "ادارة الوجبات",
              class: "white--text col-sm-12 p-0",
            },
            {
              href: "/manage-orders",
              title: "ادارة الطلبات",
              class: "white--text col-sm-12 p-0",
            },

            {
              href: "/manage-clients",
              title: "ادارة العملاء",
              class: "white--text col-sm-12 p-0",
            },
                        {
              href: "/manage-pos",
              title: "manage-pos",
              class: "white--text col-sm-12 p-0",
            }
          ],
        },
        {
          title: " التكاليف المباشرة",
          icon: "fa fa-building font-2 white--text",
          child: [
            {
              href: "/manage-direct-costs",
              title: "إدارة التكاليف المباشرة",
              class: "white--text col-sm-12 p-0",
            },
          ],
        },
        {
          title: " التكاليف الغير مباشرة",
          icon: "fa fa-building font-2 white--text",
          child: [
            {
              href: "/manage-in-direct-costs",
              title: "إدارة التكاليف الغير مباشرة",
              class: "white--text col-sm-12 p-0",
            },
          ],
        },

        {
          title: "الإعدادت",
          icon: "fa fa-cogs font-2 white--text",
          child: [
            {
              title: "الملف الشخصي",
              href: "/profile",
            },
            {
              title: "الماليات",
              href: "/finances",
            },
            {
              title: "الضرائب والخدمات",
              href: "/taxes",
            },
            {
              title: "الخصومات",
              href: "/discounts",
            }
          ],
        },
        {
          title: "التقارير",
          icon: "fa fa-chart-bar font-2 white--text",
          href: "/manage-reports",
        },

        {
          title: "تسجيل خروج",
          icon: "fa fa-sign-out-alt font-2 white--text",
        },
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
