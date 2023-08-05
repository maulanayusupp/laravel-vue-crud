<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Companies" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Companies</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mb-6">
                    <Link :href="route('employees.create')">
                        <PrimaryButton>Create Employee</PrimaryButton>
                    </Link>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="w-full">
                        <tr>
                            <th class="text-white p-4 text-left">ID</th>
                            <th class="text-white p-4 text-left">Company</th>
                            <th class="text-white p-4 text-left">Name</th>
                            <th class="text-white p-4 text-left">Email</th>
                            <th class="text-white p-4 text-left">Phone</th>
                            <th class="text-white p-4">Actions</th>
                        </tr>
                        <tr v-for="item in employees.data" :key="item.id">
                            <td class="text-white px-4 py-2">{{ item.id }}</td>
                            <td class="text-white px-4 py-2">{{ item.company.name || '' }}</td>
                            <td class="text-white px-4 py-2">{{ item.first_name }} {{ item.last_name }}</td>
                            <td class="text-white px-4 py-2">{{ item.email }}</td>
                            <td class="text-white px-4 py-2">{{ item.phone }}</td>
                            <td class="text-white px-4 py-2 space-x-4 text-center">
                                <Link :href="route('employees.show', item.id)">
                                    <PrimaryButton>Show</PrimaryButton>
                                </Link>
                                <Link :href="route('employees.edit', item.id)">
                                    <PrimaryButton>Edit</PrimaryButton>
                                </Link>
                                <PrimaryButton @click="deleteItem(item)">Delete</PrimaryButton>
                            </td>
                        </tr>
                    </table>
                </div>

                <div>
                    <Link v-if="employees.prev_page_url" :href="employees.prev_page_url">Previous</Link>
                    <Link v-if="employees.next_page_url" :href="employees.next_page_url">Next</Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
    },
    props: {
        employees: Object
    },
    data() {
        return {
            form: useForm({
            })
        };
    },
    mounted() {
    },
    methods: {
        deleteItem(item){
            this.form.delete(route('employees.destroy', item.id), {
                preserveScroll: true,
                onSuccess: () => {},
                onError: () => {},
                onFinish: () => {},
            });
        },
    },
};
</script>
