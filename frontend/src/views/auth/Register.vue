<template>
    <div class="flex justify-center m-5">
        <div class="card w-96 bg-base-100 shadow-xl">
            <div class="card-body">
                <input
                    v-model="form.name"
                    type="text"
                    placeholder="Name"
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
                        @click="register()"
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
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const register = async () => {
    isDisabled.value = true;
    try {
        const response = await axios.post("/api/register", form.value);
        console.log(response);
        const { data } = await axios.post("/api/login", form.value);
        await useAuthStore().setToken(data.access_token, form.remember);
        await useAuthStore().fetchUser();
        router.push("/");
    } catch (error) {
        console.log(error);
    }
};
</script>
