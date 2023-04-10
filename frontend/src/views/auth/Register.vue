<template>
    <div class="flex justify-center m-5">
        <div class="card w-96 bg-base-100 shadow-xl">
            <div class="card-body">
                <input
                    v-model="form.first_name"
                    type="text"
                    placeholder="First Name"
                    class="input input-bordered input-primary w-full max-w-xs"
                />
                <input
                    v-model="form.last_name"
                    type="text"
                    placeholder="Last Name"
                    class="input input-bordered input-primary w-full max-w-xs"
                />
                <input
                    v-model="form.email"
                    type="email"
                    placeholder="Email"
                    class="input input-bordered input-primary w-full max-w-xs"
                />
                <input
                    v-model="form.password"
                    type="password"
                    placeholder="Password"
                    class="input input-bordered input-primary w-full max-w-xs"
                />
                <input
                    v-model="form.password_confirmation"
                    type="password"
                    placeholder="Password Confirmation"
                    class="input input-bordered input-primary w-full max-w-xs"
                />
                <div class="form-control" v-if="!isDisabled">
                    <button
                        @click="handleRegister"
                        class="btn btn-outline btn-primary btn-sm"
                    >
                        Register
                    </button>
                </div>
                <div v-else class="form-control">
                    <button class="btn btn-outline btn-primary btn-sm" disabled>
                        Register
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
import { useAuthStore } from "@/stores/auth.js";

const router = useRouter();

let isDisabled = ref(false);

const form = ref({
    first_name: "",
    last_name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const handleRegister = async () => {
    isDisabled.value = true;
    try {
        await useAuthStore().register(form.value);
        await router.push("/");
    } catch (error) {
        console.log(error);
    }
};
</script>
