<script setup>
import { ref } from 'vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';
import plantillanav from '@/Layouts/plantillanav.vue';

const props = defineProps({
  venta: Object,
  detalleVenta: Array,
  pago: Object,
});

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
</script>

<template>
  <plantillanav :userName="$page.props.auth.user.name" />
  <AppLayout title="Detalles de la Venta">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        Detalles de la Venta
      </h1>
    </template>

    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 lg:p-8 rounded-lg">
            <h1 class="text-3xl font-bold text-center  mb-6">Detalles de la Venta</h1>

            <div class="rounded-lg p-6">
              <h3 class="text-2xl font-semibold  mb-4">Información de la Venta</h3>

              <p><strong>Venta #:</strong> {{ venta.codVenta }}</p>
              <p><strong>Fecha de Venta:</strong> {{ formatoFecha(venta.fechaVenta) }}</p>
              <p><strong>Cliente:</strong> {{ venta.cliente.nombre }} {{ venta.cliente.apellidoPaterno }} {{ venta.cliente.apellidoMaterno }}</p>
              <p><strong>Encargado:</strong> {{ venta.trabajador.nombre }} {{ venta.trabajador.apellidoPaterno }} {{ venta.trabajador.apellidoMaterno }}</p>
              <p><strong>Monto Total:</strong> {{ venta.montoTotal }} Bs.</p>

              <h4 class="text-xl font-semibold  mt-4">Productos Vendidos</h4>
              <table class="table-auto w-full text-sm mt-4">
                <thead class="bg-blue-100">
                  <tr>
                    <th class="p-3 text-left">Producto</th>
                    <th class="p-3 text-left">Cantidad</th>
                    <th class="p-3 text-left">Precio</th>
                    <th class="p-3 text-left">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="producto in detalleVenta" :key="producto.codProducto" class="border-b hover:bg-blue-200">
                    <td class="p-3">{{ producto.producto ? producto.producto.nombre : 'Producto no disponible' }}</td>
                    <td class="p-3">{{ producto.cantidad }}</td>
                    <td class="p-3">{{ producto.precioV }} Bs.</td>
                    <td class="p-3">{{ (producto.cantidad * producto.precioV).toFixed(2) }} Bs.</td>
                  </tr>
                </tbody>
              </table>

              <h4 class="text-xl font-semibold  mt-4">Pago</h4>
              <p><strong>Monto Pagado:</strong> {{ pago.monto }} Bs.</p>
              <p><strong>Estado:</strong> {{ pago.estado }}</p>
            </div>
          </div>
        </div>
      </div>
      <VisitaFooter />
    </div>
  </AppLayout>
</template>
