<template>
  <plantillanav :userName="$page.props.auth.user.name" />
  <div class="container mx-auto p-4">
    <h1 class="text-3xl font-semibold text-center mb-6 text-d6336c">Registrar Cliente</h1>

    <form @submit.prevent="submitForm" novalidate class=" p-6 rounded-lg shadow-lg space-y-6">

      <!-- Mensaje de éxito -->
      <div v-if="successMessage" class="alert alert-success bg-green-100 text-green-700 p-4 rounded-lg mb-4">
        {{ successMessage }}
      </div>

      <!-- Cédula de identidad -->
      <div class="mb-4">
        <label for="carnetIdentidad" class="block text-sm font-medium text-gray-700">Cédula de identidad:</label>
        <input type="text" id="carnetIdentidad" v-model="formData.carnetIdentidad" class="mt-2 p-2 w-full border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required />
        <div v-if="errors.carnetIdentidad" class="text-red-500 text-xs mt-1">{{ errors.carnetIdentidad }}</div>
      </div>

      <!-- Nombre -->
      <div class="mb-4">
        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
        <input type="text" id="nombre" v-model="formData.nombre" class="mt-2 p-2 w-full border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required />
        <div v-if="errors.nombre" class="text-red-500 text-xs mt-1">{{ errors.nombre }}</div>
      </div>

      <!-- Apellido Paterno -->
      <div class="mb-4">
        <label for="apellidoPaterno" class="block text-sm font-medium text-gray-700">Apellido Paterno:</label>
        <input type="text" id="apellidoPaterno" v-model="formData.apellidoPaterno" class="mt-2 p-2 w-full border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required />
        <div v-if="errors.apellidoPaterno" class="text-red-500 text-xs mt-1">{{ errors.apellidoPaterno }}</div>
      </div>

      <!-- Apellido Materno -->
      <div class="mb-4">
        <label for="apellidoMaterno" class="block text-sm font-medium text-gray-700">Apellido Materno:</label>
        <input type="text" id="apellidoMaterno" v-model="formData.apellidoMaterno" class="mt-2 p-2 w-full border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required />
        <div v-if="errors.apellidoMaterno" class="text-red-500 text-xs mt-1">{{ errors.apellidoMaterno }}</div>
      </div>

      <!-- Sexo -->
      <div class="mb-4">
        <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo:</label>
        <select v-model="formData.sexo" id="sexo" class="mt-2 p-2 w-full border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
          <option value="" disabled>Selecciona el sexo</option>
          <option value="masculino">Masculino</option>
          <option value="femenino">Femenino</option>
        </select>
        <div v-if="errors.sexo" class="text-red-500 text-xs mt-1">{{ errors.sexo }}</div>
      </div>

      <!-- Edad -->
      <div class="mb-4">
        <label for="edad" class="block text-sm font-medium text-gray-700">Edad:</label>
        <input type="number" id="edad" v-model="formData.edad" class="mt-2 p-2 w-full border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required />
        <div v-if="errors.edad" class="text-red-500 text-xs mt-1">{{ errors.edad }}</div>
      </div>

      <!-- Teléfono -->
      <div class="mb-4">
        <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono:</label>
        <input type="tel" id="telefono" v-model="formData.telefono" class="mt-2 p-2 w-full border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required />
        <div v-if="errors.telefono" class="text-red-500 text-xs mt-1">{{ errors.telefono }}</div>
      </div>

      <!-- Nombre de Usuario -->
      <div class="mb-4">
        <label for="nombreUsuario" class="block text-sm font-medium text-gray-700">Nombre de usuario:</label>
        <input type="text" id="nombreUsuario" v-model="formData.nombreUsuario" class="mt-2 p-2 w-full border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required />
        <div v-if="errors.nombreUsuario" class="text-red-500 text-xs mt-1">{{ errors.nombreUsuario }}</div>
      </div>

      <!-- Correo electrónico -->
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico:</label>
        <input type="email" id="email" v-model="formData.email" class="mt-2 p-2 w-full border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required />
        <div v-if="errors.email" class="text-red-500 text-xs mt-1">{{ errors.email }}</div>
      </div>

      <!-- Contraseña -->
      <div class="mb-4 relative">
        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña:</label>
        <input type="password" id="password" v-model="formData.password" class="mt-2 p-2 w-full border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" :type="passwordVisible ? 'text' : 'password'" required />
        <button type="button" @click="togglePassword" class="absolute top-1/2 right-3 transform -translate-y-1/2 text-gray-500 hover:text-indigo-500">
          <i :class="passwordVisible ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
        </button>
        <div v-if="errors.password" class="text-red-500 text-xs mt-1">{{ errors.password }}</div>
      </div>

      <!-- Botones -->
      <div class="flex justify-center space-x-4">
        <Link :href=" route('cliente.index') " class="btn btn-secondary me-3">
             <i class="fas fa-arrow-left"></i> Atrás
        </Link>
        <PrimaryButton 
            ref="submitButton"
            class="mt-4"
        >
            <i class="fas fa-save"></i> Guardar
        </PrimaryButton>
      </div>
    </form>
    <VisitaFooter />
  </div>
