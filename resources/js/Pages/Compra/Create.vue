<template>
  <!-- Barra lateral -->
  <plantillanav :userName="$page.props.auth.user.name"/>
  <AppLayout title="Realizar Compra">
    <template #header>
      <h2 class="font-semibold text-2xl text-pink-600 leading-tight text-center">Realizar Compra</h2>
    </template>
    <div class="divgrande rounded-2xl mb-1">
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <h2 class="font-semibold text-2xl text-pink-600 leading-tight text-center">Realizar Compra</h2>

          <form @submit.prevent="submitCompra" class="space-y-6">
            <div v-if="errors.length" class="alert alert-danger text-pink-800 p-4 rounded-md">
              <ul>
                <li v-for="error in errors" :key="error">{{ error }}</li>
              </ul>
            </div>

            <input type="hidden" v-model="productosSeleccionadosInput" />
            <input type="hidden" v-model="totalCompraInput" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Columna 1: Campos de entrada -->
              <div>
                <div class="form-group">
                  <label for="trabajador" class="text-lg font-semibold text-pink-600 mb-4">Trabajador:</label>
                  <input type="hidden" v-model="codTrabajadorF" />
                  <p class="text-lg font-semibold">{{ trabajador.nombre }} {{ trabajador.apellidoPaterno }} {{ trabajador.apellidoMaterno }}</p>
              </div>

                <div class="form-group">
                  <label for="proveedor" class="text-lg font-semibold text-pink-600 mb-3">Proveedor:</label>
                  <select v-model="codProveedorF" 
                          class="mt-2 p-2 w-full border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" 
                          required>
                    <option v-for="proveedor in proveedores" :key="proveedor.codProveedor" :value="proveedor.codProveedor">
                      {{ proveedor.nombre }} - {{ proveedor.direccion }} - {{ proveedor.telefono }}
                    </option>
                  </select>
                </div>

                <div class="form-group mt-4">
                  <label for="fechacompra" class="text-lg font-semibold text-pink-600 mb-3">Fecha:</label>
                  <input type="date" v-model="fechaCompra"
                         class="form-input w-full p-2 border border-pink-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500"
                         required />
                </div>
                <br>
                <a :href="route('compra.index')" 
                   class="btn btn-secondary mb-3 bg-gray-500 text-white p-2 rounded-md hover:bg-gray-600">
                  <i class="fas fa-arrow-left"></i> Volver
                </a>
                <button type="submit" 
                        class="btn btn-primary mx-4 mb-3 bg-pink-600 text-white p-2 rounded-md hover:bg-pink-700" 
                        :disabled="productosSeleccionados.length === 0">
                  Realizar Compra
                </button>
              </div>

              <!-- Columna 2: Botones y tabla de productos seleccionados -->
              <div>
                <!-- Contenedor del título y botón -->
                <div class="flex justify-between items-center mb-4">
                  <!-- Texto de Productos Seleccionados -->
                  <h3 class="text-lg font-semibold text-pink-600">Productos Seleccionados</h3>

                  <!-- Botón Buscar Producto -->
                  <button type="button" 
                          class="btn btn-primary bg-pink-500 text-white p-2 rounded-md hover:bg-pink-600" 
                          @click="openBuscarProductoModal">
                    <i class="fas fa-search"></i> Buscar Producto
                  </button>
                </div>

                <!-- Tabla de Productos Seleccionados -->
                <div class="overflow-x-auto mt-4">
                  <table class="table-auto w-full text-sm">
                    <thead class="bg-pink-100">
                      <tr>
                        <th class="p-3 text-left">Nombre</th>
                        <th class="p-3 text-left">Cantidad</th>
                        <th class="p-3 text-left">Precio</th>
                        <th class="p-3 text-left">Subtotal</th>
                        <th class="p-3 text-left">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="producto in productosSeleccionados" :key="producto.id">
                        <td class="p-3">{{ producto.nombre }}</td>
                        <td class="p-3">
                          <input type="number" v-model="producto.cantidad" min="1"
                                 class="form-input w-full p-2 border border-pink-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500"
                                 @input="calcularTotalCompra" />
                        </td>
                        <td class="p-3">{{ producto.precio }} Bs.</td>
                        <td class="p-3">{{ (producto.cantidad * producto.precio).toFixed(2) }} Bs.</td>
                        <td class="p-3">
                          <button type="button" 
                                  class="btn btn-primary bg-pink-500 text-white p-2 rounded-md hover:bg-pink-600" 
                                  @click="quitarProducto(producto.id)">
                            <i class="fas fa-times"></i> Quitar
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </form>

          <!-- Modal de Buscar Producto -->
        <DialogModal :show="showBuscarProductoModal">
          <template #title>
              <h5 class="modal-title text-xl font-semibold text-pink-600">Buscar Producto</h5>
            </template>

          <template #content>
            <div class="form-group mb-4">
              <label for="nombreProducto" class="block text-sm font-medium text-pink-400">Buscar por Nombre:</label>
              <input type="text" v-model="nombreProducto" class="form-input w-full p-3 border border-pink-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" placeholder="Ingrese el nombre del producto" />
            </div>

            <div class="overflow-x-auto mt-4">
              <table class="table-auto w-full text-sm">
                <thead class="bg-pink-100">
                  <tr>
                    <th class="p-3 text-left">Nombre</th>
                    <th class="p-3 text-left">Precio</th>
                    <th class="p-3 text-left">Stock</th>
                    <th class="p-3 text-left">Categoría</th>
                    <th class="p-3 text-left">Imagen</th>
                    <th class="p-3 text-center">Opción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="producto in productos" :key="producto.codProducto" class="border-b">
                    <td class="p-3">{{ producto.nombre }}</td>
                    <td class="p-3">{{ producto.precio }} Bs.</td>
                    <td class="p-3">{{ producto.stock }}</td>
                    <td class="p-3">{{ producto.categoria?.nombre ?? 'No disponible' }}</td>
                    <td class="p-3">
                      <img v-if="producto.imagen" :src="`/storage/uploads/${producto.imagen}`" alt="Imagen del producto" class="img-thumbnail" style="max-width: 120px;" />
                      <span v-else>No tiene imagen</span>
                    </td>
                    <td class="p-3 text-center">
                        <button type="button" class="btn-primary bg-pink-500 text-white p-2 rounded-md"
                          @click="seleccionarProducto(producto)">
                          Seleccionar
                        </button>
                      </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </template>

          <template #footer>
            <button type="button" class="btn btn-secondary bg-pink-500 text-white p-2 rounded-md"
                @click="showBuscarProductoModal = false">
                Cerrar
              </button>
          </template>
        </DialogModal>
        </div>
      </div>
    </div>
    <VisitaFooter />
  </AppLayout>
