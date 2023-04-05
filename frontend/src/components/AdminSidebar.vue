<template>
    <aside class="bg-cyan-600 w-64 px-4 py-6 text-gray-300">
        <h2 class="text-lg font-semibold mb-4">Sidebar</h2>
        <ul>
            <li class="mb-2">
                <router-link to="/users" class="hover:text-gray-100"
                    >Users</router-link
                >
            </li>
            <li class="mb-2">
                <a href="#" class="hover:text-gray-100">admin</a>
            </li>
            <li class="mb-2">
                <a href="#" class="hover:text-gray-100">admin</a>
            </li>
            <li class="mb-2">
                <a href="#" class="hover:text-gray-100">Logout</a>
            </li>
        </ul>
    </aside>
</template>

<script setup>
import { RouterLink } from "vue-router";
</script>
