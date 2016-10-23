Vue.component('create-team', {
    
    data() {
        return {
            errors: {},
            form: {
                name: null,
                discipline: null
            }
        }
    },

    methods: {
        store(url) {
            this.$http.post(url, this.form).then(response => {
                this.errors = {};
                $('#createTeam').modal('hide');
            }).catch(response => {
                if (response.status === 422) {
                    this.errors = JSON.parse(response.body);
                    window.toastr.error('При создании команды произошла ошибка.')
                }
            })
        },
    }

});
