// importar módulos de gráficos
import { Chart, registerables } from "chart.js";
Chart.register(...registerables);

// Importando o arquivo bootstrap.js
import "./bootstrap";

// Importando o arquivo SASS principal
import "../scss/app.scss";

// Importando todos os componentes do Bootstrap
import * as bootstrap from "bootstrap";

// Importando Icons do Bootstrap
import "bootstrap-icons/font/bootstrap-icons.css";

// Importando o Alpine.js
import Alpine from "alpinejs";

// Adicionando Alpine.js ao objeto global
window.Alpine = Alpine;

// Iniciando Alpine.js
Alpine.start();
