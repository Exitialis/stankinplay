Vue.component('forgot', {

    data() {
        return {
            errors: {},
            form: {
                login: null
            },
            loading: false,
            confirm: false,
            success: false
        }
    },

    methods: {
        reset(url) {
            this.$http.post(url, this.form).then(response => {
                this.loading = false;
                this.confirm = true;
                this.errors = {};
                this.success = true;
            }).catch(response => {
                this.loading = false;
                if (response.status === 422) {
                    this.errors = response.data;
                    window.toastr.error('При сбросе пароля произошла ошибка.')
                } else if (response.status === 403) {
                    window.toastr.error('При сбросе пароля произошла ошибка.')
                }
            });
        }
    }

});