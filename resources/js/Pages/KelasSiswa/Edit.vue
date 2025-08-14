<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    kelassiswa: Object,
    kelas: Object,
    siswa: Object,
    errors: Object,
});

const form = ref({
    id_kelas: props.kelassiswa.id_kelas,
    id_siswa: props.kelassiswa.id_siswa,
});
const process = ref(false);

const submit = () => {
    process.value = true;

    router.put(route('kelas-siswa.editData', props.kelassiswa.id), form.value, {
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
                        :href="route('kelas.list')"
                        class="mb-4 flex items-center gap-2 text-blue-600 hover:text-blue-800"
                    >
                        < Kembali
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Kelas</h1>
                </div>

                <div
                    class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm"
                >
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label
                                for="id_kelas"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Kelas <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="id_kelas"
                                v-model="form.id_kelas"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{
                                    'border-red-500': errors.id_kelas,
                                }"
                            >
                                <option value="">Pilih Kelas</option>
                                <option
                                    v-for="kelas in props.kelas"
                                    :key="kelas.id"
                                    :value="kelas.id"
                                >
                                    {{ kelas.nama }}
                                </option>
                            </select>
                            <p
                                v-if="errors.id_kelas"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ errors.id_kelas }}
                            </p>
                        </div>

                        <div>
                            <label
                                for="id_siswa"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Siswa <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="id_siswa"
                                v-model="form.id_siswa"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{
                                    'border-red-500': errors.id_siswa,
                                }"
                            >
                                <option value="">Pilih siswa</option>
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

                        <div class="flex gap-3 pt-4">
                            <a
                                :href="route('kelas-siswa.list')"
                                class="rounded bg-gray-100 px-4 py-2 text-gray-700 hover:bg-gray-200"
                            >
                                Batal
                            </a>
                            <button
                                type="submit"
                                class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :disabled="process"
                            >
                                {{ process ? 'Menyimpan...' : 'Simpan' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
