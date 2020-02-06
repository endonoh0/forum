try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    window.Vue = require('vue');

    require('bootstrap');
} catch (e) {}

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


