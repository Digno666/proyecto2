<template>
  <plantillanav :userName="$page.props.auth.user.name"/>
  <div v-if="stats" class="container mx-auto p-6 space-y-8">
    <h1 class="text-3xl font-semibold text-center bb">Estadísticas del Negocio</h1>

    <!-- Estadísticas Generales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      
      <!-- Ventas Totales -->
      <div class="card p-6 bg-green-100 shadow-lg rounded-lg border border-green-300 hover:shadow-xl transition duration-300 ease-in-out">
        <h2 class="font-medium text-xl text-green-600 mb-3">Ventas Totales</h2>
        <p class="text-green-600">Total de ventas: <span class="font-semibold text-green-900">{{ stats.totalSales }}</span></p>
        <p class="text-green-600">Monto total de ventas: <span class="font-semibold text-green-700">${{ stats.totalSalesAmount }}</span></p>
      </div>

      <!-- Compras Totales -->
      <div class="card p-6 bg-red-100 shadow-lg rounded-lg border border-red-300 hover:shadow-xl transition duration-300 ease-in-out">
        <h2 class="font-medium text-xl text-red-600 mb-3">Compras Totales</h2>
        <p class="text-red-600">Total de compras: <span class="font-semibold text-red-900">{{ stats.totalPurchases }}</span></p>
        <p class="text-red-600">Monto total de compras: <span class="font-semibold text-red-700">${{ stats.totalPurchasesAmount }}</span></p>
      </div>

      <!-- Ventas del Mes -->
      <div class="card p-6 bg-blue-100 shadow-lg rounded-lg border border-blue-300 hover:shadow-xl transition duration-300 ease-in-out">
        <h2 class="font-medium text-xl text-blue-600 mb-3">Ventas del Mes</h2>
        <p class="text-blue-600">Total de ventas: <span class="font-semibold text-blue-900">{{ stats.monthlySales }}</span></p>
        <p class="text-blue-600">Monto total de ventas: <span class="font-semibold text-blue-700">${{ stats.monthlySalesAmount }}</span></p>
      </div>

      <!-- Compras del Mes -->
      <div class="card p-6 bg-yellow-100 shadow-lg rounded-lg border border-yellow-300 hover:shadow-xl transition duration-300 ease-in-out">
        <h2 class="font-medium text-xl text-yellow-600 mb-3">Compras del Mes</h2>
        <p class="text-yellow-600">Total de compras: <span class="font-semibold text-yellow-900">{{ stats.monthlyPurchases }}</span></p>
        <p class="text-yellow-600 ">Monto total de compras: <span class="font-semibold text-yellow-700">${{ stats.monthlyPurchasesAmount }}</span></p>
      </div>

    </div>

    <!-- Gráfico de Productos más Vendidos -->
    <div class="flex justify-center items-center w-full">
      <div class="card p-6 bg-indigo-100 shadow-lg rounded-lg border border-indigo-300 hover:shadow-xl transition duration-300 ease-in-out">
        <h2 class="font-medium text-xl text-indigo-600 mb-3">Productos Más Vendidos</h2>
        <canvas ref="chartRef" id="topSellingProductsChart" class="w-full h-40"></canvas>
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
    stats: Object
  },
  setup(props) {
    const chartRef = ref(null);

    onMounted(() => {
      // Verifica que los datos estén disponibles antes de crear el gráfico
      if (chartRef.value && props.stats.topSellingProducts) {
        const ctx = chartRef.value.getContext('2d');
        const chartData = {
          labels: props.stats.topSellingProducts.map(product => product.name),
          datasets: [{
            label: 'Cantidad Vendida',
            data: props.stats.topSellingProducts.map(product => product.count),
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
