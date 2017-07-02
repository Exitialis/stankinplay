const mde = require('../../../components/mde.vue')

Vue.component('create-news', {
  components: {
    mde
  },

  props: {
    id: { requred: true, type: String}
  },

  data() {
    return {
      form: {
        name: '',
        content: '',
        image: null
      }
    }
  },

  methods: {
    save (url) {
      const formData = new FormData()

      formData.append('image', this.form.image)
      formData.append('name', this.form.name)
      formData.append('content', this.form.content)

      this.$http.post(url, formData).then(result => {
        console.log(result)
      }).catch(err => {
        console.log(err)
      })
    },

    uploadImage () {
      let fileInput = document.getElementById(this.id)

      this.form.image = fileInput.files[0]
      console.log(this.form.image)
    }
  }
})
