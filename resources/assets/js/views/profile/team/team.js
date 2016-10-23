Vue.component('team', {

    computed: {
        user() {
            return this.$store.state.user;
        },
        team() {
            return this.$store.state.team;
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
                }
            ).catch(
                response => {
                    console.log(response)
                }
            )
        }
    },

    mounted() {
        if ( ! this.team) {
            this.loadTeam();
        }

        this.user.can(['create-team', 'edit-team']).then(
            response => {
                this.manageTeam = response.data.can;
            }
        );
    }
    
});
