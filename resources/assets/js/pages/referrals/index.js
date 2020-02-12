import Store from '../Stores/ReferralStore';
import ReferralWidget from '../Components/ReferralWidget';
import VueFormWizard from 'vue-form-wizard';
import 'vue-form-wizard/dist/vue-form-wizard.min.css';

window.v = new Vue({
    el: '#app',

    store: Store,

    components: {
        ReferralWidget
    },

    data: {
        formMode: Enums.FormMode.normal,
        page: 1,
        ///editMode: true,
        isLoading: true,
        insertMode: false,
        tempRecord: {},
    },

    created() {
        this.tempRecord = this.emptyRecord;
        // this.prepare();
    },

    mounted() {
       this.loadRecords(this.page);
        this.setImageLoader();
    },

    computed: {

        isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,
        isShowMode: state => state.formMode == Enums.FormMode.show,

        records: state => state.$store.getters.records,
        allData: state => state.$store.getters.allData,
        hasRow: state => (0 < state.records.length),

        genders: state => state.$store.getters.genders,
        departments: state => state.$store.getters.departments,
        warranties: state => state.$store.getters.warranties,
        referralTypes: state => state.$store.getters.referralTypes,


        /**
         * Generate new Empty record
         */
        emptyRecord() {
            return {
                id: 0,
                name: '',
                lastname: '',
                mobile:'',
                nationalId: '',
                user:{
                    id:0
                },
                department:{
                    id:0
                },
                referralType:{
                    id:0
                },
                warranty:{
                    id: 0
                },
                gender: {
                    id: 0
                },
                organization:'',
                description: '',

                saveMode: true,
                editMode: true,
                listMode: true,


            };
        },

    },

    methods: {
           setImageLoader() {
                let baseVue = this;

                $("#wizard-picture").off('change');
                $("#wizard-picture").on('change', (e) => {
                    let t = $("#wizard-picture")[0].files[0];

                    if (t) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            baseVue.tempRecord.pictureUrl = e.target.result;
                    }

                    reader.readAsDataURL(t);
                }
            });
        },

        /**
         * Change form mode
         *
         * @param      {<type>}  formMode  The form mode
         */
        changeFormMode(formMode) {
            this.formMode = formMode;
        },

        /**
         * Show Invisible items
         */
        showInvisibleItems() {
            document.querySelectorAll('.invisible')
                .forEach(item => {
                    item.classList.remove('invisible');
                });
        },

        /**
         * Clear errors
         */
        clearErrors() {
            this.errors.clear();

            document.querySelectorAll('.form-control')
                .forEach(x => {
                    $(x).removeClass('has-error')
                        .parent()
                        .addClass('label-floating is-empty');
                });
        },

        /**
         * Hide insert/update modal
         */
        registerCancel() {
            this.tempRecord = this.emptyRecord;

            this.changeFormMode(Enums.FormMode.show);
        },

        /**
         * Shows the cancel. From show Page to index Page
         */
        showCancel() {
            this.tempRecord = this.emptyRecord;

            this.changeFormMode(Enums.FormMode.normal);
        },

        /**
         * File Select for Image file
         */
        fileSelect(sender) {
            let file = sender.target.files[0];

            this.file = file;
        },

        /**
         * Load warranty list
         */
        loadWarranties(callback) {
            this.$store.dispatch('loadWarranties')
                .then(res =>{
                    callback();
                })
                .catch(err =>{
                    this.isLoading = false;
                });
        },

        /**
         * Load ReferralTypes list
         */
        loadReferralTypes() {
            this.$store.dispatch('loadReferralTypes')
                .then(res =>{
                    // callback();
                    this.isLoading = false;
                })
                .catch(err =>{
                    this.isLoading = false;
                });
        },

         /**
         * Load Department list
         */
        loadDepartments(callback) {
            this.$store.dispatch('loadDepartments')
                .then(res => {
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Genders list
         */
        loadGenders(callback) {
            this.$store.dispatch('loadGenders')
                .then(res => {
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },


         /**
         * Load Records list
         */
        loadRecords(page) {
            this.page = page;
            this.isLoading = true;

            this.$store.dispatch('loadRecords', page)
                .then(res => {

                    this.loadGenders();
                    this.loadReferralTypes();
                    this.loadWarranties();
                    this.loadDepartments();
                    // this.isLoading = false;

                    this.showInvisibleItems();
                })
                .catch(err => {
                    this.isLoading = false;

                    this.showInvisibleItems();
                });
        },

        /**
         * New record dialog
         */
        newRecord() {
            this.clearErrors();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);
            this.changeFormMode(Enums.FormMode.register);
        },

        searchRecord(){
            this.clearErrors();
            this.changeFormMode(Enums.FormMode.show);
        }
    },

})
