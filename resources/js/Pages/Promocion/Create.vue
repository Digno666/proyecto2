<script setup>
import { ref, computed } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const { props } = usePage();
const servicios = ref(props.servicios || []);
const serviciosSeleccionados = ref([]);
const errores = ref([]);
const codPromocion = ref(''); 
const nombrePromocion = ref('');
const descripcionPromocion = ref('');
const nombreServicio = ref('');
const imagenPromocion = ref(null);
const imagePreview = ref(null);

const showBuscarServicioModal = ref(false);

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
  // Eliminar el servicio de la lista de seleccionados
  serviciosSeleccionados.value = serviciosSeleccionados.value.filter(s => s.id !== servicioId);
};

const isServicioSeleccionado = (servicio) => {
  // Verifica si el servicio ya está en la lista de seleccionados
  return serviciosSeleccionados.value.some(s => s.id === servicio.codServicio);
};

const submitPromocion = () => {
  const formData = new FormData();
  formData.append('codPromocion', codPromocion.value);
  formData.append('nombrePromocion', nombrePromocion.value);
  formData.append('descripcionPromocion', descripcionPromocion.value);
  formData.append('totalConDescuento', totalConDescuento.value);

  serviciosSeleccionados.value.forEach((servicio, index) => {
    formData.append(`serviciosSeleccionados[${index}][id]`, servicio.id);
  });

  if (imagenPromocion.value) {
    formData.append('imagenPromocion', imagenPromocion.value);
  }

  axios.post(route('promocion.store'), formData)
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

// Computed para filtrar los servicios según el nombre
const serviciosFiltrados = computed(() => {
  return servicios.value.filter(servicio =>
    servicio.nombre.toLowerCase().includes(nombreServicio.value.toLowerCase())
  );
});

const totalConDescuento = computed(() => {
  const total = serviciosSeleccionados.value.reduce((acc, servicio) => {
    const precio = parseFloat(servicio.precio);
    if (isNaN(precio)) {
      console.error("Precio inválido:", servicio.precio);  // Asegúrate de que los precios sean válidos
      return acc;
    }
    return acc + precio;
  }, 0);
  return (total * 0.9).toFixed(2); // Aplicar 10% de descuento
});



const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!validTypes.includes(file.type)) {
      errores.value.push("El archivo seleccionado no es una imagen válida. Debe ser .jpg, .png o .gif.");
      imagenPromocion.value = null;
      imagePreview.value = null;
      return;
    }

    imagenPromocion.value = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

</script>

<template>
   
    <AppLayout title="Registrar Promoción">
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Registrar Promoción</h2>
        </template>
      </AppLayout>
      <plantillanav :userName="$page.props.auth.user.name"/>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                      <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Registrar Promocion</h1>
                    <form @submit.prevent="submitPromocion">
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
                            <textarea v-model="descripcionPromocion" class="form-input w-full p-3 border rounded-md shadow-sm cc" required></textarea>
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
                                            <td class="p-3">{{ (parseFloat(servicio.precio) || 0).toFixed(2) }} Bs.</td>
                                            <td class="p-3 text-center">
                                                <button type="button" class="bg-red-500 text-white p-2 rounded-md hover:bg-red-600" @click="quitarServicio(servicio.id)">
                                                    <i class="fas fa-times"></i> Quitar
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Mostrar el precio total con descuento -->
                        <div class="mt-4 font-semibold text-xl bb">
                            <p class="bb">Total con descuento (10%): {{ totalConDescuento }} Bs.</p>
                        </div>

                        <!-- Seleccionar imagen de la promoción -->
                        <div class="form-group mt-6">
                            <label for="imagenPromocion" class="block text-sm font-medium bb">Seleccionar Imagen:</label>
                            <input type="file" @change="handleImageUpload" class="form-input w-full p-3 border border-gray-300 rounded-md shadow-sm" />
                            <div v-if="imagenPromocion">
                                <img :src="imagePreview" alt="Imagen Previa de la Promoción" class="mt-2 max-w-xs rounded-lg" />
                            </div>
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" class="mt-4 btn btn-primary" :disabled="serviciosSeleccionados.length === 0">
                                Registrar
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
                                <label for="nombreServicio" class="block text-sm font-medium text-gray-700">Buscar por Nombre:</label>
                                <input type="text" v-model="nombreServicio" class="form-input w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" placeholder="Ingrese el nombre del servicio" />
                            </div>

                            <div class="overflow-x-auto mt-4">
                                <table class="table-auto w-full text-sm">
                                    <thead class="bg-pink-100">
                                        <tr>
                                            <th class="p-3 text-left">Código</th>
                                            <th class="p-3 text-left">Nombre</th>
                                            <th class="p-3 text-left">Descripción</th>
                                            <th class="p-3 text-left">Precio</th>
                                            <th class="p-3 text-center">Opción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="servicio in serviciosFiltrados" :key="servicio.codServicio" class="border-b">
                                            <td class="p-3">{{ servicio.codServicio }}</td>
                                            <td class="p-3">{{ servicio.nombre }}</td>
                                            <td class="p-3">{{ servicio.descripcion }}</td>
                                            <td class="p-3">{{ (parseFloat(servicio.precio) || 0).toFixed(2) }} Bs.</td>
                                            <td class="p-3 text-center">
                                                <button type="button" :class="{'bg-pink-500 text-white': !isServicioSeleccionado(servicio), 'bg-gray-500 text-white': isServicioSeleccionado(servicio)}" 
                                                        class="p-2 rounded-md hover:bg-pink-600" 
                                                        :disabled="isServicioSeleccionado(servicio)" 
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
</template>
