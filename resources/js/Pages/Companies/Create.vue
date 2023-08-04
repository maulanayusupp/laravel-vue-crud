<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Companies" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Company</h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <form @submit.prevent="submit">
                        <div class="space-y-6">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    ref="nameInput"
                                    v-model="form.name"
                                    type="text"
                                    class="block w-full"
                                    autocomplete="name-input"
                                />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="email" value="Email" />

                                <TextInput
                                    id="email"
                                    ref="emailInput"
                                    v-model="form.email"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="email-input"
                                />

                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>

                            <div>
                                <input type="file" @change="onLogoChange" id="logo" />
                            </div>
                        </div>


                        <div class="mt-8">
                            <PrimaryButton type="submit">Create Company</PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
        InputError,
        InputLabel,
        TextInput,
    },
    data() {
        return {
            form: useForm({
                name: "",
                email: "",
                logo: null
            })
        };
    },
    methods: {
        submit() {
            this.form.post(route('companies.store'), {
                preserveScroll: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.name) {
                        this.form.reset('name');
                    }
                    if (this.form.errors.logo) {
                        this.form.reset('logo');
                    }
                },
            });
        },
        onLogoChange(event) {
            this.form.logo = event.target.files[0];
        }
    }
};
</script>
