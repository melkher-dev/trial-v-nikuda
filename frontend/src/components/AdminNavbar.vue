<template>
    <header class="bg-green-400 px-4 py-3 flex justify-between items-center">
        <div class="text-black-300 font-semibold text-lg">Admin Navbar</div>
        <nav>
            <ul class="flex space-x-4">
                <li>
                    <a href="#" class="text-black-300 hover:text-gray-100"
                        >admin</a
                    >
                </li>
                <li>
                    <a href="#" class="text-black-300 hover:text-gray-100"
                        >admin</a
                    >
                </li>
                <li>
                    <router-link
                        to="/dashboard"
                        class="text-black-300 hover:text-gray-100"
                        >Dashboard</router-link
                    >
                </li>
                <li>
                    <button
                        @click="handleLogout"
                        class="text-black-300 hover:text-gray-100"
                    >
                        Logout
                    </button>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script setup>
import { useAuthStore } from "../stores/auth";
import { useRouter, RouterLink } from "vue-router";

const router = useRouter();
const authStore = useAuthStore();

const handleLogout = () => {
    authStore.logout();
    router.push("/login");
};
</script>
