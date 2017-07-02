require('./create')
require('./show')

const urlParser = require('url');

Vue.component('admin-news', {

  props: {
    ajaxUrl: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      url: this.ajaxUrl,
      news: [],
      form: {},
      errors: {},
      loading: false,
      currentPage: 1,
      totalPages: 0,
      perPage: 10,
    }
  },

  methods: {
    fetchNews(page) {
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
  },

  created() {
    this.fetchNews()
  }

});
