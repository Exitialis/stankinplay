Vue.component('navbar', {

    computed: {
        currentUrl() {
            return window.location.href;
        }
    },

    data() {
        return {

        }
    },

    methods() {

    },

    mounted() {
        alert('Я родился')
    }

});
