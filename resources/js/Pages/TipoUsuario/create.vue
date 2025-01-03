<script setup>
import { ref, watch } from 'vue'; 
import { router, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
    errors: Object,
});

// Formulario para registrar el tipo de usuario
const form = useForm({
    descripcion: '', // Campo de descripción
});

// Referencia al botón de submit para habilitar/deshabilitar
const submitButton = ref(null);

// Función para manejar la validación de la descripción
const validateDescripcion = () => {
    const descripcion = form.descripcion.trim();
    const isValid = descripcion.length > 2 && descripcion.length < 21;
    return isValid;
};

// Función para habilitar o deshabilitar el botón de envío
const validateForm = () => {
    submitButton.value.disabled = !validateDescripcion();
};

// Función para manejar el envío del formulario
const submit = () => {
    form.post(route('tipoUsuario.store'), {
        onSuccess: () => {
            // Redirigir al listado de tipos de usuario en caso de éxito
            router.get(route('tipoUsuario.index'));
        },
    });
};

// Verificar la validación del campo al cargar y al escribir
watch(() => form.descripcion, () => {
    validateForm();
});
</script>

<template>
    <!-- <plantillanav :userName="$page.props.auth.user.name"/> -->
      <!-- Barra lateral -->
      <plantillanav />
    <AppLayout title="Registrar Tipo de Usuario">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Registrar Tipo de Usuario
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Registrar tipo de Usuario</h1>
                        <form @submit.prevent="submit" novalidate>
                            <!-- Campo de Descripción -->
                            <div class="mb-4">
                                <InputLabel for="descripcion" value="Descripción" class="text-pink-600" />
                                <InputError :message="errors.descripcion" />
                                <TextInput 
                                    v-model="form.descripcion"
                                    id="descripcion"
                                    class="mt-1 block w-full border border-pink-500 focus:ring-pink-500 focus:border-pink-500"
                                    placeholder="Ingrese la descripción del tipo de usuario"
                                    required
                                    @input="validateForm"
                                />
                                <div v-if="!validateDescripcion() && form.descripcion.length > 0" class="text-red-500 text-sm">
                                    * La descripción debe tener entre 3 y 20 caracteres.
                                </div>
                            </div>

                            <div class="text-center">
                                <!-- Botón de Atrás -->
                                <Link href="{{ route('tipoUsuario.index') }}" class="btn btn-outline-pink me-2">
                                    <i class="fas fa-arrow-left"></i> Atrás
                                </Link>

                                <!-- Botón de Enviar -->
                                <PrimaryButton
                                 
                                    ref="submitButton"
                                    class="mt-4 bg-pink-600 hover:bg-pink-700 text-white"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="!validateDescripcion() || form.processing"
                                >
                                    <i class="fas fa-save "></i> Guardar
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

button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.bg-pink-500 {
  background-color: #f472b6;
}

.bg-pink-500:hover {
  background-color: #ec4899;
}

.text-pink-600 {
  color: #f472b6;
}

.text-pink-600:hover {
  color: #ec4899;
}

.border-pink-300 {
  border-color: #f472b6;
}

.focus\:ring-pink-500:focus {
  box-shadow: 0 0 0 1px #ec4899;
  border-color: #ec4899;
}
</style>
