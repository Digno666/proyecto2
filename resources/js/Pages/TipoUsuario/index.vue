<script setup>
import { ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import TextInput from '@/Components/TextInput.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
    tipoUsuarios: Object
});

const showModal = ref(false);
const selectedTipoUsuario = ref(null);

const confirmDeleteTipoUsuario = (item) => {
    selectedTipoUsuario.value = item;
    showModal.value = true;
};

const deleteTipoUsuario = () => {
    if (selectedTipoUsuario.value) {
        router.delete(route('tipoUsuario.destroy', selectedTipoUsuario.value.codTipoUsuario));
        showModal.value = false;
    }
};
</script>

<template>
    <plantillanav />
    <AppLayout title="Gestionar Tipos de Usuario">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lista de Tipos de Usuario
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Lista de Tipos de Usuario</h1>

                        <div class="flex justify-between items-center mb-6">
                            <Link :href="route('tipoUsuario.create')" class="btn btn-pink inline-flex items-center space-x-2">
                                <i class="fas fa-plus"></i>
                                <span>Registrar</span>
                            </Link>

                            <form :action="route('tipoUsuario.index')" method="get" class="flex space-x-2">
                                <TextInput class="w-full" name="buscar" placeholder="Buscar tipo de usuario" />
                                <button type="submit" class="btn btn-outline-pink flex items-center space-x-2">
                                    <i class="fas fa-search"></i>
                                    <span>Buscar</span>
                                </button>
                            </form>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table-auto w-full text-sm bg-pink-50">
                                <thead>
                                    <tr class="bg-pink-100">
                                        <th class="p-3 text-left text-pink-600">Código</th>
                                        <th class="p-3 text-left text-pink-600">Descripción</th>
                                        <th class="p-3 text-center text-pink-600">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in tipoUsuarios.data" :key="item.codTipoUsuario" class="border-b hover:bg-pink-200">
                                        <td class="p-3">{{ item.codTipoUsuario }}</td>
                                        <td class="p-3">{{ item.descripcion }}</td>
                                        <td class="p-3 text-center">
                                            <Link :href="route('tipoUsuario.edit', item.codTipoUsuario)" class="btn btn-warning btn-sm mx-1">
                                                <i class="fas fa-edit"></i> Editar
                                            </Link>

                                            <button @click="confirmDeleteTipoUsuario(item)" class="btn btn-danger btn-sm mx-1">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-between mt-4">
                            <div v-if="tipoUsuarios?.prev_page_url">
                                <Link :href="tipoUsuarios?.prev_page_url" class="btn btn-pink">
                                    <i class="fas fa-arrow-left"></i> Anterior
                                </Link>
                            </div>
                            <div v-if="tipoUsuarios?.next_page_url">
                                <Link :href="tipoUsuarios?.next_page_url" class="btn btn-pink">
                                    Siguiente <i class="fas fa-arrow-right"></i>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <VisitaFooter />
        </div>

        <DialogModal :show="showModal" @close="showModal = false">
            <template v-slot:title>
                <h1 class="text-lg font-semibold text-pink-600">Confirmar Eliminación</h1>
            </template>
            <template v-slot:content>
                <p>¿Estás seguro de que deseas eliminar el tipo de usuario <strong>{{ selectedTipoUsuario?.descripcion }}</strong>?</p>
            </template>
            <template v-slot:footer>
                <PrimaryButton @click="deleteTipoUsuario" class="bg-pink-600 hover:bg-pink-800">Eliminar</PrimaryButton>
                <button @click="showModal = false" class="ml-4 btn btn-secondary">Cancelar</button>
            </template>
        </DialogModal>
    </AppLayout>
</template>