</template>


<script setup>
import { ref, computed, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const { props } = usePage();
const trabajador = props.trabajador;
const proveedores = props.proveedores;
const productos = ref(props.productos || []);
const compra = props.compra || null;

const showBuscarProductoModal = ref(false);
const nombreProducto = ref('');
const productosSeleccionados = ref([]);
const totalCompra = ref(0);

const codTrabajadorF = ref(trabajador ? trabajador.carnetIdentidad : '');
const codProveedorF = ref('');
const fechaCompra = ref(new Date().toISOString().split('T')[0]);

const productosSeleccionadosInput = computed(() => JSON.stringify(productosSeleccionados.value));
const totalCompraInput = computed(() => totalCompra.value.toFixed(2));

const errors = ref([]);

const seleccionarProducto = (producto) => {
  const productoExistente = productosSeleccionados.value.find((p) => p.id === producto.codProducto);
  if (productoExistente) {
      productoExistente.cantidad++;
  } else {
      productosSeleccionados.value.push({
          id: producto.codProducto,
          nombre: producto.nombre,
          precio: producto.precio,
          cantidad: 1,
      });
  }
  calcularTotalCompra();
};

const calcularTotalCompra = () => {
  totalCompra.value = productosSeleccionados.value.reduce((total, producto) => {
      return total + producto.cantidad * producto.precio;
  }, 0);
};

const quitarProducto = (productoId) => {
  productosSeleccionados.value = productosSeleccionados.value.filter((p) => p.id !== productoId);
  calcularTotalCompra();
};

const submitCompra = () => {
  const data = {
      codTrabajadorF: codTrabajadorF.value,
      codProveedorF: codProveedorF.value,
      fechaCompra: fechaCompra.value,
      productosSeleccionados: productosSeleccionadosInput.value,
      totalCompra: totalCompraInput.value,
  };

  axios.post(route('compra.store'), data)
      .then(() => {
          router.get(route('compra.index'));
      })
      .catch((error) => {
          if (error.response) {
              errors.value = error.response.data.errors || [];
          } else {
              console.error('Error de red o problema con el servidor:', error);
              errors.value = ['Hubo un error al procesar la solicitud. Inténtalo más tarde.'];
          }
      });
};

const openBuscarProductoModal = () => {
  showBuscarProductoModal.value = true;
};

watch(productosSeleccionados, calcularTotalCompra, { deep: true });
</script>
