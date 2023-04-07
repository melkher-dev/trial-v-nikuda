<template>
    <div class="flex justify-center m-2">
        <div class="card w-2/3 bg-base-100 shadow-xl">
            <div class="card-body">
                <input
                    type="text"
                    placeholder="First Name"
                    class="input input-bordered input-primary w-full input-sm"
                    v-model="form.first_name"
                />
                <div v-if="errors.first_name" class="flex">
                    <span class="text-red-400 text-sm m-2 p-2">
                        {{ errors.first_name[0] }}
                    </span>
                </div>
                <input
                    type="text"
                    placeholder="Last Name"
                    class="input input-bordered input-primary w-full input-sm"
                    v-model="form.last_name"
                />
                <div v-if="errors.last_name" class="flex">
                    <span class="text-red-400 text-sm m-2 p-2">
                        {{ errors.last_name[0] }}
                    </span>
                </div>
                <input
                    type="text"
                    placeholder="Email"
                    class="input input-bordered input-primary w-full input-sm"
                    v-model="form.email"
                />
                <div v-if="errors.email" class="flex">
                    <span class="text-red-400 text-sm m-2 p-2">
                        {{ errors.email[0] }}
                    </span>
                </div>
                <input
                    type="password"
                    placeholder="Password"
                    class="input input-bordered input-primary w-full input-sm"
                    v-model="form.password"
                />
                <div v-if="errors.password" class="flex">
                    <span class="text-red-400 text-sm m-2 p-2">
                        {{ errors.password[0] }}
                    </span>
                </div>
                <input
                    type="password"
                    placeholder="Password Confirmation"
                    class="input input-bordered input-primary w-full input-sm"
                    v-model="form.password_confirmation"
                />
                <input
                    type="text"
                    placeholder="Address"
                    class="input input-bordered input-primary w-full input-sm"
                    v-model="form.address"
                />
                <input
                    type="text"
                    placeholder="Phone Number"
                    class="input input-bordered input-primary w-full input-sm"
                    v-model="form.phone_number"
                />
                <div class="grid grid-cols-3">
                    <div>
                        <label class="label cursor-pointer">
                            <span class="label-text mx-2">Avatar</span>
                            <input
                                type="file"
                                class="file-input file-input-bordered file-input-primary file-input-sm w-full max-w-xs"
                                @change="uploadAvatar"
                            />
                        </label>
                    </div>
                    <div class="card-actions justify-center">
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text mx-2">Admin</span>
                                <input
                                    type="checkbox"
                                    checked="checked"
                                    class="checkbox checkbox-primary mx-2"
                                    v-model="form.is_admin"
                                />
                            </label>
                        </div>
                    </div>
                    <div class="card-actions justify-center">
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text mx-2">Marketing</span>
                                <input
                                    type="checkbox"
                                    checked="checked"
                                    class="checkbox checkbox-primary mx-2"
                                    v-model="form.is_marketing"
                                />
                            </label>
                        </div>
                    </div>
                </div>
                <div v-if="!isDisabled" class="card-actions justify-center">
                    <button
                        @click="updateUser"
                        class="btn btn-outline btn-primary btn-sm"
                    >
                        Update
                    </button>
                </div>
                <div v-else class="card-actions justify-center">
                    <button class="btn btn-outline btn-primary btn-sm" disabled>
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();
const id = ref(router.currentRoute.value.params.id);

let isDisabled = ref(false);

const form = ref({
    first_name: "",
    last_name: "",
    email: "",
    address: "",
    phone_number: "",
    is_admin: false,
    is_marketing: false,
});

const errors = ref({});

const updateUser = async () => {
    isDisabled.value = true;
    try {
        const { data } = await axios.put(`/api/users/${id.value}`, form.value);
        router.push("/users");
    } catch (error) {
        errors.value = error.response.data.errors;
    }
};

onMounted(async () => {
    const { data } = await axios.get(`/api/users/${id.value}`);
    form.value = data;
});
</script>
