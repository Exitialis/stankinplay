import urlFormater from 'url';

Vue.component('admin-users-show', {
    props: {
        userProp: {
            type: Object,
            required: true
        },
        updateUrl: {
            type: String,
            required: true
        },
        deleteUrl: {
            type: String,
            required: true
        },
        roles: {
            type: Array,
            required: true
        },
        userApiUrl: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            form: {},
            errors: {},
            loading: false,
            user: this.userProp
        }
    },

    computed: {
        userRolesNames() {
            if(this.user.roles) {
                return this.user.roles.map(item => item.name);
            }

            return null;
        }
    },

    methods: {
        thenCallback(res)  {
            this.loading = false;
            this.errors = {};
            this.updateUser();
        },

        catchCallback(err) {
            this.loading = false;
            if(err.status === 422) {
                this.errors = err.data;
                window.toastr.error('При изменении ролей произошла ошибка.')
            } else if(err.status === 403) {
                this.errors = {};
                window.toastr.error('Ошибка: Неавторизованное действие: ' + JSON.parse(err.body))
            }
        },

        setMemberRole() {
            this.loading = true;
            this.attachRoles(['member']).then(this.thenCallback).catch(this.catchCallback);
        },

        removeMemberRole() {
            this.loading = true;
            this.detachRoles(['member']).then(this.thenCallback).catch(this.catchCallback);
        },

        updateRoles() {
            let rolesToDetach = [];
            let rolesToAttach = [];

            for(let role in this.form) {
                if(this.userRolesNames.indexOf(role) !== -1) {
                    //Тут мы поняли, что роль у пользователя такая есть и в форме она встречается.
                    //Значит, нам нужно проверить, если там false, то нужно добавить их в массив на удаление.
                    if( ! this.form[role]) {
                        rolesToDetach.push(role);
                    }
                } else {
                    if(this.form[role]) {
                        rolesToAttach.push(role);
                    }
                }
            }

            let promises = [];

            if(rolesToAttach.length > 0) {
                promises.push(this.attachRoles(rolesToAttach));
            }

            if(rolesToDetach.length > 0) {
                promises.push(this.detachRoles(rolesToDetach));
            }

            if(promises.length > 0) {
                this.loading = true;

                Promise.all(promises).then(this.thenCallback).catch(this.catchCallback)
            }
        },

        attachRoles(roles) {
            return this.$http.put(this.updateUrl, {
                roles: roles
            });
        },

        detachRoles(roles) {
            let url = urlFormater.parse(this.deleteUrl);

            url.search = '';

            url.query = {
                'roles[]': roles
            };

            return this.$http.delete(url.format());
        },

        updateUser() {
            this.$http.get(this.userApiUrl).then(res => {
                this.user = res.data.user;
            }).catch(err => {

            })
        }
    },

    created() {
        let rolesName = this.roles.map(item => item.name);

        rolesName.forEach(item => {
            this.form[item] = this.userRolesNames.indexOf(item) !== -1;
        })
    }

});
