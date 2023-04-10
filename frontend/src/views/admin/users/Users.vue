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
                        <td>
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
            <div class="flex justify-center">
                <button
                    @click="prev"
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
                        @click="fetchUsers(n)"
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
                        @click="fetchUsers(1)"
                        class="btn btn-outline btn-ghost btn-sm mx-1"
                    >
                        1
                    </button>
                    <template v-if="currentPage > 5">
                        <span class="mx-1">&hellip;</span>
                    </template>
                    <button
                        v-for="n in [
                            currentPage - 1,
                            currentPage,
                            currentPage + 1,
                        ]"
                        :key="n"
                        @click="fetchUsers(n)"
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
                        @click="fetchUsers(totalPages)"
                        class="btn btn-outline btn-ghost btn-sm mx-1"
                    >
                        {{ totalPages }}
                    </button>
                </template>
                <button
                    @click="next"
                    :disabled="currentPage === totalPages"
                    v-if="currentPage < totalPages"
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
const users = ref(null);
const currentPage = ref(1);
const totalPages = ref(0);

const fetchUsers = async (page) => {
    isLoading.value = true;
    const { data } = await axios.get(`/api/users?page=${page}`);
    users.value = data.data;
    currentPage.value = data.current_page;
    totalPages.value = data.last_page;
    isLoading.value = false;
};

onMounted(async () => {
    await fetchUsers(currentPage.value);
});

const prev = async () => {
    await fetchUsers(currentPage.value - 1);
};

const next = async () => {
    await fetchUsers(currentPage.value + 1);
};

const deleteUser = async (id) => {
    if (confirm("Are you sure?")) {
        await axios.delete(`/api/users/${id}`);
        await fetchUsers(currentPage.value);
    }
};
</script>
