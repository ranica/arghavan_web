import VueFormWizard from 'vue-form-wizard';
Vue.use(VueFormWizard)


new Vue({
    el: '#app',

    components: {
        // CarSearchCard
    },

    data: {

    },

    methods: {
        /**
         * Edit data
         *
         * @param      {<type>}  userData  The user data
         */
        editRecord(userData){
            alert ('Edit data');
        },

          /**
         * File Select for Image file
         */
        fileSelect(sender) {
            let file = sender.target.files[0];

            this.file = file;
        },
    }
})
