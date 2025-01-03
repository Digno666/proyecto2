<script setup>
import { ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import VisitaFooter from '@/Components/VisitaFooter.vue';
import plantillanav from '@/Layouts/plantillanav.vue';

const props = defineProps({
  reservas: Array, // Recibe las reservas desde el backend
});

// Método para redirigir a los detalles de la reserva
const verDetalles = (codReserva) => {
  router.visit(`/reservas/${codReserva}`);
};
</script>

<template>
  <plantillanav :userName="$page.props.auth.user.name" />
  <AppLayout title="Gestionar Reservas">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        Lista de Reservas
      </h1>
    </template>

    <div class="py-12">
      <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 lg:p-8">
            <h1 class="text-3xl font-bold text-center text-pink-600 mb-6">Lista de Reservas</h1>

            <!-- Tabla de reservas -->
            <div class="overflow-x-auto  shadow-lg rounded-lg">
              <table class="min-w-full table-auto border-collapse rounded-lg">
                <thead>
                  <tr class="bg-pink-600 text-white">
                    <th class="p-3 text-left">Código Reserva</th>
                    <th class="p-3 text-left">Cliente</th>
                    <th class="p-3 text-left">Trabajador</th>
                    <th class="p-3 text-left">Servicios</th>
                    <th class="p-3 text-left">Monto Total</th>
                    <th class="p-3 text-left">Fecha</th>
                    <th class="p-3 text-left">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="reserva in reservas" :key="reserva.codReserva" class="border-b hover:bg-pink-200">
                    <td class="p-3">{{ reserva.codReserva }}</td>
                    <td class="p-3">{{ reserva.cliente.nombre }}</td>
                    <td class="p-3">{{ reserva.trabajador.nombre }}</td>
                    <td class="p-3">
                      <ul>
                        <li v-for="servicio in reserva.servicios" :key="servicio.codServicio">{{ servicio.nombre }}</li>
                      </ul>
                    </td>
                    <td class="p-3">Bs.{{ reserva.montoTotal }}</td>
                    <td class="p-3">{{ reserva.fechaReserva }}</td>
                    <td class="p-3 text-center">
                      <button
                        @click="verDetalles(reserva.codReserva)"
                        class="btn btn-primary btn-sm mx-1 bg-pink-500 hover:bg-pink-700">
                        <i class="fas fa-eye"></i>Ver detalle
                      </button>
                      <!-- Agrega más botones aquí si es necesario -->
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <VisitaFooter />
    </div>
  </AppLayout>
</template>
