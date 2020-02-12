import Store from '../Stores/HomeStore'

window.v = new Vue({
    el: '#app',
    store: Store,

    data: {
        formMode: Enums.FormMode.normal,
        page: 1,
        isLoading: true,
        tempRecord: {
            user: {},
            people: {},
        },
    },

    created() {
        this.tempRecord.user = this.emptyRecord.user;
        this.tempRecord.people = this.emptyRecord.people;
    },

    mounted() {
        this.loadRecords();
        this.loadLock();
    },

    computed: {
        /**
         * Generate new Empty record
         */
        emptyRecord: () => {
                return {
                    id: 0,
                    user: {
                        id: 0,
                        code: '',
                        password: '',
                        email: '',
                        state: 0,
                        group: {
                            id: 0
                        },
                    },
                    people:{
                        id: 0,
                        name: '',
                        lastname: '',
                        nationalId: '',
                        mobile: '',
                        address: '',
                        pictureUrl: '',
                        melliat: {
                            id: 0,
                            name:''
                        },
                        gender: {
                            id: 0,
                            name:''
                        },
                        province: {
                            id: 0,
                            name:''
                        },
                        city: {
                            id: 0,
                            name:''
                        },

                    }
                }
        },

        isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,

        records: state => state.$store.getters.records,
        allData: state => state.$store.getters.allData,
        hasRow: state => (0 < state.records.length)
    },

    methods: {
         /**
         * Change form mode
         *
         * @param      {<type>}  formMode  The form mode
         */
        changeFormMode(formMode){
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
         * New record dialog
         */
        newRecord() {
            this.errors.clear();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);
            this.changeFormMode(Enums.FormMode.register);
        },

        login(){
            this.$validator.validateAll()
                .then(result => {
                    if (!result) {
                        this.showError('لطفا خطاها را برطرف نمایید');

                        return;
                    }

                    let data = {
                        password: this.tempRecord.user.password
                    };

                    // this.showInfo('در حال تایید هویت ...');
                   this.$store.dispatch('login', data)
                        .then(res => {
                            if (res.data.success) {
                                window.location = res.data.data;
                                return;
                            }

                            this.showError('اطلاعات شما نامعتبر می باشد');
                        })
                        .catch(err => {
                            this.showError('اطلاعات شما نامعتبر می باشد');
                        });
                });
        },

        /**
         * Show Info
         */
        showInfo(msg) {
            demo.showNotification(msg, 'info', 2000);
        },

        /**
         * Show Error
         */
        showError(msg) {
            demo.showNotification(msg, 'danger', 2000);
        },

        /**
         * Edit a record
         */
        editRecord(record) {
            this.errors.clear();

            this.tempRecord = {
                id: record.id,
                name: record.name
            };

            this.formMode = Enums.FormMode.register;
        },

        /**
         * Hide insert/update modal
         */
        registerCancel() {
            this.tempRecord = this.emptyRecord;
            this.changeFormMode(Enums.FormMode.normal);
        },

        /**
        * Load data for lock page
        */
        loadLock(){
            this.isLoading = true;
            this.$store.dispatch('loadLock')
                .then(res => {
                    this.tempRecord.user.code = res.data[0].code;
                    this.tempRecord.user.id = res.data[0].id;
                    this.tempRecord.people.id = res.data[0].people.id;
                    this.tempRecord.people.name = res.data[0].people.name;
                    this.tempRecord.people.lastname = res.data[0].people.lastname;
                    this.tempRecord.people.pictureUrl = res.data[0].people.pictureUrl;
                    this.tempRecord.people.pictureThumbUrl = res.data[0].people.pictureThumbUrl;
                })
                .catch(err => {
                    this.isLoading = false;

                    this.showInvisibleItems();
                });
        },

        /**
         * Load Records list
         */
        loadRecords() {
            this.isLoading = true;

            this.$store.dispatch('loadRecords')
                .then(res => {
                    this.tempRecord.user.code = this.records[0].user.code;
                    this.tempRecord.user.email = this.records[0].user.email;
                    this.tempRecord.user.group.name = this.records[0].group.name;
                    this.tempRecord.people.name = this.records[0].people.name;
                    this.tempRecord.people.lastname = this.records[0].people.lastname;
                    this.tempRecord.people.mobile = this.records[0].people.mobile;
                    this.tempRecord.people.address = this.records[0].people.address;
                    this.tempRecord.people.gender.name = this.records[0].gender.gender;
                    this.tempRecord.people.melliat.name = this.records[0].melliat.name;
                    this.tempRecord.people.pictureUrl = this.records[0].people.pictureUrl;
                    this.tempRecord.people.pictureThumbUrl = this.records[0].people.pictureThumbUrl;
                    this.tempRecord.people.city.name = this.records[0].city.name;
                    this.tempRecord.people.province.name = this.records[0].province.name;

                    this.isLoading = false;

                    this.showInvisibleItems();
                })
                .catch(err => {
                    this.isLoading = false;

                    this.showInvisibleItems();
                });
        },

    },
})