</template>


<script setup>
import plantillanav from '@/Layouts/plantillanav.vue';
import { ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';
import { Inertia } from '@inertiajs/inertia';
</script>

<script>
export default {
  data() {
    return {
      formData: {
        carnetIdentidad: '',
        nombre: '',
        apellidoPaterno: '',
        apellidoMaterno: '',
        sexo: '',
        edad: '',
        telefono: '',
        nombreUsuario: '',
        email: '',
        password: '',
      },
      errors: {},
      successMessage: '',
      passwordVisible: false
    };
  },
  computed: {
    formInvalid() {
      return !this.isValidForm();
    }
  },
  methods: {
    validateForm() {
      this.errors = {};
      this.validateCarnetIdentidad();
      this.validateNombre();
      this.validateApellidoPaterno();
      this.validateApellidoMaterno();
      this.validateSexo();
      this.validateEdad();
      this.validateTelefono();
      this.validateNombreUsuario();
      this.validateEmail();
      this.validatePassword();
    },
    validateCarnetIdentidad() {
      if (!/^\d{8,10}$/.test(this.formData.carnetIdentidad)) {
        this.errors.carnetIdentidad = '* La cédula de identidad debe ser un número de entre 8 y 10 dígitos.';
      }
    },
    validateNombre() {
      if (this.formData.nombre.length < 3 || this.formData.nombre.length > 30) {
        this.errors.nombre = '* El nombre debe tener entre 3 y 30 caracteres.';
      }
    },
    validateApellidoPaterno() {
      if (this.formData.apellidoPaterno.length < 3 || this.formData.apellidoPaterno.length > 30) {
        this.errors.apellidoPaterno = '* El apellido paterno debe tener entre 3 y 30 caracteres.';
      }
    },
    validateApellidoMaterno() {
      if (this.formData.apellidoMaterno.length < 3 || this.formData.apellidoMaterno.length > 30) {
        this.errors.apellidoMaterno = '* El apellido materno debe tener entre 3 y 30 caracteres.';
      }
    },
    validateSexo() {
      if (!this.formData.sexo) {
        this.errors.sexo = '* Debes seleccionar un sexo.';
      }
    },
    validateEdad() {
      if (!/^\d{1,2}$/.test(this.formData.edad) || this.formData.edad < 8 || this.formData.edad > 100) {
        this.errors.edad = '* La edad debe ser un número entre 8 y 70 años.';
      }
    },
    validateTelefono() {
      if (!/^\d{8,10}$/.test(this.formData.telefono)) {
        this.errors.telefono = '* El teléfono debe ser un número de entre 8 y 10 dígitos.';
      }
    },
    validateNombreUsuario() {
      if (this.formData.nombreUsuario.length < 4) {
        this.errors.nombreUsuario = '* El nombre de usuario debe tener más de 3 caracteres.';
      }
    },
    validateEmail() {
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(this.formData.email)) {
        this.errors.email = '* El correo electrónico debe tener un formato válido.';
      }
    },
    validatePassword() {
      if (this.formData.password.length <= 8) {
        this.errors.password = '* La contraseña debe tener más de 8 caracteres.';
      }
    },
    togglePassword() {
      this.passwordVisible = !this.passwordVisible;
    },
    submitForm() {
      this.validateForm();
      if (Object.keys(this.errors).length === 0) {
        Inertia.post(route('cliente.store'), this.formData, {
          onFinish: () => {
            this.successMessage = 'Cliente registrado con éxito.';
            this.formData = {
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
            };
          },
          onError: (errors) => {
            this.errors = errors;
          }
        });
      }
    },
  },
  watch: {
    formData: {
      handler() {
        this.validateForm();
      },
      deep: true
    }
  }
};
</script>
