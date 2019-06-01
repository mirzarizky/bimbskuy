import NotFound from "@/views/NotFound.vue"
import Index from "@/views/Index.vue"
import Login from "@/views/Login.vue"
import Dashboard from "@/views/Dashboard.vue"

export default [
  { path: '*', meta: { public: true },
    redirect: {
      path: '/404'
    }
  },
  { path: '/404', meta: { public: true },
    name: 'NotFound',
    component: NotFound
  },
  { path: '/', meta: { public: true }, component: Index },
  { path: '/login', meta: { public: true }, component: Login},
  { path: '/dashboard', component: Dashboard}
];