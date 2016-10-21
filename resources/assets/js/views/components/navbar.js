Vue.component('navbar', {

    computed: {
        currentUrl() {
            return window.location.href;
        }
    },

    data() {
        return {
            menu: null,
            url: '/menu'
        }
    },

    methods: {
        getMenu() {
            this.$http.get(this.url).then(
                response => {
                    this.menu = response.data;
                    console.log(this.menu);
                }
            ).catch(
                response => {
                    console.log(response);
                }
            )
        },
        checkUrl(url) {
            return url == this.currentUrl;
        }
    },

    mounted() {
        //this.getMenu();
    }

});
