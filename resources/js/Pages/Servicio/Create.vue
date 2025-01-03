<script setup>
import { ref, watch, computed } from 'vue';
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
    descripcion: '',
    precio: '',
});

const submitButton = ref(null);

const validateNombre = () => {
    const nombre = form.nombre.trim();
    return nombre.length >= 3 && nombre.length <= 150;
};

const validateDescripcion = () => {
    return form.descripcion.trim().length > 0;
};

const validatePrecio = () => {
    return form.precio > 0;
};

const isFormValid = computed(() => {
    return validateNombre() && validateDescripcion() && validatePrecio();
});

watch(isFormValid, () => {
    if (submitButton.value) {
        submitButton.value.disabled = !isFormValid.value;
    }
});

const submit = () => {
    form.post(route('servicio.store'), {
        onSuccess: () => {
            router.get(route('servicio.index'));
        },
    });
};
</script>

<template>
    <plantillanav :userName="$page.props.auth.user.name"/>
    <AppLayout title="Registrar Servicio">
        <template #header>
            <h2 class="font-semibold text-xl text-pink-600 leading-tight">
                Registrar Servicio
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Registrar Servicio</h1>
                        <form @submit.prevent="submit" novalidate>
                            <div class="mb-4">
                                <InputLabel for="nombre" value="Nombre" class="bb" />
                                <InputError :message="errors.nombre" />
                                <TextInput 
                                    v-model="form.nombre"
                                    id="nombre"
                                    class="mt-1 block w-full cc"
                                    placeholder="Ingrese el nombre del servicio"
                                    required
                                />
                                <div v-if="!validateNombre() && form.nombre.length > 0" class="text-red-500 text-sm dd">
                                    * El nombre debe tener entre 3 y 150 caracteres.
                                </div>
                            </div>

                            <div class="mb-4">
                                <InputLabel for="descripcion" value="Descripción" class="bb" />
                                <InputError :message="errors.descripcion" />
                                <textarea
                                    v-model="form.descripcion"
                                    id="descripcion"
                                    class="mt-1 block w-full cc"
                                    placeholder="Ingrese la descripción del servicio"
                                    rows="3"
                                    required
                                ></textarea>
                                <div v-if="!validateDescripcion() && form.descripcion.length > 0" class="text-red-500 text-sm dd">
                                    * La descripción es obligatoria.
                                </div>
                            </div>

                            <!-- Nuevo campo para el precio -->
                            <div class="mb-4">
                                <InputLabel for="precio" value="Precio" class="bb" />
                                <InputError :message="errors.precio" />
                                <TextInput 
                                    v-model="form.precio"
                                    id="precio"
                                    type="number"
                                    class="mt-1 block w-full cc"
                                    placeholder="Ingrese el precio del servicio"
                                    required
                                />
                                <div v-if="!validatePrecio() && form.precio.length > 0" class="text-red-500 text-sm dd">
                                    * El precio debe ser mayor que 0.
                                </div>
                            </div>

                            <div class="text-center">
                                <Link href="{{ route('servicio.index') }}" class="btn btn-secondary me-3">
                                    <i class="fas fa-arrow-left"></i> Atrás
                                </Link>

                                <PrimaryButton 
                                    ref="submitButton"
                                    class="mt-4 btn-primary"
                                    :disabled="!isFormValid || form.processing"
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

.bb {
    color: #ec4899; /* Rosa fuerte */
}

.cc {
    border-color: #f9a8d4; /* Rosa claro */
}

.ee {
    border-color: #f9a8d4; /* Rosa claro */
}

.text-pink-600 {
    color: #ec4899; /* Rosa fuerte */
}

.text-red-500 {
    color: #f87171; /* Rojo para mensajes de error */
}

.text-sm {
    font-size: 0.875rem; /* Tamaño pequeño para los mensajes de error */
}

.btn-primary {
    background-color: #f9a8d4; /* Rosa claro */
    border-color: #f9a8d4;
    color: #fff;
}

.btn-primary:hover {
    background-color: #ec4899; /* Rosa fuerte */
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
}
input, textarea {
    background-color: #fce7f3; /* Fondo rosado muy suave */
    color: #ec4899; /* Texto negro para contraste */
    border-radius: 0.375rem; /* Bordes redondeados para un diseño más moderno */
}
</style>
