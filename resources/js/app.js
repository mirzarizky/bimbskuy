import Vue from "vue";
import Vuetify from "vuetify";
import VeeValidate from "vee-validate";

import store from "@/store";
import router from "@/router";
import App from "@/App.vue";

Vue.use(VeeValidate);

Vue.use(Vuetify, {
  iconfont: "md",
});

new Vue({
  el: "#app",
  store,
  router,
  render: h => h(App),
});
