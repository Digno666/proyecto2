<script setup>
import { ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import TextInput from '@/Components/TextInput.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
    productos: Object,
    categorias: Array,
});

const showModal = ref(false);
const selectedProducto = ref(null);

const confirmDeleteProducto = (producto) => {
    selectedProducto.value = producto;
    showModal.value = true;
};

const deleteProducto = () => {
    if (selectedProducto.value) {
        router.delete(route('producto.destroy', selectedProducto.value.codProducto));
        showModal.value = false;
    }
};
</script>

<template>
     <plantillanav :userName="$page.props.auth.user.name"/>
    <AppLayout title="Gestionar Productos">
        <template #header>
            <h2 class="font-semibold text-xl text-pink-600 leading-tight">
                Lista de Productos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Lista de Productos</h1>

                        <div class="flex justify-between items-center mb-6">
                            <Link :href="route('producto.create')" class="btn btn-pink inline-flex items-center space-x-2">
                                <i class="fas fa-plus"></i>
                                <span>Registrar</span>
                            </Link>

                            <form :action="route('producto.index')" method="get" class="flex space-x-2">
                                <div class="input-group">
                                    <select name="criterio" class="form-select text-pink-600 border-pink-300" aria-label="Criterio de búsqueda">
                                        <option value="" disabled selected>Seleccionar criterio</option>
                                        <option value="nombre">Nombre</option>
                                    </select>
                                    <input type="text" name="buscar" class="form-control bg-pink-100 text-pink-600 border-pink-300" placeholder="Buscar producto" />
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
                                        <th class="p-3 text-left text-pink-600">Código</th>
                                        <th class="p-3 text-left text-pink-600">Nombre</th>
                                        <th class="p-3 text-left text-pink-600">Descripción</th>
                                        <th class="p-3 text-left text-pink-600">Precio</th>
                                        <th class="p-3 text-left text-pink-600">Stock</th>
                                        <th class="p-3 text-left text-pink-600">Categoría</th>
                                        <th class="p-3 text-left text-pink-600">Imagen</th>
                                        <th class="p-3 text-center text-pink-600">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="producto in productos.data" :key="producto.codProducto" class="border-b hover:bg-pink-200">
                                        <td class="p-3">{{ producto.codProducto }}</td>
                                        <td class="p-3">{{ producto.nombre }}</td>
                                        <td class="p-3">{{ producto.descripcion }}</td>
                                        <td class="p-3">{{ producto.precio.toFixed(2) }} Bs.</td>
                                        <td class="p-3">{{ producto.stock }}</td>
                                        <td class="p-3">{{ producto.categoria?.nombre ?? 'No disponible' }}</td>
                                        <td class="p-3">
                                            <img v-if="producto.imagen" :src="`/storage/uploads/${producto.imagen}`" alt="Imagen del producto" class="img-thumbnail" style="max-width: 120px;" />
                                            <span v-else>No tiene imagen</span>
                                        </td>
                                        <td class="p-3 text-center">
                                            <Link :href="route('producto.edit', producto.codProducto)" class="btn btn-warning btn-sm mx-1">
                                                <i class="fas fa-edit"></i> Editar
                                            </Link>

                                            <button @click="confirmDeleteProducto(producto)" class="btn btn-danger btn-sm mx-1">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-between mt-4">
                            <div v-if="productos?.prev_page_url">
                                <Link :href="productos?.prev_page_url" class="btn btn-pink">
                                    <i class="fas fa-arrow-left"></i> Anterior
                                </Link>
                            </div>
                            <div v-if="productos?.next_page_url">
                                <Link :href="productos?.next_page_url" class="btn btn-pink">
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
                <p>¿Estás seguro de que deseas eliminar el producto <strong>{{ selectedProducto?.nombre }}</strong>?</p>
            </template>
            <template v-slot:footer>
                <PrimaryButton @click="deleteProducto" class="bg-pink-600 hover:bg-pink-800">Eliminar</PrimaryButton>
                <button @click="showModal = false" class="ml-4 btn btn-secondary">Cancelar</button>
            </template>
        </DialogModal>
    </AppLayout>
</template>

