Vue.component('profile', {

    computed: {
        user() {
            return this.$store.state.user;
        }
    },

    data() {
        const universityProfile = this.universityProfile || {};

        return {
            currentTab: 'main',
            createTeam: null,
            universityProfile: {},
            form: {
                module: universityProfile.module || false,
                group: universityProfile.group || {},
                studentID: universityProfile.studentID || '',
                budget: universityProfile.budget || false,
                grants: universityProfile.grants || false
            },
            ready: false,
        }
    },

    methods: {
        changeTab(tab) {
            this.currentTab = tab;
        },
        loadProfile() {
            this.ready = false;

            this.$http.get('/api/users/profiles/university/' + this.user.id).then(
                response => {
                    const universityProfile = response.data.profile;
                    this.universityProfile = universityProfile;
                    this.form.module = universityProfile.module || false;
                    this.form.budget = universityProfile.budget || false;
                    this.form.grants = universityProfile.grants || false;
                    this.form.group = universityProfile.group || {};
                    this.ready = true;
                }
            )
        }
    },

    mounted() {
        this.loadProfile();
    }

});
