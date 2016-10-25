Vue.component('invite-user', {
    computed: {
        team() {
            return this.$store.state.team;
        },
        user() {
            return this.$store.state.user;
        },
        invites() {
            return this.$store.state.invites;
        }
    },

    data() {
        return {
            errors: {},
            form: {
                user_id: null,
                team_id: null,
            },
            options: null
        }
    },

    methods: {
        send(url) {
            this.form.team_id = this.team.id;
            this.$http.post(url, this.form).then(
                response => {
                    $('#inviteUser').modal('hide');
                    this.getOptions();
                    var invites = this.invites.concat([response.data.invite]);
                    this.$store.commit('setInvites', invites);
                    this.erorrs = {};
                }
            ).catch(
                response => {
                    if (response.status === 422) {
                        this.errors = JSON.parse(response.body);
                    }
                }
            )
        },
        getOptions() {
            this.$http.get('/users', {
                    params: {
                        discipline: this.user.discipline_id,
                    }
                }).then(
                response => {
                    this.options = response.data;
                }
            ).catch(
                response => {
                    console.log(response);
                }
            )
        }
    },

    mounted() {
        this.getOptions()
    }
});


