<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps(['tipoUsuario', 'errors']);
const form = useForm({
    descripcion: props.tipoUsuario?.descripcion || '',
});

const submit = () => {
    form.put(route('tipoUsuario.update', props.tipoUsuario.codTipoUsuario));
};

const validateDescripcion = () => {
    return form.descripcion.length > 2 && form.descripcion.length < 21;
};
</script>

<template>
    <!-- <plantillanav :userName="$page.props.auth.user.name" /> -->
      <!-- Barra lateral -->
      <plantillanav />
    <AppLayout title="Modificar Tipo de Usuario">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Tipo de Usuario
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <!-- Título principal -->
                        <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Editar Tipo de Usuario</h1>

                        <!-- Alerta de éxito -->
                        <div v-if="form.errors.success" class="alert alert-success">
                            {{ form.errors.success }}
                        </div>

                        <!-- Errores de validación -->
                        <div v-if="form.errors.descripcion" class="alert alert-danger text-pink-600">
                            {{ form.errors.descripcion }}
                        </div>

                        <!-- Formulario -->
                        <form @submit.prevent="submit" novalidate>
                            <div class="mb-4">
                                <InputLabel for="descripcion" value="Descripción" class="text-pink-600" />
                                <InputError :message="form.errors.descripcion" />
                                <TextInput
                                    v-model="form.descripcion"
                                    type="text"
                                    id="descripcion"
                                    class="mt-1 block w-full border border-pink-500 focus:ring-pink-500 focus:border-pink-500"
                                    placeholder="Ingrese la descripción del tipo de usuario"
                                    required
                                    @input="validateForm"
                                />
                            </div>

                            <!-- Botones -->
                            <div class="text-center mt-4">
                                <Link 
                                    :href="route('tipoUsuario.index')" 
                                    class="btn btn-outline-pink me-3"
                                >
                                    <i class="fas fa-arrow-left"></i> Atrás
                                </Link>
                                <PrimaryButton
                                    type="submit"
                                    :disabled="!validateDescripcion() || form.processing"
                                    class="btn btn-pink-600 hover:bg-pink-700 text-white"
                                >
                                    <i class="fas fa-pencil-alt"></i> Guardar
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
}

/* Estilos para los botones rosados */
.btn-outline-pink {
    border: 1px solid #f472b6;
    color: #f472b6;
}

.btn-outline-pink:hover {
    background-color: #f472b6;
    color: white;
}

.btn-pink-600 {
    background-color: #f472b6;
}

.btn-pink-600:hover {
    background-color: #ec4899;
}

/* Estilos para el campo de texto rosado */
input, textarea {
    border-color: #f472b6;
}

input:focus, textarea:focus {
    border-color: #ec4899;
    box-shadow: 0 0 0 1px #ec4899;
}

/* Estilo para los textos y etiquetas rosados */
.text-pink-600 {
    color: #f472b6;
}

.text-pink-600:hover {
    color: #ec4899;
}

/* Estilo para los mensajes de error */
.text-pink-600 {
    color: #f472b6;
}
</style>
