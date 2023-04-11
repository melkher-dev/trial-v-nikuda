<template>
    <div class="flex justify-center">
        <button
            @click="$emit('fetch', currentPage - 1)"
            :disabled="currentPage === 1"
            v-if="currentPage > 1"
            class="btn btn-outline btn-ghost btn-sm mx-2"
        >
            Prev
        </button>
        <template v-if="totalPages <= 7">
            <button
                v-for="n in totalPages"
                :key="n"
                @click="$emit('fetch', n)"
                :class="[
                    'btn',
                    n === currentPage ? 'btn-primary' : 'btn-outline',
                    'btn-ghost',
                    'btn-sm',
                    'mx-1',
                ]"
            >
                {{ n }}
            </button>
        </template>
        <template v-else>
            <button
                v-if="currentPage > 4"
                @click="$emit('fetch', 1)"
                class="btn btn-outline btn-ghost btn-sm mx-1"
            >
                1
            </button>
            <template v-if="currentPage > 5">
                <span class="mx-1">&hellip;</span>
            </template>
            <button
                v-for="n in [currentPage - 1, currentPage, currentPage + 1]"
                :key="n"
                @click="$emit('fetch', n)"
                :class="[
                    'btn',
                    n === currentPage ? 'btn-primary' : 'btn-outline',
                    'btn-ghost',
                    'btn-sm',
                    'mx-1',
                ]"
            >
                {{ n }}
            </button>
            <template v-if="currentPage < totalPages - 4">
                <span class="mx-1">&hellip;</span>
            </template>
            <button
                v-if="currentPage < totalPages - 3"
                @click="$emit('fetch', totalPages)"
                class="btn btn-outline btn-ghost btn-sm mx-1"
            >
                {{ totalPages }}
            </button>
        </template>
        <button
            @click="$emit('fetch', currentPage + 1)"
            :disabled="currentPage === totalPages"
            v-if="currentPage < totalPages"
            class="btn btn-outline btn-ghost btn-sm mx-2"
        >
            Next
        </button>
    </div>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
    currentPage: {
        type: Number,
        required: true,
    },
    totalPages: {
        type: Number,
        required: true,
    },
});
</script>
