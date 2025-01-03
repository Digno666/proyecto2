<template>
  <plantillanav :userName="$page.props.auth.user.name" />
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
              <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                  <h2 class="text-2xl font-bold text-center mb-6 text-pink-600">EDITAR CLIENTE</h2>
                  <form @submit.prevent="submitForm" class="needs-validation" novalidate>
                      <div v-if="errors.length" class="alert alert-danger">
                          <ul>
                              <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                          </ul>
                      </div>

                      <div class="mb-4">
                          <InputLabel for="carnetIdentidad" value="Cédula de identidad:" class="bb" />
                          <InputError :message="errors.carnetIdentidad" />
                          <TextInput
                              v-model="formData.carnetIdentidad"
                              type="text"
                              id="carnetIdentidad"
                              class="mt-1 block w-full bg-pink-100 text-pink-600 border border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                              required
                          />
                          <div v-if="errors.carnetIdentidad" class="text-red-500 text-sm dd">
                              {{ errors.carnetIdentidad }}
                          </div>
                      </div>

                      <div class="mb-4">
                          <InputLabel for="nombre" value="Nombre:" class="bb" />
                          <InputError :message="errors.nombre" />
                          <TextInput
                              v-model="formData.nombre"
                              type="text"
                              id="nombre"
                              class="mt-1 block w-full bg-pink-100 text-pink-600 border border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                              required
                          />
                          <div v-if="errors.nombre" class="text-red-500 text-sm dd">
                              {{ errors.nombre }}
                          </div>
                      </div>

                      <div class="mb-4">
                          <InputLabel for="apellidoPaterno" value="Apellido Paterno:" class="bb" />
                          <InputError :message="errors.apellidoPaterno" />
                          <TextInput
                              v-model="formData.apellidoPaterno"
                              type="text"
                              id="apellidoPaterno"
                              class="mt-1 block w-full bg-pink-100 text-pink-600 border border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                              required
                          />
                          <div v-if="errors.apellidoPaterno" class="text-red-500 text-sm dd">
                              {{ errors.apellidoPaterno }}
                          </div>
                      </div>

                      <div class="mb-4">
                          <InputLabel for="apellidoMaterno" value="Apellido Materno:" class="bb" />
                          <InputError :message="errors.apellidoMaterno" />
                          <TextInput
                              v-model="formData.apellidoMaterno"
                              type="text"
                              id="apellidoMaterno"
                              class="mt-1 block w-full bg-pink-100 text-pink-600 border border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                              required
                          />
                          <div v-if="errors.apellidoMaterno" class="text-red-500 text-sm dd">
                              {{ errors.apellidoMaterno }}
                          </div>
                      </div>

                      <div class="mb-4">
                          <InputLabel for="sexo" value="Sexo:" class="bb" />
                          <InputError :message="errors.sexo" />
                          <select
                              v-model="formData.sexo"
                              id="sexo"
                              class="mt-1 block w-full bg-pink-100 text-pink-600 border border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                              required
                          >
                              <option value="" disabled>Selecciona el sexo</option>
                              <option value="masculino">Masculino</option>
                              <option value="femenino">Femenino</option>
                          </select>
                          <div v-if="errors.sexo" class="text-red-500 text-sm dd">
                              {{ errors.sexo }}
                          </div>
                      </div>

                      <div class="mb-4">
                          <InputLabel for="telefono" value="Teléfono:" class="bb" />
                          <InputError :message="errors.telefono" />
                          <TextInput
                              v-model="formData.telefono"
                              type="tel"
                              id="telefono"
                              class="mt-1 block w-full bg-pink-100 text-pink-600 border border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                              required
                          />
                          <div v-if="errors.telefono" class="text-red-500 text-sm dd">
                              {{ errors.telefono }}
                          </div>
                      </div>

                      <div class="mb-4">
                          <InputLabel for="edad" value="Edad:" class="bb" />
                          <InputError :message="errors.edad" />
                          <TextInput
                              v-model="formData.edad"
                              type="number"
                              id="edad"
                              class="mt-1 block w-full bg-pink-100 text-pink-600 border border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                              required
                          />
                          <div v-if="errors.edad" class="text-red-500 text-sm dd">
                              {{ errors.edad }}
                          </div>
                      </div>

                      <div class="text-center mt-4">
                          <Link :href=" route('cliente.index') " class="btn btn-outline-pink me-3">
                              <i class="fas fa-arrow-left"></i> Atrás
                          </Link>
                          <PrimaryButton
                              type="submit"
                              class="btn btn-pink mt-4"
                              :disabled="form.processing"
                          >
                              <i class="fas fa-pencil-alt"></i> Modificar
                          </PrimaryButton>
                      </div>
                  </form>
                  <VisitaFooter />
              </div>
          </div>
      </div>
  </div>
</template>
<script setup>
import { ref } from 'vue'; 
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';
import { router, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
  cliente: Object,
});

const formData = ref({
  carnetIdentidad: props.cliente.carnetIdentidad,
  nombre: props.cliente.nombre,
  apellidoPaterno: props.cliente.apellidoPaterno,
  apellidoMaterno: props.cliente.apellidoMaterno,
  sexo: props.cliente.sexo,
  telefono: props.cliente.telefono,
  edad: props.cliente.edad,
});

const form = ref({
  processing: false,
});

const errors = ref({});

const submitForm = async () => {
  form.value.processing = true;  // Establecer que el formulario está procesando
  try {
      errors.value = {};
      await router.put(route('cliente.update', { carnetIdentidad: formData.value.carnetIdentidad }), formData.value);
  } catch (err) {
      errors.value = err.response.data.errors;
  } finally {
      form.value.processing = false;  // Restaurar el estado de procesamiento después de la solicitud
  }
};
</script>


<style scoped>
.py-12 {
margin-top: calc(60px + 1rem); 
margin-bottom: calc(60px + 1rem); 
}

.text-pink-600 {
color: #ec4899;
}

.text-pink-500 {
color: #f472b6;
}

.bg-pink-100 {
background-color: #fce4ec;
}

.bg-pink-500 {
background-color: #ec4899;
}

.border-pink-300 {
border-color: #f472b6;
}

.border-pink-500 {
border-color: #ec4899;
}

.focus\:border-pink-500 {
border-color: #ec4899;
}

.btn {
  display: inline-flex;
  align-items: center;
  padding: 0.5rem 1rem;
  border-radius: 0.375rem;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.3s ease;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.btn-pink {
  background-color: #f472b6;
  color: white;
  border: 1px solid #f472b6;
}

.btn-pink:hover {
  background-color: #ec4899;
  border-color: #ec4899;
  transform: scale(1.05);
}

.btn-outline-pink {
  border: 1px solid #f472b6;
  background-color: transparent;
  color: #f472b6;
}

.btn-outline-pink:hover {
  background-color: #f472b6;
  color: white;
  transform: scale(1.05);
}

input, select, textarea {
  background-color: #fce4ec;
  color: #ec4899;
}

input::placeholder, select::placeholder {
  color: #ec4899;
}

.text-red-500 {
color: #ef4444;
}

.dd {
  margin-top: 0.5rem;
}

.text-pink-600 {
  color: #ec4899;
}
</style>
