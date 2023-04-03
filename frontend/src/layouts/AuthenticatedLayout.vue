<script setup>
import Sidebar from "@/components/Sidebar.vue";
import Navbar from "@/components/Navbar.vue";
import { RouterView } from "vue-router";
</script>

<template>
    <div class="flex h-screen">
        <sidebar></sidebar>
        <div class="flex-1">
            <navbar></navbar>
            <main>
                <slot></slot>
            </main>
        </div>
    </div>
</template>
