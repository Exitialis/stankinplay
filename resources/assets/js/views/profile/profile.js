Vue.component('profile', {

    computed: {
        user() {
            return this.$store.state.user;
        }
    },

    data() {
        return {
            currentTab: 'main',
            createTeam: null
        }
    },

    methods: {
        changeTab(tab) {
            this.currentTab = tab;
        }
    }

});
