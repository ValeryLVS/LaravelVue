import { createApp } from 'vue';
import Vuex from 'vuex'

const app = createApp({});
import * as article from './modules/article.js'


export default new Vuex.Store({
    modules: {
        article
    },
    state: {
        slug: '',
    },
    actions: {

    },
    getters: {
        articleSlugRevers(state) {
            return state.slug.split('').reverse().join('');
        },
    },
    mutations: {
        SET_SLUG(state, payload) {
            state.slug = payload;
        }
    }
})


