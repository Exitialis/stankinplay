const urlParser = require('url');

Vue.component('teams', {

    data() {
        return {
            teams: null,
            loading: false,
            url: '/api/team/lists',
            currentPage: 1,
            totalPages: 0,
            perPage: 10,
        }
    },

    methods: {
        fetchTeams(page) {
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
                this.teams = response.data.data;
                this.loading = false;
            }).catch(error => {
                console.log(error);
            })
        },
        membersCount(id) {
            return this.teams[id].members.length;
        }
    },

    mounted() {
        this.fetchTeams();
    }

});
