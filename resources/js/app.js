/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


//window.Vue = require('vue').default;
import { createApp } from 'vue';
import store from './store'


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = createApp({})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
app.component('article-component', require('./components/ArticleComponent.vue').default);
app.component('views-component', require('./components/ViewsComponent.vue').default);
app.component('likes-component', require('./components/LikesComponent.vue').default);
app.component('comments-component', require('./components/CommentsComponent.vue').default);

createApp({
    store,
    el: '#app',
    created() {
        let url = window.location.pathname
        let slug = url.substring(url.lastIndexOf('/')+1)

        console.log(url)
        console.log(slug)
        this.$store.commit('SET_SLUG',slug )
        this.$store.dispatch('article/getArticleData', slug)
        this.$store.dispatch('article/viewsIncrement', slug)
    }
});
