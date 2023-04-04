<template>
    <div class="flex h-screen">
        <div class="flex-1">
            <navbar></navbar>
            <main>
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script setup>
import Navbar from "@/components/Navbar.vue";

</script>
