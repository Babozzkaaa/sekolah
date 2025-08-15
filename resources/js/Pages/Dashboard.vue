<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
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
                        Pastikan sudah menjalankan "php artisan db:seed" dan isi
                        data kelas guru dan kelas siswa secara manual
                    </div>
                    <div class="p-6 text-gray-900">
                        untuk melihat route guru berdasarkan kelas
                        <button
                            class="rounded-md border-2 bg-blue-600 px-3 py-2"
                        >
                            <Link :href="route('gbk.list')">
                                <span class="font-bold text-white"> Guru </span>
                            </Link>
                        </button>
                        <br />
                        untuk melihat route siswa berdasarkan kelas

                        <button
                            class="rounded-md border-2 bg-blue-600 px-3 py-2"
                        >
                            <Link :href="route('sbk.list')">
                                <span class="font-bold text-white">
                                    Siswa
                                </span>
                            </Link>
                        </button>
                        <br />
                        untuk melihat route guru dan siswa berdasarkan kelas
                        <button
                            class="rounded-md border-2 bg-blue-600 px-3 py-2"
                        >
                            <Link :href="route('kgs.list')">
                                <span class="font-bold text-white">
                                    Guru Siswa
                                </span>
                            </Link>
                        </button>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
