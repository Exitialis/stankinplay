Vue.component('team', {

    computed: {
        user() {
            return this.$store.state.user;
        },
        team() {
            return this.$store.state.team;
        },
        invites() {
            return this.$store.state.invites;
        },
        userInvites() {
            return this.$store.state.userInvites;
        }
    },

    data() {
        return {
            manageTeam: null,
            url: '/team'
        }
    },
    
    methods: {
        loadTeam() {
            this.$http.get(this.url).then(
                response => {
                    this.$store.commit('setTeam', response.data.team);
                    if ( ! this.invites) {
                        this.loadInvites();
                    }
                }
            ).catch(
                response => {
                    console.log(response)
                }
            )
        },
        loadInvites() {
            this.$http.get('/invites/' + this.team.id).then(
                response => {
                    this.$store.commit('setInvites', response.data.invites)
                }
            )
        },
        loadUserInvites() {
            this.$http.get('/invites').then(
                response => {
                    this.$store.commit('setUserInvites', response.data.invites);
                }
            )
        }
    },

    mounted() {
        if ( ! this.team) {
            this.loadTeam();
        }

        if ( ! this.userInvites) {
            this.loadUserInvites();
        }

        this.user.can(['create-team', 'edit-team']).then(
            response => {
                this.manageTeam = response.data.can;
            }
        );
    }
    
});
