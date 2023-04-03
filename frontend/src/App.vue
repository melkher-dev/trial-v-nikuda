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
    <AuthenticatedLayout v-if="useAuthStore().user">
        <RouterView />
    </AuthenticatedLayout>

    <GuestLayout v-else>
        <RouterView />
    </GuestLayout>
    <!-- </div> -->
    <!-- <div v-else> -->
    <!-- <GuestLayout /> -->
    <!-- </div> -->
</template>

<script setup>
import AuthenticatedLayout from "./layouts/AuthenticatedLayout.vue";
import { RouterLink, RouterView } from "vue-router";
import { ref, onMounted } from "vue";
import { useAuthStore } from "@/stores/auth.js";
import GuestLayout from "./layouts/GuestLayout.vue";

// onMounted(() => {
//     useAuthStore().fetchUser();
// });
</script>
