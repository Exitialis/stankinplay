import Vue from 'vue/dist/vue';
import Vuex from 'vuex';
import team from './modules/team';
import * as types from './mutation-types';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
        universityProfile: null,
        permissions: []
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setUniversityProfile(state, profile) {
            state.universityProfile = profile;
        },
        [types.RECEIVE_USER_PERMISSION](state, permission, value) {
            state.permissions[permission] = value;
        }
    },
    actions: {

    },
    getters: {
        getUser(state) {
            return state.user;
        },
        getPermissions(state) {
            return state.permissions
        }
    },
    modules: {
        team
    }
});
