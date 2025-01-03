<template>
  <footer>
    <div class="footer-container">
      <p class="visita-text">
        Cantidad de veces que se ha visitado esta página: <span class="visita-count">{{ visitaCount }}</span> veces.
      </p>
    </div>
  </footer>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
  name: 'VisitaFooter',
  setup() {
    const visitaCount = ref(0);

    const obtenerVisitas = async () => {
      try {
        const ruta = window.location.pathname;

        const response = await axios.get(route('api.visitas'), {
          params: { ruta },
        });

        if (response.data && typeof response.data.visitas === 'number') {
          visitaCount.value = response.data.visitas;
        }
      } catch (error) {
        console.error('Error al obtener las visitas:', error);
      }
    };

    onMounted(() => {
      obtenerVisitas();
    });

    return {
      visitaCount,
    };
  },
};
</script>

<style scoped>
footer {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: #f8bbd0;
  color: #6a1b9a;
  text-align: center;
  padding: 12px;
  box-shadow: 0 -2px 12px rgba(106, 27, 154, 0.3); 
  z-index: -1000;
}
.footer-container {
  display: flex;
  justify-content: center;
  align-items: center;
}

.visita-text {
  font-size: 1.2rem;
  font-weight: 500;
  margin: 0;
  color: black;
}

.visita-count {
  font-weight: bold;
  color: #ad1457; 
  font-size: 1.4rem;
}
</style>
