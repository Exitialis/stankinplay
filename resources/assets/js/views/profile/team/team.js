Vue.component('profile-team', {

    computed: {
        user() {
            return this.$store.state.user;
        }
    },

    data() {
        return {
            manageTeam: null,
            url: '/api/team',
            team: {},
            invites: {},
            userInvites: {},
        }
    },

    methods: {
        loadTeam() {
            this.$http.get(this.url).then(response => {
                this.team = response.data.team;

                if (!this.invites) {
                    this.loadInvites();
                }
            }).catch(response => {
                console.log(response);
            })
        },
        loadInvites() {
            this.$http.get('/invites/' + this.team.id).then(response => {
                this.invites = response.data.invites
            })
        },
        loadUserInvites() {
            this.$http.get('/invites').then(response => {
                this.userInvites = response.data.invites;
            })
        },
        acceptInvite(id) {
            this.$http.put('/invites', {
                invite_id: this.userInvites[id].id,
                action: 'accept'
            }).then(response => {
                if (response.data.status) {
                    let invites = this.userInvites;

                    invites = invites.splice(id, 1);

                    this.invites = invites;
                    this.loadTeam();
                }
            })
        },
        declineInvite(id) {
            this.$http.put('/invites', {
                invite_id: this.userInvites[id].id,
                action: 'decline'
            }).then(response => {
                if (response.data.status) {
                    let invites = this.userInvites.splice(id, 1);
                    this.$store.commit('setUserInvites', invites);
                }
            })
        },
    },

    mounted() {
        this.loadTeam();
        this.loadUserInvites();

        this.user.can(['create-team', 'edit-team']).then(
            response => {
                this.manageTeam = response.data.can;
            }
        );
    }

});
