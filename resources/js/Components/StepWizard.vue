<script lang="ts" setup>
import { ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";

const step = ref(1);

const form = useForm({
    phone: "",
    code: "",
    firstName: "",
    lastName: "",
    email: "",
});

import axios from "axios";

const submitPhone = async () => {
    try {
        await axios.post("/verify/phone", form.data());
        step.value = 2;
    } catch (error) {
        if (error.response && error.response.data) {
            Object.keys(error.response.data.errors).forEach((key: any) => {
                form.setError(key, error.response.data.errors[key][0]);
            });
        }
    }
};

const submitCode = async () => {
    try {
        await axios.post("/verify/code", form);
        step.value = 3;
    } catch (error) {
        if (error.response && error.response.data) {
            Object.keys(error.response.data.errors).forEach((key: any) => {
                form.setError(key, error.response.data.errors[key][0]);
            });
        }
    }
};

const submitProfile = async () => {
    try {
        await axios.post("/verify/profile", form);
        router.visit("/dashboard");
    } catch (error) {
        if (error.response && error.response.data) {
            Object.keys(error.response.data.errors).forEach((key: any) => {
                form.setError(key, error.response.data.errors[key][0]);
            });
        }
    }
};
</script>

<template>
    <div>
        <form v-if="step === 1" @submit.prevent="submitPhone">
            <input type="tel" v-model="form.phone" placeholder="Phone Number" />
            <p v-if="form.errors.phone" class="text-red-500">
                {{ form.errors.phone }}
            </p>
            <button type="submit" :disabled="form.processing">Continue</button>
        </form>

        <form v-if="step === 2" @submit.prevent="submitCode">
            <input
                type="text"
                v-model="form.code"
                placeholder="Verification Code"
            />
            <button type="submit" :disabled="form.processing">Verify</button>
        </form>

        <form v-if="step === 3" @submit.prevent="submitProfile">
            <input
                type="text"
                v-model="form.firstName"
                placeholder="First Name"
            />
            <input
                type="text"
                v-model="form.lastName"
                placeholder="Last Name"
            />
            <input type="email" v-model="form.email" placeholder="Email" />
            <button type="submit" :disabled="form.processing">Complete</button>
        </form>
    </div>
</template>
