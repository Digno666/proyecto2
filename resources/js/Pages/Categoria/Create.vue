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
    errors: Object,
});

const form = useForm({
    nombre: '',
});

const submitButton = ref(null);

const validateNombre = () => {
    const nombre = form.nombre.trim();
    return nombre.length > 3 && nombre.length < 51;
};

const validateForm = () => {
    submitButton.value.disabled = !validateNombre();
};

const submit = () => {
    form.post(route('categoria.store'), {
        onSuccess: () => {
            router.get(route('categoria.index'));
        },
    });
};

watch(() => form.nombre, () => {
    validateForm();
});
</script>

<template>
    <plantillanav :userName="$page.props.auth.user.name" />
    <AppLayout title="Registrar Categoría">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                Registrar Categoría
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Registrar Categoría</h1>

                        <form @submit.prevent="submit" novalidate>
                            <div class="mb-4">
                                <InputLabel for="nombre" value="Nombre" class="bb" />
                                <InputError :message="errors.nombre" />
                                <TextInput
                                    v-model="form.nombre"
                                    id="nombre"
                                    class="mt-1 block w-full bg-pink-100 text-pink-600 border border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                                    placeholder="Ingrese el nombre de la categoría"
                                    required
                                    @input="validateForm"
                                />
                                <div v-if="!validateNombre() && form.nombre.length > 0" class="text-red-500 text-sm dd">
                                    * El nombre debe tener entre 4 y 50 caracteres.
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <Link href="{{ route('categoria.index') }}" class="btn btn-outline-pink me-2">
                                    <i class="fas fa-arrow-left"></i> Atrás
                                </Link>

                                <PrimaryButton
                                    ref="submitButton"
                                    class="mt-4 btn btn-pink"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="!validateNombre() || form.processing"
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
.py-12 {
  margin-top: calc(60px + 1rem);
  margin-bottom: calc(60px + 1rem);
}

.text-pink-600 {
  color: #ec4899; /* Color rosado para el texto */
}

.text-pink-500 {
  color: #f472b6; /* Color rosado más suave para el texto */
}

.bg-pink-100 {
  background-color: #fce4ec; /* Fondo rosado muy suave */
}

.bg-pink-500 {
  background-color: #ec4899; /* Fondo rosado medio */
}

.border-pink-300 {
  border-color: #f472b6; /* Borde rosado suave */
}

.border-pink-500 {
  border-color: #ec4899; /* Borde rosado medio */
}


.focus:border-pink-500 {
  border-color: #ec4899; /* Borde rosado al enfocar */
}

/* Botones */
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

/* Botón rosado */
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

/* Botón rosado para borde solo */
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

/* Estilos para el campo de entrada */
input, select, textarea {
    background-color: #fce4ec;
    color: #ec4899;
}

input::placeholder, select::placeholder {
    color: #ec4899;
}

/* Texto de error */
.text-red-500 {
  color: #ef4444; /* Rojo fuerte para mensajes de error */
}

.dd {
    margin-top: 0.5rem;
}

/* Estilo del título */
.text-pink-600 {
    color: #ec4899; /* Color rosado para el título */
}
</style>
