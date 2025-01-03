<script setup>
import { useForm, router, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { defineProps, computed, ref, watch } from 'vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
  vendedor: Object,
  errors: Object,
  sessionSuccess: String,
});

const form = useForm({
  carnetIdentidad: props.vendedor.carnetIdentidad || '',
  nombre: props.vendedor.nombre || '',
  apellidoPaterno: props.vendedor.apellidoPaterno || '',
  apellidoMaterno: props.vendedor.apellidoMaterno || '',
  sexo: props.vendedor.sexo || '',
  telefono: props.vendedor.telefono || '',
  edad: props.vendedor.edad || '',  
});

const errorMessages = ref({
  carnetIdentidad: '',
  nombre: '',
  apellidoPaterno: '',
  apellidoMaterno: '',
  sexo: '',
  telefono: '',
  edad: ''
});

watch(() => form.carnetIdentidad, (newValue) => {
  errorMessages.value.carnetIdentidad = /^\d{8,10}$/.test(newValue)
    ? ''
    : 'La cédula de identidad debe tener entre 8 y 10 caracteres.';
});

watch(() => form.nombre, (newValue) => {
  errorMessages.value.nombre = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{3,30}$/.test(newValue)
    ? ''
    : 'El nombre debe tener entre 3 y 30 caracteres y solo debe contener letras.';
});

watch(() => form.apellidoPaterno, (newValue) => {
  errorMessages.value.apellidoPaterno = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{3,30}$/.test(newValue)
    ? ''
    : 'El apellido paterno debe tener entre 3 y 30 caracteres y solo debe contener letras.';
});

watch(() => form.apellidoMaterno, (newValue) => {
  errorMessages.value.apellidoMaterno = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{3,30}$/.test(newValue)
    ? ''
    : 'El apellido materno debe tener entre 3 y 30 caracteres y solo debe contener letras.';
});

watch(() => form.telefono, (newValue) => {
  errorMessages.value.telefono = /^\d{8,10}$/.test(newValue)
    ? ''
    : 'El teléfono debe tener entre 8 y 10 dígitos.';
});

watch(() => form.edad, (newValue) => {
  errorMessages.value.edad = /^\d+$/.test(newValue) && newValue >= 18 && newValue <= 100
    ? ''
    : 'La edad debe ser un número entre 18 y 100.';
});

watch(() => form.sexo, (newValue) => {
  errorMessages.value.sexo = newValue ? '' : 'El sexo es obligatorio.';
});

const submit = () => {
  form.put(route('encargado.update', props.vendedor.carnetIdentidad), {
    onSuccess: () => {
      router.get(route('encargado.index'));
    },
  });
};

const isFormValid = computed(() => {
  return (
    /^\d{8,10}$/.test(form.carnetIdentidad) &&
    /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{3,30}$/.test(form.nombre) &&
    /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{3,30}$/.test(form.apellidoPaterno) &&
    /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{3,30}$/.test(form.apellidoMaterno) &&
    form.sexo !== '' &&
    /^\d{8,10}$/.test(form.telefono) &&
    /^\d+$/.test(form.edad) && form.edad >= 18 && form.edad <= 100
  );
});

const successMessage = computed(() => props.sessionSuccess);
</script>

