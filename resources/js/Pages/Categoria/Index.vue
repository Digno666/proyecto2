<script setup>
import { ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import TextInput from '@/Components/TextInput.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
    categorias: Object
});

const showModal = ref(false);
const selectedCategoria = ref(null);

const confirmDeleteCategoria = (item) => {
    selectedCategoria.value = item;
    showModal.value = true;
};

const deleteCategoria = () => {
    if (selectedCategoria.value) {
        router.delete(route('categoria.destroy', selectedCategoria.value.codCategoria));
        showModal.value = false;
    }
};
</script>

<template>
    <plantillanav :userName="$page.props.auth.user.name"/>
  
    <AppLayout title="Gestionar Categorías">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lista de Categorías
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Lista de Categorías</h1>

                        <div class="flex justify-between items-center mb-6">
                            <Link :href="route('categoria.create')" class="btn btn-pink inline-flex items-center space-x-2">
                                <i class="fas fa-plus"></i>
                                <span>Registrar</span>
                            </Link>
                            <form :action="route('categoria.index')" method="get" class="flex items-center space-x-2">
                                <div class="input-group flex items-center space-x-2">
                                    <select name="criterio" class="form-select">
                                        <option value="nombre">Nombre</option>
                                    </select>
                                    <TextInput class="w-full" name="buscar" placeholder="Buscar categoría" />
                                    <button type="submit" class="btn btn-outline-pink flex items-center space-x-2">
                                        <i class="fas fa-search"></i>
                                        <span>Buscar</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table-auto w-full text-sm bg-pink-50">
                                <thead>
                                    <tr class="bg-pink-100">
                                        <th class="p-3 text-left text-pink-600">Código de Categoría</th>
                                        <th class="p-3 text-left text-pink-600">Nombre</th>
                                        <th class="p-3 text-center text-pink-600">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in categorias.data" :key="item.codCategoria" class="border-b hover:bg-pink-200">
                                        <td class="p-3">{{ item.codCategoria }}</td>
                                        <td class="p-3">{{ item.nombre }}</td>
                                        <td class="p-3 text-center">
                                            <Link :href="route('categoria.edit', item.codCategoria)" class="btn btn-warning btn-sm mx-1">
                                                <i class="fas fa-edit"></i> Editar
                                            </Link>
                                            <button @click="confirmDeleteCategoria(item)" class="btn btn-danger btn-sm mx-1">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-between mt-4">
                            <div v-if="categorias?.prev_page_url">
                                <Link :href="categorias?.prev_page_url" class="btn btn-pink">
                                    <i class="fas fa-arrow-left"></i> Anterior
                                </Link>
                            </div>
                            <div v-if="categorias?.next_page_url">
                                <Link :href="categorias?.next_page_url" class="btn btn-pink">
                                    Siguiente <i class="fas fa-arrow-right"></i>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <DialogModal :show="showModal" @close="showModal = false">
            <template v-slot:title>
                <h1 class="text-lg font-semibold text-pink-600">Confirmar Eliminación</h1>
            </template>
            <template v-slot:content>
                <p>¿Estás seguro de que deseas eliminar la categoría <strong>{{ selectedCategoria?.nombre }}</strong>?</p>
            </template>
            <template v-slot:footer>
                <PrimaryButton @click="deleteCategoria" class="bg-pink-600 hover:bg-pink-800">Eliminar</PrimaryButton>
                <button @click="showModal = false" class="ml-4 btn btn-secondary">Cancelar</button>
            </template>
        </DialogModal>
    </AppLayout>
    <VisitaFooter />
</template>

