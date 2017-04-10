import { mapGetters } from 'vuex';

Vue.component('profile-team', {

    computed: {
        ...mapGetters({
            team: 'getTeam',
            invites: 'getInvites',
            userInvites: 'getUserInvites'
        }),
        user() {
            return this.$store.state.user;
        }
    },

    data() {
        return {
            manageTeam: null,
        }
    },

    methods: {
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
        this.$store.dispatch('loadTeamWithInvites');
        this.$store.dispatch('loadUserInvites');

        this.user.can(['create-team', 'edit-team']).then(
            response => {
                this.manageTeam = response.data.can;
            }
        );
    }

});
