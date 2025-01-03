<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps(['servicio', 'errors']);

const form = useForm({
    nombre: props.servicio?.nombre || '',
    descripcion: props.servicio?.descripcion || '',
    precio: props.servicio?.precio || '', // Añadido el campo precio
});

const submit = () => {
    form.put(route('servicio.update', props.servicio.codServicio));
};

const validateNombre = () => {
    return form.nombre.length > 2 && form.nombre.length < 151;
};

const validateDescripcion = () => {
    return form.descripcion.trim() !== '';
};

const validatePrecio = () => {
    return form.precio > 0; // Validación para asegurar que el precio es mayor a 0
};
</script>

<template>
     <!-- Barra lateral -->
     <plantillanav :userName="$page.props.auth.user.name"/>
    <AppLayout title="Modificar Servicio">
        <template #header>
            <h2 class="font-semibold text-xl text-pink-600 leading-tight">
                Editar Servicio
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Editar Servicio</h1>

                        <div v-if="form.errors" class="alert alert-danger">
                            <ul>
                                <li v-for="(error, index) in form.errors" :key="index">{{ error }}</li>
                            </ul>
                        </div>

                        <form @submit.prevent="submit" novalidate>
                            <div class="mb-4">
                                <InputLabel for="nombre" value="Nombre" class="bb" />
                                <InputError :message="form.errors.nombre" />
                                <input 
                                    v-model="form.nombre"
                                    type="text" 
                                    id="nombre" 
                                    class="mt-1 block w-full cc border-2 border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                                    placeholder="Ingrese el nombre del servicio"
                                    required 
                                    @input="validateForm"
                                />
                                <div v-if="!validateNombre() && form.nombre.length > 0" class="text-red-500 text-sm dd">
                                    * El nombre debe tener entre 3 y 150 caracteres.
                                </div>
                            </div>

                            <div class="mb-4">
                                <InputLabel for="descripcion" value="Descripción" class="bb" />
                                <InputError :message="form.errors.descripcion" />
                                <textarea 
                                    v-model="form.descripcion"
                                    id="descripcion"
                                    class="mt-1 block w-full cc border-2 border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                                    placeholder="Ingrese la descripción del servicio"
                                    required
                                ></textarea>
                                <div v-if="!validateDescripcion() && form.descripcion.length > 0" class="text-red-500 text-sm dd">
                                    * La descripción no puede estar vacía.
                                </div>
                            </div>

                            <!-- Campo para Precio -->
                            <div class="mb-4">
                                <InputLabel for="precio" value="Precio" class="bb" />
                                <InputError :message="form.errors.precio" />
                                <input 
                                    v-model="form.precio"
                                    type="number" 
                                    id="precio" 
                                    class="mt-1 block w-full cc border-2 border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                                    placeholder="Ingrese el precio del servicio"
                                    required 
                                    min="0.01" 
                                    step="0.01"
                                />
                                <div v-if="!validatePrecio() && form.precio > 0" class="text-red-500 text-sm dd">
                                    * El precio debe ser mayor a 0.
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <Link 
                                    :href=" route('servicio.index')" 
                                    class="btn btn-secondary me-3 bg-pink-600 hover:bg-pink-800 text-white"
                                >
                                    <i class="fas fa-arrow-left"></i> Atrás
                                </Link>
                                <PrimaryButton
                                    type="submit"
                                    :disabled="!validateNombre() || !validateDescripcion() || !validatePrecio() || form.processing"
                                    class="btn btn-primary bg-pink-600 hover:bg-pink-800"
                                >
                                    <i class="fas fa-pencil-alt"></i> Modificar
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>'
        <VisitaFooter />'
    </AppLayout>
</template>

<style scoped>
.py-12 {
  margin-top: calc(60px + 1rem); 
  margin-bottom: calc(60px + 1rem); 
}

/* Estilos personalizados para los campos */
.cc {
    border-color: #f9a8d4; /* Rosa suave para bordes de los inputs */
    background-color: #fff; /* Fondo blanco para inputs */
}

.cc:focus {
    border-color: #ec4899; /* Rosa fuerte al enfocarse */
    box-shadow: 0 0 0 1px #ec4899; /* Efecto de sombra rosada al enfocar */
}

.bb {
    font-weight: bold;
    color: #ec4899; /* Color rosa fuerte para las etiquetas */
}

/* Estilo para el botón "Modificar" */
.btn-primary {
    background-color: #f9a8d4; /* Rosa claro */
    border-color: #f9a8d4;
    color: #fff;
}

.btn-primary:hover {
    background-color: #ec4899; /* Rosa fuerte */
    border-color: #ec4899;
}

.btn-secondary {
    background-color: #f9a8d4; /* Rosa claro */
    border-color: #f9a8d4;
    color: #fff;
}

.btn-secondary:hover {
    background-color: #ec4899; /* Rosa fuerte */
    border-color: #ec4899;
}

.text-pink-600 {
    color: #ec4899; /* Rosa fuerte para textos */
}

.text-pink-500 {
    color: #ec4899; /* Rosa más suave para los textos al hacer foco */
}

.text-red-500 {
    color: #ef4444; /* Rojo para los mensajes de error */
}

.dd {
    margin-top: 4px;
}

</style>
