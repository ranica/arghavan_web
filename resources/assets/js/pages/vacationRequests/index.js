import Store from '../Stores/VacationRequestStore';
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
import VacationWidget from '../Components/VacationWidget';

window.v = new Vue({
    el: '#app',

    store: Store,
    components: {
        persianCalendar: VuePersianDatetimePicker,
        VacationWidget
    },

    data: {
        formMode: Enums.FormMode.normal,
        vacType: 0,
        page: 1,
        isLoading: true,
        insertMode: false,
        tempRecord: {},
    },

    created() {
        this.tempRecord = this.emptyRecord;
        this.prepare();
    },

    mounted() {
        this.loadRecords(this.page);
    },

    computed: {
        isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,

        /**
         * Generate new Empty record
         */
        emptyRecord() {
            return {
                id: 0,
                subject: '',
                begin_date: '',
                finish_date: '',
                begin_hour: '',
                finish_hour: '',
                responsed_at: '',

                vacationType: {
                    id: 0,
                },
                vacationStatus: {
                    id: 0,
                },
                user: {
                    code: 0,
                },
                people: {
                    name: '',
                    lastname: '',
                    picture: '',
                },
                group: {
                    id: 0
                },
                editMode: false,
                deleteMode: false,
                refreshMode: false,
            };
        },
        vacationTypes: state => state.$store.getters.vacationTypes,
        vacationStatuses: state => state.$store.getters.vacationStatuses,
        records: state => state.$store.getters.records,
        allData: state => state.$store.getters.allData,
        hasRow: state => (0 < state.records.length),

        isClock() {
            return (this.vacType == 1);
        },

        isDaily() {
            return (this.vacType == 2);
        },
    },

    methods: {
        /**
         * Prepare
         */
        prepare() {
            this.page = 1;
            this.isLoading = true;

            this.loadVacationTypes(() => {
                this.loadVacationStatuses(() => {
                    this.loadRecords(page);
                });
            });
        },

        /**
         * Convert gregorian date to persian
         */
        toPersian(gDate) {
            return window.Helper.gregorianToJalaali(gDate);
        },

        /**
         * Convert persian date to gregorian
         */
        toGregorian(pDate) {
            return window.Helper.jalaaliToGregorian(pDate);
        },

        toTime(gDate) {
            return window.Helper.gregorianToJalaaliByTime(gDate).split(' ')[1];
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
         * Load VacationTypes list
         */
        loadVacationTypes(callback) {
            this.$store.dispatch('loadVacationTypes')
                .then(res => {
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load VacationStatuses list
         */
        loadVacationStatuses(callback) {
            this.$store.dispatch('loadVacationStatuses')
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
                    this.showInvisibleItems();
                })
                .catch(err => {
                    this.isLoading = false;

                    this.showInvisibleItems();
                });
        },

        updateFields() {
            switch (this.tempRecord.vacationType.id) {
                // Clock Vacation
                case 1:
                    this.vacType = 2;
                    break;

                    // Daily Vacation
                case 2:
                    this.vacType = 1;
                    break;
            }
        },

        /**
         * New record dialog
         */
        newRecord() {
            this.clearErrors();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);
            this.changeFormMode(Enums.FormMode.register);
        },

        /**
         * Hide insert/update modal
         */
        registerCancel() {
            this.tempRecord = this.emptyRecord;

            this.changeFormMode(Enums.FormMode.normal);
        },

        /**
         * Prepare to delete
         */
        readyToDelete(record) {
            this.tempRecord.id = record.id;
            $('#removeRecordModal').modal('show');
        },

        /**
         * Delete a record
         */
        deleteRecord() {
            this.isLoading = true;

            this.$store.dispatch('deleteRecord', this.tempRecord.id)
                .then(res => {
                    this.isLoading = false;

                    demo.showNotification('حذف رکورد با موفقیت انجام شد', 'success');
                    this.tempRecord = {};
                })
                .catch(err => {
                    demo.showNotification('خطا در حذف رکورد! این خطا در سامانه ذخیره شد و مورد بررسی قرار خواهد گرفت', 'danger');
                });
        },

        /**
         * Edit Record
         */
        editRecord(record) {
            this.tempRecord = Object.assign({}, this.emptyRecord);

            this.errors.clear();
            this.tempRecord = {
                id: record.id,
                subject: record.subject,
                begin_hour: (record.begin_hour) ? Helper.gregorianToJalaaliByTime(record.begin_hour).split(' ')[1] : '',
                finish_hour: (record.finish_hour) ? Helper.gregorianToJalaaliByTime(record.finish_hour).split(' ')[1] : '',
                vacationType: {
                    id: record.vacation_type.id,
                    name: record.vacation_type.name
                },
                begin_date: (record.begin_date) ? Helper.gregorianToJalaali(record.begin_date) : '',
                finish_date: (record.finish_date) ? Helper.gregorianToJalaali(record.finish_date) : '',
                user: {
                    code: record.user.code,
                },
                people: {
                    name: record.user.people.name,
                    lastname: record.user.people.lastname,
                    picture: record.user.people.picture,
                },
            };

            if (record.vacation_type.id == 2) {
                //Clock Vacation
                this.vacType = 1;
            } else {
                this.vacType = 2
            }
            this.formMode = Enums.FormMode.register;

        },

        /**
         * Save record
         */
        saveRecord() {
            this.$validator.validateAll()
                .then(result => {
                    if (result) {
                        // Prepare data
                        let beginTime = Helper.jalaaliToGregorianByTime(
                            ((this.tempRecord.begin_date).split(' ')[0]) + ' ' +
                            (this.tempRecord.begin_hour).split(':')[0] + ':' +
                            (this.tempRecord.begin_hour).split(':')[1] + ':00');

                        let finishTime = Helper.jalaaliToGregorianByTime(
                            ((this.tempRecord.begin_date).split(' ')[0]) + ' ' +
                            (this.tempRecord.finish_hour).split(':')[0] + ':' +
                            (this.tempRecord.finish_hour).split(':')[1] + ':00');
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            user_id: document.pageData.user_id,
                            subject: this.tempRecord.subject,
                            vacationType_id: this.tempRecord.vacationType.id,
                            vacationStatus_id: 1,
                            begin_hour: beginTime,
                            finish_hour: finishTime,
                            begin_date: this.toGregorian(this.tempRecord.begin_date),
                            finish_date: this.toGregorian(this.tempRecord.finish_date),
                        };

                        this.isLoading = true;
                        // Try to save
                        this.$store.dispatch('saveRecord', data)
                            .then(res => {
                                this.isLoading = false;

                                if (res) {
                                    demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

                                    this.registerCancel();
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

                    let err = Helper.generateErrorString();

                    demo.showNotification(err, 'warning');
                });
        },
        /**
         * Update Notification Vacation Request
         */
        updateNotification() {
            var p = $('.vacation-count')[0];
            var c = parseInt(p.innerText);
            c--;
            p.innerText = c;
        },
        //Check Request
        checkRequest(record) {
            // this.updateNotification();
            this.modalMode = Enums.FormMode.normal;
            this.errors.clear();
            this.tempRecord = {
                id: record.id,
                subject: record.subject,
                begin_hour: (record.begin_hour) ? Helper.gregorianToJalaaliByTime(record.begin_hour).split(' ')[1] : '',
                finish_hour: (record.finish_hour) ? Helper.gregorianToJalaaliByTime(record.finish_hour).split(' ')[1] : '',
                vacationType: {
                    id: record.vacation_type.id,
                    name: record.vacation_type.name
                },

                begin_date: (record.begin_date) ? Helper.gregorianToJalaali(record.begin_date) : '',
                finish_date: (record.finish_date) ? Helper.gregorianToJalaali(record.finish_date) : '',
                user: {
                    code: record.user.code,
                },
                people: {
                    name: record.user.people.name,
                    lastname: record.user.people.lastname,
                    picture: record.user.people.picture,
                },
                responsed_at: record.responsed_at,
            };

            if (record.vacation_type.id == 2) {
                //Clock Vacation
                this.vacType = 1;
            } else {
                this.vacType = 2
            }

            if (null == record.seen_at) {
                let data = {
                    id: record.id,
                };

                this.$store.dispatch('updateReaded', data)
                    .then(res => {})
                    .catch(err => {
                        // if (err.response.status) {
                        //     demo.showNotification('این نام قبلا ثبت شده است', 'danger');
                        // }
                        // else {
                        //     demo.showNotification(err.message, 'danger');
                        // }
                    });
            }
        },
        /**
         * Accept Record
         */
        acceptRecord(record) {
            record.vacationStatus_id = 2;
            this.responseRequest(record);
        },

        /**
         * Reject Requetst
         */
        rejectRecord(record) {
            record.vacationStatus_id = 3;
            this.responseRequest(record);
        },

        /**
         * Response Request
         */
        responseRequest(record) {
            this.$store.dispatch('responseRequest', record)
                .then(res => {
                    this.isLoading = false;

                    if (res) {
                        demo.showNotification('پذیرش درخواست با موفقیت ثبت شد', 'success');

                        this.hideModal();
                    } else {
                        demo.showNotification('ثبت پذیرش دارای خطا می باشد', 'warning');
                    }
                })
                .catch(err => {
                    if (err.response.status) {
                        demo.showNotification('خطا در ثبت درخواست', 'danger');
                    } else {
                        demo.showNotification(err.message, 'danger');
                    }
                });
        },

        /**
         * Hide Manual Traffic Modal
         */
        hideModal() {
            this.tempRecord = $.extend(true, {}, this.emptyRecord);
            $('#RequestRecordModal').modal('hide');
        },
    },
})
