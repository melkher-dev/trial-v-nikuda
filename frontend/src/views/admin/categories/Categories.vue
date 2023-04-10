<template>
    <div class="flex justify-center">
        <div v-if="isLoading">
            <progress class="progress w-56"></progress>
        </div>
        <div v-else class="overflow-x-auto w-full m-2">
            <div class="flex justify-center my-2">
                <router-link
                    to="/category/create"
                    class="btn btn-outline btn-primary btn-sm"
                >
                    Create Category
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
                    <tr v-for="(category, index) in categories" :key="index">
                        <td>{{ category?.title }}</td>
                        <td>{{ category?.slug }}</td>
                        <td>
                            <router-link
                                :to="`/category/update/${category.id}`"
                                class="btn btn-outline btn-ghost btn-sm mx-1"
                            >
                                Edit
                            </router-link>
                            <button
                                @click="deleteCategory(category.id)"
                                class="btn btn-outline btn-error btn-sm mx-1"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-center">
                <button
                    @click="prev"
                    :disabled="currentPage === 1"
                    class="btn btn-outline btn-ghost btn-sm mx-2"
                >
                    Prev
                </button>
                <span>{{ currentPage }} of {{ totalPages }}</span>
                <button
                    @click="next"
                    :disabled="currentPage === totalPages"
                    class="btn btn-outline btn-ghost btn-sm mx-2"
                >
                    Next
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { RouterLink } from "vue-router";

const isLoading = ref(true);
const categories = ref(null);
const currentPage = ref(1);
const totalPages = ref(0);

const fetchCategories = async (page) => {
    isLoading.value = true;
    const { data } = await axios.get(`/api/categories?page=${page}`);
    categories.value = data.data;
    currentPage.value = data.current_page;
    totalPages.value = data.last_page;
    isLoading.value = false;
};

onMounted(async () => {
    await fetchCategories(currentPage.value);
});

const prev = async () => {
    await fetchCategories(currentPage.value - 1);
};

const next = async () => {
    await fetchCategories(currentPage.value + 1);
};

const deleteCategory = async (id) => {
    if (confirm("Are you sure?")) {
        await axios.delete(`/api/categories/${id}`);
        await fetchCategories(currentPage.value);
    }
};
</script>
