import { createRouter, createWebHistory } from 'vue-router';
import DashboardView from '@/views/DashboardView.vue';
import HomeView from '@/views/HomeView.vue';
import LoginView from '@/views/LoginView.vue';
import SignUpView from '@/views/SignUpView.vue';
import PeticionView from '@/views/PeticionView.vue';
import ListadoPeticionesView from '@/views/ListadoPeticionesView.vue';
import axios from 'axios';

const apiUrl = import.meta.env.VITE_APP_API_URL;
const clientId = localStorage.getItem('clientId');

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'landing',
      component: HomeView,
      children: [
        {
          path: '/login/:client_id',
          name: 'login',
          component: LoginView,
        },
        {
          path: '/signup/:client_id',
          name: 'signup',
          component: SignUpView,
        },
      ],
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: DashboardView,
      meta: { requiresAuth: true },
    },
    {
      path: '/peticion',
      name: 'peticion',
      component: PeticionView,
      meta: { requiresAuth: true },
    },
    {
      path: '/listadopeticiones',
      name: 'listadopeticiones',
      component: ListadoPeticionesView,
      meta: { requiresAuth: true },
    },
  ],
});

router.beforeEach(async (to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    try {
      await axios.get(apiUrl + '/api/user');
      next();
    } catch (error) {
      next({ name: 'login', params: { client_id: clientId } });
    }
  } else {
    next();
  }
});

export default router;
