<script setup>
import { ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import TextInput from '@/Components/TextInput.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
    servicios: Object
});

const showModal = ref(false);
const selectedServicio = ref(null);

const confirmDeleteServicio = (item) => {
    selectedServicio.value = item;
    showModal.value = true;
};

const deleteServicio = () => {
    if (selectedServicio.value) {
        router.delete(route('servicio.destroy', selectedServicio.value.codServicio));
        showModal.value = false;
    }
};
</script>

<template>
    <plantillanav :userName="$page.props.auth.user.name"/>
    <AppLayout title="Gestionar Servicio">
        <template #header>
            <h2 class="font-semibold text-xl text-pink-600 leading-tight">
                Lista de Servicios
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Lista de Servicios</h1>

                        <div class="flex justify-between items-center mb-6">
                            <Link :href="route('servicio.create')" class="btn btn-pink inline-flex items-center space-x-2">
                                <i class="fas fa-plus"></i>
                                <span>Registrar</span>
                            </Link>

                            <form :action="route('servicio.index')" method="get" class="flex space-x-2">
                                <div class="input-group">
                                    <select name="criterio" class="form-select">
                                        <option value="nombre">Nombre</option>
                                        <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" name="buscar" class="form-control" placeholder="Buscar" aria-label="Buscar" aria-describedby="button-addon2">
                                    <button type="submit" class="btn btn-outline-pink flex items-center space-x-2">
                                        <i class="fas fa-search"></i>
                                        <span>Buscar</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table-auto w-full text-sm bg-pink-50">
                                <thead class="bg-pink-100">
                                    <tr>
                                        <th class="p-3 text-left text-pink-600">Código de Servicio</th>
                                        <th class="p-3 text-left text-pink-600">Nombre</th>
                                        <th class="p-3 text-left text-pink-600">Descripción</th>
                                        <th class="p-3 text-left text-pink-600">Precio</th>
                                        <th class="p-3 text-center text-pink-600">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in props.servicios.data" :key="item.codServicio" class="border-b hover:bg-pink-200">
                                        <td class="p-3">{{ item.codServicio }}</td>
                                        <td class="p-3">{{ item.nombre }}</td>
                                        <td class="p-3">{{ item.descripcion }}</td>
                                        <td class="p-3">{{ item.precio }} Bs.</td>
                                        <td class="p-3 text-center">
                                            <Link :href="route('servicio.edit', item.codServicio)" class="btn btn-warning btn-sm mx-1">
                                                <i class="fas fa-edit"></i> Editar
                                            </Link>

                                            <button @click="confirmDeleteServicio(item)" class="btn btn-danger btn-sm mx-1">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-between mt-4">
                            <div v-if="props.servicios?.prev_page_url">
                                <Link :href="props.servicios?.prev_page_url" class="btn btn-pink">
                                    <i class="fas fa-arrow-left"></i> Anterior
                                </Link>
                            </div>
                            <div v-if="props.servicios?.next_page_url">
                                <Link :href="props.servicios?.next_page_url" class="btn btn-pink">
                                    Siguiente <i class="fas fa-arrow-right"></i>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <VisitaFooter />

        <DialogModal :show="showModal" @close="showModal = false">
            <template v-slot:title>
                <h1 class="text-lg font-semibold text-pink-600">Confirmar Eliminación</h1>
            </template>
            <template v-slot:content>
                <p>¿Estás seguro de que deseas eliminar el servicio <strong>{{ selectedServicio?.nombre }}</strong>?</p>
            </template>
            <template v-slot:footer>
                <PrimaryButton @click="deleteServicio" class="bg-pink-600 hover:bg-pink-800">Eliminar</PrimaryButton>
                <button @click="showModal = false" class="ml-4 btn btn-cancel">Cancelar</button>
            </template>
        </DialogModal>
    </AppLayout>
</template>
