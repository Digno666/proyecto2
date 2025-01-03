<template>
     <!-- Barra lateral -->
     <plantillanav />
  <AppLayout title="Editar Promoción">
      <template #header>
          <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Editar Promoción</h2>
      </template>
          <div class="py-12">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                  <form @submit.prevent="submitEdicionPromocion" >

                      <!-- Mostrar errores -->
                      <div v-if="errores && errores.length" class="alert alert-danger bg-red-100 text-red-800 p-4 rounded-md">
                          <ul>
                              <li v-for="error in errores" :key="error">{{ error }}</li>
                          </ul>
                      </div>

                      <!-- Campos para Promoción -->
                      <div class="form-group">
                          <label for="nombrePromocion" class="block text-sm font-medium bb">Nombre Promoción:</label>
                          <input type="text" v-model="nombrePromocion" class="form-input w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 cc" required />
                      </div>

                      <div class="form-group">
                          <label for="descripcionPromocion" class="block text-sm font-medium bb">Descripción:</label>
                          <textarea v-model="descripcionPromocion" class="form-input w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 cc" required></textarea>
                      </div>

                      <div class="form-group">
                          <label for="precioUnitario" class="block text-sm font-medium bb">Precio Unitario:</label>
                          <input type="text" v-model="precioUnitario" class="form-input w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 cc" disabled />
                      </div>

                      <!-- Botón para buscar servicios -->
                      <div class="flex space-x-4">
                          <button type="button" class="btn bg-pink-500 text-white p-3 rounded-md hover:bg-pink-600" @click="openBuscarServicioModal">
                              <i class="fas fa-search"></i> Buscar Servicio
                          </button>
                      </div>

                      <!-- Tabla de servicios seleccionados -->
                      <div class="mt-6">
                          <h3 class="text-lg font-semibold bb">Servicios Seleccionados</h3>
                          <div class="overflow-x-auto mt-4">
                              <table class="table-auto w-full text-sm">
                                  <thead class="bg-pink-100">
                                      <tr>
                                          <th class="p-3 text-left">Nombre</th>
                                          <th class="p-3 text-left">Precio Unitario</th>
                                          <th class="p-3 text-center">Acción</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr v-for="servicio in serviciosSeleccionados" :key="servicio.id" class="border-b">
                                          <td class="p-3">{{ servicio.nombre }}</td>
                                          <td class="p-3">{{ servicio.precio}} Bs.</td>
                                          <td class="p-3 text-center">
                                              <button type="button" class="btn btn-secondary" @click="quitarServicio(servicio.id)">
                                                  <i class="fas fa-times"></i> Quitar
                                              </button>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>

                      <!-- Mostrar el precio total con descuento -->
                      <div class="mt-4 font-semibold text-xl">
                          <p>Total con descuento (10%): {{ totalConDescuento }} Bs.</p>
                      </div>

                      <!-- Seleccionar imagen de la promoción -->
                      <div class="form-group mt-6">
                          <label for="imagen" class="block text-sm font-medium bb">Seleccionar Imagen:</label>
                          <input type="file" @change="handleImageUpload" class="form-input w-full p-3 border border-gray-300 rounded-md shadow-sm" />
                          <div v-if="imagen">
                              <img :src="imagePreview" alt="Imagen Previa de la Promoción" class="mt-2 max-w-xs rounded-lg" />
                          </div>
                      </div>

                      <div class="flex space-x-4">
                          <button type="submit" class="mt-4 btn btn-primary" :disabled="serviciosSeleccionados.length === 0">
                              Guardar Cambios
                          </button>
                          <a :href="route('promocion.index')" class="mt-4 btn btn-secondary">
                              <i class="fas fa-arrow-left"></i> <span>Volver</span>
                          </a>
                      </div>
                  </form>
                  </div>
                </div>

                  <!-- Modal Buscar Servicio -->
                  <DialogModal :show="showBuscarServicioModal">
                      <template #title>
                          <h5 class="modal-title text-xl font-semibold text-gray-800">Buscar Servicio</h5>
                      </template>
                      <template #content>
                          <div class="form-group mb-4">
                              <label for="nombreServicio" class="block text-sm font-medium bb">Buscar por Nombre:</label>
                              <input type="text" v-model="nombreServicio" class="form-input w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" placeholder="Ingrese el nombre del servicio" />
                          </div>

                          <div class="overflow-x-auto mt-4">
                              <table class="table-auto w-full text-sm">
                                  <thead class="bg-pink-100">
                                      <tr>
                                          <th class="p-3 text-left">Código</th>
                                          <th class="p-3 text-left">Nombre</th>
                                          <th class="p-3 text-left">Descripción</th>
                                          <th class="p-3 text-center">Opción</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr v-for="servicio in serviciosFiltrados" :key="servicio.codServicio" class="border-b">
                                          <td class="p-3">{{ servicio.codServicio }}</td>
                                          <td class="p-3">{{ servicio.nombre }}</td>
                                          <td class="p-3">{{ servicio.descripcion }}</td>
                                          <td class="p-3 text-center">
                                              <button 
                                                  type="button" 
                                                  :class="{
                                                      'bg-pink-500 text-white': !isServicioSeleccionado(servicio),
                                                      'bg-gray-500 text-white': isServicioSeleccionado(servicio)
                                                  }" 
                                                  :disabled="isServicioSeleccionado(servicio)" 
                                                  class="p-2 rounded-md hover:bg-pink-600" 
                                                  @click="seleccionarServicio(servicio)">
                                                  {{ isServicioSeleccionado(servicio) ? 'Seleccionado' : 'Seleccionar' }}
                                              </button>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                      </template>
                      <template #footer>
                          <button type="button" class="bg-gray-500 text-white p-3 rounded-md hover:bg-gray-600" @click="showBuscarServicioModal = false">
                              Cerrar
                          </button>
                      </template>
                  </DialogModal>
              </div>
          </div>
      <VisitaFooter />
  </AppLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';
