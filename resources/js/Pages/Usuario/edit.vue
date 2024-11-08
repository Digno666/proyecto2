<script setup>
import { ref, computed } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

// Props: recibir los datos del usuario y errores desde el controlador
const props = defineProps({
  usuario: Object,
  tiposUsuario: Array,
  errors: Object,
});

// Formulario reactivo usando useForm
const form = useForm({
  nombreUsuario: props.usuario?.nombreUsuario || '',
  email: props.usuario?.email || '',
  password: '',
  codTipoUsuarioF: props.usuario?.codTipoUsuarioF || '',
});

// Validaciones en los campos
const isNombreUsuarioValid = computed(() => form.nombreUsuario.length > 3);
const isEmailValid = computed(() => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email));
const isPasswordValid = computed(() => form.password.length >= 8 || form.password === '');
const isCodTipoUsuarioFValid = computed(() => form.codTipoUsuarioF !== '');

// Habilitar o deshabilitar el botón de envío
const isFormValid = computed(() => 
  isNombreUsuarioValid.value &&
  isEmailValid.value &&
  isPasswordValid.value &&
  isCodTipoUsuarioFValid.value
);

// Función para enviar el formulario
const submit = () => {
  form.put(route('usuario.update', props.usuario.codUsuario), {
    onSuccess: () => {
      // Redirigir después de éxito, o mostrar un mensaje
    }
  });
};
</script>

<template>
  <AppLayout title="Modificar Usuario">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        Editar Usuario
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <!-- Errores del servidor -->
            <div v-if="form.errors.success" class="alert alert-success">
              {{ form.errors.success }}
            </div>

            <!-- Formulario de edición -->
            <form @submit.prevent="submit">
              <!-- Nombre de usuario -->
              <div class="mb-3">
                <InputLabel for="nombreUsuario" value="Nombre" />
                <InputError :message="form.errors.nombreUsuario" />
                <TextInput
                  v-model="form.nombreUsuario"
                  type="text"
                  id="nombreUsuario"
                  class="form-control"
                  placeholder="Ingrese el nombre de usuario"
                  required
                />
                <div v-if="!isNombreUsuarioValid && form.nombreUsuario.length > 0" class="text-red-500 text-sm">
                  * El nombre de usuario debe tener más de 3 caracteres.
                </div>
              </div>

              <!-- Email -->
              <div class="mb-3">
                <InputLabel for="email" value="Email" />
                <InputError :message="form.errors.email" />
                <TextInput
                  v-model="form.email"
                  type="email"
                  id="email"
                  class="form-control"
                  placeholder="Ingrese el correo electrónico"
                  required
                />
                <div v-if="!isEmailValid && form.email.length > 0" class="text-red-500 text-sm">
                  * El correo electrónico debe tener un formato válido.
                </div>
              </div>

              <!-- Contraseña -->
              <div class="mb-3">
                <InputLabel for="password" value="Contraseña" />
                <InputError :message="form.errors.password" />
                <div class="input-group">
                  <TextInput
                    v-model="form.password"
                    type="password"
                    id="password"
                    class="form-control"
                    placeholder="Ingrese la contraseña"
                  />
                  <button
                    type="button"
                    class="btn btn-outline-secondary"
                    @click="form.password = form.password ? '' : form.password"
                  >
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
                <div v-if="!isPasswordValid && form.password.length > 0" class="text-red-500 text-sm">
                  * La contraseña debe tener al menos 8 caracteres.
                </div>
              </div>

              <!-- Tipo de Usuario -->
              <div class="mb-3">
                <InputLabel for="codTipoUsuarioF" value="Tipo de Usuario" />
                <InputError :message="form.errors.codTipoUsuarioF" />
                <select
                  v-model="form.codTipoUsuarioF"
                  id="codTipoUsuarioF"
                  class="form-select"
                  required
                >
                  <option value="" disabled>Seleccionar tipo de usuario</option>
                  <option
                    v-for="tipo in props.tiposUsuario"
                    :key="tipo.codTipoUsuario"
                    :value="tipo.codTipoUsuario"
                  >
                    {{ tipo.descripcion }}
                  </option>
                </select>
                <div v-if="!isCodTipoUsuarioFValid && form.codTipoUsuarioF.length === 0" class="text-red-500 text-sm">
                  * Debes seleccionar un tipo de usuario.
                </div>
              </div>

              <!-- Botones -->
              <div class="text-center mt-4">
                <Link
                  href="{{ route('usuario.index') }}"
                  class="btn btn-secondary me-2"
                >
                  <i class="fas fa-arrow-left"></i> Atrás
                </Link>
                <PrimaryButton
                  type="submit"
                  :disabled="!isFormValid || form.processing"
                  class="btn btn-primary"
                >
                  <i class="fas fa-pencil-alt"></i> Modificar
                </PrimaryButton>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
