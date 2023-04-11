<template>
    <div class="flex justify-center">
        <div v-if="isLoading">
            <progress class="progress w-56"></progress>
        </div>
        <div v-else class="overflow-x-auto w-full m-5">
            <div class="flex justify-center my-2">
                <router-link
                    to="/product/create"
                    class="btn btn-outline btn-primary btn-sm"
                >
                    Create Product
                </router-link>
            </div>
            <table class="table table-compact w-full">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, index) in products" :key="index">
                        <td>{{ product?.title }}</td>
                        <td>{{ product?.price }}</td>
                        <td class="whitespace-pre-wrap">{{ product?.description }}</td>
                        <td class="flex justify-end">
                            <router-link
                                :to="`/product/update/${product.id}`"
                                class="btn btn-outline btn-ghost btn-sm mx-1"
                            >
                                Edit
                            </router-link>
                            <button
                                @click="deleteProduct(product.id)"
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
const products = ref(null);
const currentPage = ref(1);
const totalPages = ref(0);

const fetch = async (page) => {
    isLoading.value = true;
    const { data } = await axios.get(`/api/products?page=${page}`);
    products.value = data.data;
    currentPage.value = data.current_page;
    totalPages.value = data.last_page;
    isLoading.value = false;
};

onMounted(async () => {
    await fetch(currentPage.value);
});

const deleteProduct = async (id) => {
    if (confirm("Are you sure?")) {
        await axios.delete(`/api/products/${id}`);
        await fetch(currentPage.value);
    }
};
</script>
