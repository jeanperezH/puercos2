/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('inicio', require('./components/Inicio.vue').default);
Vue.component('gallo', require('./components/Gallo.vue').default);
Vue.component('gallina', require('./components/Gallina.vue').default);
Vue.component('cria', require('./components/Cria.vue').default);

const app = new Vue({
    el: '#app',
    data :{
        menu:0,
        ruta: 'http://localhost/Gallinero/public',
       }
});
