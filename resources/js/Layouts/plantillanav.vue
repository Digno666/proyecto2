<template>
  <div id="sidebar" class="relative">
    <!-- Barra lateral -->
    <div :class="`sidebar-container ${isOpen ? 'translate-x-0' : '-translate-x-64'}`">
      <div class="space-y-4 flex-1">
        <!-- Encabezado -->
        <div class="header">
          <h2 class="title">Menú</h2>
          <button @click="toggleSidebar" id="ocultarmenu" class="toggle-btn">
            <i class="fas fa-bars"></i> 
          </button>
        </div>
        

          <!-- Búsqueda -->
          <div class="search-container">
            <span class="search-icon">
              <i class="fas fa-search"></i> 
            </span>
            <input type="search" name="Search" placeholder="Buscar..." class="search-input" />
          </div>

        <!-- Menú -->
        <ul class="menu">
    <li class="menu-item" v-for="(module, index) in menuData" :key="index">
      <button @click="toggleModule(module.name)" class="menu-link">
        <i :class="module.icon"></i>
        <span>{{ module.name }}</span>
        <i v-if="activeModule === module.name" class="submenu-icon"></i>
      </button>
      
      <!-- Submenú -->
      <ul v-if="activeModule === module.name" class="submenu">
        <li v-for="(option, index) in module.options" :key="index">
          <a :href="route(option.route)" class="submenu-link">
            <span>{{ option.name }}</span>
          </a>
        </li>
      </ul>
    </li>
  </ul>

          <div class="selector">
    <a :href="route('encargado')" class="submenu-link flex items-center gap-2">
      <i class="fas fa-home"></i> 
      <span>Inicio</span>
    </a>
  <button @click="toggleModule('Estilos')">
    <i class="fas fa-palette"></i> <!-- Estilos -->
    <span>  Estilos</span>
    <i v-if="activeModule === 'Estilos'" class="submenu-icon"></i>
  </button>
  <ul v-if="activeModule === 'Estilos'" class="submenu">
    <div>
      <select v-model="selectedStyle" @change="updateStyles" class="submenu-link">
        <option value="defecto">Cliente</option>
        <option value="ninos">Niño</option>
        <option value="jovenes">Joven</option>
        <option value="adultos">Adulto</option>
      </select>
    </div>
  </ul>
</div>




      </div>
      <span class="greeting">Hola, {{ userName }}</span>
       <!-- Modo Día/Noche -->
