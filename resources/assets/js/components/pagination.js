var urlParser = require('url');

Vue.component('pagination', {

    template: `
        <div class="pagination">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="nav nav-pills">
                        <li v-if="hasPrev()">
                            <a href="#" @click.prevent="changePage(prevPage)" v-text="'<<'"></a>
                        </li>
                        <li v-if="hasFirst()" :class="{active: current == 1}">
                            <a href="#" @click.prevent="changePage(1)">1</a>
                        </li>
                        <li v-for="page in pages" :class="{ active: current == page }">
                            <a href="#" @click.prevent="changePage(page)" >
                              {{ page }}
                            </a>
                        </li>
                        <li v-if="hasLast()"><a href="#" @click.prevent="changePage(totalPages)">{{ totalPages }}</a></li>
                        <li v-if="hasNext()" >
                            <a href="#" @click.prevent="changePage(nextPage)" v-text="'>>'"></a>
                        </li>
                    </ul>
                </div>
            </div>
        
            <div class="pagination__mid">
                
                   
                    
                </ul>
            </div>
            <div class="pagination__right">
                
            </div>
        </div>
    `,

    props: {
        current: {
            type: Number,
            default: 1
        },
        totalPages: {
            type: Number,
            default: 0
        },
        perPage: {
            type: Number,
            default: 9
        },
        pageRange: {
            type: Number,
            default: 2
        }
    },
    computed: {
        pages: function () {
            var pages = []

            for (var i = this.rangeStart; i <= this.rangeEnd; i++) {
                pages.push(i)
            }

            return pages
        },
        rangeStart: function () {
            var start = this.current - this.pageRange

            return (start > 0) ? start : 1
        },
        rangeEnd: function () {
            var end = this.current + this.pageRange

            return (end < this.totalPages) ? end : this.totalPages
        },
        nextPage: function () {
            return this.current + 1
        },
        prevPage: function () {
            return this.current - 1
        }
    },
    methods: {
        hasFirst: function () {
            return this.rangeStart !== 1
        },
        hasLast: function () {
            return this.rangeEnd < this.totalPages
        },
        hasPrev: function () {
            return this.current > 1
        },
        hasNext: function () {
            return this.current < this.totalPages
        },
        changePage: function (page) {
            this.$emit('page-changed', page)
        }
    }

});
