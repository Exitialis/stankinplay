Vue.component('login', {

    data() {
        return {
            errors: {},
            form: {
                login: null,
                password: null,
            },
            loading: false,
            confirm: false
        }
    },

    methods: {
        login(url) {
            this.$http.post(url, this.form).then(response => {
                this.loading = false;
                this.confirm = true;
                this.errors = {}
            }).catch(response => {
                this.loading = false;
                if (response.status === 422) {
                    this.errors = JSON.parse(response.body);
                    window.toastr.error('При авторизации произошла ошибка.')
                }
            });
        }
    }

});
