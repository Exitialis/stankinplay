var urlParser = require('url');

Vue.component('admin-users', {

    props: {
        ajaxUrl: {
            type: String,
            required: true
        }
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
            //Добавляем sort в параметры
            url.query['sort'] = field;

            this.url = urlParser.format(url);
        }
    }

});