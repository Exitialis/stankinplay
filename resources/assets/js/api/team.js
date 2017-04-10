export default {

    getTeam() {
        return window.axios.get('/api/team').catch(() => {
            window.toastr.error('Не удалось получить команду');
        })
    },

    getInvites(teamId) {
        return window.axios.get(`/api/invites/${teamId}`).catch(() => {
            window.toastr.error('Не удалось получить приглашения команды');
        })
    },

    getUserInvites() {
        return window.axios.get('/api/userInvites').catch(() => {
            window.toastr.error('Не удалось получить приглашения в команду');
        })
    }

};
