<template>
  <plantillanavcliente :userName="$page.props.auth.user.name" />
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg divgrande">
          <div class="p-6 lg:p-8 border-gray-200 divpequeno">
            <h1 class="text-2xl font-bold text-center mb-6">Realizar Pago</h1>
            <form @submit.prevent="submitPayment">
              <input type="hidden" v-model="form.idcliente"/>
              <input type="hidden" v-model="form.tcRazonSocial"  />
              <input type="hidden" v-model="form.tcCiNit"  />
              <input type="hidden" v-model="form.tnMonto" />
              <input type="hidden" v-model="form.tcCorreo">
              <input type="hidden" v-model="form.tnTelefono" />
              
  
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="form-group">
                  <label for="tnTipoServicio" class="block text-sm font-medium bb">Tipo de Servicio</label>
                  <select v-model="form.tnTipoServicio" id="tnTipoServicio" class="form-select mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 cc" required>
                    <option value="1">Servicio QR</option>
                    <option value="2">Tigo Money</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tnTelefono" class="block text-sm font-medium bb">Número de cuenta</label>
                  <input
                    type="text"
                    v-model="form.tnTelefono"
                    id="tnTelefono"
                    class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 cc"
                    readonly
                  />
                </div>
              </div>
  
              <div class="text-right">
                <button type="submit" class="mt-4 btn btn-primary">
                  Generar QR
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="text-center">
        <button 
          @click="goBack" 
          class="btn btn-secondary me-3">
                                    <i class="fas fa-arrow-left"></i> Atrás
        </button>
      </div>
      <div class="flex flex-col justify-center items-center">
        <div v-if="qrImage" class="w-full max-w-md text-center">
          <img :src="qrImage" alt="Imagen QR" class="w-full h-auto rounded-md shadow-lg" />
        </div>
  
  
        <div v-if="transaction" class="w-full max-w-md text-center mt-6">
          <p class="text-lg text-gray-700">{{ message }}</p>
          <p id="tnTransaccion" class="text-indigo-600 font-semibold">{{ transaction }}</p>
          <iframe name="QrImage" class="w-full h-64 mt-4 rounded-md border border-gray-300 shadow-md"></iframe>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import plantillanav from '@/Layouts/plantillanav.vue';
  import VisitaFooter from '@/Components/VisitaFooter.vue';
  import plantillanavcliente from '@/Layouts/plantillanavcliente.vue';
  
  export default {
    props: {
      idcliente: String,
      tcRazonSocial: String,
      tcCiNit: String,
      tnMonto: String,
      tnTelefono: String,
      qrImage: String,
      message: String,
      transaction: String,
      csrfToken: String,
      tcCorreo: String,
    },
    components: {
      plantillanav, 
      VisitaFooter, 
      plantillanavcliente,
    },
    data() {
      return {
        form: {
          idcliente: this.idcliente || '', 
          tnTelefono: this.tnTelefono || '',
          tcCiNit: this.tcCiNit || '', 
          tcRazonSocial: this.tcRazonSocial || '', 
          tnMonto: this.tcMonto || '22',
          tnTipoServicio: '1', 
          tcCorreo: this.tcCorreo || '',
          taPedidoDetalle: [], 
        },
      };
    },
    methods: {
      submitPayment() {
    this.$inertia.post(this.route('consumirServicio2'), this.form)
      .then(response => {
        if (response.data.qrImage) {
          this.qrImage = response.data.qrImage; 
          this.message = response.data.message; 
          this.transaction = null;
        } else if (response.data.transaction) {
          this.transaction = response.data.transaction;  
          this.message = response.data.message; 
          this.qrImage = null;  
        } else {
          console.error('Error: La respuesta no contiene los datos esperados', response);
          this.message = 'Hubo un error al procesar la solicitud.';
        }
      })
      .catch(error => {
        console.error('Error al enviar el pago:', error);
        this.message = 'Hubo un error al procesar el pago.';
      });
  },
      goBack() {
        this.$inertia.visit(this.route('cliente'));
      },
      consultarEstadoTransaccion() {
        const data = { _token: this.csrfToken, tnTransaccion: this.transaction };
        axios
          .post(this.route('consultarEstado2'), data)
          .then((response) => {
            const iframe = document.getElementsByName('QrImage')[0];
            iframe.contentDocument.open();
            iframe.contentDocument.write(response.data.message);
            iframe.contentDocument.close();
          })
          .catch((error) => console.error(error));
      },
    },
    watch: {
      transaction(newValue) {
        if (newValue) {
          this.consultarEstadoTransaccion();
        }
      },
    },
  };
  </script>
  <style>
.py-12 {
  margin-top: calc(60px + 1rem); 
  margin-bottom: calc(60px + 1rem); 
}
</style>
  