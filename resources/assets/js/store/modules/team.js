import * as types from '../mutation-types';
import teamApi from '../../api/team';

const state = {
    team: null,
    invites: [],
    userInvites: [],
    usersToInvite: []
};

const getters = {
    getTeam: state => state.team,
    getInvites: state => state.invites,
    getUserInvites: state => state.userInvites,
    getUsersToInvite: state => state.usersToInvite
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
    },

    [types.ACCEPT_INVITE](state, id) {
        state.userInvites.splice(id, 1);
    },

    [types.DECLINE_INVITE](state, id) {
        state.userInvites.splice(id, 1);
    },

    [types.RECEIVE_USERS_TO_INVITE](state, users) {
        state.usersToInvite = users;
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
    loadUsersToInvite({ commit }) {
        teamApi.getUsersToInvite().then(users => {
            commit(types.RECEIVE_USERS_TO_INVITE, users.data);
        });
    },
    loadUserInvites({ commit }) {
        teamApi.getUserInvites().then(response => {
            commit(types.RECEIVE_USER_INVITES, response.data.invites);
        });
    },
    acceptInvite({ commit }, id) {
        commit(types.ACCEPT_INVITE, id);

        teamApi.getTeam().then(response => {
            commit(types.RECEIVE_TEAM, response.data.team);
        });
    },
    declineInvite({ commit }, id) {
        commit(types.DECLINE_INVITE, id);

        teamApi.getTeam().then(response => {
            commit(types.RECEIVE_TEAM, response.data.team);
        });
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
