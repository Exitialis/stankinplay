import Vue from 'vue/dist/vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
        team: null
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setTeam(state, team) {
            state.team = team;
        }
    },
    getters: {
        team(state) {
            return state.team;
        }
    }
});
