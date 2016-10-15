Vue.component('registration', {

    data() {
        return {
            errors: {},
            form: {
                login: null,
                email: null,
                password: null,
                last_name: null,
                first_name: null,
                middle_name: null,
                group: null,
                captain: false
            },
            loading: false,
            confirm: false
        }
    },

    methods: {
        store(url) {
            this.$http.post(url, this.form).then(response => {
                this.loading = false;
                this.confirm = true;
                this.errors = {}
            }).catch(response => {
                this.loading = false;
                if (response.status === 422)
                    this.errors = JSON.parse(response.body);
            })
        }
    },

    ready() {
        
    }



});