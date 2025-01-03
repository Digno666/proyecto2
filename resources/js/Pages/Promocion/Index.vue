<template>
      <plantillanav :userName="$page.props.auth.user.name"/>
      <div :class="`transition-all duration-300 ${isOpen ? 'ml-64' : 'ml-0'}`" class="flex-1">
        <AppLayout title="Gestionar Promociones">
          <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Lista de Promociones
            </h2>
          </template>
  
          <div class="py-12">
            <!-- Aquí va el contenido de la página (la tabla y demás) -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
                <div class="p-6 lg:p-8 border-gray-200 divpequeno">
                  <h1 class="text-2xl font-bold text-center mb-6 text-pink-600">Lista de Promociones</h1>
  
                  <div class="flex justify-between items-center mb-6">
                    <Link :href="route('promocion.create')" class="btn btn-pink inline-flex items-center space-x-2">
                      <i class="fas fa-plus"></i>
                      <span>Registrar</span>
                    </Link>
  
                    <form :action="route('promocion.index')" method="get" class="flex space-x-2">
                      <TextInput class="w-full" name="buscar" placeholder="Buscar promoción" />
                      <button type="submit" class="btn btn-outline-pink flex items-center space-x-2">
                        <i class="fas fa-search"></i>
                        <span>Buscar</span>
                      </button>
                    </form>
                  </div>
  
                  <!-- La tabla y demás contenido -->
                  <div class="overflow-x-auto">
                    <table class="table-auto w-full text-sm bg-pink-50">
                      <thead>
                        <tr class="bg-pink-100">
                          <th class="p-3 text-left text-pink-600">Código de Promoción</th>
                          <th class="p-3 text-left text-pink-600">Nombre</th>
                          <th class="p-3 text-left text-pink-600">Descripción</th>
                          <th class="p-3 text-left text-pink-600">Imagen</th>
                          <th class="p-3 text-left text-pink-600">Precio Unitario</th>
                          <th class="p-3 text-center text-pink-600">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="item in promociones.data" :key="item.codPromocion" class="border-b hover:bg-pink-200">
                          <td class="p-3">{{ item.codPromocion }}</td>
                          <td class="p-3">{{ item.nombre }}</td>
                          <td class="p-3">{{ item.descripcion }}</td>
                          <td class="p-3">
                            <img v-if="item.imagen" :src="`/storage/uploads/${item.imagen}`" alt="Imagen del producto" class="img-thumbnail" style="max-width: 120px;" />
                            <span v-else>No tiene imagen</span>
                          </td>
                          <td class="p-3">
                            <span v-if="item.precioUnitario">{{ item.precioUnitario | currency }} Bs.</span>
                            <span v-else>No disponible</span>
                          </td>
                          <td class="p-3 text-center">
                            <Link :href="route('promocion.edit', item.codPromocion)" class="btn btn-warning btn-sm mx-1">
                              <i class="fas fa-edit"></i> Editar
                            </Link>
  
                            <button @click="confirmDeletePromocion(item)" class="btn btn-danger btn-sm mx-1">
                              <i class="fas fa-trash"></i> Eliminar
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
  
                  <div class="flex justify-between mt-4">
                    <div v-if="promociones?.prev_page_url">
                      <Link :href="promociones?.prev_page_url" class="btn btn-pink">
                        <i class="fas fa-arrow-left"></i> Anterior
                      </Link>
                    </div>
                    <div v-if="promociones?.next_page_url">
                      <Link :href="promociones?.next_page_url" class="btn btn-pink">
                        Siguiente <i class="fas fa-arrow-right"></i>
                      </Link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <VisitaFooter />
        </AppLayout>
      </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { router, Link } from '@inertiajs/vue3';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import DialogModal from '@/Components/DialogModal.vue';
  import TextInput from '@/Components/TextInput.vue';
  import plantillanav from '@/Layouts/plantillanav.vue';
  import VisitaFooter from '@/Components/VisitaFooter.vue';
  
  const props = defineProps({
    promociones: Object
  });
  
  const showModal = ref(false);
  const selectedPromocion = ref(null);
  
  const confirmDeletePromocion = (item) => {
    selectedPromocion.value = item;
    showModal.value = true;
  };
  
  const deletePromocion = () => {
    if (selectedPromocion.value) {
      router.delete(route('promocion.destroy', selectedPromocion.value.codPromocion));
      showModal.value = false;
    }
  };
  </script>
