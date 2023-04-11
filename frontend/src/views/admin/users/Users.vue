<template>
    <div class="flex justify-center">
        <div v-if="isLoading">
            <progress class="progress w-56"></progress>
        </div>
        <div v-else class="overflow-x-auto w-full m-5">
            <div class="flex justify-center my-2">
                <router-link
                    to="/user/create"
                    class="btn btn-outline btn-primary btn-sm"
                >
                    Create User
                </router-link>
            </div>
            <table class="table table-compact w-full">
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users" :key="index">
                        <td>{{ user?.avatar }}</td>
                        <td>{{ user?.first_name }}</td>
                        <td>{{ user?.last_name }}</td>
                        <td>{{ user?.email }}</td>
                        <td>{{ user?.address }}</td>
                        <td>{{ user?.phone_number }}</td>
                        <td class="flex justify-end">
                            <router-link
                                :to="`/user/update/${user.id}`"
                                class="btn btn-outline btn-ghost btn-sm mx-1"
                            >
                                Edit
                            </router-link>
                            <button
                                @click="deleteUser(user.id)"
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
const users = ref(null);
const currentPage = ref(1);
const totalPages = ref(0);

const fetch = async (page) => {
    isLoading.value = true;
    const { data } = await axios.get(`/api/users?page=${page}`);
    users.value = data.data;
    currentPage.value = data.current_page;
    totalPages.value = data.last_page;
    isLoading.value = false;
};

onMounted(async () => {
    await fetch(currentPage.value);
});

const deleteUser = async (id) => {
    if (confirm("Are you sure?")) {
        await axios.delete(`/api/users/${id}`);
        await fetch(currentPage.value);
    }
};
</script>
