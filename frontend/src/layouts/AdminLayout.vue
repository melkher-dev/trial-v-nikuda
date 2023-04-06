<template>
    <div class="flex h-screen">
        <admin-sidebar></admin-sidebar>
        <div class="flex-1">
            <admin-navbar></admin-navbar>
            <main>
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script setup>
import AdminSidebar from "@/components/AdminSidebar.vue";
import AdminNavbar from "@/components/AdminNavbar.vue";
</script>
