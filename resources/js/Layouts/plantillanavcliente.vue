<template>
  <nav class="navbar">
    <div class="navbar-container">
      <!-- Logo personalizado con "BeautySalon" -->
      <a href="/cliente" class="logo">
        <img src="/img/logoSalon.png" alt="Beauty Salon" class="logo-img" />
      </a>

      <!-- Información del Usuario (Nombre) antes del menú -->
      <div class="user-info">
        <i class="fas fa-user user-icon"></i>
        <span class="greeting">{{ userName }}</span>
      </div>

      <!-- Selector de Estilos -->
      

      <!-- Menú principal con enlaces relacionados con el salón de belleza -->
      <ul class="nav-links" :class="{ open: isMenuOpen }">
        <li class="nav-item" :class="{ active: activeLink === 'productos' }">
          <a href="/cliente" @click="setActiveLink('productos')">
            <i class="fas fa-cogs"></i> Comprar Productos
          </a>
        </li>
        <li class="nav-item" :class="{ active: activeLink === 'servicios' }">
          <a href="/reservaCliente/index" @click="setActiveLink('servicios')">
            <i class="fas fa-scissors"></i> Reservar Servicios
          </a>
        </li>
        <!-- Enlace de Mis Reservas -->
        <li class="nav-item" :class="{ active: activeLink === 'reservas' }">
          <a href="/mis-reservas" @click="setActiveLink('reservas')">
            <i class="fas fa-calendar-check"></i> Mis Reservas
          </a>
        </li>
      </ul>

      <!-- Icono del Carrito de Compras -->
      <div class="cart-icon" @click="toggleCartModal">
        🛒
        <span v-if="cartItemCount > 0" class="cart-count">{{ cartItemCount }}</span>
      </div>

      <div class="style-selector">
        <select v-model="selectedStyle" @change="updateStyles" class="style-select">
          <option value="defecto">Cliente</option>
          <option value="ninos">Niño</option>
          <option value="jovenes">Joven</option>
          <option value="adultos">Adulto</option>
        </select>
      </div>
      <!-- Modo Día/Noche -->
      <div class="mode-switch">
        <label class="swap swap-rotate">
          <input type="checkbox" class="theme-controller" v-model="isNightMode" @change="updateStyles" />
          
          <!-- Icono de Sol (Modo Claro) -->
          <svg class="swap-off h-10 w-10 fill-current sol" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" v-if="!isNightMode">
            <path d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
          </svg>
          
          <!-- Icono de Luna (Modo Oscuro) -->
          <svg class="swap-on h-10 w-10 fill-current luna" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" v-if="isNightMode">
            <path d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
          </svg>
        </label>
      </div>

      <!-- Botón de Cerrar sesión -->
      <button @click="logout" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
      </button>
    </div>
  </nav>
</template>

<script>
export default {
  name: "NavBar",
  props: {
    cartItemCount: {
      type: Number,
      default: 0,
    },
    userName: {
      type: String,
      default: "Sin Usuario",
    },
  },
  data() {
    return {
      isMenuOpen: false,
      activeLink: null,
      selectedStyle: localStorage.getItem("selectedStyle") || "defecto",
      isNightMode: JSON.parse(localStorage.getItem("isNightMode")) || false,
      cartItemCount: 0, // Contador de productos en el carrito
    };
  },
  mounted() {
    this.applyStyles(); // Aplica los estilos según la configuración
    // Aquí podrías agregar la lógica para obtener el conteo del carrito
  },
  watch: {
    selectedStyle(newStyle) {
      localStorage.setItem("selectedStyle", newStyle);
      this.applyStyles(); // Aplica los estilos según el estilo seleccionado
    },
    isNightMode(newMode) {
      localStorage.setItem("isNightMode", JSON.stringify(newMode));
      this.applyStyles(); // Aplica los estilos según el modo noche
    },
  },
  methods: {
    setActiveLink(link) {
      this.activeLink = link;
    },
    logout() {
      axios
        .post(route("logout"))
        .then(() => {
          window.location.href = route("login");
        })
        .catch((error) => console.error("Error al cerrar sesión:", error));
    },
    applyStyles() {
      const styles = {
        defecto: this.isNightMode
          ? "/css/estiloPagClienteOscuro.css"
          : "/css/estiloPagClienteClaro.css",
        ninos: this.isNightMode
          ? "/css/estiloPagNinoOscuro.css"
          : "/css/estiloPagNinoClaro.css",
        jovenes: this.isNightMode
          ? "/css/estiloPagJovenOscuro.css"
          : "/css/estiloPagJovenClaro.css",
        adultos: this.isNightMode
          ? "/css/estiloPagAdultoOscuro.css"
          : "/css/estiloPagAdultoClaro.css",
      };

      const selectedHref = styles[this.selectedStyle];
      document.querySelectorAll('link[rel="stylesheet"][data-page-style]').forEach((link) => link.remove());

      const linkTag = document.createElement("link");
      linkTag.rel = "stylesheet";
      linkTag.href = selectedHref;
      linkTag.setAttribute("data-page-style", "true");
      document.head.appendChild(linkTag);
    },
    toggleCartModal() {
      this.$emit("toggle-cart-modal");
    },
  },
};
</script>

<style scoped>
.navbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem;
  background-color: var(--bg-color);
  color: var(--text-color);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  position: fixed; /* Fija la barra en la parte superior */
  top: 0; /* La posicionamos en la parte superior */
  left: 0;
  right: 0;
  z-index: 1000; /* Asegura que esté por encima de otros elementos */
  width: 100%; /* Asegura que ocupe todo el ancho */
}

.navbar-container {
  display: flex;
  align-items: center;
  width: 100%;
}

.logo-img {
  width: 150px;
}

.user-info {
  display: flex;
  align-items: center;
}

.user-icon {
  font-size: 1.5rem;
  margin-right: 8px;
  cursor: pointer;
}

.greeting {
  font-size: 1.2rem;
}

/* Estilos del selector de estilo */
.style-selector {
  margin-left: 20px;
}

.style-select {
  padding: 0.5rem;
  border-radius: 5px;
  border: 1px solid #ccc;
}

/* Estilos del menú */
.nav-links {
  display: flex;
  gap: 30px; /* Aumenta el espacio entre los elementos del menú */
}

.nav-item {
  font-size: 1rem;
  padding: 0.5rem 1rem; /* Añadir más espacio alrededor de cada item */
}

.nav-item.active {
  font-weight: bold;
}

.nav-item a {
  text-decoration: none;
  color: var(--text-color);
}

/* Estilos del icono del carrito de compras */
.cart-icon {
  position: relative;
  font-size: 1.5rem;
  cursor: pointer;
  margin-left: 20px;
}

.cart-count {
  position: absolute;
  top: -5px;
  right: -5px;
  background-color: BLACK;
  color: white;
  border-radius: 50%;
  padding: 5px;
  font-size: 0.8rem;
}

/* Estilos del modo día/noche */
.mode-switch {
  display: flex;
  align-items: center;
  gap: 10px;
}

.swap {
  display: flex;
  justify-content: center;
  align-items: center;
}

.swap-off, .swap-on {
  transition: all 0.3s ease;
}

.sol {
  color: #FFD700;
}

.luna {
  color: #fff;
}

/* Ocultar el checkbox pero mantener su funcionalidad */
.theme-controller {
  display: none;
}

/* Botón de cerrar sesión */
.logout-btn {
  margin-left: 20px;
  padding: 0.5rem;
  background-color: var(--bg-color);
  border-radius: 5px;
  cursor: pointer;
  border: none;
}
</style>
