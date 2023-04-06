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
                <div class="card-actions justify-center">
                    <button
                        @click="handleUser"
                        class="btn btn-outline btn-primary btn-sm"
                    >
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

let errors = ref([]);

const form = ref({
    first_name: "",
    last_name: "",
    email: "",
    password: "",
    password_confirmation: "",
    address: "",
    phone_number: "",
    avatar: "",
    is_admin: false,
    is_marketing: false,
});

const uploadAvatar = async (event) => {
    const formData = new FormData();
    formData.append("avatar", event.target.files[0]);

    try {
        const response = await axios.post("/api/upload", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        form.value.avatar = response.data.avatar;
    } catch (error) {
        console.error(error);
    }
};

const handleUser = async () => {
    try {
        const response = await axios.post("/api/users", form.value);
        form.value = {
            first_name: "",
            last_name: "",
            email: "",
            password: "",
            password_confirmation: "",
            address: "",
            phone_number: "",
            avatar: "",
            is_admin: false,
            is_marketing: false,
        };
        router.push("/users");
    } catch (error) {
        errors.value = error.response.data.errors;
        console.log(error.response.data.errors);
    }
};
</script>
