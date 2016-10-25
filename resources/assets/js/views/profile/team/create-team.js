Vue.component('create-team', {

    data() {
        return {
            errors: {},
            form: {
                name: null,
                discipline: null
            },
            options: null
        }
    },

    computed: {
        user() {
            return this.$store.state.user;
        }
    },

    methods: {
        store(url) {
            this.$http.post(url, this.form).then(response => {
                this.errors = {};
                $('#createTeam').modal('hide');
                this.$store.commit('setTeam', response.data.team);
            }).catch(response => {
                if (response.status === 422) {
                    this.errors = JSON.parse(response.body);
                    window.toastr.error('При создании команды произошла ошибка.')
                }
            })
        }
    },

    mounted() {
        this.form.discipline = this.user.discipline_id;
    }

});
