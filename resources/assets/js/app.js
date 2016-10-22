require('./bootstrap');

require('./views')

import store from './store';

const app = new Vue({
    store,
    el: '#wrapper',

    created() {
        var v = this;

        store.commit('setUser', window.user);

        if ( ! window.user || window.user === undefined) {
            store.commit('setUser', null);
        } else {
            window.user.can = function(permission) {
                return v.$http.get('permission-check/' + permission);
            };
            store.commit('setUser', window.user);
        }


    }
});
