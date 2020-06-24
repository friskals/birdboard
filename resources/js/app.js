
// require('./bootstrap');

// window.Vue = require('vue');


// Vue.component('theme-swither', require('./components/ThemeSwither.vue').default);

// const app = new Vue({
//     el: '#app',
// });
import './bootstrap';

import Vue from 'vue';
import VModal from 'vue-js-modal';

Vue.use(VModal);

Vue.component('theme-switcher', require('./components/ThemeSwitcher.vue').default);
Vue.component('new-project-modal', require('./components/NewProjectModal.vue').default);


new Vue({
    el: '#app'
});
