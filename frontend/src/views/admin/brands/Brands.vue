<template>
    <div class="flex justify-center">
        <div v-if="isLoading">
            <progress class="progress w-56"></progress>
        </div>
        <div v-else class="overflow-x-auto w-full m-5">
            <div class="flex justify-center my-2">
                <router-link
                    to="/brand/create"
                    class="btn btn-outline btn-primary btn-sm"
                >
                    Create Brand
                </router-link>
            </div>
            <table class="table table-compact w-full">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(brand, index) in brands" :key="index">
                        <td>{{ brand?.title }}</td>
                        <td>{{ brand?.slug }}</td>
                        <td class="flex justify-end">
                            <router-link
                                :to="`/brand/update/${brand.id}`"
                                class="btn btn-outline btn-ghost btn-sm mx-1"
                            >
                                Edit
                            </router-link>
                            <button
                                @click="deleteBrand(brand.id)"
                                class="btn btn-outline btn-error btn-sm mx-1"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination
                :current-page="currentPage"
                :total-pages="totalPages"
                @fetch="(n) => fetch(n)"
            />
        </div>
    </div>
</template>

<script setup>
import Pagination from "@/components/Pagination.vue";
import { ref, onMounted } from "vue";
import axios from "axios";
import { RouterLink } from "vue-router";

const isLoading = ref(true);
const brands = ref(null);
const currentPage = ref(1);
const totalPages = ref(0);

const fetch = async (page) => {
    isLoading.value = true;
    const { data } = await axios.get(`/api/brands?page=${page}`);
    brands.value = data.data;
    currentPage.value = data.current_page;
    totalPages.value = data.last_page;
    isLoading.value = false;
};

onMounted(async () => {
    await fetch(currentPage.value);
});

const deleteBrand = async (id) => {
    if (confirm("Are you sure?")) {
        await axios.delete(`/api/brands/${id}`);
        await fetch(currentPage.value);
    }
};
</script>
