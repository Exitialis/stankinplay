import { mapGetters } from 'vuex';

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
        ...mapGetters({
            user: 'getUser'
        })
    },

    methods: {
        store(url) {
            this.$http.post(url, this.form).then(response => {
                this.errors = {};
                $('#createTeam').modal('hide');
                this.$store.dispatch('loadTeamWithUsersToInvite');
            }).catch(response => {
                if (response.status === 422) {
                    this.errors = response.data;
                    window.toastr.error('При создании команды произошла ошибка.')
                }
            })
        }
    },

    mounted() {
        this.form.discipline = this.user.discipline_id;
    }

});