<div class="day-night-toggle">
  <label class="themeSwitcherTwo shadow-two relative inline-flex cursor-pointer select-none items-center justify-center rounded-md bg-white dark:bg-dark-2 p-0">
    <input
      type="checkbox"
      class="sr-only"
      v-model="isNightMode"
      @change="updateStyles"
    />
    <!-- Visualización de Modo Día -->
    <span
      v-if="!isNightMode"
      class="light text-primary bg-gray dark:bg-dark-3 flex items-center space-x-[6px] rounded py-2 px-[18px] text-sm font-medium w-full"
    >
      <svg width="16" height="16" viewBox="0 0 16 16" class="mr-[6px] fill-current">
        <g clip-path="url(#clip0_3122_652)">
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M8 0C8.36819 0 8.66667 0.298477 8.66667 0.666667V2C8.66667 2.36819 8.36819 2.66667 8 2.66667C7.63181 2.66667 7.33333 2.36819 7.33333 2V0.666667C7.33333 0.298477 7.63181 0 8 0ZM8 5.33333C6.52724 5.33333 5.33333 6.52724 5.33333 8C5.33333 9.47276 6.52724 10.6667 8 10.6667C9.47276 10.6667 10.6667 9.47276 10.6667 8C10.6667 6.52724 9.47276 5.33333 8 5.33333ZM4 8C4 5.79086 5.79086 4 8 4C10.2091 4 12 5.79086 12 8C12 10.2091 10.2091 12 8 12C5.79086 12 4 10.2091 4 8ZM8.66667 14C8.66667 13.6318 8.36819 13.3333 8 13.3333C7.63181 13.3333 7.33333 13.6318 7.33333 14V15.3333C7.33333 15.7015 7.63181 16 8 16C8.36819 16 8.66667 15.7015 8.66667 15.3333V14ZM2.3411 2.3424C2.60145 2.08205 3.02356 2.08205 3.28391 2.3424L4.23057 3.28906C4.49092 3.54941 4.49092 3.97152 4.23057 4.23187C3.97022 4.49222 3.54811 4.49222 3.28776 4.23187L2.3411 3.28521C2.08075 3.02486 2.08075 2.60275 2.3411 2.3424ZM12.711 11.7682C12.4506 11.5078 12.0285 11.5078 11.7682 11.7682C11.5078 12.0285 11.5078 12.4506 11.7682 12.711L12.7148 13.6577C12.9752 13.918 13.3973 13.918 13.6577 13.6577C13.918 13.3973 13.918 12.9752 13.6577 12.7148L12.711 11.7682ZM0 8C0 7.63181 0.298477 7.33333 0.666667 7.33333H2C2.36819 7.33333 2.66667 7.63181 2.66667 8C2.66667 8.36819 2.36819 8.66667 2 8.66667H0.666667C0.298477 8.66667 0 8.36819 0 8ZM14 7.33333C13.6318 7.33333 13.3333 7.63181 13.3333 8C13.3333 8.36819 13.6318 8.66667 14 8.66667H15.3333C15.7015 8.66667 16 8.36819 16 8C16 7.63181 15.7015 7.33333 15.3333 7.33333H14ZM4.23057 11.7682C4.49092 12.0285 4.49092 12.4506 4.23057 12.711L3.28391 13.6577C3.02356 13.918 2.60145 13.918 2.3411 13.6577C2.08075 13.3973 2.08075 12.9752 2.3411 12.7148L3.28776 11.7682C3.54811 11.5078 3.97022 11.5078 4.23057 11.7682ZM13.6577 3.28521C13.918 3.02486 13.918 2.60275 13.6577 2.3424C13.3973 2.08205 12.9752 2.08205 12.7148 2.3424L11.7682 3.28906C11.5078 3.54941 11.5078 3.97152 11.7682 4.23187C12.0285 4.49222 12.4506 4.49222 12.711 4.23187L13.6577 3.28521Z"
          />
        </g>
      </svg>
      Modo Claro
    </span>

    <!-- Visualización de Modo Oscuro -->
    <span
      v-if="isNightMode"
      class="dark text-body-color flex items-center space-x-[6px] rounded py-2 px-[18px] text-sm font-medium w-full"
    >
      <svg width="16" height="16" viewBox="0 0 16 16" class="mr-[6px] fill-current">
        <path
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M8.0547 1.67334C8.18372 1.90227 8.16622 2.18562 8.01003 2.39693C7.44055 3.16737 7.16651 4.11662 7.23776 5.07203C7.30901 6.02744 7.72081 6.92554 8.39826 7.60299C9.07571 8.28044 9.97381 8.69224 10.9292 8.76349C11.8846 8.83473 12.8339 8.5607 13.6043 7.99122C13.8156 7.83502 14.099 7.81753 14.3279 7.94655C14.5568 8.07556 14.6886 8.32702 14.6644 8.58868C14.5479 9.84957 14.0747 11.0512 13.3002 12.053C12.5256 13.0547 11.4818 13.8152 10.2909 14.2454C9.09992 14.6756 7.81108 14.7577 6.57516 14.4821C5.33925 14.2065 4.20738 13.5846 3.312 12.6892C2.41661 11.7939 1.79475 10.662 1.51917 9.42608C1.24359 8.19017 1.32569 6.90133 1.75588 5.71038C2.18606 4.51942 2.94652 3.47561 3.94828 2.70109C4.95005 1.92656 6.15168 1.45335 7.41257 1.33682C7.67423 1.31264 7.92568 1.44442 8.0547 1.67334ZM6.21151 2.96004C5.6931 3.1476 5.20432 3.41535 4.76384 3.75591C3.96242 4.37553 3.35405 5.21058 3.00991 6.16334C2.66576 7.11611 2.60008 8.14718 2.82054 9.13591C3.04101 10.1246 3.5385 11.0301 4.25481 11.7464C4.97111 12.4627 5.87661 12.9602 6.86534 13.1807C7.85407 13.4012 8.88514 13.3355 9.8379 12.9913C10.7907 12.6472 11.6257 12.0388 12.2453 11.2374C12.5859 10.7969 12.8536 10.3081 13.0412 9.78974C12.3391 10.0437 11.586 10.1495 10.8301 10.0931C9.55619 9.99813 8.35872 9.44907 7.45545 8.5458C6.55218 7.64253 6.00312 6.44506 5.90812 5.17118C5.85174 4.4152 5.9575 3.66212 6.21151 2.96004Z"
        />
      </svg>
      Modo Oscuro
    </span>
  </label>
