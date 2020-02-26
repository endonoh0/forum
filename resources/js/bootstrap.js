window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');
    window.Vue = require('vue');

    require('bootstrap');
} catch (e) {}

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


