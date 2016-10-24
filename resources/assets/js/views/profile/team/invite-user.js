Vue.component('invite-user', {
    computed: {
        team() {
            return this.$store.state.team;
        },
        user() {
            return this.$store.state.user;
        }
    },

    data() {
        return {
            errors: {},
            form: {
                user_id: null,
                team_id: null,
            }
        }
    },

    methods: {
        send(url) {
            this.form.team_id = this.team.id;
            this.$http.post(url, this.form).then(
                response => {
                    this.erorrs = {};
                }
            ).catch(
                response => {
                    if (response.status === 422) {
                        this.errors = JSON.parse(response.body);
                    }
                }
            )
        }
    },

    mounted() {
                
    }
});


