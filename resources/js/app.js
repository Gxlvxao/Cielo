import './bootstrap';

// 1. Importar Alpine Core
import Alpine from 'alpinejs';

// 2. Importar Plugins
import intersect from '@alpinejs/intersect';
import collapse from '@alpinejs/collapse'; // <--- Adicionado

// 3. Registrar Plugins
Alpine.plugin(intersect);
Alpine.plugin(collapse); // <--- Registrando o Collapse

// 4. Atribuir ao Window (Global) ANTES de iniciar
window.Alpine = Alpine;

// 5. Iniciar
Alpine.start();