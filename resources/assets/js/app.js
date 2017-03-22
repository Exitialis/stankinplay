require('./bootstrap');

require('./views')

require('./components')

import store from './store';

const app = new Vue({
    store,
    el: '#wrapper',

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