</div>


      <!-- Botón de Cerrar sesión -->
      <button @click="logout" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i> <!-- Cerrar sesión -->
        Cerrar sesión
      </button>
    </div>

    <!-- Botón flotante para la barra lateral -->
    <button v-if="!isOpen" @click="toggleSidebar" class="floating-btn">
      <i class="fas fa-bars"></i> <!-- Menú flotante -->
    </button>
  </div>
</template>

<script>
export default {
  props: {
    userName: {
      type: String,
      default: "Sin Usuario",
    },
  },
  data() {
    return {
      isOpen: true,
      menuData: [], 
      activeModule: null, 
      selectedStyle: localStorage.getItem("selectedStyle") || "defecto", 
      isNightMode: JSON.parse(localStorage.getItem("isNightMode")) || false, 
    };
  },
  mounted() {
    this.applyStyles(); 
    this.loadMenuData(); 
  },
  watch: {
    selectedStyle(newStyle) {
      localStorage.setItem("selectedStyle", newStyle); 
      this.applyStyles(); 
    },
    isNightMode(newMode) {
      localStorage.setItem("isNightMode", JSON.stringify(newMode));
      this.applyStyles();
    },
  },
  methods: {
    toggleSidebar() {
      this.isOpen = !this.isOpen;
    },
    toggleModule(moduleName) {
      this.activeModule = this.activeModule === moduleName ? null : moduleName;
    },
    loadMenuData() {
      fetch("/menu-options")
        .then((response) => response.json())
        .then((data) => {
          this.menuData = data;
        })
        .catch((error) => console.error("Error al cargar el menú:", error));
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
  },
};
</script>



<style scoped>
a{
  text-decoration: none;
}
.submenu-link {
  text-decoration: none;
}

.greeting{
  font-size: 20px;
  margin-bottom: 19px;
  margin-left: 3px;
}
/* Estilos principales */
/* Barra lateral */
.sidebar-container {
  display: flex;
  flex-direction: column;
  height: 100%;
  padding: 1rem;
  width: 16rem;
  background: var(--bg-color);
  color: var(--text-color);
  transition: transform 0.3s ease-in-out;
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  z-index: 999; /* Barra lateral con z-index 999 */
}

/* Botón flotante */
.floating-btn {
  position: fixed;
  bottom: 2rem;
  left: 2rem;
  height: 50px;
  width: 50px;
  padding: 1rem;
  border-radius: 50%;
  transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
  z-index: 1001; /* Botón flotante con z-index más alto para estar sobre la barra lateral */
}

.translate-x-0 {
  transform: translateX(0);
}

.-translate-x-64 {
  transform: translateX(-16rem);
}

/* Encabezado */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.title {
  font-size: var(--title-font-size);
  font-weight: var(--font-weight-bold);
}

.toggle-btn {
  padding: 0.5rem;
  transition: transform 0.3s ease-in-out;
}

.toggle-btn:hover {
  transform: scale(1.5);
}

/* Búsqueda */
.search-container {
  position: relative;
}

.search-icon {
  position: absolute;
  left: 0.75rem;
  top: 50%;
  transform: translateY(-50%);
}

.search-input {
  width: 100%;
  padding: 0.5rem 0.75rem 0.5rem 2.5rem;
  font-size: var(--font-size-small);
  border-radius: var(--border-radius);
  border: none;
  transition: box-shadow 0.3s ease-in-out;
}

.search-input:focus {
  outline: none;
}

/* Menú */
.menu {
  list-style: none;
  padding: 0;
}

.menu-item {
  border-radius: var(--border-radius);
}

.menu-link {
  display: flex;
  align-items: center;
  padding: 0.75rem;
  gap: 0.5rem;
  width: 100%;
  transition: background-color 0.3s ease-in-out;
}

.submenu {
  margin-top: 0.5rem;
  padding-left: 2rem;
}

.submenu-link:hover {
  text-decoration: underline;
}

/* Botón Cerrar Sesión */
.logout-btn {
  margin-top: 1rem;
  padding: 0.75rem;
  border-radius: var(--border-radius);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background-color 0.3s ease-in-out;
}

.day-night-toggle {
  display: flex;
  align-items: center;
  justify-content: center;
}

.themeSwitcherTwo {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 10px;
  width: 100%;

}

.light {
  background-color: #f0f0f0;
}

.dark {
  background-color: #333333;
}

.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  margin: -1px;
  padding: 0;
  border: 0;
  clip: rect(0, 0, 0, 0);
  overflow: hidden;
}

.text-primary {
  color: #4a4a4a;
}

.bg-gray {
  background-color: #cccccc;
}
.selector{
  margin-left: 10px;
  margin-top: 10px;
}
</style>
