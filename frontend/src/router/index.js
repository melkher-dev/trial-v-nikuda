import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/auth/Login.vue'
import Register from '../views/auth/Register.vue'
import Dashboard from '../views/Dashboard.vue'
import { useAuthStore } from '../stores/auth'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: Dashboard
    },
  ]
})

router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore();
  const isGuestRoute = to.name === "login" || to.name === "register";

  if (!isGuestRoute && authStore.token) {
    try {
      await authStore.fetchUser();
    } catch (e) { }
  }

  next()
});

export default router