import Vue from 'vue/dist/vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
        team: null,
        invites: null,
        userInvites: null,
        tournament: null
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setTeam(state, team) {
            state.team = team;
        },
        setInvites(state, invites) {
            state.invites = invites;
        },
        setUserInvites(state, invites) {
            state.userInvites = invites;
        },
        setTour(state, tournament) {
            state.tournament = tournament;
        }
    },
    getters: {
        team(state) {
            return state.team;
        }
    }
});
