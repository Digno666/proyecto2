<script setup>
import { ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import TextInput from '@/Components/TextInput.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';
import plantillanav from '@/Layouts/plantillanav.vue';

const props = defineProps({
    proveedores: Object,
    permisos: {
        type: Array,
        default: () => [],
    },
});

// Estado para el modal de confirmación de eliminación
const showModal = ref(false);
const selectedProveedor = ref(null);

// Función para confirmar eliminación de proveedor
const confirmDeleteProveedor = (item) => {
    selectedProveedor.value = item;
    showModal.value = true;
};

// Función para eliminar proveedor
const deleteProveedor = () => {
    if (selectedProveedor.value) {
        router.delete(route('proveedor.destroy', selectedProveedor.value.codProveedor));
        showModal.value = false;
    }
};

// Función para formatear fechas
const formatoFecha = (fecha) => {
    const date = new Date(fecha);
    const fechaLocal = new Date(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate());
    const options = {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
    };
    return fechaLocal.toLocaleDateString('es-ES', options);
};

// Función para convertir a formato de moneda (en bolivianos)
const formatCurrency = (value) => {
    return new Intl.NumberFormat('es-BO', { style: 'currency', currency: 'BOB' }).format(value);
};
</script>

<template>
     <plantillanav :userName="$page.props.auth.user.name"/>
    <AppLayout title="Gestionar Proveedores">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                Lista de Proveedores
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Lista de Proveedores</h1>

                        <div class="flex justify-between items-center mb-6">
                            <Link 
                                v-if="Array.isArray(permisos) && permisos.includes('registrar')" 
                                :href="route('proveedor.create')" 
                                class="btn btn-pink inline-flex items-center space-x-2"
                            >
                                <i class="fas fa-plus"></i>
                                <span>Registrar</span>
                            </Link>
                            <p v-if="!Array.isArray(permisos)">La propiedad permisos no es un array.</p>
                            <p v-if="Array.isArray(permisos) && !permisos.includes('registrar')">No tienes permiso para registrar nuevos proveedores.</p>

                            <form :action="route('proveedor.index')" method="get" class="flex space-x-2">
                                <div class="flex space-x-2">
                                    <select name="criterio" class="form-select bg-pink-100 text-pink-600 border-pink-300">
                                        <option value="nombre">Nombre</option>
                                        <option value="direccion">Dirección</option>
                                        <option value="telefono">Teléfono</option>
                                    </select>
                                    <TextInput class="w-full bg-pink-100 text-pink-600 border-pink-300" name="buscar" placeholder="Buscar proveedor" />
                                    <button type="submit" class="btn btn-outline-pink flex items-center space-x-2">
                                        <i class="fas fa-search"></i>
                                        <span>Buscar</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Tabla de proveedores -->
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full text-sm border-collapse text-pink-600">
                                <thead>
                                    <tr class="bg-pink-100 text-pink-700">
                                        <th class="p-3 text-left">Código</th>
                                        <th class="p-3 text-left">Nombre</th>
                                        <th class="p-3 text-left">Dirección</th>
                                        <th class="p-3 text-left">Teléfono</th>
                                        <th class="p-3 text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in proveedores.data" :key="item.codProveedor" class="border-b hover:bg-pink-200">
                                        <td class="p-3">{{ item.codProveedor }}</td>
                                        <td class="p-3">{{ item.nombre }}</td>
                                        <td class="p-3">{{ item.direccion }}</td>
                                        <td class="p-3">{{ item.telefono }}</td>
                                        <td class="p-3 text-center">
                                            <Link 
                                                v-if="Array.isArray(permisos) && permisos.includes('editar')" 
                                                :href="route('proveedor.edit', item.codProveedor)" 
                                                class="btn btn-warning btn-sm mx-1"
                                            >
                                                <i class="fas fa-edit"></i> Editar
                                            </Link>
                                            <button 
                                                v-if="Array.isArray(permisos) && permisos.includes('eliminar')" 
                                                @click="confirmDeleteProveedor(item)" 
                                                class="btn btn-danger btn-sm mx-1"
                                            >
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-between mt-4">
                            <div v-if="proveedores?.prev_page_url">
                                <Link :href="proveedores?.prev_page_url" class="btn btn-pink">
                                    <i class="fas fa-arrow-left"></i> Anterior
                                </Link>
                            </div>
                            <div v-if="proveedores?.next_page_url">
                                <Link :href="proveedores?.next_page_url" class="btn btn-pink">
                                    Siguiente <i class="fas fa-arrow-right"></i>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <VisitaFooter />
        </div>

        <!-- Modal de confirmación de eliminación -->
        <DialogModal :show="showModal" @close="showModal = false">
            <template v-slot:title>
                <h1 class="text-lg font-semibold text-pink-600">Confirmar Eliminación</h1>
            </template>
            <template v-slot:content>
                <p>¿Estás seguro de que deseas eliminar el proveedor <strong>{{ selectedProveedor?.nombre }}</strong>?</p>
            </template>
            <template v-slot:footer>
                <PrimaryButton @click="deleteProveedor" class="bg-pink-600 hover:bg-pink-800">Eliminar</PrimaryButton>
                <button @click="showModal = false" class="ml-4 btn btn-secondary">Cancelar</button>
            </template>
        </DialogModal>
    </AppLayout>
</template>

