
<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Companies" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">View Company</h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <form @submit.prevent="submit" enctype="multipart/form-data">

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
                                    disabled="true"
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
                                    disabled="true"
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
                                    disabled="true"
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
                                    disabled="true"
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
                                    disabled="true"
                                />

                                <InputError :message="form.errors.phone" class="mt-2" />
                            </div>
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
        companies: Object,
        employee: Object,
    },
    data() {
        return {
            form: useForm(this.employee)
        };
    },
    methods: {
    }
};
</script>
