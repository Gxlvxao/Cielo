import './bootstrap';

// 1. Importar Alpine e Plugins
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

// 2. Registrar Plugin
Alpine.plugin(intersect);

// 3. Atribuir ao Window (Global) ANTES de iniciar
window.Alpine = Alpine;

// 4. Iniciar
Alpine.start();