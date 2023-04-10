<template>
    <div class="flex justify-center m-2">
        <div class="card w-2/3 bg-base-100 shadow-xl">
            <div class="card-body">
                <input
                    type="text"
                    placeholder="Category Title"
                    class="input input-bordered input-primary w-full input-sm"
                    v-model="form.title"
                />
                <div v-if="errors.title" class="flex">
                    <span class="text-red-400 text-sm m-2 p-2">
                        {{ errors.title[0] }}
                    </span>
                </div>
                <div v-if="!isDisabled" class="card-actions justify-center">
                    <button
                        @click="handleBrand"
                        class="btn btn-outline btn-primary btn-sm"
                    >
                        Create
                    </button>
                </div>
                <div v-else class="card-actions justify-center">
                    <button class="btn btn-outline btn-primary btn-sm" disabled>
                        Create
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();
const isDisabled = ref(false);
let errors = ref([]);

const form = ref({
    title: "",
});

const handleBrand = async () => {
    isDisabled.value = true;
    try {
        await axios.post("/api/brands", form.value);
        router.push("/brands");
    } catch (error) {
        errors.value = error.response.data.errors;
    }
};
</script>
