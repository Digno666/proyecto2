<template>
  <div>
    <plantillanavcliente :userName="$page.props.auth.user.name" />

    <main class="container mt-5 py-12">
      <div class="card mb-4">
        <h1 class="text-center mb-4">Lista de tus productos que comprarás</h1>
        <div class="overflow-x-auto">
          <table class="table-auto w-full text-sm bg-pink-50">
            <thead class="bg-pink-100">
              <tr>
                <th class="p-3 text-left text-pink-600">Imagen</th>
                <th class="p-3 text-left text-pink-600">Producto</th>
                <th class="p-3 text-left text-pink-600">Cantidad</th>
                <th class="p-3 text-left text-pink-600">Precio Unitario</th>
                <th class="p-3 text-left text-pink-600">Total</th>
                <th class="p-3 text-left text-pink-600">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b hover:bg-pink-200" v-for="(producto, index) in productos" :key="index">
                <td class="p-3">
                  <img
                    v-if="producto.imagen"
                    :src="`/storage/uploads/${producto.imagen}`"
                    alt="Imagen del producto"
                    class="img-thumbnail"
                    style="max-width: 120px;"
                  />
                  <span v-else>No tiene imagen</span>
                </td>
                <td class="p-3">{{ producto.nombre }}</td>
                <td class="p-3">
                  <input
                    type="number"
                    v-model.number="producto.cantidad"
                    class="cc"
                    :min="1"
                    :max="producto.stock"
                    @input="validarCantidad(index)"
                  />
                </td>
                <td class="p-3">Bs. {{ producto.precio.toFixed(2) }}</td>
                <td class="p-3">Bs. <span>{{ (producto.precio * producto.cantidad).toFixed(2) }}</span></td>
                <td>
                  <button @click="eliminarProducto(index)" class="btn btn-primary btn-sm"><i class="fas fa-times"> </i>Quitar</button>
                </td>
              </tr>
            </tbody>
          </table>
          
        </div>
      </div>

      <div class="container mt-4 d-flex justify-content-end">
        <div class="card p-3 shadow-sm" style="max-width: 300px; width: 100%;">
          <div class="d-flex justify-content-between align-items-center">
            <div class="font-weight-bold">TOTAL:</div>
            <div class="font-weight-bold ml-3">{{ totalCarrito }} Bs.</div>
          </div>
        </div>
      </div>

           <!-- Botón de Realizar Pago -->
           <div class="d-flex justify-content-center mb-4 mx-4">
        <button type="button" @click="confirmarCompra" class="btn btn-primary" :disabled="productos.length === 0">Comprar</button>
      </div>
       <!-- <div class="container mt-4 d-flex justify-content-end">
        <button @click="realizarPago" class="btn btn-primary">
          Realizar Pago
        </button>
      </div> -->

    </main>
    <VisitaFooter />
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
  data() {
    return {
      productos: this.$page.props.productos.map((producto) => ({
        ...producto,
        cantidad: this.$page.props.cantidades[producto.codProducto] || 1,
      })),
      form: {
        idcliente: this.$page.props.auth.user.cliente ? this.$page.props.auth.user.cliente.carnetIdentidad : '',  
        tcRazonSocial: this.$page.props.auth.user.cliente ? this.$page.props.auth.user.cliente.nombre : '', 
        tcCiNit: this.$page.props.auth.user.cliente ? this.$page.props.auth.user.cliente.carnetIdentidad : '', 
        tcCorreo: this.$page.props.auth.user.email, 
        tnMonto: this.totalCarrito,  
        tnTelefono: this.$page.props.auth.user.cliente ? this.$page.props.auth.user.cliente.telefono : '', 
        taPedidoDetalle: [], 
      },
      qrImage: null,
    };
  },
  computed: {
    totalCarrito() {
      return this.productos.reduce((total, producto) => total + producto.precio * producto.cantidad, 0).toFixed(2);
    },
  },
  methods: {
    validarCantidad(index) {
      const producto = this.productos[index];
      if (producto.cantidad > producto.stock) {
        producto.cantidad = producto.stock;
        this.mostrarAlerta("La cantidad no puede ser mayor que el stock disponible.");
      }
    },
    eliminarProducto(index) {
      this.productos.splice(index, 1); 
      if (this.productos.length === 0) {
        this.redirigirVistaCliente();
      }
    },
    redirigirVistaCliente() {
      Inertia.visit(route('vista-cliente'));
    },
    mostrarAlerta(mensaje) {
      alert(mensaje);
    },
    confirmarCompra() {
      axios.post(route('comprarprosel'), {
        productos: this.productos,
        tnMonto: parseFloat(this.totalCarrito),
      })
      .then((response) => {
          // Enviar los datos a la ruta de pago usando Inertia
          this.$inertia.visit(this.route('pago2'), {
            method: 'get', 
            data: {
              idcliente: this.$page.props.auth.user.codUsuario,
              tcRazonSocial: this.$page.props.auth.user.name,
              tnMonto: this.totalCarrito,
            }
          });
      })
      .catch((error) => {
        console.error(error);
        alert("Hubo un error al registrar la compra.");
      });
    },

//     confirmarCompra() {
//       axios
//       axios.post(route('comprarprosel'), {
//     productos: this.productos,
//     tnMonto: parseFloat(this.totalCarrito),
// })
//         .then((response) => {
//           if (response.data.redirect) {
//             window.location.href = response.data.redirect;
//           } else {
//             alert(response.data.success || "Compra realizada con éxito.");
//           }
//         })
//         .catch((error) => {
//           console.error(error);
//           alert("Hubo un error al registrar la compra.");
//         });
//     },
    volver() {
      this.$router.push({ name: "cliente" });
    },
  },
};
</script>

<style scoped>
.table {
  width: 100%;
  margin-bottom: 20px;
}

.table th,
.table td {
  text-align: center;
  vertical-align: middle;
}

.font-weight-bold {
  font-weight: bold;
}

.table td img {
  display: block;
  margin: auto;
}

.card {
  margin-bottom: 25px;
}

.card-body {
  padding: 20px;
}

.container {
  margin-top: 20px;
}

.fila {
  height: 60px;
}

.table td,
.table th {
  padding: 15px;
}

.d-flex {
  display: flex;
}

.cantidad-input {
  color: black;
}

.row.mb-4 {
  display: flex;
  flex-wrap: wrap;
}

.col-md-6 {
  flex: 1;
  padding: 15px;
}

.card-body form .form-group {
  margin-bottom: 1.5rem;
}

.card-body form .form-control {
  margin-bottom: 1rem;
}

.card-body form .btn {
  padding: 0.75rem 1.5rem;
  font-size: 1rem;
}

h1 {
  font-size: 22px;
  margin-top: 10px;
  margin-bottom: 25px;
  font-weight: bold;
}
.py-12 {
  margin-top: calc(60px + 1rem); 
  margin-bottom: calc(60px + 1rem); 
}
</style>
