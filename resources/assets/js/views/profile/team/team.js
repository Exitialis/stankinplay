Vue.component('team', {

    computed: {
        user() {
            return this.$store.state.user;
        }
    },

    data() {
        return {
            team: null,
            url: '/team',
            createTeam: null
        }
    },
    
    methods: {
        loadTeam() {
            this.$http.get(this.url).then(
                response => {
                    this.team = response.data.team;
                }
            ).catch(
                response => {
                    console.log(response)
                }
            )
        }
    },

    mounted() {
        this.loadTeam();

        this.user.can('create-team').then(
            response => {
                this.createTeam = response.data.can;
            }
        );
    }
    
});
