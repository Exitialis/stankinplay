Vue.component('create-team', {
    
    data() {
        return {
            errors: {},
            form: {
                name: null
            },
            options: null
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
        },
        getOptions() {
            this.$http.get('/disciplines').then(
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
        this.getOptions();
    }

});
