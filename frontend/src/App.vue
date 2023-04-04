<template>
    <header>
        <!-- <img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" /> -->

        <!-- <div class="wrapper">
            <nav>
                <RouterLink to="/">Home</RouterLink>
                <RouterLink to="/login">login</RouterLink>
            </nav>
        </div> -->
    </header>
    <!-- <div v-if="user"> -->
    <div>
        <GuestLayout v-if="isGuestRoute(route)">
            <RouterView />
        </GuestLayout>
        <AdminLayout v-if="isAdminRoute(route)">
            <RouterView />
        </AdminLayout>
        <AuthenticatedLayout v-else>
            <RouterView />
        </AuthenticatedLayout>
    </div>

    <!-- </div> -->
    <!-- <div v-else> -->
    <!-- <GuestLayout /> -->
    <!-- </div> -->
</template>

<script setup>
import AuthenticatedLayout from "./layouts/AuthenticatedLayout.vue";
import AdminLayout from "./layouts/AdminLayout.vue";
import GuestLayout from "./layouts/GuestLayout.vue";
import { useRoute, RouterView } from "vue-router";
import { ref, onMounted } from "vue";
import { useAuthStore } from "@/stores/auth.js";

const route = useRoute();

const isGuestRoute = (route) => {
    return route.path === "/login" || route.path === "/register" || route.path === "/";
};

const isAdminRoute = (route) => {
    return route.path === "/admin";
};

onMounted(async () => {
    await useAuthStore().fetchUser();
});
</script>
