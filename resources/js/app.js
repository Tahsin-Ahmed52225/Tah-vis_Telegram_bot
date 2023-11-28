/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

// AXIOS default route
axios.defaults.baseURL = `https://8c8e-203-76-123-69.ngrok-free.app`+`/api/`;

const app = createApp({});
import Layout from './views/layout.vue';
app.component('layout', Layout);
app.mount('#app');