<template>
  <!-- <plantillanav :userName="$page.props.auth.user.name" /> -->
    <!-- Barra lateral -->
    <plantillanav />
  <AppLayout title="Editar Proveedor">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Editar Proveedor
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
          <div class="p-6 lg:p-8 border-gray-200 divpequeno">
            <h1 class="text-2xl font-bold text-center mb-6 text-rose-400">Editar Trabajador</h1>
            <div v-if="successMessage" class="alert alert-success mb-4 p-3 rounded-md shadow-md text-green-800 bg-green-100">
              <strong>¡Éxito!</strong> {{ successMessage }}
            </div>

            <div v-if="form.errors" class="alert alert-danger">
              <ul>
                <li v-for="(error, key) in form.errors" :key="key">{{ error }}</li>
              </ul>
            </div>

            <form @submit.prevent="submit">
              <div class="mb-4">
                <InputLabel for="carnetIdentidad" value="Cédula de Identidad" class="text-rose-400" />
                <TextInput
                  v-model="form.carnetIdentidad"
                  id="carnetIdentidad"
                  type="text"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                  placeholder="Ingrese la cédula de identidad"
                  required
                />
                <InputError :message="errorMessages.carnetIdentidad" class="text-red-500 text-sm" />
              </div>

              <div class="mb-4">
                <InputLabel for="nombre" value="Nombre" class="text-rose-400" />
                <TextInput
                  v-model="form.nombre"
                  id="nombre"
                  type="text"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                  placeholder="Ingrese el nombre"
                  required
                />
                <InputError :message="errorMessages.nombre" class="text-red-500 text-sm" />
              </div>

              <div class="mb-4">
                <InputLabel for="apellidoPaterno" value="Apellido Paterno" class="text-rose-400" />
                <TextInput
                  v-model="form.apellidoPaterno"
                  id="apellidoPaterno"
                  type="text"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                  placeholder="Ingrese el apellido paterno"
                  required
                />
                <InputError :message="errorMessages.apellidoPaterno" class="text-red-500 text-sm" />
              </div>

              <div class="mb-4">
                <InputLabel for="apellidoMaterno" value="Apellido Materno" class="text-rose-400" />
                <TextInput
                  v-model="form.apellidoMaterno"
                  id="apellidoMaterno"
                  type="text"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                  placeholder="Ingrese el apellido materno"
                  required
                />
                <InputError :message="errorMessages.apellidoMaterno" class="text-red-500 text-sm" />
              </div>

              <div class="mb-4">
                <InputLabel for="edad" value="Edad" class="text-rose-400" />
                <TextInput
                  v-model="form.edad"
                  id="edad"
                  type="number"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                  placeholder="Ingrese la edad"
                  required
                />
                <InputError :message="errorMessages.edad" class="text-red-500 text-sm" />
              </div>

              <div class="mb-4">
                <InputLabel for="sexo" value="Sexo" class="text-rose-400" />
                <select
                  v-model="form.sexo"
                  id="sexo"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600"
                  required
                >
                  <option value="">Seleccione el sexo</option>
                  <option value="masculino" :selected="form.sexo === 'masculino'">Masculino</option>
                  <option value="femenino" :selected="form.sexo === 'femenino'">Femenino</option>
                </select>
                <InputError :message="errorMessages.sexo" class="text-red-500 text-sm" />
              </div>

              <div class="mb-4">
                <InputLabel for="telefono" value="Teléfono" class="text-rose-400" />
                <TextInput
                  v-model="form.telefono"
                  id="telefono"
                  type="tel"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                  placeholder="Ingrese el teléfono"
                  required
                />
                <InputError :message="errorMessages.telefono" class="text-red-500 text-sm" />
              </div>

              <div class="text-center mt-4">
                <button onclick="history.back()" class="btn btn-secondary me-2 text-rose-600 bg-rose-100 hover:bg-rose-200">
                  <i class="fas fa-arrow-left"></i> Atrás
                </button>
                <PrimaryButton
                  type="submit"
                  class="mt-4 btn-primary text-rose-600"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  <i class="fas fa-pencil-alt"></i> Modificar
                </PrimaryButton>
              </div>
            </form>
          </div>
        </div>
      </div>
      <VisitaFooter />
    </div>
  </AppLayout>
</template>

<style scoped>
.text-rose-400 {
    color: #ff66b2;
}

.border-rose-600 {
    border-color: #ff66b2;
}

.bg-rose-100 {
    background-color: #ffe6f0;
}

.placeholder-rose-400 {
    color: #ffb3d9;
}

.btn-primary {
    background-color: #ff66b2;
    border: none;
    color: white;
}

.btn-primary:hover {
    background-color: #e55c9e;
}

.btn-secondary {
    background-color: #f3f4f6;
    color: #333;
}

.btn-secondary:hover {
    background-color: #e5e7eb;
}

.alert-success {
    border-color: #4caf50;
    background-color: #e8f5e9;
    color: #4caf50;
}

.alert-danger {
    border-color: #f44336;
    background-color: #fce4e4;
    color: #f44336;
}
</style>
