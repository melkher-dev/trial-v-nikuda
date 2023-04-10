<template>
    <header></header>
    <div>
        <component :is="layout">
            <RouterView />
        </component>
    </div>
</template>

<script setup>
import { useRoute, RouterView } from "vue-router";
import { onMounted, computed } from "vue";
import { useAuthStore } from "@/stores/auth.js";

const route = useRoute();

const layout = computed(() => {
    const meta = route.meta?.layout;
    return meta || "div";
});

onMounted(() => {
    const authStore = useAuthStore();
    if (!authStore.fetched) {
        authStore.fetchUser();
    }
});
</script>
