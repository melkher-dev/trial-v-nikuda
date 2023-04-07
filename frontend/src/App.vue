<template>
    <header></header>
    <div>
        <component :is="layoutComponent">
            <RouterView />
        </component>
    </div>
</template>

<script setup>
import AuthenticatedLayout from "./layouts/AuthenticatedLayout.vue";
import AdminLayout from "./layouts/AdminLayout.vue";
import GuestLayout from "./layouts/GuestLayout.vue";
import { useRoute, RouterView } from "vue-router";
import { onMounted, computed } from "vue";
import { useAuthStore } from "@/stores/auth.js";

const route = useRoute();

const isGuestRoute = () => {
    return (
        route.path === "/" ||
        route.path === "/login" ||
        route.path === "/register"
    );
};

const isAdminRoute = () => {
    return (
        route.path === "/admin" ||
        route.path === "/users" ||
        route.path === "/user/create" ||
        route.path.startsWith("/user/update/")
    );
};

const isUserRoute = () => {
    return route.path === "/dashboard";
};

const layoutComponent = computed(() => {
    if (isGuestRoute()) {
        return GuestLayout;
    } else if (isAdminRoute()) {
        return AdminLayout;
    } else if (isUserRoute()) {
        return AuthenticatedLayout;
    }
});

onMounted(() => {
    useAuthStore().fetchUser();
});
</script>
