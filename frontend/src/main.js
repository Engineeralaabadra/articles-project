import Vue from "vue";
import "./plugins/bootstrap-vue";
import App from "./App.vue";
import "./registerServiceWorker";
import router from "./router";
import store from "./store";
import vuetify from "./plugins/vuetify";
import axios from "axios";
import VueSidebarMenu from 'vue-sidebar-menu'
import 'vue-sidebar-menu/dist/vue-sidebar-menu.css'
import "@fortawesome/fontawesome-free/css/all.css";
import VuejsDialog from 'vuejs-dialog';
 
// include the default style
import 'vuejs-dialog/dist/vuejs-dialog.min.css';

Vue.use(VueSidebarMenu)
Vue.use(VuejsDialog);
window.axios = axios;
Vue.config.productionTip = false;

new Vue({
    router,
    store,
    vuetify,
    render: (h) => h(App),
}).$mount("#app");