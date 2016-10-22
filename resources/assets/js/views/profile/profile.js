Vue.component('profile', {

    computed: {
        user() {
            return this.$store.state.user;
        }
    },

    data() {
        return {
            currentTab: 'main',
            create: null
        }
    },

    methods: {
        changeTab(tab) {
            this.currentTab = tab;
        }
    },
    
    mounted() {
        this.user.can('create-team')
    }

});
