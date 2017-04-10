import * as types from '../mutation-types';
import teamApi from '../../api/team';

const state = {
    team: null,
    invites: [],
    userInvites: []
};

const getters = {
    getTeam: state => state.team,
    getInvites: state => state.invites,
    getUserInvites: state => state.userInvites
};

const mutations = {
    [types.RECEIVE_TEAM](state, team) {
        state.team = team;
    },

    [types.RECEIVE_INVITES](state, invites) {
        state.invites = invites;
    },

    [types.RECEIVE_USER_INVITES] (state, userInvites) {
        state.userInvites = userInvites;
    },

    [types.SEND_INVITE](state, invite) {
        state.invites.push(invite);
    }
};

const actions = {
    loadTeamWithInvites({ commit }) {
        teamApi.getTeam().then(response => {
            commit(types.RECEIVE_TEAM, response.data.team);

            return response.data.team;
        }).then(team => {
            return teamApi.getInvites(team.id)
        }).then(response => {
            commit(types.RECEIVE_INVITES, response.data.invites);
        });
    },
    loadTeam({ commit }) {
        teamApi.getTeam().then(response => {
            commit(types.RECEIVE_TEAM, response.data.team);
        });
    },
    loadUserInvites({ commit }) {
        teamApi.getUserInvites().then(response => {
            commit(types.RECEIVE_USER_INVITES, response.data.invites);
        });
    },
    loadInvites({ commit, state }) {
        teamApi.getInvites(state.team.id).then(response => {
            commit(types.RECEIVE_INVITES, response.data.invites);
        });
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};