<template>
  <plantillanav :userName="$page.props.auth.user.name"/>
  <div v-if="stats" class="container mx-auto p-6 space-y-8">
    
    <!-- Título de la Página y Bienvenida -->
    <h1 class="text-3xl font-semibold text-center bb">Estadísticas de Visitas</h1>
    <div class="text-center mt-4">
      <h1 class="text-2xl font-semibold">Bienvenido, Propietario</h1>
      <p class="text-lg">Estamos encantados de tenerte aquí.</p>
    </div>

    <!-- Estadísticas Generales - Cards en una fila -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
      
      <!-- Total de Visitas -->
      <div class="card p-6 bg-green-100 shadow-lg rounded-lg border border-green-300 hover:shadow-xl transition duration-300 ease-in-out">
        <h2 class="font-medium text-xl text-green-600 mb-3">Total de Visitas</h2>
        <p class="text-green-600">Total de visitas: <span class="font-semibold text-green-900">{{ stats.totalVisits }}</span></p>
      </div>

      <!-- Página Más Visitada -->
      <div class="card p-6 bg-blue-100 shadow-lg rounded-lg border border-blue-300 hover:shadow-xl transition duration-300 ease-in-out">
        <h2 class="font-medium text-xl text-blue-600 mb-3">Página Más Visitada</h2>
        <p class="text-blue-600">Página: <span class="font-semibold text-blue-900">{{ stats.mostVisitedPage.nombrePagina }}</span></p>
        <p class="text-blue-600">Visitas: <span class="font-semibold text-blue-700">{{ stats.mostVisitedPage.conteoVisitas }}</span></p>
      </div>

      <!-- Gráfico de Páginas Más Visitadas -->
      <div class="card p-6 bg-indigo-100 shadow-lg rounded-lg border border-indigo-300 hover:shadow-xl transition duration-300 ease-in-out">
        <h2 class="font-medium text-xl text-indigo-600 mb-3">Páginas Más Visitadas</h2>
        <canvas ref="chartRef" id="topVisitedPagesChart" class="w-full h-40"></canvas>
      </div>

    </div>

  </div>
  <VisitaFooter />
</template>

<script>
import { ref, onMounted } from 'vue';
import VisitaFooter from '@/Components/VisitaFooter.vue';
import plantillanav from '@/Layouts/plantillanav.vue';
export default {
  components: {
    plantillanav,
    VisitaFooter,
  },
  props: {
    stats: Object,
  },
  setup(props) {
    const chartRef = ref(null);

    onMounted(() => {
      // Verifica que los datos estén disponibles antes de crear el gráfico
      if (chartRef.value && props.stats.topVisitedPages) {
        const ctx = chartRef.value.getContext('2d');
        const chartData = {
          labels: props.stats.topVisitedPages.map(page => page.nombrePagina),
          datasets: [{
            label: 'Visitas',
            data: props.stats.topVisitedPages.map(page => page.conteoVisitas),
            backgroundColor: ['#42A5F5', '#66BB6A', '#FF7043', '#AB47BC', '#FFEB3B'],
            borderColor: ['#1E88E5', '#43A047', '#FF5722', '#8E24AA', '#FBC02D'],
            borderWidth: 1
          }]
        };

        new Chart(ctx, {
          type: 'bar',
          data: chartData,
          options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true,
              },
            },
          },
        });
      }
    });

    return {
      chartRef,
    };
  },
}
</script>

<style scoped>
.bb {
  border-bottom: 4px solid #48bb78; /* Color verde para el borde inferior */
}

.w-full {
  width: 100%; /* Asegura que el canvas ocupe el 100% del contenedor */
}

.h-40 {
  height: 10rem; /* Ajusta la altura del gráfico a un valor más pequeño */
}
</style>
