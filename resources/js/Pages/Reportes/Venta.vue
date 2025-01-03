<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
    ventas: Object
});


const fechaInicio = ref('');
const fechaFin = ref('');


const formatoFecha = (fecha) => {
    const date = new Date(fecha);
    return date.toLocaleDateString('es-ES'); 
};


const filtrarVentas = () => {
    router.get(route('reportes.ventas'), {
        inicio: fechaInicio.value,
        fin: fechaFin.value
    });
};
</script>

<template>
    <plantillanav  />
    <AppLayout title="Reporte de Ventas">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reporte de Ventas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <h1 class="text-2xl font-bold text-center mb-6">Reporte de Ventas</h1>

                        <div class="flex justify-between items-center mb-6">
                            <div class="flex space-x-2">
                                <TextInput v-model="fechaInicio" type="date" class="w-full cc" placeholder="Fecha Inicio" />
                                <TextInput v-model="fechaFin" type="date" class="w-full cc" placeholder="Fecha Fin" />
                            </div>
                            <PrimaryButton @click="filtrarVentas" class="btn btn-primary">
                                Filtrar
                            </PrimaryButton>
                        </div>
                        <div v-if="props.ventas.data.length === 0" class="text-center text-red-600">
                            <p>No se realizaron ventas en el rango de fechas seleccionado.</p>
                        </div>

                        <div class="overflow-x-auto" v-else>
                            <table class="table-auto w-full text-sm">
                                <thead>
                                    <tr>
                                        <th class="p-3 text-left">Código Venta</th>
                                        <th class="p-3 text-left">Fecha</th>
                                        <th class="p-3 text-left">Monto Total</th>
                                        <th class="p-3 text-left">Encargado</th>
                                        <th class="p-3 text-left">Cliente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="venta in props.ventas.data" :key="venta.codVenta" class="border-b">
                                        <td class="p-3">{{ venta.codVenta }}</td>
                                        <td class="p-3">{{ formatoFecha(venta.fechaVenta) }}</td>
                                        <td class="p-3">{{ venta.montoTotal }} Bs.</td>
                                        <td class="p-3">{{ venta.trabajador.nombre }}</td>
                                        <td class="p-3">{{ venta.cliente.nombre }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-between mt-4">
                            <div v-if="props.ventas?.prev_page_url">
                                <Link :href="props.ventas?.prev_page_url" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i> Anterior
                                </Link>
                            </div>
                            <div v-if="props.ventas?.next_page_url">
                                <Link :href="props.ventas?.next_page_url" class="btn btn-primary">
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
