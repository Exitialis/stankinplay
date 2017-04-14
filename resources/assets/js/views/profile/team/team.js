import { mapGetters } from 'vuex';

Vue.component('profile-team', {

    computed: {
        ...mapGetters({
            user: 'getUser',
            team: 'getTeam',
            invites: 'getInvites',
            userInvites: 'getUserInvites'
        }),
    },

    data() {
        return {
            manageTeam: null,
        }
    },

    methods: {
        acceptInvite(id) {
            this.$http.put('/api/invites', {
                invite_id: this.userInvites[id].id,
                action: 'accept'
            }).then(() => {
                this.$store.dispatch('acceptInvite', id);
            })
        },
        declineInvite(id) {
            this.$http.put('/api/invites', {
                invite_id: this.userInvites[id].id,
                action: 'decline'
            }).then(response => {
                if (response.data.status) {
                    let invites = this.userInvites.splice(id, 1);
                    this.$store.commit('setUserInvites', invites);
                }
            })
        },
        loadOptions() {
            this.$store.dispatch('loadUsersToInvite');
        }
    },

    mounted() {
        this.$store.dispatch('loadUserInvites');

        this.user.can(['create-team', 'edit-team']).then(response => {
            this.manageTeam = response.data.can;

            this.$store.commit('RECEIVE_USER_PERMISSION', 'manageTeam', response.data.can);

            if (this.manageTeam) {
                this.$store.dispatch('loadTeamWithInvites');
            } else {
                this.$store.dispatch('loadTeam');
            }
        });


    }

});
