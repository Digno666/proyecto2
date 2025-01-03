<script setup>
import { ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import TextInput from '@/Components/TextInput.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';

const props = defineProps({
    usuarios: Object 
});

const showModal = ref(false);
const selectedUsuario = ref(null);

const confirmDeleteUsuario = (item) => {
    selectedUsuario.value = item;
    showModal.value = true;
};

const deleteUsuario = () => {
    if (selectedUsuario.value) {
        router.delete(route('usuario.destroy', selectedUsuario.value.codUsuario));
        showModal.value = false;
    }
};

const searchTerm = ref('');
const searchCriteria = ref('');

const handleSearch = () => {
    const queryParams = new URLSearchParams();
    if (searchTerm.value) {
        queryParams.append('buscar', searchTerm.value);
    }
    if (searchCriteria.value) {
        queryParams.append('criterio', searchCriteria.value);
    }
    window.location.href = `${route('usuario.index')}?${queryParams.toString()}`;
};
</script>

<template>
    <plantillanav/>
    <AppLayout title="Gestionar Usuarios">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lista de Usuarios
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                    <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                        <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Lista de Usuarios</h1>

                        <div class="flex justify-between items-center mb-6">
        
                            <Link :href="route('usuario.create')" class="btn btn-pink inline-flex items-center space-x-2">
                                <i class="fas fa-user-plus"></i>
                                <span>Registrar</span>
                            </Link>

                            <form @submit.prevent="handleSearch" class="flex space-x-2">
                                <select v-model="searchCriteria" class="form-select">
                                    <option value="" disabled selected>Seleccionar criterio</option>
                                    <option value="name">Nombre</option>
                                    <option value="codTipoUsuarioF">Tipo de Usuario</option>
                                </select>
                                <TextInput v-model="searchTerm" class="w-full" placeholder="Buscar usuario" />
                                <button type="submit" class="btn btn-outline-pink flex items-center space-x-2">
                                    <i class="fas fa-search"></i>
                                    <span>Buscar</span>
                                </button>
                            </form>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table-auto w-full text-sm bg-pink-50">
                                <thead>
                                    <tr class="bg-pink-100">
                                        <th class="p-3 text-left text-pink-600">Código de Usuario</th>
                                        <th class="p-3 text-left text-pink-600">Nombre</th>
                                        <th class="p-3 text-left text-pink-600">Email</th>
                                        <th class="p-3 text-left text-pink-600">Contraseña</th>
                                        <th class="p-3 text-left text-pink-600">Tipo de Usuario</th>
                                        <th class="p-3 text-center text-pink-600">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="usuario in usuarios.data" :key="usuario.codUsuario" class="border-b hover:bg-pink-200">
                                        <td class="p-3">{{ usuario.codUsuario }}</td>
                                        <td class="p-3">{{ usuario.name }}</td>
                                        <td class="p-3">{{ usuario.email }}</td>
                                        <td class="p-3">********</td>
                                        <td class="p-3">{{ usuario.codTipoUsuarioF }}</td>

                                        <td class="p-3 text-center">
                                            <Link :href="route('usuario.edit', usuario.codUsuario)" class="btn btn-warning btn-sm mx-1">
                                                <i class="fas fa-edit"></i> Editar
                                            </Link>

                                            <button @click="confirmDeleteUsuario(usuario)" class="btn btn-danger btn-sm mx-1">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-between mt-4">
                            <div v-if="usuarios?.prev_page_url">
                                <Link :href="usuarios?.prev_page_url" class="btn btn-pink">
                                    <i class="fas fa-arrow-left"></i> Anterior
                                </Link>
                            </div>
                            <div v-if="usuarios?.next_page_url">
                                <Link :href="usuarios?.next_page_url" class="btn btn-pink">
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
                <p>¿Estás seguro de que deseas eliminar el usuario <strong>{{ selectedUsuario?.name }}</strong>?</p> 
            </template>
            <template v-slot:footer>
                <PrimaryButton @click="deleteUsuario" class="bg-pink-600 hover:bg-pink-800">Eliminar</PrimaryButton>
                <button @click="showModal = false" class="ml-4 btn btn-secondary">Cancelar</button>
            </template>
        </DialogModal>
    </AppLayout>
</template>
