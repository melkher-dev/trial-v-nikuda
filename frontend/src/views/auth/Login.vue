<template>
    <div class="flex justify-center m-5">
        <div class="card w-96 bg-base-100 shadow-xl">
            <div class="card-body">
                <input
                    v-model="form.email"
                    type="text"
                    placeholder="Email"
                    class="input input-bordered input-primary w-full max-w-xs"
                />
                <input
                    v-model="form.password"
                    type="password"
                    placeholder="Password"
                    class="input input-bordered input-primary w-full max-w-xs"
                />
                <div class="form-control">
                    <label class="label cursor-pointer">
                        <span class="label-text">Remember me</span>
                        <input
                            v-model="form.remember"
                            type="checkbox"
                            class="checkbox checkbox-primary"
                        />
                    </label>
                </div>
                <div class="form-control">
                    <router-link
                        to="/register"
                        class="btn btn-ghost btn-outline btn-sm nav-link"
                        >Register</router-link
                    >
                </div>
                <div class="form-control">
                    <button
                        @click="login"
                        class="btn btn-outline btn-primary btn-sm"
                    >
                        Login
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { RouterLink, useRouter } from "vue-router";
import axios from "axios";
import { ref } from "vue";
import Cookies from "js-cookie";
import { useAuthStore } from '@/stores/auth.js'

const router = useRouter();

const form = ref({
    email: "",
    password: "",
    remember: false,
});

const login = async () => {
    const { data } = await axios.post("/api/login", form.value);

    await useAuthStore().setToken(data.access_token, form.remember);

    await useAuthStore().fetchUser();

    router.push("/");
};
</script>
