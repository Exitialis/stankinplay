const urlParser = require('url');

Vue.component('admin-users', {

    props: {
        ajaxUrl: {
            type: String,
            required: true
        },
        disciplinesUrl: {
            type: String,
            required: true,
        }
    },

    data() {
        return {
            users: [],
            url: this.ajaxUrl,
            disciplines: [],
            form: {
                discipline_id: null,
                group_id: null,
                studentID: null,
                module: null,
                budget: null,
                grants: null,
            },
            errors: {},
            loading: false,
            currentPage: 1,
            totalPages: 0,
            perPage: 10,
        }
    },

    methods: {
        filter() {
            this.loading = true;

            let url = urlParser.parse(this.url, true);

            url.search = '';

            url.query.group_id = this.form.group_id;
            url.query.discipline_id = this.form.discipline_id;

            this.url = url.format();
            this.fetchUsers();

            $('#filter').modal('hide');
        },
        fetchUsers(page) {
            this.loading = true;

            if(page) {
                let url = urlParser.parse(this.url, true);
                url.query.page = page;
                url.search = '';
                this.url = url.format();
            }

            this.$http.get(this.url).then(response => {
                this.totalPages = response.data.users['last_page'];
                this.perPage = response.data.users['per_page'];
                this.currentPage = response.data.users['current_page'];
                this.users = response.data.users.data;
                this.loading = false;
            }).catch(error => {
                console.log(error);
            })
        },
        getDisciplines() {
            this.$http.get(this.disciplinesUrl).then(response => {
                this.disciplines = response.data;
            }).catch(error => {
                console.log(error);
            })
        }
    },

    created() {
        this.fetchUsers();
        this.getDisciplines();
    }

});