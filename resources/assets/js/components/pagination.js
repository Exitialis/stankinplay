var urlParser = require('url');

Vue.component('pagination', {

    template: `
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-pills" v-if="pages.length > 1">
                    <li v-if="prev_page_url" class="active">
                        <a href="#" @click.prevent="prevPage()" v-text="'<<'"></a>
                    </li>
                    <li v-for="page in pages" :class="{active: page.active}">
                        <a href="#" @click.prevent="changePage(page.number)">{{ page.number }}</a>
                    </li>
                    <li v-if="next_page_url" class="active">
                        <a href="#" @click.prevent="nextPage()" v-text="'>>'"></a>
                    </li>
                </ul>
            </div>
        </div>
    `,

    props: {
        pagesToShow: {
            type: Number,
            default: 5
        },
        url: {
            type: String,
            required: true
        },
        value: {},
    },

    data() {
        return {
            next_page_url: null,
            prev_page_url: null,
            current_page: null,
            last_page: null,
            ready: false,
            loading: false,
            temp: urlParser
        }
    },

    computed: {
        pages() {
            let diff = this.current_page - Math.floor(this.pagesToShow / 2)
            //начальная страница - первая, конечная - первая + разница
            let firstPage = 1
            let lastPage = firstPage + this.pagesToShow

            if (lastPage > this.last_page) {
                lastPage = this.last_page + 1
            }

            if (this.last_page > this.pagesToShow) {
                if (diff > 0) {
                    firstPage = diff
                    lastPage = firstPage + this.pagesToShow
                    if (lastPage > this.last_page) {
                        lastPage = this.last_page + 1
                        firstPage = lastPage - this.pagesToShow
                    }
                }
            }

            var pages = []

            for (var i = firstPage;i < lastPage; i++) {
                pages.push({
                    number: i,
                    active: this.current_page == i
                })
            }

            return pages
        }
    },

    methods: {
        loadData(page) {
            if (this.loading) return;
            var url = urlParser.parse(this.url, true);
            if (page) {
                url.query.page = page;
                url.search = '';
            }
            url = url.format();
            this.loading = true;
            this.$http.get(url).then(
                response => {
                    this.$emit('input', response.data.data)
                    this.next_page_url = response.data.next_page_url
                    this.prev_page_url = response.data.prev_page_url
                    this.current_page = response.data.current_page
                    this.last_page = response.data.last_page
                    this.loading = false
                    this.ready = true
                }
            )
        },
        changePage(page) {
            this.loadData(page)
        },
        prevPage() {
            var page = this.current_page - 1
            this.loadData(page)
        },
        nextPage() {
            var page = this.current_page + 1
            this.loadData(page)
        }
    },

    watch: {
        loading(value) {
            this.$emit('loading', value)
        },
        ready(value) {
            this.$emit('ready', value)
        },
        url(value) {
            this.loadData();
        }
    },

    created() {
        this.loadData()
    }

});
