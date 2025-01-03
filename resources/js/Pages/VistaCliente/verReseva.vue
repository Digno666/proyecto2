<template>
    <div class="max-w-4xl mx-auto py-12">
      <plantillanavcliente :userName="$page.props.auth.user.name" />
  
      <h1 class="text-3xl font-bold text-center text-pink-600 mb-6">Mis Reservas</h1>
  
      <!-- Verificar si el cliente tiene reservas -->
      <div v-if="reservasLocal.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  <div v-for="reserva in reservasLocal" :key="reserva.codReserva" :class="{'bg-gray-100': isReservaExpirada(reserva)}">
    <!-- Aplicar la clase .card para estilizar el contenedor de cada reserva -->
    <div class="card">
      <div class="p-6">
        <h3 class="text-xl font-semibold text-pink-600 mb-4">
          Reserva para el {{ reserva.fechaReserva }}
          <span v-if="isReservaExpirada(reserva)" class="text-red-600 font-bold">(Expirada)</span>
          <span v-if="reserva.estado == 'cancelado'" class="text-red-600 font-bold">(Cancelada)</span>
        </h3>

        <div v-if="reserva.estado !== 'cancelado'">
          <div class="mb-4">
            <h4 class="font-semibold bb">Hora:</h4>
            <p class="text-gray-600">{{ reserva.horaReserva }}</p>
          </div>

          <div class="mb-4">
            <h4 class="font-semibold bb">Servicios:</h4>
            <ul class="list-disc pl-5 bb">
              <li v-for="servicio in reserva.servicios" :key="servicio.codServicio">
                {{ servicio.nombre }} - Bs.{{ servicio.precio }}
              </li>
            </ul>
          </div>

          <!-- Solo mostrar el título de promociones si existen promociones -->
          <div v-if="reserva.promociones && reserva.promociones.length > 0" class="mb-4">
            <h4 class="font-semibold bb">Promociones:</h4>
            <ul class="list-disc pl-5 bb">
              <li v-for="promocion in reserva.promociones" :key="promocion.codPromocion">
                {{ promocion.nombre }} - Bs.{{ promocion.precioUnitario }}
              </li>
            </ul>
          </div>

          <div class="mt-4">
            <h4 class="font-semibold bb">Total:</h4>
            <p class="text-pink-600 font-bold">Bs.{{ reserva.montoTotal }}</p>
          </div>

          <!-- Botón para cancelar la reserva -->
          <div v-if="!isReservaExpirada(reserva)" class="mt-4 text-center">
            <button 
              @click="openModal(reserva.codReserva)" 
              class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700">
              Cancelar Reserva
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  
      <!-- Mensaje si no hay reservas -->
      <div v-else class="text-center text-lg font-semibold mt-6 bb">
        No tienes reservas realizadas.
      </div>
  
      <!-- Modal de confirmación -->
      <div v-if="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
          <h3 class="text-xl font-semibold text-center text-pink-600 mb-4">¿Estás seguro de que deseas cancelar esta reserva?</h3>
          <div class="flex justify-between">
            <button 
              @click="cancelarReserva(codReservaSeleccionada)" 
              class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700">
              Sí, Cancelar
            </button>
            <button 
              @click="closeModal" 
              class="px-4 py-2 bg-gray-300 text-gray-800 font-semibold rounded-lg hover:bg-gray-400">
              No, Cancelar
            </button>
          </div>
        </div>
      </div>
  
      <!-- Modal de confirmación de cancelación exitosa -->
      <div v-if="showCancelSuccessModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
          <h3 class="text-xl font-semibold text-center text-pink-600 mb-4">¡Reserva Cancelada Exitosamente!</h3>
          <div class="flex justify-center">
            <button 
              @click="closeCancelSuccessModal" 
              class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700">
              Ok
            </button>
          </div>
        </div>
      </div>
      
    </div>
  </template>  
  
  <script>
  import plantillanavcliente from '@/Layouts/plantillanavcliente.vue';
  import VisitaFooter from '@/Components/VisitaFooter.vue';
  export default {
    components: {
      plantillanavcliente,
      VisitaFooter,
    },
    props: {
      reservas: Array, // Recibe las reservas desde el backend
    },
    data() {
      return {
        showModal: false,  // Para controlar la visibilidad del modal
        showCancelSuccessModal: false,  // Para mostrar el modal de cancelación exitosa
        codReservaSeleccionada: null,  // Para guardar el código de la reserva seleccionada
        reservasLocal: JSON.parse(JSON.stringify(this.reservas)),  // Copia local de las reservas
      };
    },
    methods: {
      // Función para abrir el modal
      openModal(codReserva) {
        this.showModal = true;
        this.codReservaSeleccionada = codReserva;
      },
      // Función para cerrar el modal
      closeModal() {
        this.showModal = false;
        this.codReservaSeleccionada = null;
      },
      // Función para cerrar el modal de confirmación de cancelación exitosa
      closeCancelSuccessModal() {
        this.showCancelSuccessModal = false;
      },
      // Función para cancelar la reserva
      async cancelarReserva(codReserva) {
        try {
          // Realizar la solicitud al backend para cancelar la reserva
          const response = await axios.post(`/cancelar-reserva/${codReserva}`);
          if (response.data.success) {
            // Si la cancelación es exitosa, actualizar la lista de reservas local
            const reservaCancelada = this.reservasLocal.find(reserva => reserva.codReserva === codReserva);
            if (reservaCancelada) {
              reservaCancelada.cancelada = true; // Marcar la reserva como cancelada
            }
            // Cerrar el modal de cancelación
            this.closeModal();
            // Mostrar el modal de confirmación de cancelación exitosa
            this.showCancelSuccessModal = true;
          } else {
            alert("Hubo un error al intentar cancelar la reserva. Intenta nuevamente.");
          }
        } catch (error) {
          console.error("Error al cancelar la reserva:", error);
          alert("Hubo un error al cancelar la reserva.");
        }
      },
      // Método para verificar si la reserva ha expirado
      isReservaExpirada(reserva) {
        const fechaReserva = new Date(`${reserva.fechaReserva} ${reserva.horaReserva}`);
        const fechaActual = new Date();
        // Si la fecha y hora de la reserva son anteriores a la actual, la reserva ha expirado
        return fechaReserva < fechaActual;
      },
    },
  };
  </script>
  
  <style scoped>
  /* Estilo para los cards */
  
  .py-12 {
    margin-top: calc(60px + 1rem);
    margin-bottom: calc(60px + 1rem);
  }
  
  </style>
  