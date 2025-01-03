<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';


const { ventas } = usePage().props;


const criterio = ref('fechaVenta');
const buscar = ref('');

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

// Función para manejar la búsqueda
const handleSearch = () => {
  router.get(route('venta.index'), { buscar: buscar.value, criterio: criterio.value });
};
</script>

<template>
  <plantillanav :userName="$page.props.auth.user.name"/>
  <AppLayout title="Gestionar Ventas">
    <template #header>
      <h2 class="font-semibold text-xl text-pink-600 leading-tight">
        Lista de Ventas
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
          <div class="p-6 lg:p-8 border-gray-200 divpequeno">
            <h1 class="text-2xl font-bold text-center mb-6 text-pink-500">Lista de Ventas</h1>

            <div class="flex justify-between items-center mb-6">
              <Link :href="route('venta.create')" class="btn bg-pink-500 hover:bg-pink-700 text-white inline-flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Registrar</span>
              </Link>

              <form @submit.prevent="handleSearch" class="flex space-x-2">
                <select v-model="criterio" class="form-select bg-pink-100 border-pink-300">
                  <option value="fechaVenta">Fecha</option>
                  <option value="codClienteF">ID Cliente</option>
                  <option value="codEncargadoF">ID Encargado</option>
                </select>
                <TextInput v-model="buscar" class="w-full bg-pink-50 border-pink-300" placeholder="Buscar Venta" />
                <button type="submit" class="btn bg-pink-500 hover:bg-pink-700 text-white flex items-center space-x-2">
                  <i class="fas fa-search"></i>
                  <span>Buscar</span>
                </button>
              </form>
            </div>

            <div class="overflow-x-auto">
              <table class="table-auto w-full text-sm">
                <thead class="bg-pink-200">
                  <tr>
                    <th class="p-3 text-left text-pink-600">Código de Venta</th>
                    <th class="p-3 text-left text-pink-600">Fecha de Venta</th>
                    <th class="p-3 text-left text-pink-600">Monto Total</th>
                    <th class="p-3 text-left text-pink-600">Cliente</th>
                    <th class="p-3 text-left text-pink-600">Encargado</th>
                    <th class="p-3 text-center text-pink-600">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="venta in ventas.data" :key="venta.codVenta" class="border-b">
                    <td class="p-3">{{ venta.codVenta }}</td>
                    <td class="p-3">{{ formatoFecha(venta.fechaVenta) }}</td>
                    <td class="p-3">{{ venta.montoTotal.toFixed(2) }} Bs.</td>
                    <td class="p-3">{{ venta.cliente.nombre }}</td>
                    <td class="p-3">{{ venta.trabajador.nombre }}</td>
                    <td class="p-3 text-center">
                      <Link :href="route('venta.show', venta.codVenta)" class="btn btn-primary btn-sm mx-1 bg-pink-500 hover:bg-pink-700">
                        <i class="fas fa-eye"></i> Ver Detalle
                      </Link>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="flex justify-between mt-4">
              <div v-if="ventas.prev_page_url">
                <Link :href="ventas.prev_page_url" class="btn bg-pink-500 hover:bg-pink-700 text-white">
                  <i class="fas fa-arrow-left"></i> Anterior
                </Link>
              </div>
              <div v-if="ventas.next_page_url">
                <Link :href="ventas.next_page_url" class="btn bg-pink-500 hover:bg-pink-700 text-white">
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
