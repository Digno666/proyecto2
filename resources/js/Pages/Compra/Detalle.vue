<template>
  <plantillanav :userName="$page.props.auth.user.name" />
  <AppLayout title="Detalles de la Compra">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        Detalles de la Compra
      </h1>
    </template>

    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 lg:p-8 rounded-lg">
            <h1 class="text-3xl font-bold text-center mb-6">Detalles de la Compra</h1>

            <div class="rounded-lg p-6">
              <h3 class="text-2xl font-semibold mb-4">Información de la Compra</h3>

              <p><strong>Compra realizada el:</strong> {{ formatoFecha(compra.fechaCompra) }}</p>
              <p><strong>Proveedor:</strong> {{ compra.proveedor ? compra.proveedor.nombre : 'Proveedor no disponible' }}</p>
              <p><strong>Encargado:</strong> {{ compra.trabajador ? compra.trabajador.nombre : 'Encargado no disponible' }}</p>
              <p><strong>Monto Total:</strong> {{ formatCurrency(compra.montoTotal) }}</p>

              <h4 class="text-xl font-semibold mt-4">Productos Comprados</h4>
              <table class="table-auto w-full text-sm mt-4">
                <thead class="bg-blue-100">
                  <tr>
                    <th class="p-3 text-left">Imagen</th>
                    <th class="p-3 text-left">Producto</th>
                    <th class="p-3 text-left">Cantidad</th>
                    <th class="p-3 text-left">Precio Unitario</th>
                    <th class="p-3 text-left">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="detalle in detalleCompra" :key="detalle.codProducto" class="border-b hover:bg-blue-200">
                    <td class="p-3">
                      <img 
                        v-if="detalle.producto && detalle.producto.imagen"
                        :src="`/storage/uploads/${detalle.producto.imagen}`"
                        alt="Imagen del producto"
                        class="w-16 h-16 object-cover rounded-lg"
                      />
                      <span v-else class="text-gray-500">No tiene imagen</span>
                    </td>
                    <td class="p-3">{{ detalle.producto ? detalle.producto.nombre : 'Producto no disponible' }}</td>
                    <td class="p-3">{{ detalle.cantidad }}</td>
                    <td class="p-3">{{ formatCurrency(detalle.precioC) }}</td>
                    <td class="p-3">{{ formatCurrency(detalle.cantidad * detalle.precioC) }}</td>
                  </tr>
                </tbody>
              </table>

              <h4 class="text-xl font-semibold mt-4">Total de la Compra</h4>
              <p><strong>Monto Total:</strong> {{ formatCurrency(compra.montoTotal) }}</p>
            </div>

            <div class="mt-6 flex justify-between space-x-4">
              <Link :href="route('compra.index')" class="px-6 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 transition duration-300 ease-in-out">
                Volver a la lista de compras
              </Link>

              <Link :href="route('compra.create')" class="px-6 py-2 bg-green-500 text-white rounded-md shadow-md hover:bg-green-600 transition duration-300 ease-in-out">
                Realizar Nueva Compra
              </Link>

              <button @click="goBack" class="btn btn-secondary mb-3 bg-gray-500 text-white p-2 rounded-md hover:bg-gray-600">
                <i class="fas fa-arrow-left"></i> Volver
              </button>
            </div>
          </div>
        </div>
      </div>
      <VisitaFooter />
    </div>
  </AppLayout>
</template>

<script>
import { Link } from '@inertiajs/vue3'; 
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

export default {
  props: {
    compra: Object,
    detalleCompra: Array
  },
  components: {
    plantillanav,
    VisitaFooter
  },
  methods: {
    formatoFecha(fecha) {
      const date = new Date(fecha); 
      const fechaLocal = new Date(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate());
      const options = {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
      };
      return fechaLocal.toLocaleDateString('es-ES', options); 
    },
    formatCurrency(value) {
      return new Intl.NumberFormat('es-BO', { style: 'currency', currency: 'BOB' }).format(value);
    },
    goBack() {
      window.history.back();
    }
  }
};
</script>
