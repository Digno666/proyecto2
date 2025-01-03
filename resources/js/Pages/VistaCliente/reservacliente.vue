<template>
 <plantillanavcliente :userName="$page.props.auth.user.name" />
  <div class="max-w-4xl mx-auto py-12">
   
    <h1 class="text-3xl font-bold text-center text-pink-600 mb-6">Reserva de Servicios</h1>

    <form @submit.prevent="submitReserva" class="space-y-6">
      <!-- Fecha y hora de la reserva -->
      <div>
        <label for="fechaReserva" class="bb">Fecha de Reserva</label>
        <input type="date" v-model="form.fechaReserva" required class="mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 cc"/>
      </div>

      <div>
        <label for="horaReserva" class="bb">Hora de Reserva</label>
        <input 
          id="horaReserva" 
          type="text" 
          v-model="form.horaReserva" 
          required 
          class="mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 cc"
        />
        <!-- Mostrar el mensaje de error si la hora ya está ocupada -->
        <!-- <div v-if="horaError" class="text-red-500 text-md mt-1 bb">
          La hora seleccionada no está disponible.
        </div> -->
      </div>
        <input type="hidden" v-model="form.codClienteF" placeholder="Código de cliente" required class="mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" />
        <div>
    <h3 class="text-2xl font-semibold mb-4 bb">Servicios Disponibles</h3>
    <div class="relative">
      <!-- Flecha izquierda -->
      <button @click.prevent="changeSlide(-1)" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-pink-600 text-white p-2 rounded-full shadow-lg hover:bg-pink-700 z-10">
        &lt;
      </button>

      <div class="flex overflow-hidden">
        <div class="flex transition-transform" :style="carouselStyle">
          <div v-for="(servicio, index) in servicios" :key="servicio.codServicio" class="card"> <!-- Usar 'card' en lugar de 'service-card' -->
            <div class="service-card-content p-6 text-center">
              <h4 class="text-xl font-semibold text-pink-600 mb-2">{{ servicio.nombre }}</h4>
              <p class="text-gray-600 mb-4">{{ servicio.descripcion }}</p>
              <p class="text-lg font-semibold text-pink-500">Bs.{{ servicio.precio }}</p>
              <button 
                :class="{'': form.servicios.includes(servicio.codServicio), '': !form.servicios.includes(servicio.codServicio)}"
                @click="toggleServicio(servicio.codServicio)"
                :disabled="form.servicios.includes(servicio.codServicio)"
                class="mt-4 w-full py-2 rounded-lg text-lg font-medium transition duration-300"
              >
                {{ form.servicios.includes(servicio.codServicio) ? 'Seleccionado' : 'Seleccionar' }}
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Flecha derecha -->
      <button @click.prevent="changeSlide(1)" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-pink-600 text-white p-2 rounded-full shadow-lg hover:bg-pink-700 z-10">
        &gt;
      </button>
    </div>
  </div>
      <!-- Promociones Disponibles -->
