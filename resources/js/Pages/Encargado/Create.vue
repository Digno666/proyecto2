<script setup>
import { ref, computed, watch } from 'vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import plantillanav from '@/Layouts/plantillanav.vue'; 
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
  vendedores: Object, 
  sessionSuccess: String,
  errors: Object
});

const form = useForm({
  carnetIdentidad: '',
  nombre: '',
  apellidoPaterno: '',
  apellidoMaterno: '',
  sexo: '',
  edad: '',
  telefono: '',
  nombreUsuario: '',
  email: '',
  password: ''
});

const errorMessages = ref({
  carnetIdentidad: '',
  nombre: '',
  apellidoPaterno: '',
  apellidoMaterno: '',
  sexo: '',
  edad: '',
  telefono: '',
  nombreUsuario: '',
  email: '',
  password: ''
});

watch(() => form.carnetIdentidad, () => {
  errorMessages.value.carnetIdentidad = form.carnetIdentidad.length < 8 || form.carnetIdentidad.length > 10
    ? 'La cédula de identidad debe tener entre 8 y 10 caracteres.'
    : '';
});

watch(() => form.nombre, () => {
  errorMessages.value.nombre = form.nombre.length < 3
    ? 'El nombre debe tener al menos 3 caracteres.'
    : '';
});

watch(() => form.apellidoPaterno, () => {
  errorMessages.value.apellidoPaterno = form.apellidoPaterno.length < 3
    ? 'El apellido paterno debe tener al menos 3 caracteres.'
    : '';
});

watch(() => form.apellidoMaterno, () => {
  errorMessages.value.apellidoMaterno = form.apellidoMaterno.length < 3
    ? 'El apellido materno debe tener al menos 3 caracteres.'
    : '';
});

watch(() => form.sexo, () => {
  errorMessages.value.sexo = form.sexo ? '' : 'El sexo es obligatorio.';
});

watch(() => form.edad, () => {
  errorMessages.value.edad = (form.edad < 18 || form.edad > 60)
    ? 'La edad debe estar entre 18 y 60 años.'
    : '';
});

watch(() => form.telefono, () => {
  errorMessages.value.telefono = form.telefono.length < 8 || form.telefono.length > 10
    ? 'El teléfono debe tener entre 8 y 10 caracteres.'
    : '';
});

watch(() => form.nombreUsuario, () => {
  errorMessages.value.nombreUsuario = form.nombreUsuario.length < 3
    ? 'El nombre de usuario debe tener al menos 3 caracteres.'
    : '';
});

watch(() => form.email, () => {
  errorMessages.value.email = !form.email.includes('@')
    ? 'El correo electrónico debe ser válido.'
    : '';
});

watch(() => form.password, () => {
  errorMessages.value.password = form.password.length < 8
    ? 'La contraseña debe tener al menos 8 caracteres.'
    : '';
});

const submit = () => {
  form.post(route('encargado.store'));
};

const togglePasswordVisibility = () => {
  const passwordField = document.getElementById('password');
  passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
};
</script>

