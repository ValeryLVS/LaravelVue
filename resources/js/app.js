require('./bootstrap');

window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import { createApp } from 'vue';
import store from "./store"

const app = createApp({
    el: '#app',
    created() {
        let url = window.location.pathname
        let slug = url.substring(url.lastIndexOf('/')+1)

        this.$store.commit('SET_SLUG',slug )
        this.$store.dispatch('article/getArticleData', slug)
        this.$store.dispatch('article/viewsIncrement', slug)
    }
})

app.component('article-component', require('./components/ArticleComponent.vue').default);
app.component('views-component', require('./components/ViewsComponent.vue').default);
app.component('likes-component', require('./components/LikesComponent.vue').default);
app.component('comments-component', require('./components/CommentsComponent.vue').default);

app.use(store).mount('#app');

