import Vue from 'vue/dist/vue';
import Vuex from 'vuex';
import team from './modules/team';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
        universityProfile: null
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setUniversityProfile(state, profile) {
            state.universityProfile = profile;
        }
    },
    getters: {
        getUser(state) {
            return state.user;
        }
    },
    modules: {
        team
    }
});
