<template>
    <div>
        <header class="bg-cyan-800 px-4 py-3 flex justify-between items-center">
            <div class="text-gray-300 font-semibold text-lg">Kek App</div>
            <nav>
                <ul class="flex space-x-4">
                    <li>
                        <router-link
                            to="/login"
                            class="text-gray-300 hover:text-gray-100"
                        >
                            Login
                        </router-link>
                    </li>
                    <li>
                        <router-link
                            to="/register"
                            class="text-gray-300 hover:text-gray-100"
                        >
                            Register
                        </router-link>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="flex justify-center">
                <h1>Something will be here...</h1>
            </div>
        </main>
    </div>
</template>

<script setup>
import { RouterLink } from "vue-router";
</script>
