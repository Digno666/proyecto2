<template>
  <div>
    <plantillanavcliente :cart-item-count="carrito.length" @toggle-cart-modal="toggleCartModal"
    :userName="$page.props.auth.user.name" />
    <div class="py-12">
      <div class="text-center">
        <h2 class="font-semibold text-4xl text-pink-600 mb-6">
          <em>¡Encuentra todo lo que necesitas para tu belleza!</em>
        </h2>
      </div>
      <div class="mb-8 mx-6 mt-6">
        <label for="categoriaSelect" class="mr-4 text-lg font-medium bb">Filtrar por Categoría:</label>
        <select id="categoriaSelect" v-model="categoriaSeleccionada" @change="filtrarProductosPorCategoria" class="border px-4 py-2 rounded-md">
          <option value="" disabled>Selecciona una categoría</option>
          <option value="todos">Todos</option>
          <!-- Renderizar las categorías dinámicamente -->
          <option v-for="categoria in categorias" :key="categoria.codCategoria" :value="categoria.codCategoria">
            {{ categoria.nombre }}
          </option>
        </select>
      </div>
      <!-- Contenedor de productos, utilizando grid de Tailwind con 3 columnas por fila -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 px-4 justify-items-center" id="productosContainer">
        <div v-if="productos.length === 0" class="col-span-full text-center text-xl">
          <p>No hay productos disponibles.</p>
        </div>

        <div v-for="producto in productos" :key="producto.codProducto" class="card relative">
          <div v-if="producto.stock <= 0" class="agotado-overlay">
            <span class="transform rotate-12">¡AGOTADO!</span>
          </div>
          <img :src="producto.imagen ? `/storage/uploads/${producto.imagen}` : 'https://via.placeholder.com/300?text=Producto'" alt="Producto" class="imagen-card">
          <div class="p-6">
            <h5 class="bb">{{ producto.nombre }}</h5>
            <p class="text-sm text-gray-600 mt-2 bb">{{ producto.descripcion }}</p>
            <p class="price mt-2 bb">{{ producto.precio }} Bs.</p>
            <p class="stock mt-1 bb">Stock: {{ producto.stock }}</p>
            <button @click="agregarAlCarrito(producto)" :disabled="producto.stock === 0" class="btn w-full mt-4 text-center">
              {{ producto.stock > 0 ? 'Agregar al carrito' : 'Sin stock' }}
            </button>
          </div>
        </div>
      </div>
      <!-- Modal para mostrar el carrito -->
      <div v-if="isCartModalOpen" class="modal-overlay fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="modal-content bg-white p-8 rounded-lg w-1/2">
          <div class="modal-header modal-title bg-pink-600 text-white flex justify-between items-center p-4 rounded-t">
            <h5 class="m-0 namecar text-lg">Carrito de Compras</h5>
            <button type="button" @click="toggleCartModal" class="close text-white text-2xl">&times;</button>
          </div>
          <div class="modal-body">
            <div class="overflow-x-auto">
            <table class="table-auto w-full text-sm bg-pink-50">
              <thead class="bg-pink-100">
                <tr>
                  <th class="p-3 text-left text-pink-600">Producto</th>
                  <th class="p-3 text-left text-pink-600">Cantidad</th>
                  <th class="p-3 text-left text-pink-600">Precio</th>
                  <th class="p-3 text-left text-pink-600">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in carrito" :key="item.codProducto">
                  <td class="p-3">{{ item.nombre }}</td>
                  <td class="text-center">
                    <button @click="decrementarCantidad(item)" :disabled="item.cantidad === 1"
                      class="btn btn-sm bg-gray-300 px-2 py-1 rounded text-gray-700 cc">-</button>
                    <span class="mx-2">{{ item.cantidad }}</span>
                    <button @click="incrementarCantidad(item)" :disabled="item.cantidad >= item.stock"
                      class="btn btn-sm bg-gray-300 px-2 py-1 rounded text-gray-700">+</button>
                  </td>
                  <td class="p-3">{{ item.precio * item.cantidad }} Bs.</td>
                  <td>
                    <button @click="eliminarDelCarrito(item)" class="btn btn-primary">Eliminar</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
            <div class="total-container text-right mt-4">
              <strong class="bb">Total:</strong> <span class="total-price text-xl text-pink-700">{{ totalCarrito }} Bs.</span>
            </div>
          </div>
          <div class="modal-footer justify-content-end flex justify-end p-3">
            <button class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600" @click="redirigirCompra">
              Realizar Compra
            </button>
          </div>
        </div>
      </div>
    </div>
    <VisitaFooter />
  </div>
