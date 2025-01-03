<script setup>
import { ref, computed } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
  usuario: Object,
  tiposUsuario: Array,
  errors: Object,
});

const form = useForm({
  name: props.usuario?.name || '', 
  email: props.usuario?.email || '',
  password: props.usuario?.password || '', 
  codTipoUsuarioF: props.usuario?.codTipoUsuarioF || '',
});

const showPassword = ref(false);

const isNameValid = computed(() => form.name.length > 3);  
const isEmailValid = computed(() => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email));
const isPasswordValid = computed(() => form.password.length >= 8 || form.password === '');
const isCodTipoUsuarioFValid = computed(() => form.codTipoUsuarioF !== '');

const isFormValid = computed(() => 
  isNameValid.value &&
  isEmailValid.value &&
  isPasswordValid.value &&
  isCodTipoUsuarioFValid.value
);

const submit = () => {
  form.put(route('usuario.update', props.usuario.codUsuario), {
    onSuccess: () => {
    }
  });
};
</script>

<template>
  <!-- <plantillanav :userName="$page.props.auth.user.name" /> -->
    <!-- Barra lateral -->
    <plantillanav />
  <AppLayout title="Modificar Usuario">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        Editar Usuario
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
          <div class="p-6 lg:p-8 border-gray-200 divpequeno">
            <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Modificar Usuario</h1>

            <div v-if="form.errors.success" class="alert alert-success">
              {{ form.errors.success }}
            </div>

            <form @submit.prevent="submit" novalidate>
            
              <div class="mb-4">
                <InputLabel for="name" value="Nombre" class="bb" />
                <InputError :message="form.errors.name" />
                <TextInput
                  v-model="form.name"
                  type="text"
                  id="name"
                  class="mt-1 block w-full cc"
                  placeholder="Ingrese el nombre de usuario"
                  required
                />
                <div v-if="!isNameValid && form.name.length > 0" class="text-red-500 text-sm dd">
                  * El nombre de usuario debe tener más de 3 caracteres.
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="email" value="Email" class="bb" />
                <InputError :message="form.errors.email" />
                <TextInput
                  v-model="form.email"
                  type="email"
                  id="email"
                  class="mt-1 block w-full cc"
                  placeholder="Ingrese el correo electrónico"
                  required
                />
                <div v-if="!isEmailValid && form.email.length > 0" class="text-red-500 text-sm dd">
                  * El correo electrónico debe tener un formato válido.
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="password" value="Contraseña" class="bb" />
                <InputError :message="form.errors.password" />
                <div class="input-group">

                  <TextInput
                    v-model="form.password"
                    :type="showPassword ? 'text' : 'password'"
                    id="password"
                    class="mt-1 block w-full cc"
                    placeholder="Ingrese la contraseña"
                  />
                  <button
                    type="button"
                    class="btn btn-outline-secondary"
                    @click="showPassword = !showPassword"
                  >
                    <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                  </button>
                </div>
                <div v-if="!isPasswordValid && form.password.length > 0" class="text-red-500 text-sm dd">
                  * La contraseña debe tener al menos 8 caracteres.
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="codTipoUsuarioF" value="Tipo de Usuario" class="bb" />
                <InputError :message="form.errors.codTipoUsuarioF" />
                <select
                  v-model="form.codTipoUsuarioF"
                  id="codTipoUsuarioF"
                  class="form-select ee"
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
                <div v-if="!isCodTipoUsuarioFValid && form.codTipoUsuarioF.length === 0" class="text-red-500 text-sm dd">
                  * Debes seleccionar un tipo de usuario.
                </div>
              </div>

              <div class="text-center mt-4">
                <Link 
                                    :href="route('usuario.index')" 
                                    class="btn btn-secondary me-3"
                                >
                                    <i class="fas fa-arrow-left"></i> Atrás
                                </Link>
                <PrimaryButton
                  type="submit"
                  :disabled="!isFormValid || form.processing"
                  class="btn btn-pink-600"
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
.py-12 {
  margin-top: calc(60px + 1rem); 
  margin-bottom: calc(60px + 1rem); 
}

.text-pink-600 {
  color: #ec4899; /* Rosado */
}

.bg-pink-600 {
  background-color: #ec4899; /* Rosado */
}

.bg-pink-800 {
  background-color: #9b1d48; /* Rosado oscuro */
}

.hover\:bg-pink-800:hover {
  background-color: #9b1d48; /* Rosado oscuro al pasar el mouse */
}

/* Estilos para botones */
.btn {
  display: inline-flex;
  align-items: center;
  padding: 0.5rem 1rem;
  border-radius: 0.5rem; /* Bordes más redondeados */
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-secondary {
  background-color: #d1d5db; /* Gris claro */
  color: white;
  border-radius: 0.5rem;
}

.btn-secondary:hover {
  background-color: #a1a1aa; /* Gris más oscuro */
}

/* Estilos para el campo de selección */
.form-select {
  border: 1px solid #f472b6; /* Rosado suave */
  color: #ec4899; /* Color rosado en los textos */
  border-radius: 0.5rem;
}

.form-select:focus {
  border-color: #f472b6;
  outline: none;
  box-shadow: 0 0 0 1px rgba(244, 114, 182, 0.5);
}

/* Estilos para los campos de texto */
.cc {
  border-radius: 0.5rem;
  padding: 0.75rem;
  color: #ec4899; /* Textos rosados */
  border: 1px solid #f472b6; /* Borde rosado */
}

.cc:focus {
  border-color: #ec4899; /* Borde rosado al enfocar */
  outline: none;
  box-shadow: 0 0 0 1px rgba(244, 114, 182, 0.5); /* Resplandor rosado al enfocar */
}

/* Estilo de los labels */
.bb {
  font-weight: 600;
  color: #ec4899; /* Color rosado para los labels */
}

/* Estilos para los mensajes de error */
.dd {
  font-size: 0.875rem;
  color: #f87171; /* Rojo suave para los mensajes de error */
}

/* Estilos de los textos de error en los campos */
.text-red-500 {
  color: #f87171; /* Rojo suave */
}

/* Estilo de los botones de acción */
.btn-pink-600 {
  background-color: #ec4899;
  color: white;
  border-radius: 0.5rem;
}

.btn-pink-600:hover {
  background-color: #9b1d48;
}

/* Estilo para el botón de mostrar/ocultar la contraseña */
.input-group button {
  background-color: #f472b6;
  border-radius: 50%;
  padding: 0.5rem;
  border: none;
  cursor: pointer;
}

.input-group button:hover {
  background-color: #ec4899;
}
</style>
