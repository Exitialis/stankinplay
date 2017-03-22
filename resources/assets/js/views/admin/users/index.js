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
                last_name: null,
                first_name: null,
                middle_name: null,
                module: null,
                budget: null,
                grants: null,
                anotherSections: null,
                socialActivity: null,
                gto: null,
                onlyMembers: null
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

            for(let prop in this.form) {
                if (this.form[prop] !== null) {
                    url.query[prop] = prop === 'module' || prop === 'budget' || prop === 'grants' || prop === 'gto' || prop === 'anotherSections' || prop === 'socialActivity' || prop === 'onlyMembers' ? +this.form[prop] : this.form[prop];
                }
            }

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

            console.log(this.url);

            this.$http.get(this.url).then(response => {
                this.totalPages = response.data['last_page'];
                this.perPage = response.data['per_page'];
                this.currentPage = response.data['current_page'];
                this.users = response.data.data;
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
        },
        clear() {
            for(let prop in this.form) {
                this.form[prop] = null;
            }

            let url = urlParser.parse(this.url, true);
            url.query = {};
            url.search = '';
            this.url = url.format();

            this.fetchUsers();
            $('#filter').modal('hide');
        }
    },

    created() {
        this.clear();
        this.fetchUsers();
        this.getDisciplines();
    }

});