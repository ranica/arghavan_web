import Store from './store';
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
import VueFormWizard from 'vue-form-wizard';
import VueChartist from 'vue-chartist';
Vue.use(VueFormWizard);

window.v = new Vue({
    el: '#app',
    store: Store,

    components: {
        persianCalendar: VuePersianDatetimePicker,
    },

    data: {
        selectFilterRadio: true,
        selectDeviceBoolean: true,
        selectDirectBoolean: true,
        selectMessageBoolean: true,
        selectGenderBoolean: true,

        formMode: Enums.FormMode.normal,
        showModal: false,
        page: 1,
        is_search: false,
        isLoading: true,
        events: [],
        tempRecord: {
            traffic: {},
        },
        searchParams: {}
    },

    watch: {
        selectDeviceBoolean(newVal, oldVal) {
            this.selectGateDevice(newVal);
        },

        selectDirectBoolean(newVal, oldVal) {
            this.selectGateDirect(newVal);
        },
        selectMessageBoolean(newVal, oldVal) {
            this.selectGateMessage(newVal);
        },
        selectGenderBoolean(newVal, oldVal) {
            this.selectGender(newVal);
        },
    },

    created() {
        this.tempRecord = this.emptyRecord;
    },

    mounted() {
        this.loadRecords(this.page);
        //this.refreshResults();
        this.selectGateDevice(this.selectDeviceBoolean);
        this.selectGateDirect(this.selectDirectBoolean);
        this.selectGateMessage(this.selectMessageBoolean);
        this.selectGender(this.selectGenderBoolean);
    },

    computed: {
        groups: state => state.$store.getters.baseInformation.groups,
        genders: state => state.$store.getters.baseInformation.genders,
        gatedirects: state => state.$store.getters.baseInformation.gateDirects,
        gatedevices: state => state.$store.getters.baseInformation.gateDevices,
        gatemessages: state => state.$store.getters.baseInformation.gateMessages,
        gatepasses: state => state.$store.getters.baseInformation.gatePasses,
        commonranges: state => state.$store.getters.baseInformation.commonRanges,

        isModal() {
            return this.showModal;
        },

        /**
         * Generate new Empty record
         */
        emptyRecord: () => {
            return {
                id: 0,
                group: {
                    id: 0
                },
                gender: {
                    id: 0,
                },
                gatedevice: {
                    id: 0,
                },
                gatedirect: {
                    id: 0,
                },
                gatemessage: {
                    id: 0,
                },
                commonrange: {
                    id: 0,
                },
                code: '',
                nationalId: '',
                name: '',
                lastname: '',
                cdn: '',
                startDate: '',
                endDate: '',
                startClock: 0,
                endClock: 0,

                traffic: {
                    id: 0,
                    user: {
                        id: 0,
                        code: '',
                        name: '',
                    },
                    gatedate: '',
                    gatetime: '',
                    gatepass: {
                        id: 0
                    },
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

        // groups: state => state.$store.getters.groups,

        userData: state => state.$store.getters.userData,

        records: state => state.$store.getters.records,
        allData: state => state.$store.getters.allData,
        hasRow: state => (0 < state.records.length),

        /**
         * Show form title
         */
        title: function() {
            let header = '';

            if (this.isSearchMode) {
                header = 'جستجوی کاربر';
            } else if (this.isNormalMode) {
                header = 'نمایش ورود و خروج های اخیر'
            }

            return header;
        },
    },

    methods: {
        /**
         * Active or Deactive checkbox device
         */
        selectGateDevice(value) {
            $('#fullDevice').prop('checked', value);
            $("#gateDevice_id").prop("disabled", value);
        },
        /**
         * Active or Deactive checkbox Direct
         */
        selectGateDirect(value) {
            $('#fullDirect').prop('checked', value);
            $('#gatedirect_id').prop("disabled", value);
        },
        /**
         * Active or Deactive checkbox Message
         */
        selectGateMessage(value) {
            $('#fullMessage').prop('checked', value);
            $('#gatemessage_id').prop("disabled", value);
        },
        /**
         * Active or Deactive checkbox Gender
         */
        selectGender(value) {
            $('#fullGender').prop('checked', value);
            $('#gender_id').prop("disabled", value);
        },

        /**
         * Edit Manual traffic
         */
        editTrafficStatus(record) {

            if (record.gatedevice.id == this.$store.getters.gatedevices[0].id) {
                this.tempRecord = $.extend(true, {}, this.emptyRecord);

                this.clearErrors();
                this.showManualTrafficModal();
                let data = {
                    data: {
                        user_id: record.user_id,
                        code: '',
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
         * Load user by code
         */
        loadUser(record) {
            let data = {
                data: {
                    user_id: '',
                    code: this.tempRecord.traffic.user.code,
                }
            };
            this.$store.dispatch('loadUser', data)
                .then(res => {

                    if (0 < this.userData.length) {
                        this.tempRecord.traffic.user.name = this.userData[0].people.name + '  ' + this.userData[0].people.lastname;
                    } else {
                        this.tempRecord.traffic.user.name = 'کد وارد شده نامعتبر است.';
                    }

                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                })
        },

        /**
         * Load logical device
         */
        loadGatedevices() {
            this.$store.dispatch('loadGatedevices')
                .then(res => {

                    if (null != this.$store.getters.gatedevices[0].id) {
                        this.tempRecord.gatedevice.id = this.$store.getters.gatedevices[0].id;
                    }
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                })
        },

        /**
         * Load Gate Message
         */
        loadGatemessages() {
            this.$store.dispatch('loadGatemessages')
                .then(res => {

                    if (null != this.$store.getters.gatemessages[0].id) {
                        this.tempRecord.gatemessage.id = this.$store.getters.gatemessages[0].id;
                    }
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                })
        },

        /**
         * Load Gate Directs
         */
        loadGatedirects() {
            this.$store.dispatch('loadGatedirects')
                .then(res => {

                    if (null != this.$store.getters.gatedirects[0].id) {
                        this.tempRecord.gatedirect.id = this.$store.getters.gatedirects[0].id;
                    }
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Gate Pass
         */
        loadGatepasses() {
            this.$store.dispatch('loadGatepasses')
                .then(res => {

                    if (null != this.$store.getters.gatepasses[0].id) {
                        this.tempRecord.traffic.gatepass.id = this.$store.getters.gatepasses[0].id;
                    }
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
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
         * Convert Date now to Persian Date
         * @param  {[type]} gDate [description]
         */
        toPersian(gDate) {
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
        loadRecords(page) {
            this.page = page;
            this.isLoading = true;
            this.tempRecord.startDate = window.DateTime.toPersianDate(new Date()) + " 00:00";
            this.tempRecord.endDate = window.DateTime.toPersianDate(new Date()) + " 23:59";

            this.loadAllData(page);
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
         * Tab Search Record
         *
         * @return     {boolean}  { description_of_the_return_value }
         */
        tabSwitchSearch() {
            this.errors.clear();
            this.is_search = false;

            // Prepare data
            this.searchParams.groupId = this.tempRecord.group.id;
            this.searchParams.code = this.tempRecord.code;
            this.searchParams.type_filter = this.selectFilterRadio,
            this.searchParams.commonrangeId = this.tempRecord.commonrange.id,
            this.searchParams.genderId = null;
            this.searchParams.deviceId = null;
            this.searchParams.messageId = null;
            this.searchParams.directId = null;
            this.searchParams.beginDateTime = null;
            this.searchParams.endDateTime = null;

            this.searchParams.beginDateTime = Helper.jalaaliToGregorianByTime(this.tempRecord.startDate + ":00");
            this.searchParams.endDateTime = Helper.jalaaliToGregorianByTime(this.tempRecord.endDate + ":59");

            if (!this.selectGenderBoolean) {
                this.searchParams.genderId = this.tempRecord.gender.id;
            }

            if (!this.selectDeviceBoolean) {
                this.searchParams.deviceId = this.tempRecord.gatedevice.id;
            }

            if (!this.selectDirectBoolean) {
                this.searchParams.directId = this.tempRecord.gatedirect.id;
            }

            if (!this.selectMessageBoolean) {
                this.searchParams.messageId = this.tempRecord.gatemessage.id;
            }

            let data = {
                page: 1,
                data: this.searchParams
            };

            this.isLoading = true;

            this.$store.dispatch('searchMyRecord', data)
                .then(res => {
                    if (res.data.data.length > 0){
                        this.is_search = true;
                    }
                    // FILL VUE DATA
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;

                    demo.showNotification(err.message, 'danger');
                });
            return true;
        },
        /**
         * Search Data Record
         */
        showRecord(page) {
            this.isLoading = true;

            let params = Object.assign ({}, this.searchParams);
            // data.page = page;
             let data = {
                page: page,
                data: params
            };

            this.$store.dispatch('searchMyRecord', data)
                .then(res => {
                    // FILL VUE DATA
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;

                    demo.showNotification(err.message, 'danger');
                });

            this.changeFormMode(Enums.FormMode.show);
        },

        /**
         * Load all Record
         */
        loadAllData(page) {
            this.loadBaseInformation();

            this.showInvisibleItems();
            // })
            // .catch(err => {
            //  this.isLoading = false;
            //  this.showInvisibleItems();
            // });
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
                data: {
                    code: this.tempRecord.code,
                    name: this.tempRecord.name,
                    // group_id: this.tempRecord.group.id,
                    lastname: this.tempRecord.lastname,
                    nationalId: this.tempRecord.nationalId,
                    cdn: this.tempRecord.cdn,
                    startDate: Helper.jalaaliToGregorian(this.tempRecord.startDate),
                    endDate: Helper.jalaaliToGregorian(this.tempRecord.endDate),
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
        uploadImage() {
            // Set header
            let config = {
                headers: {
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
        saveRecord($user_id) {
            this.$validator.validateAll()
                .then(result => {
                    if (result) {

                        // Prepare data
                        let time = Helper.jalaaliToGregorianByTime(
                            ((this.tempRecord.traffic.gatedate).split(' ')[0]) + ' ' +
                            this.tempRecord.traffic.gatetime + ':00');

                        let data = {
                            id: this.tempRecord.traffic.id,
                            gatedate: time,
                            gatedirect_id: this.tempRecord.traffic.gatedirect.id,
                            gatedevice_id: this.tempRecord.traffic.gatedevice.id,
                            gatemessage_id: this.tempRecord.traffic.gatemessage.id,
                            gatepass_id: this.tempRecord.traffic.gatepass.id,
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
        showManualTrafficModal() {
            $('#ManualRecordModal').modal('show');
        },

        /**
         * Hide Manual Traffic Modal
         */
        hideManualTrafficModal() {
            this.tempRecord = $.extend(true, {}, this.emptyRecord);
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
        /**
         * Export Traffic PDF
         */
        exportTrafficPDF(){
             let url =  document.pageData.report.urls.traffic_export_pdf_data;

            let data = {
                url: url,
                exportData: this.searchParams
            };

            this.$store.dispatch('exportTrafficPDF', data)
                .then(res => {
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                    demo.showNotification(err.message, 'danger');
                });
        },
        /**
         * Export traffic excel
         */
        exportTrafficExcel(){
            let url =  document.pageData.report.urls.traffic_export_excel_data;

            let data = {
                url: url,
                exportData: this.searchParams
            };

            this.$store.dispatch('exportTrafficExcel', data)
                .then(res => {
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                    demo.showNotification(err.message, 'danger');
                });
        },
    },
})
