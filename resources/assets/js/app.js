require('./bootstrap');

require('./views')

import store from './store';

const app = new Vue({
    store,
    el: '#wrapper',

    created() {
        store.commit('setUser', window.user);
    }
});
