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
                group_id: null,
                discipline: null,
                captain: false,
                module: false
            },
            loading: false,
            confirm: false,
            registration: false,
            disciplines: null
        }
    },

    methods: {
        store(url) {
            this.$http.post(url, this.form).then(response => {
                this.loading = false;
                this.confirm = true;
                this.errors = {};
            }).catch(response => {
                this.loading = false;
                if (response.status === 422) {
                    this.errors = response.data;
                    window.toastr.error('При регистрации произошла ошибка.')
                }
            })
        },
        getDisciplines() {
            this.$http.get('/api/disciplines').then(
                response => {
                    this.disciplines = response.data;
                }
            ).catch(
                response => {
                    console.log(response);
                }
            )
        }
    },

    mounted() {
        this.getDisciplines();
    }
});