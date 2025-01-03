<script setup>
import { ref, computed, watch } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
  producto: Object,
  categorias: Array,
  errors: Object,
});

const form = useForm({
  nombre: props.producto?.nombre || '',
  descripcion: props.producto?.descripcion || '',
  precio: props.producto?.precio || '',
  codCategoriaF: props.producto?.codCategoriaF || '',
  imagen: null,
});

const imagePreview = ref(null);
const handleImageChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  } else {
    imagePreview.value = null;
  }
};

const validateNombre = () => form.nombre.length > 2 && form.nombre.length < 101;
const validateDescripcion = () => form.descripcion.length > 4 && form.descripcion.length < 256;
const validatePrecio = () => parseFloat(form.precio) > 0;
const validateCategoria = () => form.codCategoriaF !== '';

const validateForm = () => validateNombre() && validateDescripcion() && validatePrecio() && validateCategoria();
watch([() => form.nombre, () => form.descripcion, () => form.precio, () => form.codCategoriaF], validateForm);

const submit = () => {
  const formData = new FormData();
  formData.append('nombre', form.nombre);
  formData.append('descripcion', form.descripcion);
  formData.append('precio', form.precio);
  formData.append('codCategoriaF', form.codCategoriaF);

  if (form.imagen) {
    formData.append('imagen', form.imagen);
  }

  form.put(route('producto.update', props.producto.codProducto), {
    data: formData,
    onSuccess: () => {
      router.get(route('producto.index'));
    },
  });
};
</script>

<template>
   <!-- Barra lateral -->
   <plantillanav />
  <AppLayout title="Editar Producto">
    <template #header>
      <h2 class="font-semibold text-xl text-pink-600 leading-tight">
        Editar Producto
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
          <div class="p-6 lg:p-8 border-gray-200 divpequeno">
            <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Editar Producto</h1>

            <div v-if="form.errors.length" class="alert alert-danger">
              <ul>
                <li v-for="(error, index) in form.errors" :key="index">
                  {{ error }}
                </li>
              </ul>
            </div>

            <form @submit.prevent="submit" novalidate>
              <div class="mb-4">
                <InputLabel for="nombre" value="Nombre" class="text-pink-600" />
                <InputError :message="form.errors.nombre" />
                <TextInput
                  v-model="form.nombre"
                  id="nombre"
                  class="mt-1 block w-full border-pink-300 focus:ring-pink-500 focus:border-pink-500 bg-pink-50 text-pink-600"
                  placeholder="Ingrese el nombre del producto"
                  required
                  @input="validateForm"
                />
                <div v-if="!validateNombre()" class="text-red-500 text-sm">
                  * El nombre debe tener entre 3 y 100 caracteres.
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="descripcion" value="Descripción" class="text-pink-600" />
                <InputError :message="form.errors.descripcion" />
                <textarea
                  v-model="form.descripcion"
                  id="descripcion"
                  class="mt-1 block w-full border-pink-300 focus:ring-pink-500 focus:border-pink-500 bg-pink-50 text-pink-600"
                  placeholder="Ingrese la descripción del producto"
                  rows="3"
                  required
                ></textarea>
                <div v-if="!validateDescripcion()" class="text-red-500 text-sm">
                  * La descripción debe tener entre 5 y 255 caracteres.
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="precio" value="Precio" class="text-pink-600" />
                <InputError :message="form.errors.precio" />
                <TextInput
                  v-model="form.precio"
                  type="number"
                  id="precio"
                  class="mt-1 block w-full border-pink-300 focus:ring-pink-500 focus:border-pink-500 bg-pink-50 text-pink-600"
                  placeholder="Ingrese el precio del producto"
                  required
                />
                <div v-if="!validatePrecio()" class="text-red-500 text-sm">
                  * El precio debe ser un número mayor a 0.
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="codCategoriaF" value="Categoría" class="text-pink-600" />
                <InputError :message="form.errors.codCategoriaF" />
                <select
                  v-model="form.codCategoriaF"
                  id="codCategoriaF"
                  class="mt-1 block w-full border-pink-300 focus:ring-pink-500 focus:border-pink-500 bg-pink-50 text-pink-600"
                  required
                >
                  <option value="">Seleccione una categoría</option>
                  <option
                    v-for="categoria in props.categorias"
                    :key="categoria.codCategoria"
                    :value="categoria.codCategoria"
                  >
                    {{ categoria.nombre }}
                  </option>
                </select>
                <div v-if="!validateCategoria()" class="text-red-500 text-sm">
                  * Seleccione una categoría válida.
                </div>
              </div>

              <div class="mb-4">
                <InputLabel for="imagen" value="Imagen" class="text-pink-600" />
                <input
                  type="file"
                  id="imagen"
                  class="form-control"
                  accept="image/*"
                  @change="handleImageChange"  
                />
                <img
                  v-if="imagePreview"
                  :src="imagePreview"
                  alt="Vista previa de la imagen"
                  class="img-fluid mt-2"
                />
              </div>

              <div class="mb-4">
                <InputLabel value="Imagen Actual" class="text-pink-600" />
                <div v-if="props.producto.imagen_url">
                  <img
                    :src="`/inf513/grupo01cc/proyecto2/public/storage/uploads/${props.producto.imagen_url}`"
                    alt="Imagen actual"
                    width="200"
                  />
                </div>
                <div v-else class="text-gray-500">No hay imagen actual.</div>
              </div>

              <div class="text-center mt-4">
                <Link :href="route('producto.index')" class="btn btn-outline-pink me-3">
                  <i class="fas fa-arrow-left"></i> Atrás
                </Link>
                <PrimaryButton
                  class="btn btn-pink"
                  :disabled="!validateForm() || form.processing"
                >
                  <i class="fas fa-pencil-alt"></i> Modificar
                </PrimaryButton>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <VisitaFooter />
  </AppLayout>
</template>

<style scoped>
.py-12 {
  margin-top: calc(60px + 1rem); 
  margin-bottom: calc(60px + 1rem); 
}

.text-pink-600 {
  color: #ec4899;
}

.bg-pink-50 {
  background-color: #fdf2f8; /* Fondo rosado aún más claro */
}

.border-pink-300 {
  border-color: #f472b6;
}

.focus:ring-pink-500 {
  box-shadow: 0 0 0 1px rgba(236, 72, 153, 0.5);
}

.focus:border-pink-500 {
  border-color: #ec4899;
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
  background-color: white;
  color: #f472b6;
  border: 1px solid #f472b6;
}

.btn-outline-pink:hover {
  background-color: #f472b6;
  color: white;
  border-color: #f472b6;
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

.min-w-full {
  min-width: 100%;
}

.table-auto th, .table-auto td {
  padding: 0.75rem;
}

.table-auto th {
  background-color: #f472b6;
  color: white;
  text-align: left;
}

.table-auto td {
  border-bottom: 1px solid #f472b6;
}

.table-auto tbody tr:hover {
  background-color: #fce4ec;
}
</style>
