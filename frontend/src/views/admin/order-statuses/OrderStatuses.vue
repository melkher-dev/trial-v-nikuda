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
                    Create Order Status
                </router-link>
            </div>
            <table class="table table-compact w-full">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(orderStatus, index) in orderStatuses"
                        :key="index"
                    >
                        <td>{{ orderStatus?.title }}</td>
                        <td class="flex justify-end">
                            <router-link
                                :to="`/order-status/update/${orderStatus.id}`"
                                class="btn btn-outline btn-ghost btn-sm mx-1"
                            >
                                Edit
                            </router-link>
                            <button
                                @click="deleteOrderStatus(orderStatus.id)"
                                class="btn btn-outline btn-error btn-sm mx-1"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { RouterLink } from "vue-router";

const isLoading = ref(true);
const orderStatuses = ref(null);

const fetch = async () => {
    isLoading.value = true;
    const { data } = await axios.get("/api/order/statuses");
    orderStatuses.value = data;
    isLoading.value = false;
};

onMounted(async () => {
    fetch();
});

const deleteOrderStatus = async (id) => {
    if (confirm("Are you sure?")) {
        try {
            const response = await axios.delete(`/api/order/statuses/${id}`);
            if (response.status === 200) {
                const index = orderStatuses.value.findIndex(
                    (status) => status.id === id
                );
                orderStatuses.value.splice(index, 1);
            }
        } catch (error) {
            console.error(error);
        }
    }
};
</script>
