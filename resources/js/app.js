require('./bootstrap');

// Require Vue
window.Vue = require('vue').default;

// Register Vue Components
Vue.component('app-component', require('./components/AppComponent.vue').default);

// Initialize Vue
const app = new Vue({
    el: '#app',
});