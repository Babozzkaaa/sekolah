<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    siswa: Object,
    errors: Object,
});

const form = ref({
    nama: props.siswa.nama,
    nis: props.siswa.nis,
    jenis_kelamin: props.siswa.jenis_kelamin,
    tanggal_lahir: props.siswa.tanggal_lahir,
});
const process = ref(false);

const submit = () => {
    process.value = true;

    router.put(route('siswa.editData', props.siswa.id), form.value, {
        onFinish: () => {
            process.value = false;
        },
    });
};
</script>

<template>
    <AuthenticatedLayout>


        <div class="min-h-screen bg-gray-50 py-8">
            <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <a
                        :href="route('siswa.list')"
                        class="mb-4 flex items-center gap-2 text-blue-600 hover:text-blue-800"
                    >
                       < Kembali
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Edit Siswa
                    </h1>
                </div>

                <div
                    class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm"
                >
                    <form @submit.prevent="submit">
                        <div class="space-y-6">
                            <div>
                                <label
                                    for="nama"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    Nama Siswa
                                    <span class="text-red-500">*</span>
                                </label>
                                <input
                                    id="nama"
                                    v-model="form.nama"
                                    type="text"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                                    :class="{ 'border-red-500': errors.nama }"
                                    placeholder="Masukkan nama siswa"
                                />
                                <p
                                    v-if="errors.nama"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ errors.nama }}
                                </p>
                            </div>

                            <div>
                                <label
                                    for="nis"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    NIS <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                                    ></div>
                                    <input
                                        id="nis"
                                        v-model="form.nis"
                                        type="number"
                                        class="w-full rounded-lg border border-gray-300 py-2 pr-3 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                                        :class="{
                                            'border-red-500': errors.nis,
                                        }"
                                        placeholder="Masukkan NIS siswa"
                                    />
                                </div>
                                <p
                                    v-if="errors.nis"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ errors.nis }}
                                </p>
                            </div>

                            <div>
                                <label
                                    for="jenis_kelamin"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    Jenis Kelamin
                                    <span class="text-red-500">*</span>
                                </label>
                                <select
                                    id="jenis_kelamin"
                                    v-model="form.jenis_kelamin"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                                    :class="{
                                        'border-red-500': errors.jenis_kelamin,
                                    }"
                                >
                                    <option value="">
                                        Pilih Jenis Kelamin
                                    </option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <p
                                    v-if="errors.jenis_kelamin"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ errors.jenis_kelamin }}
                                </p>
                            </div>

                            <div>
                                <label
                                    for="tanggal_lahir"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    Tanggal Lahir *
                                </label>
                                <input
                                    type="date"
                                    id="tanggal_lahir"
                                    v-model="form.tanggal_lahir"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                                    :class="{
                                        'border-red-500': errors.tanggal_lahir,
                                    }"
                                    placeholder="Masukkan tanggal lahir"
                                ></input>
                                <p
                                    v-if="errors.tanggal_lahir"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ errors.tanggal_lahir }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="mt-8 flex items-center justify-end gap-4 border-t border-gray-200 pt-6"
                        >
                            <a
                                :href="route('siswa.list')"
                                class="rounded-lg border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-gray-500"
                            >
                                Batal
                            </a>
                            <button
                                type="submit"
                                :disabled="processing"
                                class="flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 disabled:cursor-not-allowed disabled:opacity-50"
                            >
                                <svg
                                    v-if="processing"
                                    class="h-4 w-4 animate-spin"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    ></circle>
                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                    ></path>
                                </svg>
                                {{
                                    processing
                                        ? 'Menyimpan...'
                                        : 'Simpan'
                                }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
