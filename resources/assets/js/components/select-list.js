Vue.component('select-list', {
    template: '\
        <div class="form-group">\
          <label :class="{\'col-sm-2\': horizontal == 1}">{{ label }}:</label>\
          <div :class="{\'col-sm-10\': horizontal == 1}">\
              <select class="form-control" @change="select">\
                <option value="null"></option>\
                <option v-for="option in options"  :value="option.id">\
                    {{ option.name }}\
                </option>\
              </select>\
          </div>\
        </div>\
    ',
    props: ['url', 'value', 'options', 'label', 'horizontal'],

    methods: {
        select(event) {
            this.$emit('input', event.target.value)
        }
    }
})
