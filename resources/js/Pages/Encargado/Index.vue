<script setup>
import { ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import TextInput from '@/Components/TextInput.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
    vendedores: Object
});

const showModal = ref(false);
const selectedVendedor = ref(null);

const confirmDeleteVendedor = (item) => {
    selectedVendedor.value = item;
    showModal.value = true;
};

const deleteVendedor = () => {
    if (selectedVendedor.value) {
        router.delete(route('vendedor.destroy', selectedVendedor.value.carnetIdentidad));
        showModal.value = false;
    }
};
</script>
<template>
     <plantillanav/>
    <AppLayout title="Gestionar Encargados">
        <template #header>
            <h1 class="font-semibold text-xl text-pink-600 leading-tight">
                Lista de Trabajadores
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Lista de Trabajadores</h1>

                        <div class="flex justify-between items-center mb-6">
                            <Link :href="route('encargado.create')" class="btn btn-pink inline-flex items-center space-x-2">
                                <i class="fas fa-plus"></i>
                                <span>Registrar</span>
                            </Link>

                            <form :action="route('encargado.index')" method="get" class="flex space-x-2">
                                <div class="flex space-x-2">
                                    <TextInput class="w-full text-input" name="buscar" placeholder="Buscar trabajador" />
                                    <button type="submit" class="btn btn-outline-pink flex items-center space-x-2">
                                        <i class="fas fa-search"></i>
                                        <span>Buscar</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table-auto w-full text-sm">
                                <thead>
                                    <tr>
                                        <th class="p-3 text-left text-pink-600">Carnet de Identidad</th>
                                        <th class="p-3 text-left text-pink-600">Nombre</th>
                                        <th class="p-3 text-left text-pink-600">Apellido Paterno</th>
                                        <th class="p-3 text-left text-pink-600">Apellido Materno</th>
                                        <th class="p-3 text-left text-pink-600">Sexo</th>
                                        <th class="p-3 text-left text-pink-600">Teléfono</th>
                                        <th class="p-3 text-left text-pink-600">Usuario</th>
                                        <th class="p-3 text-center text-pink-600">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in vendedores.data" :key="item.carnetIdentidad" class="border-b">
                                        <td class="p-3">{{ item.carnetIdentidad }}</td>
                                        <td class="p-3">{{ item.nombre }}</td>
                                        <td class="p-3">{{ item.apellidoPaterno }}</td>
                                        <td class="p-3">{{ item.apellidoMaterno }}</td>
                                        <td class="p-3">{{ item.sexo }}</td>
                                        <td class="p-3">{{ item.telefono }}</td>
                                        <td class="p-3">{{ item.usuario ? item.usuario.name : 'N/A' }}</td>
                                        <td class="p-3 text-center">
                                            <Link :href="route('encargado.edit', item.carnetIdentidad)" class="btn btn-warning btn-sm mx-1">
                                                <i class="fas fa-edit"></i> Editar
                                            </Link>

                                            <button @click="confirmDeleteVendedor(item)" class="btn btn-danger btn-sm mx-1">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-between mt-4">
                            <div v-if="vendedores?.prev_page_url">
                                <Link :href="vendedores?.prev_page_url" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i> Anterior
                                </Link>
                            </div>
                            <div v-if="vendedores?.next_page_url">
                                <Link :href="vendedores?.next_page_url" class="btn btn-primary">
                                    Siguiente <i class="fas fa-arrow-right"></i>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <VisitaFooter />

        <DialogModal :show="showModal" @close="showModal = false">
            <template v-slot:title>
                <h1 class="text-lg font-semibold text-pink-600">Confirmar Eliminación</h1>
            </template>
            <template v-slot:content>
                <p>¿Estás seguro de que deseas eliminar al encargado <strong>{{ selectedVendedor?.nombre }} {{ selectedVendedor?.apellidoPaterno }}</strong>?</p>
            </template>
            <template v-slot:footer>
                <PrimaryButton @click="deleteVendedor" class="bg-red-600 hover:bg-red-800 text-white">Eliminar</PrimaryButton>
                <button @click="showModal = false" class="ml-4 btn btn-secondary">Cancelar</button>
            </template>
        </DialogModal>
    </AppLayout>
</template>

