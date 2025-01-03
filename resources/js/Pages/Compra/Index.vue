<script setup>
import { ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import TextInput from '@/Components/TextInput.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
    compras: Object
});

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

const showModal = ref(false);
const selectedCompra = ref(null);

// Función para confirmar eliminación de compra
const confirmDeleteCompra = (item) => {
    selectedCompra.value = item;
    showModal.value = true;
};

// Función para eliminar compra
const deleteCompra = () => {
    if (selectedCompra.value) {
        router.delete(route('compra.destroy', selectedCompra.value.codCompra));
        showModal.value = false;
    }
};
</script>

<template>
    <plantillanav :userName="$page.props.auth.user.name"/>
    <AppLayout title="Gestionar Compras">
        <template #header>
            <h2 class="font-semibold text-xl text-pink-600 leading-tight">
                Lista de Compras
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <h1 class="text-2xl font-bold text-center mb-6 text-pink-500">Lista de Compras</h1>

                        <div class="flex justify-between items-center mb-6">
                            <Link :href="route('compra.create')" class="btn btn-primary inline-flex items-center space-x-2 bg-pink-500 hover:bg-pink-700 text-white">
                                <i class="fas fa-plus"></i>
                                <span>Registrar Compra</span>
                            </Link>

                            <form :action="route('compra.index')" method="get" class="flex space-x-2">
                                <select name="criterio" class="form-select bg-pink-100 border-pink-300">
                                    <option value="fechaCompra">Fecha</option>
                                    <option value="codProveedorF">ID Proveedor</option>
                                </select>
                                <TextInput class="w-full bg-pink-50 border-pink-300" name="buscar" placeholder="Buscar Compra" />
                                <button type="submit" class="btn btn-outline-secondary flex items-center space-x-2 bg-pink-500 hover:bg-pink-700 text-white">
                                    <i class="fas fa-search"></i>
                                    <span>Buscar</span>
                                </button>
                            </form>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table-auto w-full text-sm bg-pink-50">
                                <thead class="bg-pink-200">
                                    <tr>
                                        <th class="p-3 text-left text-pink-600">Código de Compra</th>
                                        <th class="p-3 text-left text-pink-600">Fecha de Compra</th>
                                        <th class="p-3 text-left text-pink-600">Monto Total</th>
                                        <th class="p-3 text-left text-pink-600">Proveedor</th>
                                        <th class="p-3 text-left text-pink-600">Encargado</th>
                                        <th class="p-3 text-center text-pink-600">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="compra in compras.data" :key="compra.codCompra" class="border-b hover:bg-pink-100">
                                        <td class="p-3">{{ compra.codCompra }}</td>
                                        <td class="p-3">{{ formatoFecha(compra.fechaCompra) }}</td>
                                        <td class="p-3">{{ compra.montoTotal }} Bs.</td>
                                        <td class="p-3">{{ compra.proveedor.nombre }}</td>
                                        <td class="p-3">{{ compra.trabajador.nombre }}</td>
                                        <td class="p-3 text-center">
                                            <Link :href="route('compra.show', compra.codCompra)" class="btn btn-primary btn-sm mx-1 bg-pink-500 hover:bg-pink-700">
                                                <i class="fas fa-eye"></i> Ver Detalle
                                            </Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-between mt-4">
                            <div v-if="compras?.prev_page_url">
                                <Link :href="compras?.prev_page_url" class="btn btn-primary bg-pink-500 hover:bg-pink-700 text-white">
                                    <i class="fas fa-arrow-left"></i> Anterior
                                </Link>
                            </div>
                            <div v-if="compras?.next_page_url">
                                <Link :href="compras?.next_page_url" class="btn btn-primary bg-pink-500 hover:bg-pink-700 text-white">
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
                <p class="text-pink-600">¿Estás seguro de que deseas eliminar la compra <strong>{{ selectedCompra?.codCompra }}</strong>?</p>
            </template>
            <template v-slot:footer>
                <PrimaryButton @click="deleteCompra" class="bg-red-600 hover:bg-red-800">Eliminar</PrimaryButton>
                <button @click="showModal = false" class="ml-4 btn btn-secondary">Cancelar</button>
            </template>
        </DialogModal>
    </AppLayout>
</template>



<script>
import { defineComponent } from 'vue';

export default defineComponent({
    filters: {
        formatDate(value) {
            if (!value) return '';
            return new Date(value).toLocaleDateString();
        },
        formatCurrency(value) {
            return new Intl.NumberFormat('es-BO', { style: 'currency', currency: 'BOB' }).format(value);
        }
    }
});
</script>
