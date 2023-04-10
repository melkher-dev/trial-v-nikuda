import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth'
import AuthenticatedLayout from "../layouts/AuthenticatedLayout.vue";
import AdminLayout from "../layouts/AdminLayout.vue";
import GuestLayout from "../layouts/GuestLayout.vue";
import Home from '../views/Home.vue'
import Login from '../views/auth/Login.vue'
import Register from '../views/auth/Register.vue'
import Dashboard from '../views/Dashboard.vue'
import Admin from '../views/admin/Admin.vue'
import Users from '../views/admin/users/Users.vue'
import UserCreate from '../views/admin/users/UserCreate.vue'
import UserUpdate from '../views/admin/users/UserUpdate.vue'
import Categories from '../views/admin/categories/Categories.vue'
import CategoryCreate from '../views/admin/categories/CategoryCreate.vue'
import CategoryUpdate from '../views/admin/categories/CategoryUpdate.vue'
import Brands from '../views/admin/brands/Brands.vue'
import BrandCreate from '../views/admin/brands/BrandCreate.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
      // meta: {
      //   layout: GuestLayout
      // }
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: {
        layout: GuestLayout
      }
    },
    {
      path: '/register',
      name: 'register',
      component: Register,
      meta: {
        layout: GuestLayout
      }
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: Dashboard,
      meta: {
        layout: AuthenticatedLayout,
        requiresAuth: true
      }
    },
    {
      path: '/admin',
      name: 'admin',
      component: Admin,
      meta: {
        layout: AdminLayout,
        requiresAuth: true,
        requiresAdmin: true
      }
    },
    {
      path: '/users',
      name: 'users',
      component: Users,
      meta: {
        layout: AdminLayout,
        requiresAuth: true,
        requiresAdmin: true
      }
    },
    {
      path: '/user/create',
      name: 'user-create',
      component: UserCreate,
      meta: {
        layout: AdminLayout,
        requiresAuth: true,
        requiresAdmin: true
      }
    },
    {
      path: '/user/update/:id',
      name: 'user-update',
      component: UserUpdate,
      meta: {
        layout: AdminLayout,
        requiresAuth: true,
        requiresAdmin: true
      }
    },
    {
      path: '/categories',
      name: 'categories',
      component: Categories,
      meta: {
        layout: AdminLayout,
        requiresAuth: true,
        requiresAdmin: true
      }
    },
    {
      path: '/category/create',
      name: 'category-create',
      component: CategoryCreate,
      meta: {
        layout: AdminLayout,
        requiresAuth: true,
        requiresAdmin: true
      }
    },
    {
      path: '/category/update/:id',
      name: 'category-update',
      component: CategoryUpdate,
      meta: {
        layout: AdminLayout,
        requiresAuth: true,
        requiresAdmin: true
      }
    },
    {
      path: '/brands',
      name: 'brands',
      component: Brands,
      meta: {
        layout: AdminLayout,
        requiresAuth: true,
        requiresAdmin: true
      }
    },
    {
      path: '/brand/create',
      name: 'brand-create',
      component: BrandCreate,
      meta: {
        layout: AdminLayout,
        requiresAuth: true,
        requiresAdmin: true
      }
    },
  ]
})

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth)
  if (requiresAuth && !authStore.token) {
    next('/login')
  } else {
    next()
  }
})

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()
  const requiresAdmin = to.matched.some(record => record.meta.requiresAdmin)
  if (requiresAdmin && !authStore.admin) {
    next('/dashboard')
  } else {
    next()
  }
})

export default router
