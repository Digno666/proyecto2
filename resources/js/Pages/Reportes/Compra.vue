<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
    compras: Object
});

const fechaInicio = ref('');
const fechaFin = ref('');


const formatoFecha = (fecha) => {
    const date = new Date(fecha);
    return date.toLocaleDateString('es-ES'); 
};

const filtrarCompras = () => {
    if (fechaInicio.value && fechaFin.value) {
        
        router.get(route('reportes.compras'), {
            inicio: fechaInicio.value,
            fin: fechaFin.value
        });
    } else {
        alert('Por favor, selecciona ambas fechas.');
    }
};
</script>

<template>
    <plantillanav />
    <AppLayout title="Reporte de Compras">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reporte de Compras
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <h1 class="text-2xl font-bold text-center mb-6">Reporte de Compras</h1>

                        
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex space-x-2">
                                <TextInput v-model="fechaInicio" type="date" class="w-full cc" placeholder="Fecha Inicio" />
                                <TextInput v-model="fechaFin" type="date" class="w-full cc" placeholder="Fecha Fin" />
                            </div>
                            <PrimaryButton @click="filtrarCompras" class="btn btn-primary">
                                Filtrar
                            </PrimaryButton>
                        </div>

                        
                        <div v-if="props.compras.data.length === 0" class="text-center text-red-600">
                            <p>No se realizaron compras en el rango de fechas seleccionado.</p>
                        </div>

                        
                        <div class="overflow-x-auto" v-else>
                            <table class="table-auto w-full text-sm">
                                <thead>
                                    <tr>
                                        <th class="p-3 text-left">Código Compra</th>
                                        <th class="p-3 text-left">Fecha</th>
                                        <th class="p-3 text-left">Monto Total</th>
                                        <th class="p-3 text-left">Proveedor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="compra in props.compras.data" :key="compra.codCompra" class="border-b">
                                        <td class="p-3">{{ compra.codCompra }}</td>
                                        <td class="p-3">{{ formatoFecha(compra.fechaCompra) }}</td>
                                        <td class="p-3">{{ compra.montoTotal }} Bs.</td>
                                        <td class="p-3">{{ compra.proveedor.nombre }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        
                        <div class="flex justify-between mt-4">
                            <div v-if="props.compras?.prev_page_url">
                                <Link :href="props.compras?.prev_page_url" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i> Anterior
                                </Link>
                            </div>
                            <div v-if="props.compras?.next_page_url">
                                <Link :href="props.compras?.next_page_url" class="btn btn-primary">
                                    Siguiente <i class="fas fa-arrow-right"></i>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <VisitaFooter />
        </div>
    </AppLayout>
</template>

<style scoped>
.table-auto th, .table-auto td {
    text-align: left;
    vertical-align: middle;
}
.py-12 {
  margin-top: calc(60px + 1rem); 
  margin-bottom: calc(60px + 1rem); 
}
</style>
