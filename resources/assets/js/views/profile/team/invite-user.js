Vue.component('invite-user', {

    props: {
        team: {
            type: String,
            default: null
        }
    },

    computed: {
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
                    this.form.user_id = null;
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
            this.$http.get(`/api/team/users`, {
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


