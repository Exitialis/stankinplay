require('./bootstrap');

require('./admin')

import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'

Vue.use(VueRouter)

const app = new Vue({
    store,
    el: '#admin',

    created() {
        var v = this;

        if ( ! window.user || window.user === undefined) {
            store.commit('setUser', null);
        } else {
            window.user.can = function(permission) {
                return v.$http.post('/permission-check', {permission: permission});
            };
            store.commit('setUser', window.user);
        }
    }
});