<template>
   <!-- Barra lateral -->
   <plantillanav />
  <AppLayout title="Registrar Encargado">
    <template #header>
      <h2 class="font-semibold text-xl text-rose-600 leading-tight">
        Registrar Encargado
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg bg-rose-50">
          <div class="p-6 lg:p-8 border-gray-200 bg-white">
            <h1 class="text-2xl font-bold text-center mb-6 text-rose-600">Registrar Trabajador</h1>

            <form @submit.prevent="submit">
              <div class="mb-4">
                <InputLabel for="carnetIdentidad" value="Cédula de Identidad" class="text-rose-600" />
                <TextInput
                  v-model="form.carnetIdentidad"
                  id="carnetIdentidad"
                  type="text"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                  placeholder="Ingrese la cédula de identidad"
                  required
                />
                <div v-if="errorMessages.carnetIdentidad" class="text-rose-600 text-sm">
                  {{ errorMessages.carnetIdentidad }}
                </div>
              </div>
              <div class="mb-4">
                <InputLabel for="nombre" value="Nombre" class="text-rose-600" />
                <TextInput
                  v-model="form.nombre"
                  id="nombre"
                  type="text"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                  placeholder="Ingrese el nombre"
                  required
                />
                <div v-if="errorMessages.nombre" class="text-rose-600 text-sm">
                  {{ errorMessages.nombre }}
                </div>
              </div>
              <div class="mb-4">
                <InputLabel for="apellidoPaterno" value="Apellido Paterno" class="text-rose-600" />
                <TextInput
                  v-model="form.apellidoPaterno"
                  id="apellidoPaterno"
                  type="text"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                  placeholder="Ingrese el apellido paterno"
                  required
                />
                <div v-if="errorMessages.apellidoPaterno" class="text-rose-600 text-sm">
                  {{ errorMessages.apellidoPaterno }}
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="apellidoMaterno" value="Apellido Materno" class="text-rose-600" />
                <TextInput
                  v-model="form.apellidoMaterno"
                  id="apellidoMaterno"
                  type="text"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                  placeholder="Ingrese el apellido materno"
                  required
                />
                <div v-if="errorMessages.apellidoMaterno" class="text-rose-600 text-sm">
                  {{ errorMessages.apellidoMaterno }}
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="sexo" value="Sexo" class="text-rose-600" />
                <select
                  v-model="form.sexo"
                  id="sexo"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600"
                  required
                >
                  <option value="">Selecciona el sexo</option>
                  <option value="masculino">Masculino</option>
                  <option value="femenino">Femenino</option>
                </select>
                <div v-if="errorMessages.sexo" class="text-rose-600 text-sm">
                  {{ errorMessages.sexo }}
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="edad" value="Edad" class="text-rose-600" />
                <TextInput
                  v-model="form.edad"
                  id="edad"
                  type="number"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                  placeholder="Ingrese la edad"
                  required
                />
                <div v-if="errorMessages.edad" class="text-rose-600 text-sm">
                  {{ errorMessages.edad }}
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="telefono" value="Teléfono" class="text-rose-600" />
                <TextInput
                  v-model="form.telefono"
                  id="telefono"
                  type="tel"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                  placeholder="Ingrese el teléfono"
                  required
                />
                <div v-if="errorMessages.telefono" class="text-rose-600 text-sm">
                  {{ errorMessages.telefono }}
                </div>
              </div>
              <div class="mb-4">
                <InputLabel for="email" value="Correo Electrónico" class="text-rose-600" />
                <TextInput
                  v-model="form.email"
                  id="email"
                  type="email"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                  placeholder="Ingrese el correo electrónico"
                  required
                />
                <div v-if="errorMessages.email" class="text-rose-600 text-sm">
                  {{ errorMessages.email }}
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="nombreUsuario" value="Nombre de Usuario" class="text-rose-600" />
                <TextInput
                  v-model="form.nombreUsuario"
                  id="nombreUsuario"
                  type="text"
                  class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                  placeholder="Ingrese el nombre de usuario"
                  required
                />
                <div v-if="errorMessages.nombreUsuario" class="text-rose-600 text-sm">
                  {{ errorMessages.nombreUsuario }}
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="password" value="Contraseña" class="text-rose-600" />
                <div class="relative">
                  <TextInput
                    v-model="form.password"
                    id="password"
                    type="password"
                    class="mt-1 block w-full border-rose-600 bg-rose-100 text-rose-600 placeholder-rose-600"
                    placeholder="Ingrese la contraseña"
                    required
                  />
                  <button
                    type="button"
                    class="absolute top-0 right-0 mt-1 mr-3 text-rose-600"
                    @click="togglePasswordVisibility"
                  >
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
                <div v-if="errorMessages.password" class="text-rose-600 text-sm">
                  {{ errorMessages.password }}
                </div>
              </div>

              <div class="text-center mt-4">
                <button onclick="history.back()" class="btn btn-secondary me-2">
                  <i class="fas fa-arrow-left"></i> Atrás
                </button>

                <PrimaryButton
                  type="submit"
                  class="mt-4 btn-primary"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  <i class="fas fa-save"></i> Guardar
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
</style>
