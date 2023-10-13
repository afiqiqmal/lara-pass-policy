<script setup>
import {Link, useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: ''
})

const submit = () => {
    form.post(route('password_change.send'), {
        onFinish: () => form.reset('current_password', 'password', 'password_confirmation'),
    })
};
</script>

<template>
    <GuestLayout>
        <div class="font-bold text-gray-600">
            {{ __('Your password has expired') }}
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="mt-6 flex flex-col justify-between">
            <form @submit.prevent="submit">
                <div class="mt-4">
                    <InputLabel for="current_password" value="Current password"/>
                    <TextInput type="password" class="mt-1 block w-full" v-model="form.current_password" required/>
                    <InputError class="mt-2" :message="form.errors.current_password"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="New password"/>
                    <TextInput type="password" class="mt-1 block w-full" v-model="form.password" required/>
                    <InputError class="mt-2" :message="form.errors.password"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Password confirmation"/>
                    <TextInput type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required/>
                    <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                </div>

                <div class="mt-4 text-right">
                    <PrimaryButton :disabled="form.processing">
                        {{ __('Update password') }}
                    </PrimaryButton>
                </div>

                <hr class="my-6">

                <div class="mt-4">
                    <Link :href="route('logout')" method="post" as="button"
                          class="w-full items-center p-4 bg-red-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        {{ __('Log out') }}
                    </Link>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
