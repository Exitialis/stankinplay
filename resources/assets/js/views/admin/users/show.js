Vue.component('admin-users-show', {
    props: {
        user: {
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
        }
    },

    data() {
        return {

        }
    },

    computed: {
        roles() {
            if(this.user.roles) {
                return this.user.roles.map(item => item.name);
            }

            return null;
        }
    },

    methods: {
        setMemberRole() {
            this.$http.put(this.updateUrl, {
                roles: ['member']
            }).then(res => {

            }).catch(err => {
                console.log(err);
            })
        },

        removeMemberRole() {
            this.$http.delete(this.deleteUrl, {
                roles: ['member']
            }).then(res => {

            }).catch(err => {
                console.log(err);
            })
        }
    }

});
