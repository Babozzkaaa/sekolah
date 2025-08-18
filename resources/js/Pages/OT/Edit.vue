<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    ot: Object,
    siswa: Object,
    errors: Object,
});

const form = ref({
    nama: props.ot.nama,
    id_siswa: props.ot.id_siswa,
});
const process = ref(false);

const submit = () => {
    process.value = true;

    router.put(route('ot.editData', props.ot.id), form.value, {
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
                        :href="route('ot.list')"
                        class="mb-4 flex items-center gap-2 text-blue-600 hover:text-blue-800"
                    >
                        < Kembali
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Edit orang tua
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
                                    Nama orang tua
                                    <span class="text-red-500">*</span>
                                </label>
                                <input
                                    id="nama"
                                    v-model="form.nama"
                                    type="text"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                                    :class="{ 'border-red-500': errors.nama }"
                                    placeholder="Masukkan nama orang tua"
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
                                    for="id_siswa"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                    >Siswa</label
                                >
                                <select
                                    id="id_siswa"
                                    v-model="form.id_siswa"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                                    :class="{
                                        'border-red-500': errors.id_siswa,
                                    }"
                                >
                                    <option value="">Pilih Siswa</option>
                                    <option
                                        v-for="siswa in props.siswa"
                                        :key="siswa.id"
                                        :value="siswa.id"
                                    >
                                        {{ siswa.nama }}
                                    </option>
                                </select>
                                <p
                                    v-if="errors.id_siswa"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ errors.id_siswa }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="mt-8 flex items-center justify-end gap-4 border-t border-gray-200 pt-6"
                        >
                            <a
                                :href="route('ot.list')"
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
                                {{ processing ? 'Menyimpan...' : 'Simpan' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
