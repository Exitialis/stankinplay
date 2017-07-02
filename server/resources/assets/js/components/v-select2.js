var urlParser = require('url');

Vue.component('v-select2', {

    template: `
        <select ref="select" class="form-control" :multiple="multiple" :disabled="disabled">
            <option v-if="defaultValue" :value="defaultValue.id" selected="selected">{{ defaultValue.text }}</option>
        </select>
    `,

    props: {
        value: { default: null, required: true},
        defaultValue: { default: null, type: Object},
        ajaxUrl: {default: 'name', required: true, type: String},
        ajaxParams: {default: null, type: Object},
        multiple: {default: null, type: String},
        disabled: {default: null, type: String},
    },

    data() {
        return {
            selected: null,
        }
    },

    watch: {
        selected(value) {
            this.$emit('input', value)
        }
    },

    methods: {
        setSelect() {
            const vm = this
            $(this.$el).select2({
                ajax: {
                    url: function() {
                        var ajaxUrl = urlParser.parse(vm.ajaxUrl, true);
                        if (vm.ajaxParams) {
                            for(var prop in vm.ajaxParams) {
                                ajaxUrl.query[prop] = vm.ajaxParams[prop]
                            }
                        }

                        return urlParser.format(ajaxUrl)
                    },
                    dataType: 'json',
                    delay: 250,
                    processResults(data) {
                        return {
                            results: data
                        }
                    }
                }
            }).on('change',
                e => {
                    this.selected = e.target.value
                }
            )
        }
    },

    mounted() {
        this.setSelect()
    }

});