import plantillanav from '@/Layouts/plantillanav.vue';

const { props } = usePage();
const promocion = ref(props.promocion || {});

const servicios = ref(props.servicios || []);
const serviciosSeleccionados = ref(promocion.value.servicios || []);
const errores = ref([]);
const codPromocion = ref(promocion.value.codPromocion || '');
const nombrePromocion = ref(promocion.value.nombrePromocion || '');
const descripcionPromocion = ref(promocion.value.descripcionPromocion || '');
const precioUnitario = ref(promocion.value.precioUnitario || 0);
const nombreServicio = ref('');
const imagen = ref(null);
const imagePreview = ref(promocion.value.imagen || null);

const showBuscarServicioModal = ref(false);

onMounted(() => {
  nombrePromocion.value = promocion.value.nombre || '';
  descripcionPromocion.value = promocion.value.descripcion || '';
  precioUnitario.value = promocion.value.precioUnitario || 0;
  imagePreview.value = promocion.value.imagen;
});

const seleccionarServicio = (servicio) => {
    const index = serviciosSeleccionados.value.findIndex(s => s.id === servicio.codServicio);
    if (index === -1) {
        serviciosSeleccionados.value.push({
            id: servicio.codServicio,
            nombre: servicio.nombre,
            precio: servicio.precio,
        });
    } else {
        serviciosSeleccionados.value.splice(index, 1);
    }
};

const quitarServicio = (servicioId) => {
    serviciosSeleccionados.value = serviciosSeleccionados.value.filter(s => s.id !== servicioId);
};

// Verifica si el servicio ya está seleccionado
const isServicioSeleccionado = (servicio) => {
    return serviciosSeleccionados.value.some(s => s.id === servicio.codServicio);
};

const submitEdicionPromocion = () => {
    const formData = new FormData();
    formData.append('codPromocion', codPromocion.value);
    formData.append('nombrePromocion', nombrePromocion.value);
    formData.append('descripcionPromocion', descripcionPromocion.value);
    formData.append('totalConDescuento', totalConDescuento.value);
    formData.append('precioUnitario', precioUnitario.value);

    serviciosSeleccionados.value.forEach((servicio, index) => {
        formData.append(`serviciosSeleccionados[${index}][id]`, servicio.codServicio);
    });

    if (imagen.value) {
        formData.append('imagen', imagen.value);
    }

    axios.post(route('promocion.update', promocion.value.codPromocion), formData)
        .then(() => {
            router.get(route('promocion.index'));
        })
        .catch((error) => {
            if (error.response) {
                errores.value = error.response.data.errors || [];
            } else {
                errores.value = ['Hubo un error al procesar la solicitud.'];
            }
        });
};

const openBuscarServicioModal = () => {
    showBuscarServicioModal.value = true;
};

const serviciosFiltrados = computed(() => {
    return servicios.value.filter(servicio =>
        servicio.nombre.toLowerCase().includes(nombreServicio.value.toLowerCase()) && 
        !isServicioSeleccionado(servicio)
    );
});

const totalConDescuento = computed(() => {
    const total = serviciosSeleccionados.value.reduce((acc, servicio) => acc + servicio.precio, 0);
    return (total * 0.9).toFixed(2); // Aplicar 10% de descuento
});

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!validTypes.includes(file.type)) {
            errores.value = ['Formato de imagen no válido'];
            return;
        }
        imagen.value = file;
        imagePreview.value = URL.createObjectURL(file);
    }
};
</script>

<style scoped>
/* Estilos adicionales aquí */
</style>
