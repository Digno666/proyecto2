<script setup>
import { ref, watch } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
  proveedor: Object,
  errors: Object,
});

const form = useForm({
  nombre: props.proveedor?.nombre || '',
  direccion: props.proveedor?.direccion || '',
  telefono: props.proveedor?.telefono || '',
});

const submitButton = ref(null);

const validateNombre = () => form.nombre.length > 2 && form.nombre.length < 31;
const validateDireccion = () => form.direccion.length > 5 && form.direccion.length < 201;
const validateTelefono = () => /^\d{8,10}$/.test(form.telefono);

const validateForm = () => {
  submitButton.value.disabled = !(validateNombre() && validateDireccion() && validateTelefono());
};

const submit = () => {
  form.put(route('proveedor.update', props.proveedor.codProveedor), {
    onSuccess: () => {
      router.get(route('proveedor.index'));
    },
  });
};

watch([() => form.nombre, () => form.direccion, () => form.telefono], () => {
  validateForm();
});
</script>

<template>
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
            <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Editar Proveedor</h1>

            <div v-if="form.errors.length" class="alert alert-danger">
              <ul>
                <li v-for="(error, index) in form.errors" :key="index">
                  {{ error }}
                </li>
              </ul>
            </div>

            <form @submit.prevent="submit" novalidate>
              <div class="mb-4">
                <InputLabel for="nombre" value="Nombre" class="text-pink-600 font-semibold" />
                <InputError :message="form.errors.nombre" />
                <TextInput
                  v-model="form.nombre"
                  id="nombre"
                  class="mt-1 block w-full bg-pink-100 text-pink-600 border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                  placeholder="Ingrese el nombre del proveedor"
                  required
                  @input="validateForm"
                />
                <div v-if="!validateNombre() && form.nombre.length > 0" class="text-red-500 text-sm">
                  * El nombre debe tener entre 3 y 30 caracteres.
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="direccion" value="Dirección" class="text-pink-600 font-semibold" />
                <InputError :message="form.errors.direccion" />
                <TextInput
                  v-model="form.direccion"
                  id="direccion"
                  class="mt-1 block w-full bg-pink-100 text-pink-600 border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                  placeholder="Ingrese la dirección del proveedor"
                  required
                  @input="validateForm"
                />
                <div v-if="!validateDireccion() && form.direccion.length > 0" class="text-red-500 text-sm">
                  * La dirección debe tener entre 6 y 200 caracteres.
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="telefono" value="Teléfono" class="text-pink-600 font-semibold" />
                <InputError :message="form.errors.telefono" />
                <TextInput
                  v-model="form.telefono"
                  id="telefono"
                  class="mt-1 block w-full bg-pink-100 text-pink-600 border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                  placeholder="Ingrese el teléfono del proveedor"
                  required
                  @input="validateForm"
                />
                <div v-if="!validateTelefono() && form.telefono.length > 0" class="text-red-500 text-sm">
                  * El teléfono debe ser un número de entre 8 y 10 dígitos.
                </div>
              </div>

              <div class="text-center mt-4">
                <Link :href="route('proveedor.index')" class="btn btn-secondary me-3">
                  <i class="fas fa-arrow-left"></i> Atrás
                </Link>
                <PrimaryButton
                  ref="submitButton"
                  class="btn btn-pink"
                  :disabled="!validateNombre() || !validateDireccion() || !validateTelefono() || form.processing"
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
/* Estilos generales */
.bg-pink-100 {
    background-color: #fce4ec;
}

.text-pink-600 {
    color: #ec4899;
}

.text-pink-500 {
    color: #f472b6;
}

.border-pink-300 {
    border-color: #f472b6;
}

.border-pink-500 {
    border-color: #ec4899;
}

.focus:border-pink-500 {
    border-color: #ec4899;
}

.py-12 {
  margin-top: calc(60px + 1rem); 
  margin-bottom: calc(60px + 1rem); 
}

/* Botón Primario */
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

.text-red-500 {
    color: #f87171;
}

.text-sm {
    font-size: 0.875rem;
}

.mt-1 {
    margin-top: 0.25rem;
}

.mb-4 {
    margin-bottom: 1rem;
}

.font-semibold {
    font-weight: 600;
}

.block {
    display: block;
}

.w-full {
    width: 100%;
}
</style>