</template>

<script>
import axios from 'axios';
import VisitaFooter from '@/Components/VisitaFooter.vue';
import plantillanavcliente from '@/Layouts/plantillanavcliente.vue';
export default {
  components: { plantillanavcliente, VisitaFooter },
  data() {
    return {
      isCartModalOpen: false,
      productos: [],
      categorias: [],
      carrito: [],
      categoriaSeleccionada: 'todos',
      mensajeNoProductos: false, 
    };
  },
  computed: {
    totalCarrito() {
      return this.carrito.reduce((total, item) => total + item.precio * item.cantidad, 0);
    },
  },
  methods: {
    mostrarProductos() {
      axios.get(route('venta.obtenerProductos')).then(response => {
        this.productos = response.data.productos;
        this.categorias = response.data.categorias;
        this.verificarProductos(); // Verifica si hay productos al mostrar
      });
    },
    filtrarProductosPorCategoria() {
  console.log("Categoria seleccionada:", this.categoriaSeleccionada);  // Verifica el valor seleccionado
  axios.get(route('venta.obtenerProductos'), { params: { categoria: this.categoriaSeleccionada === 'todos' ? null : this.categoriaSeleccionada } })
    .then(response => {
      this.productos = response.data.productos;
      this.verificarProductos(); // Verifica si hay productos después de filtrar
    });
},
    // Nueva función para verificar si hay productos
    verificarProductos() {
      this.mensajeNoProductos = this.productos.length === 0;
    },
    redirigirCompra() {
      const idsYCantidades = this.carrito.map(item => `${item.codProducto}:${item.cantidad}`).join(',');
      window.location.href = route('comprar.detalle', { idsYCantidades });
    },
    toggleCartModal() {
      this.isCartModalOpen = !this.isCartModalOpen;
    },
    agregarAlCarrito(producto) {
      const itemEnCarrito = this.carrito.find(i => i.codProducto === producto.codProducto);

      if (itemEnCarrito) {
        if (itemEnCarrito.cantidad < producto.stock) {
          itemEnCarrito.cantidad++;
        } else {
          alert("No hay suficiente stock para agregar más unidades.");
        }
      } else {
        this.carrito.push({
          ...producto,
          cantidad: 1,
        });
      }
      this.$forceUpdate();
    },
    incrementarCantidad(item) {
      if (item.cantidad < item.stock) {
        item.cantidad++;
      }
    },
    decrementarCantidad(item) {
      if (item.cantidad > 1) {
        item.cantidad--;
      }
    },
    eliminarDelCarrito(item) {
      this.carrito = this.carrito.filter(i => i.codProducto !== item.codProducto);
    },
  },
  mounted() {
    this.mostrarProductos();
  }
};
</script>

<style scoped>
body {
  background-color: #f9f7f2;
  font-family: 'Lora', serif;
}
.card {
  border: 1px solid #e2e8f0;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  height: 100%;
  width: 400px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.card:hover {
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}
h2, h5 {
  font-family: 'Playfair Display', serif;
}
button:disabled {
  background-color: #d1d5db; /* Gris claro */
}
button:hover {
  background-color: #ff63a1; /* Rosa brillante */
}
.py-12 {
  margin-top: calc(60px + 1rem); 
  margin-bottom: calc(60px + 1rem); 
}
.bb {
    color: #ec4899; /* Rosa fuerte */
}

.cc {
    border-color: #f9a8d4; /* Rosa claro */
}
.imagen-card {
  width: 100%; /* La imagen ocupará todo el ancho del contenedor */
  height: 100%; /* Máxima altura de la imagen */
  object-fit: cover; /* Ajustar la imagen para que mantenga la proporción sin deformarse */
  border-radius: 8px;
}
</style>
