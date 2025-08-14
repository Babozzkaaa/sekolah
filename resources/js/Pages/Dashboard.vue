<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Gunakan Mode Desktop untuk melihat route lengkap (route
                        berada di navbar), <br />
                        untuk melihat List Siswa berdasarkan kelasnya, List Guru
                        berdasarkan Kelas, dan List Guru Siswa di Suatu Kelas
                        dapat menuju ke halaman Kelas. <br />
                        Pastikan sudah menjalankan "php artisan db:seed" dan isi
                        data kelas guru dan kelas siswa secara manual
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
