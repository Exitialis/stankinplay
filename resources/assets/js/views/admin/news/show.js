const mde = require('../../../components/mde.vue')

Vue.component('show-news', {
  components: {
    mde
  },

  props: {
    id: {required: true, type: String},
    ajaxUrl: {required: true, type: String}
  },

  data() {
    return {
      fetched: null,
      form: {
        name: '',
        content: '',
        image: null
      }
    }
  },

  mounted () {
    this.fetchNews()
  },

  methods: {
    fetchNews () {
      this.$http.get(this.ajaxUrl).then(news => {
        news = news.data

        this.form.name = news.name
        this.form.content = news.content
        this.form.image = news.image

        this.fetched = news.content
      }).catch(err => {
        console.log(err)
      })
    },
    save (url) {
      const formData = new FormData()

      // formData.append('image', this.form.image)
      formData.append('name', this.form.name)
      formData.append('content', this.form.content)

      console.log(formData)

      this.$http.put(url, formData).then(result => {
        console.log(result)
      }).catch(err => {
        console.log(err)
      })
    },

    uploadImage () {
      let fileInput = document.getElementById(this.id)

      this.form.image = fileInput.files[0]
    }
  }
})