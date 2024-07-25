import { createRouter, createWebHistory } from 'vue-router';
import DashboardView from '@/views/DashboardView.vue';
import LoginView from '@/views/LoginView.vue';
import SignUpView from '@/views/SignUpView.vue';
import PeticionView from '@/views/PeticionView.vue';
import ListadoPeticionesView from '@/views/ListadoPeticionesView.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // {
    //   path: '/',
    //   name: 'login',
    //   component: LoginView,
    // },
    // {
    //   path: '/signup',
    //   name: 'signup',
    //   component: SignUpView,
    // },
    // {
    //   path: '/dashboard',
    //   name: 'dashboard',
    //   component: DashboardView,
    // },
    {
      path: '/peticion',
      name: 'peticion',
      component: PeticionView,
    },
    {
      path: '/listadopeticiones',
      name: 'listadopeticiones',
      component: ListadoPeticionesView,
    },
  ],
});

export default router;
