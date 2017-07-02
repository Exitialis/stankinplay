import { mapGetters } from 'vuex';
import * as types from '../../../store/mutation-types';

Vue.component('invite-user', {

    props: {
        team: {
            type: Object,
            default: null
        }
    },

    computed: {
        ...mapGetters({
            team: 'getTeam',
            invites: 'getInvites',
            userInvites: 'getUserInvites',
            user: 'getUser',
            permissions: 'getPermissions',
            options: 'getUsersToInvite'
        }),
    },

    data() {
        return {
            errors: {},
            form: {
                user_id: null,
                team_id: null,
            }
        }
    },

    methods: {
        send(url) {
            this.form.team_id = this.team.id;
            this.$http.post(url, this.form).then(response => {
                $('#inviteUser').modal('hide');
                window.toastr.success('Приглашение было успешно отправлено');
                this.form.user_id = null;
                this.$store.commit(types.SEND_INVITE, response.data.invite);
                this.errors = {};
            }).catch(response => {
                window.toastr.error('При отправке приглашения произошла ошибка');

                if (response.status === 422) {
                    this.errors = response.data;
                }
            })
        },
        getOptions() {
            this.$http.get(`/api/team/users`).then(response => {
                this.options = response.data;
            }).catch(response => {
                console.log(response);
            })
        }
    },

    mounted() {
        if (this.permissions['manageTeam']) {
            this.$store.dispatch('loadUsersToInvite');
        }
    }
});


