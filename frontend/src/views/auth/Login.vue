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
                <div v-if="!isDisabled" class="form-control">
                    <button
                        @click="handleLogin"
                        class="btn btn-outline btn-primary btn-sm"
                    >
                        Login
                    </button>
                </div>
                <div v-else class="form-control">
                    <button class="btn btn-outline btn-primary btn-sm" disabled>
                        Login
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { RouterLink, useRouter } from "vue-router";
import { ref } from "vue";
import { useAuthStore } from "@/stores/auth.js";

const router = useRouter();

let isDisabled = ref(false);

const form = ref({
    email: "",
    password: "",
    remember: false,
});

const handleLogin = async () => {
    isDisabled.value = true;
    await useAuthStore().login(form.value);
    router.push("/");
};
</script>
