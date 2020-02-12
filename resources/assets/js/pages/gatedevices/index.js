import Store from './store';
import GateWidget from '../Components/GateWidget';

window.v = new Vue({
    el: '#app',

    store: Store,

    components: {
        GateWidget
    },

    data: {
        formMode: Enums.FormMode.normal,
        page: 1,
        isLoading: true,
        insertMode: false,
        tempRecord: {},
        connectionStatus: true,
    },

    created() {
        this.tempRecord = this.emptyRecord;
    },

    mounted() {
        this.loadRecords(this.page);
    },

    computed: {
        // isConnected: state => state.connectionStatus == true,
        // isDisconnected: state => state.connectionStatus == false,
        isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,

        /**
         * Generate new Empty record
         */
        emptyRecord() {
            return {
                id: 0,
                name: '',
                ip: '',
                state: '',
                timeserver: '',
                timepass: '',
                type: '', // Logical or Physical
                gategender: {
                    id: 0,
                    gender: '',
                },
                gatepass: {
                    id: 0
                },
                gatedirect: {
                    id: 0
                },
                zone: {
                    id: 0
                },
                device_type: {
                    id: 0
                },
                editMode: false,
                deleteMode: false,
                refreshMode: false,
            };
        },

        gategenders: state => state.$store.getters.gategenders,
        gatepasses: state => state.$store.getters.gatepasses,
        gatedirects: state => state.$store.getters.gatedirects,
        zones: state => state.$store.getters.zones,
        deviceTypes: state => state.$store.getters.deviceTypes,
        records: state => state.$store.getters.records,
        allData: state => state.$store.getters.allData,
        hasRow: state => (0 < state.records.length),
    },

    methods: {
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
         * Load Gate Genders list
         */
        loadGategenders() {
            this.$store.dispatch('loadGategenders')
                .then(res => {
                    if (null != this.$store.getters.gategenders[0].id) {
                        this.tempRecord.gategender.id = this.$store.getters.gategenders[0].id;
                    }

                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Gate Genders list
         */
        loadGatepasses() {
            this.$store.dispatch('loadGatepasses')
                .then(res => {
                    if (null != this.$store.getters.gatepasses[0].id) {
                        this.tempRecord.gatepass.id = this.$store.getters.gatepasses[0].id;
                    }
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Gate Direction
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
         * Load Zones list
         */
        loadZones() {
            this.$store.dispatch('loadZones')
                .then(res => {
                    if (null != this.$store.getters.zones[0].id) {
                        this.tempRecord.zone.id = this.$store.getters.zones[0].id;
                    }
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Device Type list
         */
        loadDeviceTypes() {
            this.$store.dispatch('loadDeviceTypes')
                .then(res => {
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Hide insert/update modal
         */
        registerCancel() {
            this.tempRecord = this.emptyRecord;

            this.changeFormMode(Enums.FormMode.normal);
        },

        /**
         * Load Records list
         */
        loadRecords(page) {
            this.page = page;
            this.isLoading = true;

            this.$store.dispatch('loadRecords', page)
                .then(res => {
                    this.loadGatepasses();
                    this.loadGategenders();
                    this.loadGatedirects();
                    this.loadZones();
                    this.loadDevices();

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

        /**
         * Edit a record
         */
        editRecord(record) {
            this.clearErrors();

            this.tempRecord = {
                id: record.id,
                name: record.name,
                ip: record.ip,
                state: record.state,
                timeserver: record.timeserver,
                timepass: record.timepass,
                gategender: {
                    id: record.gategender.id,
                    gender: record.gategender.gender
                },
                gatepass: {
                    id: record.gatepass.id,
                    name: record.gatepass.name
                },
                gatedirect: {
                    id: record.gatedirect.id,
                    name: record.gatedirect.name
                },
                zone: {
                    id: record.zone.id,
                    name: record.zone.name
                },

                device_type: {
                    id: record.device_type.id,
                    name: record.device_type.name
                }
            };
            this.formMode = Enums.FormMode.register;
        },

        /**
         * Prepare to delete
         */
        readyToDelete(record) {
            this.tempRecord = record;
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
         * Save record
         */
        saveRecord() {
            this.$validator.validateAll()
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            ip: this.tempRecord.ip,
                            state: this.tempRecord.state,
                            timeserver: this.tempRecord.timeserver,
                            timepass: this.tempRecord.timepass,
                            type: 0,
                            gategender_id: this.tempRecord.gategender.id,
                            gatepass_id: this.tempRecord.gatepass.id,
                            gatedirect_id: this.tempRecord.gatedirect.id,
                            zone_id: this.tempRecord.zone.id,
                            device_type_id: 1,

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
                                }
                                else {
                                    demo.showNotification(err.message, 'danger');
                                }
                            });

                        return;
                    }
                   let err = Helper.generateErrorString();

                    demo.showNotification(err, 'warning');
                });
        },
    },

})
