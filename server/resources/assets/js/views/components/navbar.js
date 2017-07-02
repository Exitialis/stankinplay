Vue.component('navbar', {

    computed: {
        currentUrl() {
            return window.location.href;
        },
        user() {
            return this.$store.state.user;
        }
    },

    methods: {
        checkUrl(url) {
            return url == this.currentUrl;
        }
    }

});
