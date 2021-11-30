import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import ManageArticles from "../views/dashboard/articles/ManageArticles";

Vue.use(VueRouter);

const routes = [{
        path: "/",
        name: "Home",
        component: Home,
    },
     {
        path: "/manage-articles",
        name: "manage-articles",
        component: ManageArticles,
    }
];

const router = new VueRouter({
     mode: "hash",
    base: process.env.BASE_URL,
    routes,
});

export default router;