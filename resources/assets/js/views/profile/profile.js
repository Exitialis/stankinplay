Vue.component('profile', {

    computed: {
        user() {
            return this.$store.state.user;
        }
    },

    data() {
        return {
            currentTab: 'main'
        }
    },

    methods: {
        changeTab(tab) {
            this.currentTab = tab;
        }
    }

});
