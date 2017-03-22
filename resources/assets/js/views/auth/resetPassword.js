Vue.component('resetPassword', {

    props: ['code'],

    data() {
        return {
            errors: {},
            form: {
                password: null,
                password2: null,
                code: this.code
            },
            loading: false,
            confirm: false
        }
    },

    methods: {
        reset(url) {
            this.$http.post(url, this.form).then(response => {
                this.loading = false;
                this.confirm = true;
                this.errors = {}
            }).catch(response => {
                this.loading = false;
                if (response.status === 422) {
                    this.errors = JSON.parse(response.body);
                    window.toastr.error('При сохранении пароля произошла ошибка.')
                }
            });
        }
    }

});