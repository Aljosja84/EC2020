/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('stats-win', require('./components/matchStats').default);
Vue.component('events-window', require('./components/EventsWindow').default);
Vue.component('possession', require('./components/possessionStats').default);
Vue.component('lineup', require('./components/lineup').default);
Vue.component('test', require('./components/test').default);
Vue.component('scoreboard', require('./components/scoreboard').default);
Vue.component('match', require('./components/Match').default);
Vue.component('tweets', require('./components/RTTweets').default);
Vue.component('team-form', require('./components/Teamform').default);
Vue.component('goalscorers', require('./components/goalscorers').default);
Vue.component('team-players', require('./components/teamplayers').default);
Vue.component('team-stats', require('./components/teamstats').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
