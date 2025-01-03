<template>
  <!-- <plantillanav :userName="$page.props.auth.user.name" /> -->
    <!-- Barra lateral -->
    <plantillanav />
  <AppLayout title="Registrar Producto">
    <template #header>
      <h2 class="font-semibold text-xl text-pink-600 leading-tight">
        Registrar Producto
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
          <div class="p-6 lg:p-8 border-gray-200 divpequeno">
            <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Registrar Producto</h1>
            <form @submit.prevent="submitForm" novalidate>
              <div class="mb-4">
                <InputLabel for="codProducto" value="Código del Producto" class="bb text-pink-600" />
                <InputError :message="errors.codProducto" />
                <TextInput
                  v-model="form.codProducto"
                  id="codProducto"
                  class="mt-1 block w-full bg-pink-100 text-pink-600 border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                  placeholder="Ingrese el código del producto"
                  required
                  @input="validateForm"
                />
                <div v-if="!validateCodProducto() && form.codProducto.length > 0" class="text-pink-600 text-sm mt-2">
                  * El código debe tener entre 2 y 20 caracteres.
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="nombre" value="Nombre" class="bb text-pink-600" />
                <InputError :message="errors.nombre" />
                <TextInput
                  v-model="form.nombre"
                  id="nombre"
                  class="mt-1 block w-full bg-pink-100 text-pink-600 border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                  placeholder="Ingrese el nombre del producto"
                  required
                  @input="validateForm"
                />
                <div v-if="!validateNombre() && form.nombre.length > 0" class="text-pink-600 text-sm mt-2">
                  * El nombre debe tener entre 2 y 50 caracteres.
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="descripcion" value="Descripción" class="bb text-pink-600" />
                <InputError :message="errors.descripcion" />
                <TextInput
                  v-model="form.descripcion"
                  id="descripcion"
                  class="mt-1 block w-full bg-pink-100 text-pink-600 border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                  placeholder="Ingrese la descripción"
                  required
                  @input="validateForm"
                />
                <div v-if="!validateDescripcion() && form.descripcion.length > 0" class="text-pink-600 text-sm mt-2">
                  * La descripción debe tener entre 5 y 250 caracteres.
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="precio" value="Precio" class="bb text-pink-600" />
                <InputError :message="errors.precio" />
                <TextInput
                  v-model="form.precio"
                  type="number"
                  id="precio"
                  class="mt-1 block w-full bg-pink-100 text-pink-600 border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                  placeholder="Ingrese el precio"
                  required
                  @input="validateForm"
                />
                <div v-if="!validatePrecio() && form.precio" class="text-pink-600 text-sm mt-2">
                  * El precio debe ser mayor a 0.
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="codCategoriaF" value="Categoría" class="bb text-pink-600" />
                <InputError :message="errors.codCategoriaF" />
                <select
                  v-model="form.codCategoriaF"
                  id="codCategoriaF"
                  class="form-select mt-1 block w-full bg-pink-100 text-pink-600 border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                  required
                  @change="validateForm"
                >
                  <option value="">Seleccione una categoría</option>
                  <option
                    v-for="categoria in categorias"
                    :key="categoria.codCategoria"
                    :value="categoria.codCategoria"
                  >
                    {{ categoria.nombre }}
                  </option>
                </select>
                <div v-if="!validateCategoria() && form.codCategoriaF" class="text-pink-600 text-sm mt-2">
                  * Seleccione una categoría.
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="imagen" value="Imagen" class="bb text-pink-600" />
                <input
                  type="file"
                  id="imagen"
                  class="form-control mt-1 block w-full bg-pink-100 text-pink-600 border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                  accept="image/*"
                  @change="handleImageChange"
                />
                <img v-if="imagePreview" :src="imagePreview" alt="Previsualización" class="img-fluid mt-2 max-w-xs" />
              </div>

              <div class="text-center">
                <Link href="{{ route('producto.index') }}" class="btn btn-secondary me-3">
                  <i class="fas fa-arrow-left"></i> Atrás
                </Link>
                <PrimaryButton
                  :disabled="!isFormValid || form.processing"
                  class="mt-4 btn-primary px-6 py-2.5 text-white font-medium rounded-lg text-sm uppercase"
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

<script setup>
import { ref, computed, watch } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
  categorias: Array,
  errors: Object,
});

const form = useForm({
  codProducto: '',
  nombre: '',
  descripcion: '',
  precio: '',
  codCategoriaF: '',
  imagen: null,
});

const imagePreview = ref(null);

const validateField = (field) => {
  const value = form[field];
  if (field === 'precio') return parseFloat(value) > 0;
  if (field === 'codCategoriaF') return value && value !== '';
  if (field === 'imagen') return !!value;

  const minLength = { codProducto: 2, nombre: 2, descripcion: 5 };
  const maxLength = { codProducto: 20, nombre: 50, descripcion: 250 };
  return value.length >= minLength[field] && value.length <= maxLength[field];
};

const validateCodProducto = () => validateField('codProducto');
const validateNombre = () => validateField('nombre');
const validateDescripcion = () => validateField('descripcion');
const validatePrecio = () => validateField('precio');
const validateCategoria = () => validateField('codCategoriaF');

const isFormValid = computed(() =>
  ['codProducto', 'nombre', 'descripcion', 'precio', 'codCategoriaF'].every(validateField)
);

const handleImageChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.imagen = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const submitForm = () => {
  form.post(route('producto.store'), {
    onSuccess: () => {
      router.get(route('producto.index'));
    },
  });
};

watch(
  () => [form.codProducto, form.nombre, form.descripcion, form.precio, form.codCategoriaF],
  () => {}
);
</script>

<style scoped>
.py-12 {
  margin-top: calc(60px + 1rem);
  margin-bottom: calc(60px + 1rem);
}

.text-pink-600 {
  color: #ec4899;
}

.border-pink-300 {
  border-color: #f472b6;
}
.focus:border-pink-500 {
  border-color: #ec4899;
}

.form-select,
.form-control {
  background-color: #fce4ec;
  color: #ec4899;
}

input[type="file"] {
  padding: 0.5rem;
  background-color: #fce4ec;
}

.btn-primary {
  background-color: #ec4899;
  border: 1px solid #ec4899;
}

.btn-primary:hover {
  background-color: #d81b77;
}

.text-pink-600 {
  color: #ec4899;
}

.img-fluid {
  max-width: 200px;
  height: auto;
}
</style>
