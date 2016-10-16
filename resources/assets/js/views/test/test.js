Vue.component('test', {

    methods: {
        request() {
            this.$http.post('/test').
            then(
                response => {
                    console.log(response)
            }).catch(
                response => {
                    console.log(response)
                }
            );
        }
    }


});
