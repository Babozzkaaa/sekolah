<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Multiselect from 'vue-multiselect';

const props = defineProps({
    errors: Object,
    guru: Object,
    kelas: Object,
});

const form = ref({
    id_kelas: '',
    id_guru: [],
});

const process = ref(false);

const submit = () => {
    process.value = true;

    const formData = new FormData();

    formData.append('id_kelas', form.value.id_kelas);
    form.value.id_guru.forEach((item) => {
        formData.append('id_guru[]', item.id);
    });

    const res = router.post(route('kelas-guru.createData'), formData, {
        onFinish: () => {
            process.value = false;
        },
    });
    console.log(res);
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="min-h-screen bg-gray-50">
            <div class="mx-auto max-w-2xl px-6 py-8">
                <div class="mb-8">
                    <a
                        :href="route('kelas-guru.list')"
                        class="mb-4 inline-block text-blue-600 hover:text-blue-800"
                    >
                        < Kembali
                    </a>
                    <h1 class="text-2xl font-semibold text-gray-900">
                        Tambah Kelas Guru
                    </h1>
                </div>

                <div class="rounded-lg border border-gray-200 bg-white p-6">
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
                                for="id_guru"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Guru <span class="text-red-500">*</span>
                            </label>
                            <Multiselect
                                v-model="form.id_guru"
                                :options="props.guru"
                                :multiple="true"
                                label="nama"
                                track-by="id"
                                :clear-on-select="false"
                                :close-on-select="false"
                                key="id"
                                :value="id"
                            />
                            <p
                                v-if="errors.id_guru"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ errors.id_guru }}
                            </p>
                        </div>

                        <div class="flex gap-3 pt-4">
                            <a
                                :href="route('kelas-guru.list')"
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
