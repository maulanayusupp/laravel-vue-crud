<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Employees" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Employee</h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <form @submit.prevent="submit">
                        <div class="space-y-6">
                            <div>
                                <InputLabel for="company-id" value="Company" />

                                <select
                                    id="company-id"
                                    ref="companyInput"
                                    v-model="form.company_id"
                                    type="text"
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block w-full"
                                    autocomplete="company-id-input"
                                >
                                    <option v-for="company in companies" :key="company.id" :value="company.id">{{ company.name }}</option>
                                </select>

                                <InputError :message="form.errors.company_id" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="first-name" value="First Name" />

                                <TextInput
                                    id="first-name"
                                    ref="firstNameInput"
                                    v-model="form.first_name"
                                    type="text"
                                    class="block w-full"
                                    autocomplete="first-name-input"
                                />

                                <InputError :message="form.errors.first_name" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="last-name" value="Last Name" />

                                <TextInput
                                    id="last-name"
                                    ref="lastNameInput"
                                    v-model="form.last_name"
                                    type="text"
                                    class="block w-full"
                                    autocomplete="last-name-input"
                                />

                                <InputError :message="form.errors.last_name" class="mt-2" />
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
                                <InputLabel for="phone" value="Phone" />

                                <TextInput
                                    id="phone"
                                    ref="phoneInput"
                                    v-model="form.phone"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="phone-input"
                                />

                                <InputError :message="form.errors.phone" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-8">
                            <PrimaryButton type="submit">Create Employee</PrimaryButton>
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
    props: {
        companies: Array
    },
    data() {
        return {
            form: useForm({
                company_id: "",
                first_name: "",
                last_name: "",
                email: "",
                phone: ''
            })
        };
    },
    methods: {
        submit() {
            this.form.post(route('employees.store'), {
                preserveScroll: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.company_id) this.form.reset('company_id');
                    if (this.form.errors.first_name) this.form.reset('first_name');
                    if (this.form.errors.last_name) this.form.reset('last_name');
                },
            });
        },
    }
};
</script>
