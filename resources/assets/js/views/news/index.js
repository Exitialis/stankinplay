import {markdown} from 'markdown';
const urlParser = require('url');

Vue.component('news', {
  props: {
    ajaxUrl: { required: true, type: String }
  },

  data () {
    return {
      news: [],
      url: this.ajaxUrl,
      loading: false,
      currentPage: 1,
      totalPages: 0,
      perPage: 10,
    }
  },

  methods: {
    fetchNews (page) {
      this.loading = true;

      if(page) {
        let url = urlParser.parse(this.url, true);
        url.query.page = page;
        url.search = '';
        this.url = url.format();
      }

      this.$http.get(this.url).then(response => {
        this.totalPages = response.data['last_page'];
        this.perPage = response.data['per_page'];
        this.currentPage = response.data['current_page'];
        this.news = response.data.data;
        this.loading = false;
      }).catch(error => {
        console.log(error);
      })
    },
    toHtml (content) {
      return markdown.toHTML(content.substr(0, 128))
    }
  },

  created () {
    this.fetchNews()
  }
})
