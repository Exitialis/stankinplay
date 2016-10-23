Vue.component('select-list', {
    template: '\
        <div class="form-group">\
          <label :class="{\'col-sm-2\': horizontal == 1}">{{ label }}:</label>\
          <div :class="{\'col-sm-10\': horizontal == 1}">\
              <select class="form-control" @change="select">\
                <option value="null"></option>\
                <option v-for="item in items"  :value="item.id">\
                    {{ item.name }}\
                </option>\
              </select>\
          </div>\
        </div>\
    ',
    props: ['url', 'value', 'label', 'horizontal'],
    data() {
        return {
            items: null
        }
    },
    methods: {
        loadItems() {
            this.$http.get(this.url).then(
                response => {
                    this.items = response.data;
                }
            )
        },
        select(event) {
            this.$emit('input', event.target.value)
        }
    },
    mounted() {
        this.loadItems();
    }
})
