window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

// https://stackoverflow.com/questions/59448621/laravel-vue-js-axios-csrf-token-mismatch
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
import Echo from "laravel-echo"
window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

// window.requestAnimFrame = (function() {
//     return  window.requestAnimationFrame        ||
//             window.webkitRequestAnimationFrame  ||
//             window.mozRequestAnimationFrame     ||
//             window.oRequestAnimationFrame       ||
//             window.msRequestAnimationFrame      ||
//             function (callback) {
//                 window.setTimeout(callback, 1000 / 60);
//             };
// })();