Vue.component('invite-user', {

    props: {
        team: {
            type: Object,
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
                    window.toastr.success('Приглашение было успешно отправлено');
                    this.getOptions();
                    this.form.user_id = null;
                    this.$emit('newInvite', response.data.invite);
                    this.errors = {};
                }
            ).catch(
                response => {
                    window.toastr.error('При отправке приглашения произошла ошибка');

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


