/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueTippy, { TippyComponent } from "vue-tippy";

Vue.use(VueTippy);
Vue.component("tippy", TippyComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent').default);
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
Vue.component('team-stats', require('./components/teamstats.vue').default);
Vue.component('next-game', require('./components/nextgame').default);
Vue.component('login', require('./components/login').default);
Vue.component('countryList', require('./components/countryList').default);
Vue.component('chat', require('./components/chat').default);
Vue.component('notifications', require('./components/notifications').default);
Vue.component('player-select', require('./components/playerSelect').default);
Vue.component('player-dropdown', require('./components/playerDropdown').default);
Vue.component('follow-game-button', require('./components/followGameButton').default);
Vue.component('followed-game-dropdown', require('./components/followedGamesDropdown').default);
Vue.component('user-followed-games', require('./components/userFollowedGames').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

const login = new Vue({
    el: '#notify_user_icons',
});

let topmenu = new Vue({
    el: '#games_scroll_vue',
})