<div v-if="activePromociones.length > 0">
  <h3 class="text-2xl font-semibold mb-4 bb">Promociones Disponibles</h3>
  <div class="relative">
    <!-- Flecha izquierda -->
    <button @click.prevent="changeSlidePromociones(-1)" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-pink-600 text-white p-2 rounded-full shadow-lg hover:bg-pink-700 z-10">
      &lt;
    </button>

    <div class="flex overflow-hidden">
      <div class="flex transition-transform" :style="carouselStylePromociones">
        <div v-for="promocion in activePromociones" :key="promocion.codPromocion" class="card"> <!-- Aplicar clase 'card' -->
          <div class="service-card-content p-6 text-center flex flex-col justify-between h-full">
            <img :src="promocion.imagen" alt="Imagen de promoción" class="w-full h-48 object-cover mb-4 rounded-lg" />
            <h4 class="text-xl font-semibold text-pink-600 mb-2">{{ promocion.nombre }}</h4>
            <p class="text-lg font-semibold text-pink-500 mb-4">Bs.{{ promocion.precioUnitario }}</p>
            <button 
              :class="{'': form.promociones.includes(promocion.codPromocion), '': !form.promociones.includes(promocion.codPromocion)}"
              @click="togglePromocion(promocion.codPromocion)"
              :disabled="form.promociones.includes(promocion.codPromocion)"
              class="w-full py-2 rounded-lg text-lg font-medium transition duration-300"
            >
              {{ form.promociones.includes(promocion.codPromocion) ? 'Seleccionado' : 'Seleccionar' }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Flecha derecha -->
    <button @click.prevent="changeSlidePromociones(1)" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-pink-600 text-white p-2 rounded-full shadow-lg hover:bg-pink-700 z-10">
      &gt;
    </button>
  </div>
</div>



      <!-- Mensaje si no hay promociones -->
      <div v-else class="text-center text-lg font-semibold mt-6 bb">
        No hay promociones disponibles en este momento.
      </div>


      <!-- Tabla de servicios y promociones seleccionados -->
      <div class="mt-8">
        <h3 class="text-2xl font-semibold mb-4">Resumen de Selecciones</h3>
        <div class="overflow-x-auto">
        <table class="table-auto w-full text-sm bg-pink-50">
          <thead class="bg-pink-100">
            <tr class="">
              <th class="p-3 text-left text-pink-600">Nombre</th>
              <th class="p-3 text-left text-pink-600">Tipo</th>
              <th class="p-3 text-left text-pink-600">Precio</th>
              <th class="p-3 text-left text-pink-600">Opción</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="servicio in selectedServicios" :key="servicio.codServicio">
              <td class="p-3">{{ servicio.nombre }}</td>
              <td class="p-3">Servicio</td>
              <td class="p-3">Bs.{{ servicio.precio }}</td>
              <td class="p-3">
                <button @click="removeServicio(servicio.codServicio)" class="bg-pink-600 text-white py-2 px-4 rounded-full">Eliminar</button>
              </td>
            </tr>
            <tr v-for="promocion in selectedPromociones" :key="promocion.codPromocion">
              <td class="p-3">{{ promocion.nombre }}</td>
              <td class="p-3">Promoción</td>
              <td class="p-3">Bs.{{ promocion.precioUnitario }}</td>
              <td class="p-3">
                <button @click="removePromocion(promocion.codPromocion)" class="bg-red-600 text-white py-2 px-4 rounded-full">Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
        </div>
      </div>

      <!-- Mostrar el monto total -->
      <div class="mt-4 text-lg font-semibold text-pink-600">
        <p>Total: Bs.{{ montoTotal }}</p>
      </div>

      <div class="text-center">
        <button type="submit" class="w-full bg-pink-600 text-white py-3 rounded-lg text-xl font-semibold shadow-lg transition duration-300">Confirmar Reserva</button>
      </div>
    </form>
    <VisitaFooter />
  </div>
</template>

<script>
import plantillanavcliente from '@/Layouts/plantillanavcliente.vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';
import axios from 'axios';
export default {
  components: {
  plantillanavcliente,
  VisitaFooter,
},
props: {
  servicios: Array,
  promociones: Array, // Recibe las promociones desde el backend
},
data() {
  return {
    form: {
      fechaReserva: new Date().toISOString().split('T')[0],
      horaReserva: '',
      codClienteF: '',
      codTrabajadorF: '',
      codPagoF: '',
      servicios: [],
      promociones: [],
    },
    horaError: false,
    currentIndex: 0,
    itemsPerSlide: 3,
    currentIndexPromociones: 0, // Número de servicios que quieres mostrar por cada desplazamiento
  };
},
mounted() {
  flatpickr("#horaReserva", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",  // Formato de hora de 24 horas (sin fecha)
    minDate: "09:00",    // Hora mínima permitida (9:00 AM)
    maxDate: "19:00",    // Hora máxima permitida (7:00 PM)
    disable: [
      { from: "12:00", to: "13:59" },  // Bloquea el rango de 12:00 PM a 13:59 PM
    ],
  });
},
computed: {
  carouselStylePromociones() {
    return {
      transform: `translateX(-${this.currentIndexPromociones * (100 / this.itemsPerSlide)}%)`,
      transition: 'transform 0.3s ease',
    };
  },
  activePromociones() {
    // Filtra las promociones para mostrar solo las activas
    return this.promociones.filter(promocion => promocion.estActivo === true);
  },
  carouselStyle() {
    return {
      transform: `translateX(-${this.currentIndex * (100 / this.itemsPerSlide)}%)`,
      transition: 'transform 0.3s ease',
    };
  },
  selectedServicios() {
    return this.servicios.filter(servicio => this.form.servicios.includes(servicio.codServicio));
  },
  selectedPromociones() {
    return this.promociones.filter(promocion => this.form.promociones.includes(promocion.codPromocion));
  },
  montoTotal() {
    // Suma de los precios de los servicios y promociones seleccionadas
    const totalServicios = this.selectedServicios.reduce((total, servicio) => total + parseFloat(servicio.precio), 0);
    const totalPromociones = this.selectedPromociones.reduce((total, promocion) => total + parseFloat(promocion.precioUnitario), 0);
    const total = totalServicios + totalPromociones;
    
    // Devuelve el total formateado con dos decimales
    return total.toFixed(2);
  },
  activePromociones() {
      // Filtra las promociones para mostrar solo las activas
      return this.promociones.filter(promocion => promocion.estActivo === true);
  },
},
methods: {
  changeSlidePromociones(direction) {
    const totalItems = this.promociones.length;
    const maxIndex = Math.ceil(totalItems / this.itemsPerSlide) - 1;

    this.currentIndexPromociones = (this.currentIndexPromociones + direction) % (maxIndex + 1);
    if (this.currentIndexPromociones < 0) {
      this.currentIndexPromociones = maxIndex;
    }
  },
  toggleServicio(codServicio) {
    if (!this.form.servicios.includes(codServicio)) {
      this.form.servicios.push(codServicio);
    }
  },
  togglePromocion(codPromocion) {
    if (!this.form.promociones.includes(codPromocion)) {
      this.form.promociones.push(codPromocion);
    } else {
      const index = this.form.promociones.indexOf(codPromocion);
      if (index > -1) {
        this.form.promociones.splice(index, 1);
      }
    }
  },

  removeServicio(codServicio) {
    const index = this.form.servicios.indexOf(codServicio);
    if (index > -1) {
      this.form.servicios.splice(index, 1);
    }
  },
  removePromocion(codPromocion) {
    const index = this.form.promociones.indexOf(codPromocion);
    if (index > -1) {
      this.form.promociones.splice(index, 1);
    }
  },
  changeSlide(direction) {
    const totalItems = this.servicios.length;
    const maxIndex = Math.ceil(totalItems / this.itemsPerSlide) - 1;

    this.currentIndex = (this.currentIndex + direction) % (maxIndex + 1);
    if (this.currentIndex < 0) {
      this.currentIndex = maxIndex;
    }
  },
  async checkHoraDisponibilidad() {
  try {
    // Realizamos la solicitud al backend para verificar si la hora está disponible
    const response = await axios.post('/api/check-hora', {
      fechaReserva: this.form.fechaReserva,
      horaReserva: this.form.horaReserva,
    });

    // Verificar si la respuesta tiene la propiedad 'ocupada'
    this.horaError = response.data.ocupada; // Suponiendo que el backend te devuelve un objeto con la propiedad 'ocupada'
  } catch (error) {
    console.error('Error al verificar la disponibilidad de la hora:', error);
    alert('Hubo un error al verificar la disponibilidad de la hora.');
  }
},
    async submitReserva() {
      // Código para enviar la reserva al backend
      const totalServicios = this.selectedServicios.reduce((total, servicio) => total + parseFloat(servicio.precio), 0);
      const totalPromociones = this.selectedPromociones.reduce((total, promocion) => total + parseFloat(promocion.precioUnitario), 0);
      const montoTotal = (totalServicios + totalPromociones).toFixed(2);
      const porcentajePago = (parseFloat(montoTotal) * 0.20).toFixed(2);

      try {
        const response = await axios.post(route('reserva-cliente.store'), {
          fechaReserva: this.form.fechaReserva,
          horaReserva: this.form.horaReserva,
          montoTotal: montoTotal,
          codClienteF: this.form.codClienteF,
          codTrabajadorF: this.form.codTrabajadorF,
          codPagoF: this.form.codPagoF,
          servicios: this.form.servicios,
          promociones: this.form.promociones,
        });

        // Redirigir al controlador de pago
        this.$inertia.visit(this.route('pago'), {
          method: 'get',
          data: {
            codReserva: response.data.codReserva,
            mensaje: 'Reserva confirmada correctamente',
            codUsuario: this.form.codClienteF,
            name: response.data.name,
            porcentajePago: porcentajePago,
          }
        });
      } catch (error) {
        console.error('Error al crear la reserva:', error);
        alert('Hubo un error al registrar la reserva.');
      }
    },
},
};

</script>

<style scoped>
.card {
  width: 290px; 
  height: 430px; 
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: transform 0.3s ease, box-shadow 0.3s ease;/* Ajuste para hacer las cards más altas */
}
.card img {
  width: 100%;
  height: 120px;
  object-fit: cover;
  border-radius: 8px;
}

.bb {
    color: #ec4899; /* Rosa fuerte */
}

.cc {
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
button {
  transition: background-color 0.3s, transform 0.3s;
}
.py-12 {
margin-top: calc(60px + 1rem); 
margin-bottom: calc(60px + 1rem); 
}
</style>
