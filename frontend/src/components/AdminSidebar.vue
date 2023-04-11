<template>
    <aside class="bg-cyan-800 w-64 px-4 py-6 text-gray-300">
        <h2 class="text-lg font-semibold mb-4">Sidebar</h2>
        <ul>
            <li class="mb-2">
                <router-link to="/users" class="hover:text-gray-100"
                    >Users</router-link
                >
            </li>
            <li class="mb-2">
                <router-link to="/categories" class="hover:text-gray-100"
                    >Categories</router-link
                >
            </li>
            <li class="mb-2">
                <router-link to="/brands" class="hover:text-gray-100"
                    >Brands</router-link
                >
            </li>
            <li class="mb-2">
                <router-link to="/products" class="hover:text-gray-100">Products</router-link>
            </li>
        </ul>
    </aside>
</template>

<script setup>
import { RouterLink } from "vue-router";
</script>
