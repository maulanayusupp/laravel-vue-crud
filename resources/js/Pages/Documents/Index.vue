<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Documents" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Documents</h2>
        </template>

        <div class="mt-10">
            <label
                id="my-dropzone"
                for="dropzone-file"
                class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                <!-- <form id="my-dropzone" class="dropzone"> -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500 dark:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>

                    <h2 class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">Upload File</h2>

                    <p class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">Upload or drag & drop your file SVG, PNG, JPG or GIF. </p>

                    <input id="dropzone-file" type="file" class="hidden" />
                <!-- </form> -->
            </label>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mb-6">

                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="grid grid-cols-4">
                        <div v-for="item in items.data" :key="item.id">
                            <div class="text-white px-4 py-2 text-xs">{{ item.id }} - {{ item.name }}</div>
                            <div class="text-white px-4 py-2 text-center">
                                <img v-if="item.path_file" :src="item.path_file" alt="File" width="100" height="100" class="m-auto" />
                            </div>
                        </div>
                    </div>
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
import Dropzone from "dropzone";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
    },
    props: {
        items: Object,
        csrf_token: String,
    },
    data() {
        return {
            form: useForm({
            }),
            dropzone: null,
        };
    },
    mounted() {
        this.initDropzone();
    },
    methods: {
        initDropzone() {
            const options = {
                url: '/documents', // Your Laravel route for file upload
                uploadMultiple: true, // Enable multiple file upload
                paramName: 'files', // Name of the file input field
                headers: {
                    'X-CSRF-TOKEN': this.csrf_token,
                },
                previewsContainer: false, // Disable the previews container
                success: (file, response) => {
                    for (let index = 0; index < response.length; index++) {
                        const element = response[index];
                        const isExist = this.items.data.find(curr => curr.id === element.id);
                        if (!isExist) this.items.data.push(element);
                    }
                },
            };

            this.dropzone = new Dropzone('#my-dropzone', options);
        }
    },
};
</script>
