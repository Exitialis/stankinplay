var urlParser = require('url');

Vue.component('admin-users', {

    props: {
        ajaxUrl: {
            type: String,
            required: true
        },
        form: {

        },
        errors: {}
    },

    data() {
        return {
            users: [],
            url: this.ajaxUrl
        }
    },

    methods: {
        sortBy(field) {
            //Разбираем ссылку
            let url = urlParser.parse(this.url, true);

            if (url.query.sort === field) {
                if (url.query.order === 'desc') {
                    url.query.order = 'asc';
                } else {
                    url.query.order = 'desc';
                }
            } else {
                url.query.sort = field;
            }

            //Необходимо для корректной работы библиотеки.
            url.search = '';

            url = urlParser.format(url);

            this.url = url;
        }
    }

});