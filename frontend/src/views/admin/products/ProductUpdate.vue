<template>
    <div class="flex justify-center m-5">
        <div class="card w-2/3 bg-base-100 shadow-xl">
            <div class="card-body">
                <!-- category select -->
                <select
                    v-model="form.category_id"
                    class="select select-primary w-full"
                >
                    <option value="" disabled selected hidden>
                        Select Category
                    </option>
                    <option
                        v-for="(category, index) in categories"
                        :key="index"
                        :value="category.id"
                    >
                        {{ category.title }}
                    </option>
                </select>
                <div v-if="errors.category_id" class="flex">
                    <span class="text-red-400 text-sm m-2 p-2">
                        {{ errors.category_id[0] }}
                    </span>
                </div>
                <!-- product title -->
                <input
                    type="text"
                    placeholder="Product Title"
                    class="input input-bordered input-primary w-full input-sm"
                    v-model="form.title"
                />
                <div v-if="errors.title" class="flex">
                    <span class="text-red-400 text-sm m-2 p-2">
                        {{ errors.title[0] }}
                    </span>
                </div>
                <!-- product price -->
                <input
                    type="text"
                    placeholder="Product Price"
                    class="input input-bordered input-primary w-full input-sm"
                    v-model="form.price"
                />
                <div v-if="errors.price" class="flex">
                    <span class="text-red-400 text-sm m-2 p-2">
                        {{ errors.price[0] }}
                    </span>
                </div>
                <!-- product description -->
                <textarea
                    class="textarea textarea-primary w-full"
                    placeholder="Product Description"
                    v-model="form.description"
                ></textarea>
                <div v-if="errors.description" class="flex">
                    <span class="text-red-400 text-sm m-2 p-2">
                        {{ errors.description[0] }}
                    </span>
                </div>
                <!-- brand select -->
                <select
                    v-model="form.metadata[0].brand"
                    class="select select-primary w-full"
                >
                    <option value="" disabled selected hidden>
                        Select Brand
                    </option>
                    <option
                        v-for="(brand, index) in brands"
                        :key="index"
                        :value="brand.id"
                    >
                        {{ brand.title }}
                    </option>
                </select>
                <!-- image select -->
                <select class="select select-primary w-full">
                    <option disabled selected hidden>Select Image</option>
                </select>
                <div v-if="!isDisabled" class="card-actions justify-center">
                    <button
                        @click="updateProduct"
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
const isDisabled = ref(false);
const errors = ref([]);
const categories = ref([]);
const brands = ref([]);
const id = router.currentRoute.value.params.id;

const form = ref({
    category_id: "",
    title: "",
    price: "",
    description: "",
    metadata: [
        {
            brand: "",
            image: "",
        },
    ],
});

const fetchCategories = async () => {
    try {
        const { data } = await axios.get("/api/all-categories");
        categories.value = data;
    } catch (error) {
        console.log(error);
    }
};

const fetchProduct = async () => {
    try {
        const { data } = await axios.get(`/api/products/${id}`);
        form.value = data;
    } catch (error) {
        console.log(error);
    }
};

const fetchBrands = async () => {
    try {
        const { data } = await axios.get("/api/all-brands");
        brands.value = data;
    } catch (error) {
        console.log(error);
    }
};

onMounted(async () => {
    await fetchProduct();
    await fetchCategories();
    await fetchBrands();
});

const updateProduct = async () => {
    isDisabled.value = true;
    try {
        const { data } = await axios.put(`/api/products/${id}`, form.value);
        router.push("/products");
    } catch (error) {
        errors.value = error.response.data.errors;
    }
};
</script>
