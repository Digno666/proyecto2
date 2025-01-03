<script setup>
import { ref } from 'vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';
import plantillanav from '@/Layouts/plantillanav.vue';

const props = defineProps({
  reserva: Object, 
});
</script>

<template>
  <plantillanav :userName="$page.props.auth.user.name" />
  <AppLayout title="Detalles de la Reserva">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        Detalles de la Reserva
      </h1>
    </template>

    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 lg:p-8 rounded-lg">
            <h1 class="text-3xl font-bold text-center text-pink-600 mb-6">Detalles de la Reserva</h1>

            <div class=" rounded-lg p-6">
              <h3 class="text-2xl font-semibold text-pink-600 mb-4">Información de la Reserva</h3>
              
              <p><strong>Código Reserva:</strong> {{ reserva.codReserva }}</p>
              <p><strong>Cliente:</strong> {{ reserva.cliente.nombre }}</p>
              <p><strong>Trabajador:</strong> {{ reserva.trabajador.nombre }}</p>
              <p><strong>Fecha y Hora:</strong> {{ reserva.fechaReserva }} a las {{ reserva.horaReserva }}</p>

              <h4 class="text-xl font-semibold text-pink-600 mt-4">Servicios Seleccionados</h4>
              <ul class="list-disc ml-6">
                <li v-for="servicio in reserva.servicios" :key="servicio.codServicio">
                  {{ servicio.nombre }} - Bs.{{ servicio.precio }}
                </li>
              </ul>

              <h4 class="text-xl font-semibold text-pink-600 mt-4">Monto Total</h4>
              <p class="text-lg font-bold">Bs.{{ reserva.montoTotal }}</p>
            </div>
          </div>
        </div>
      </div>
      <VisitaFooter />
    </div>
  </AppLayout>
</template>
