require('./bootstrap');

 window.events = new Vue();

 window.flash = function (message, level = 'success') {
     window.events.$emit('flash', { message, level });
 };

window.Vue = require('vue');

Vue.prototype.authorize = function (handler) {
    // Additional admin privileges here.
        // return true; for testing

    let user = window.App.user;

    return user ? handler(user) : false;
};

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('paginator', require('./components/Paginator.vue').default);
Vue.component('user-notifications', require('./components/UserNotifications.vue').default);
Vue.component('thread-view', require('./pages/Thread.vue').default);

const app = new Vue({
    el: '#app'
});
