import './bootstrap';
import { createApp } from 'vue';
import PeliculasComponent from './componer/PeliculasComponent.vue';

const app = createApp({});
app.component('peliculas-component', PeliculasComponent);
app.mount('#app');
