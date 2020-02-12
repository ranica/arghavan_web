import Store from './store';
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
import MonitorWidget from '../Components/MonitorWidget';


window.v = new Vue({
    el: '#app',
    store: Store,

    components: {
        persianCalendar: VuePersianDatetimePicker,
        MonitorWidget
    },

    data: {
        formMode: Enums.FormMode.normal,
        showModal: false,
        page      : 1,
        isLoading : true,
        events: [],
        tempRecord: {
            traffic: {},
        },
    },

    created() {
        this.tempRecord = this.emptyRecord;
    },

    mounted() {
        this.loadRecords(this.page);
        this.refreshResults();
    },

    computed: {
        gatedirects: state => state.$store.getters.baseInformation.gateDirects,
        gatedevices: state => state.$store.getters.baseInformation.gateDevices,
        gatemessages: state => state.$store.getters.baseInformation.gateMessages,
        gatepasses: state => state.$store.getters.baseInformation.gatePasses,
        isModal() {
            return this.showModal;
        },

        /**
         * Generate new Empty record
         */
        emptyRecord: () => { return {
                                id: 0,
                                code: '',
                                nationalId: '',
                                name: '',
                                lastname: '',
                                cdn: '',
                                startDate:'',
                                endDate: '',

                                traffic:{
                                    id :0,
                                    user:{ id:0, code:'', name:'' },
                                    gatedate:'',
                                    gatetime:'',
                                    gatedevice:{ id:0 },
                                    gatepass:{ id:0 },
                                    gatedirect: { id:0 },
                                    gatemessage:{ id: 0 },
                                }

                                // group: {
                                //  id: 0
                                // },
                        }
        },

        isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,
        isSearchMode: state => state.formMode == Enums.FormMode.search,
        isShowMode: state => state.formMode == Enums.FormMode.show,
        userData: state => state.$store.getters.userData,

        records: state => state.$store.getters.records,
        allData: state => state.$store.getters.allData,
        hasRow: state => (0 < state.records.length),

        /**
         * Show form title
         */
        title: function() {
            let header ='';

            if (this.isSearchMode) {
                header = 'جستجوی کاربر';
            }
            else if (this.isNormalMode){
                header = 'نمایش ورود و خروج های اخیر'
            }

            return header;
        },
    },

    methods: {
         /**
         * Load Gate Groups list
         */
        loadBaseInformation() {
            let data = {
                url: document.pageData.report.urls.baseInformation
            };
            this.$store.dispatch('loadBaseInformation', data)
                .then(res => {
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },
        /**
         * Edit Manual traffic
         */
        editTrafficStatus(record){

            if (record.gatedevice.id == this.$store.getters.gatedevices[0].id){
                 this.tempRecord = $.extend(true, {}, this.emptyRecord);

                this.clearErrors();
                this.showManualTrafficModal();
                let data = {
                    data: {
                        user_id :record.user_id,
                        code :'',
                    }
                };

                //TODO : Make Fuction loadtraffic in store
                this.$store.dispatch('loadUser', data)
                .then(res => {
                    this.isLoading = false;
                    this.tempRecord.traffic.user.name = this.userData[0].people.name + '  ' + this.userData[0].people.lastname;
                    this.tempRecord.traffic.user.code = this.userData[0].code;
                    this.tempRecord.traffic.gatedirect.id = record.gatedirect.id;
                    this.tempRecord.traffic.gatedate = Helper.gregorianToJalaaliByTime(record.gatedate);
                    this.tempRecord.traffic.gatetime = Helper.gregorianToJalaaliByTime(record.gatedate).split(' ')[1];
                })
                .catch(err => {
                    this.isLoading = false;
                })
            }
        },
        /**
         * Load user by code
         */
        loadUser(record){
            let data = {
                data: {
                    user_id :'',
                    code :this.tempRecord.traffic.user.code,
                }
            };
            this.$store.dispatch('loadUser', data)
                .then(res => {
                    if ( 0 < this.userData.length){
                        this.tempRecord.traffic.user.name = this.userData[0].people.name + '  ' + this.userData[0].people.lastname;
                    }
                    else {
                        this.tempRecord.traffic.user.name = 'کد وارد شده نامعتبر است.';
                    }

                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                })
        },

         /**
         * Change form mode
         */
        changeFormMode(formMode){
            this.formMode = formMode;
        },

        /**
         * Convert Date now to Persian Date
         * @param  {[type]} gDate [description]
         */
        toPersian(gDate){
            return window.Helper.gregorianToJalaaliByTime(gDate);
        },

        /**
         * Convert persian date to gregorian
         */
        toGregorian(pDate) {
            return window.Helper.jalaaliToGregorian(pDate);
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
            this.$store.commit('turnOffSearchMode');
            this.tempRecord = this.emptyRecord;

            this.changeFormMode(Enums.FormMode.normal);
        },

        /**
         * New record dialog
         */
        newRecord() {
            this.errors.clear();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);
            this.changeFormMode(Enums.FormMode.register);
        },

        /**
         * Load records
         */
        loadRecords (page){
            this.page = page;
            this.isLoading = true;

            if (this.$store.getters.searchMode){
                this.searchRecord(page);
                return;
            }
            this.loadAllData (page);
        },

        /**
         * Refresh Log Traffic
         */
        refreshResults(){
            setTimeout (() => {
                this.loadRecords (this.page);
                this.refreshResults ();
            }, 1000);
        },

        /**
         * Load all Record
         */
        loadAllData(page){
            this.$store.dispatch('loadRecords', page)
                .then(res => {
                    this.loadBaseInformation();
                    this.showInvisibleItems();
                })
                .catch(err => {
                    this.isLoading = false;
                    this.showInvisibleItems();
                });
            },

        /**
         * Search a new record
         */
        newSearch() {
            this.clearErrors();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);
            this.formMode = Enums.FormMode.search;
        },

         /**
         * Search Data Record
         */
        searchRecord(page) {
            // Prepare data
            let data = {
                page: page,
                data : {
                    code       : this.tempRecord.code,
                    name       : this.tempRecord.name,
                    // group_id: this.tempRecord.group.id,
                    lastname   : this.tempRecord.lastname,
                    nationalId : this.tempRecord.nationalId,
                    cdn        : this.tempRecord.cdn,
                    startDate  : Helper.jalaaliToGregorian(this.tempRecord.startDate),
                    endDate    : Helper.jalaaliToGregorian(this.tempRecord.endDate),
                }
            };
            this.isLoading = true;

            this.$store.dispatch('searchRecord', data)
                .then(res => {
                    // FILL VUE DATA
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;

                    demo.showNotification(err.message, 'danger');
                });
            this.changeFormMode(Enums.FormMode.normal);
        },

        /**
         * Upload Image
         */
        uploadImage(){
            // Set header
            let config = {
                headers : {
                    'Content-Type': 'multipart/form-data'
                }
            };
        },

         /**
         * Hide insert/update modal Parent
         */
        manualTrafficCancel() {
            this.changeFormMode(Enums.FormMode.normal);
            this.hideManualTrafficModal();
        },

        /**
         * Save data
         */
        saveRecord($user_id){
            this.$validator.validateAll()
                .then(result => {
                    if (result) {
                        // Prepare data
                        let time = Helper.jalaaliToGregorianByTime(
                                            ((this.tempRecord.traffic.gatedate).split(' ')[0] ) + ' '+
                                            this.tempRecord.traffic.gatetime + ':00');

                        let data = {
                            id: this.tempRecord.traffic.id,
                            gatedate: time,
                            gatedirect_id: this.tempRecord.traffic.gatedirect.id,
                            gatedevice_id: 1,
                            gatemessage_id: 1,
                            gatepass_id: 1,
                            gateoperator_id: $user_id,
                            user_id: this.userData[0].id,
                        };

                        this.isLoading = true;
                        // Try to save
                        this.$store.dispatch('saveRecord', data)
                            .then(res => {
                                this.isLoading = false;

                                if (0 == res.status) {
                                    demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

                                     this.manualTrafficCancel();

                                } else {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'warning');
                                }
                            })
                            .catch(err => {
                                this.isLoading = false;

                                if (err.response.status) {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'danger');
                                } else {
                                    demo.showNotification(err.message, 'danger');
                                }
                            });

                        return;
                    }
                });
        },

        /**
         * Show Manual Traffic Modal
         */
        showManualTrafficModal(){
            $('#ManualRecordModal').modal('show');
        },

        /**
         * Hide Manual Traffic Modal
         */
        hideManualTrafficModal(){
            this.tempRecord =  this.emptyRecord;
            $('#ManualRecordModal').modal('hide');
        },

         /**
         * Prepare to delete
         */
        readyToDelete(record) {
            this.tempRecord.traffic = record;
        },

         /**
         * Delete a record
         */
        deleteRecord() {
            this.isLoading = true;

            this.$store.dispatch('deleteRecord', this.tempRecord.traffic.id)
                .then(res => {
                    this.isLoading = false;

                    demo.showNotification('حذف رکورد با موفقیت انجام شد', 'success');
                })
                .catch(err => {
                    demo.showNotification('خطا در حذف رکورد! این خطا در سامانه ذخیره شد و مورد بررسی قرار خواهد گرفت', 'danger');
                });
        },
    },
})
