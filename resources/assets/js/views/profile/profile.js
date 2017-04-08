Vue.component('profile', {

    computed: {
        user() {
            return this.$store.state.user;
        },
        group() {
            if (this.universityProfile.group) {
                return {
                    id: this.universityProfile.group.id,
                    text: this.universityProfile.group.name
                }
            }

            return null;
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
                group_id: universityProfile.group || {},
                studentID: universityProfile.studentID || '',
                budget: universityProfile.budget || false,
                grants: universityProfile.grants || false,
                anotherSections: universityProfile.anotherSections || false,
                gto: universityProfile.gto || false,
                socialActivity: universityProfile.socialActivity || false
            },
            errors: {},
            ready: false,
        }
    },

    methods: {
        loadProfile() {
            this.ready = false;

            this.$http.get('/api/users/profiles/university/' + this.user.id).then(
                response => {
                    const universityProfile = response.data.profile;
                    this.universityProfile = universityProfile;
                    this.form.module = universityProfile.module || false;
                    this.form.budget = universityProfile.budget || false;
                    this.form.grants = universityProfile.grants || false;
                    this.form.studentID = universityProfile.studentID || '';
                    this.form.anotherSections = universityProfile.anotherSections || false;
                    this.form.gto = universityProfile.gto || false;
                    this.form.socialActivity = universityProfile.socialActivity || false;
                    if ( ! universityProfile.studentID) {
                        window.toastr.info('Пожалуйста, заполните данные в разделе дополнительная информация');
                    }
                    this.form.group_id = universityProfile.group ? universityProfile.group.id || null : null;
                    this.ready = true;
                }
            )
        },
        submit(url) {
            this.$http.put(url, this.form).then(
                response => {
                    window.toastr.success('Сохранено.')
                }
            ).catch(
                response => {
                    if (response.status === 422) {
                        this.errors = JSON.parse(response.body);
                    }

                    window.toastr.error('При сохранении произошла ошибка.')
                }
            )
        }
    },

    mounted() {
        this.loadProfile();
    }

});
