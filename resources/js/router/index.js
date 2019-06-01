import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import routes from "@/router/routes";

export default new VueRouter({
  base: "/",
  mode: "hash",
  routes,
});
