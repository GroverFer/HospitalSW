/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import firebase from 'firebase'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('rol', require('./components/Rol.vue'));
Vue.component('user', require('./components/User.vue'));
Vue.component('departamento', require('./components/Departamento.vue'));
Vue.component('departamento_persona', require('./components/Departamento_persona.vue'));
Vue.component('especialidad', require('./components/Especialidad.vue'));
Vue.component('persona', require('./components/Persona.vue'));
Vue.component('tipo_empleado', require('./components/Tipo_empleado.vue'));
Vue.component('especilidad_persona', require('./components/Especialidad_persona'));
Vue.component('horario', require('./components/Horario'));
Vue.component('jornada', require('./components/Jornada'));
Vue.component('evento', require('./components/Evento'));
Vue.component('evento_persona', require('./components/Evento_persona'));
Vue.component('tipo_permiso', require('./components/Tipo_permiso'));


const app = new Vue({
    el: '#app',
    data: {
        menu: 0
    }
});