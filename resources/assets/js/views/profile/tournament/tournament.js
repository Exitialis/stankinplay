Vue.component('tournament', {

    computed: {
        user() {
            return this.$store.state.user;
        }

    },
    data() {
        return {
            tournament: null,
            url: '/tournament/games'
        }
    },

    methods: {
            start() {
                this.$http.get(this.url).then(
                    response => {
                        this.tournament = response.data.tournament;
                        console.log(this.tournament);
                    }

                )
            }
    },

    mounted() {

        this.start();
    }



});