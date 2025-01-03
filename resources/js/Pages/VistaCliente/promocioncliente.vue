<template>
    <div class="p-8 bg-gray-50 min-h-screen">
      <!-- Título con tamaño más grande -->
      <h1 class="text-9xl font-semibold text-center text-pink-600 mb-12">Promociones del Salón de Belleza</h1>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <div 
          v-for="promocion in promociones" 
          :key="promocion.codPromocion" 
          class="promocion-item bg-pink-50 rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl hover:bg-pink-100"
        >
          <img 
            :src="`/storage/uploads/${promocion.imagen}`" 
            :alt="promocion.nombre" 
            class="w-full h-56 object-cover object-center transition-all duration-300 transform hover:scale-110"
          />
          <div class="p-6">
            <h3 class="text-xl font-medium text-gray-800 hover:text-pink-600 transition-all">{{ promocion.nombre }}</h3>
            <p class="text-gray-600 mt-2 mb-4">{{ promocion.descripcion }}</p>
            <p class="text-lg font-semibold text-pink-600">Precio: ${{ promocion.precioUnitario }}</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      promociones: Array,  // Recibe las promociones desde Inertia
    }
  }
  </script>
  
  <style scoped>
  /* Estilos personalizados si es necesario */
  </style>
  