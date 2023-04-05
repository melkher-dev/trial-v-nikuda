<template>
    <div class="flex justify-center">
        <div v-if="isLoading">
            <progress class="progress w-56"></progress>
        </div>
        <div v-else class="overflow-x-auto w-full m-2">
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
                        <td>{{ user.avatar }}</td>
                        <td>{{ user.first_name }}</td>
                        <td>{{ user.last_name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.address }}</td>
                        <td>{{ user.phone_number }}</td>
                        <td></td>
                        <td>
                            <button
                                @click="deleteUser(user.id)"
                                class="btn btn-outline btn-error btn-sm"
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

const isLoading = ref(true);
const users = ref([]);
const currentPage = ref(1);
const totalPages = ref(0);

async function fetchUsers(page) {
    isLoading.value = true;
    const { data } = await axios.get(`/api/users?page=${page}`);
    users.value = data.data;
    currentPage.value = data.current_page;
    totalPages.value = data.last_page;
    isLoading.value = false;
}

onMounted(async () => {
    await fetchUsers(currentPage.value);
});

async function prev() {
    if (currentPage.value > 1) {
        await fetchUsers(currentPage.value - 1);
    }
}

async function next() {
    if (currentPage.value < totalPages.value) {
        await fetchUsers(currentPage.value + 1);
    }
}

const deleteUser = async (id) => {
    await axios.delete(`/api/users/${id}`);
    await fetchUsers(currentPage.value);
};
</script>
