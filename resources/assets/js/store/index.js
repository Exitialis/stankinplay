import Vue from 'vue/dist/vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
        permissions: null
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setPermissions(state, permissions) {
            state.permissions = permissions;
        }
    }
});
