<template>
  <plantillanav :userName="$page.props.auth.user.name" /> 
  <AppLayout title="Gestionar Clientes">
    <template #header>
      <h2 class="font-semibold text-xl text-pink-600 leading-tight">
        Lista de Clientes
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
          <div class="p-6 lg:p-8 border-gray-200 divpequeno">
            <h1 class="text-2xl font-bold text-pink-600 text-center mb-6">Lista de Clientes</h1>

            <div class="flex justify-between items-center mb-6">
              <Link :href="route('cliente.create')" class="btn btn-pink inline-flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Registrar</span>
              </Link>

              <form @submit.prevent="buscarCliente" class="flex space-x-2">
                <div class="input-group">
                  <select v-model="criterio" class="form-select" required>
                    <option value="" disabled selected>Seleccionar criterio</option>
                    <option value="nombre">Nombre</option>
                    <option value="apellidoPaterno">Apellido Paterno</option>
                    <option value="apellidoMaterno">Apellido Materno</option>
                    <option value="carnetIdentidad">Carnet de Identidad</option>
                  </select>
                  <input v-model="buscar" type="text" class="form-control" placeholder="Buscar" aria-label="Buscar" required />
                  <button type="submit" class="btn btn-outline-pink flex items-center space-x-2" :disabled="!isFormValid">
                    
                    <i class="fas fa-search"></i>
                    <span>Buscar</span>
                  </button> 
                </div>
              </form>
            </div>

            <div class="overflow-x-auto">
              <table class="table-auto w-full text-sm bg-pink-50">
                <thead class="bg-pink-100">
                  <tr>
                    <th class="p-3 text-left text-pink-600">Carnet de Identidad</th>
                    <th class="p-3 text-left text-pink-600">Nombre</th>
                    <th class="p-3 text-left text-pink-600">Apellido Paterno</th>
                    <th class="p-3 text-left text-pink-600">Apellido Materno</th>
                    <th class="p-3 text-left text-pink-600">Sexo</th>
                    <th class="p-3 text-left text-pink-600">Edad</th>
                    <th class="p-3 text-left text-pink-600">Telefono</th>
                    <th class="p-3 text-center text-pink-600">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="cliente in clientes?.data || []" :key="cliente.carnetIdentidad" class="border-b hover:bg-pink-200">
                    <td class="p-3">{{ cliente.carnetIdentidad }}</td>
                    <td class="p-3">{{ cliente.nombre }}</td>
                    <td class="p-3">{{ cliente.apellidoPaterno }}</td>
                    <td class="p-3">{{ cliente.apellidoMaterno }}</td>
                    <td class="p-3">{{ cliente.sexo }}</td>
                    <td class="p-3">{{ cliente.edad }}</td>
                    <td class="p-3">{{ cliente.telefono }}</td>
                    <td class="p-3 text-center">
                      <Link :href="route('cliente.edit', cliente.carnetIdentidad)" class="btn btn-warning btn-sm mx-1">
                        <i class="fas fa-edit"></i> Editar
                      </Link>

                      <button @click="confirmDelete(cliente)" class="btn btn-danger btn-sm mx-1">
                        <i class="fas fa-trash"></i> Eliminar
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="flex justify-between mt-4">
              <div v-if="clientes.prev_page_url">
                <Link :href="clientes.prev_page_url" class="btn btn-pink">
                  <i class="fas fa-arrow-left"></i> Anterior
                </Link>
              </div>
              <div v-if="clientes.next_page_url">
                <Link :href="clientes.next_page_url" class="btn btn-pink">
                  Siguiente <i class="fas fa-arrow-right"></i>
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
      <VisitaFooter />
    </div>

    <DialogModal :show="showModal" @close="showModal = false">
      <template v-slot:title>
        <h1 class="text-lg font-semibold text-pink-600">Confirmar Eliminación</h1>
      </template>
      <template v-slot:content>
        <p>¿Estás seguro de que deseas eliminar al cliente <strong>{{ selectedCliente?.nombre }}</strong>?</p>
      </template>
      <template v-slot:footer>
        <PrimaryButton @click="deleteCliente" class="bg-red-600 hover:bg-red-800">Eliminar</PrimaryButton>
        <button @click="showModal = false" class="ml-4 btn btn-pink-outline">Cancelar</button>
      </template>
    </DialogModal>
  </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import { usePage } from '@inertiajs/vue3';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
  clientes: Object, 
  error: String,
  Error: String,
});

const clientes = ref(props.clientes || { data: [], prev_page_url: null, next_page_url: null });

const showModal = ref(false); 
const selectedCliente = ref(null); 
const criterio = ref(''); 
const buscar = ref(''); 

// Computed property for form validation
const isCriterioValid = computed(() => criterio.value !== '');
const isBuscarValid = computed(() => buscar.value.length > 0);

// Combined validation for the form
const isFormValid = computed(() => isCriterioValid.value && isBuscarValid.value);

const confirmDelete = (cliente) => {
  selectedCliente.value = cliente;
  showModal.value = true;
};

const deleteCliente = () => {
  if (selectedCliente.value) {
    router.delete(route('cliente.destroy', selectedCliente.value.carnetIdentidad), {
      onSuccess: () => {
        showModal.value = false;
      },
      onError: (error) => {
        console.log('Error response:', error.response); 

        if (error.response && error.response.data && error.response.data.error) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.response.data.error, 
            confirmButtonText: 'Aceptar',
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error desconocido',
            text: 'Ocurrió un error al eliminar el cliente.',
            confirmButtonText: 'Aceptar',
          });
        }
      }
    });
  }
};

const buscarCliente = () => {
  router.get(route('cliente.index'), {
    criterio: criterio.value,
    buscar: buscar.value,
  });
};
</script>

