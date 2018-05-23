import { mapGetters } from 'vuex';

Vue.component('game-profile', {

    computed: {
        ...mapGetters({
            user: 'getUser'
        }),
    },

    data() {
        return {
            stats: {}
        }
    },

    methods: {
        loadProfile () {
            this.$http.get('/api/users/profiles/game/' + this.user.id).then(res => {
                console.log(res)
                this.stats = res.data;
            })
        }
    },

    mounted() {
        this.loadProfile()
    }

});
