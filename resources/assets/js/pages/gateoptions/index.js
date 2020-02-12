import Store from '../Stores/GateoptionStore';
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';

window.v = new Vue({
	el: '#app',

	store: Store,

	components: {
        persianCalendar: VuePersianDatetimePicker
    },

	data: {
		formMode: Enums.FormMode.normal,
		page      : 1,
		isLoading : true,
		tempRecord: {}
	},

	created() {
		this.tempRecord = this.emptyRecord;
	},

	mounted() {
		this.loadRecords(this.page);
	},

	computed: {
		isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,
        isAssignGateDevice: state => state.formMode == Enums.FormMode.assignGateDevice,

        gatezones : state => state.$store.getters.gatezones,
		records: state => state.$store.getters.records,
		allData: state => state.$store.getters.allData,
		hasRow:  state => (0 < state.records.length),
        gatedevices: state => state.$store.getters.gatedevices,

		/**
		 * Generate new Empty record
		 */
		emptyRecord() {
			return {
				id       : 0,
				startDate: '',
				endDate  : '',
				port     : '',
				emergency: '',
				gatezonew: {
					id: 0
				},
				gatezonem: {
					id: 0
				},
			};
		},
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

            this.changeFormMode(Enums.FormMode.normal);
        },
		/**
		 * Load Gate Zone list
		 */
		loadGatezones() {
			this.$store.dispatch('loadGatezones')
				.then(res => {
					if (null != this.$store.getters.gatezones[0].id){
						this.tempRecord.gatezonem.id = this.$store.getters.gatezones[0].id;
						this.tempRecord.gatezonew.id = this.$store.getters.gatezones[0].id;
					}
					this.isLoading = false;

					this.showInvisibleItems();
				})
				.catch(err => {
					this.isLoading = false;

					this.showInvisibleItems();
				});
		},
        /**
        * Load Gate device
        */
        loadGateDevices() {
            this.$store.dispatch('loadGateDevices')
                .then(res => {
                    this.isLoading = false;
                    this.showInvisibleItems();
                })
                .catch(err => {
                    this.isLoading = false;
                    this.showInvisibleItems();
                });
        },

		/**
		 * Load Records list
		 */
		loadRecords(page) {
			this.page      = page;
			this.isLoading = true;
			this.loadGateDevices();

            this.$store.dispatch('loadRecords', page)
                .then(res => {
                    this.loadGatezones();
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
		newRecord()	{
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
					id       : record.id,
					startDate: Helper.gregorianToJalaali(record.startDate),
					endDate  : Helper.gregorianToJalaali(record.endDate),
					port     : record.port,
					emergency: record.emergency,
					gatezonew: {
						id  : record.gatezone_w.id,
						name: record.gatezone_w.name
					},
					gatezonem: {
						id  : record.gatezone_m.id,
						name: record.gatezone_m.name
					}
				};

			this.formMode = Enums.FormMode.register;
		},
		 /**
         * Prepare to delete
         */
        readyToDelete(record){
            this.tempRecord = record;
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
					if (result)	{
						// Prepare data
						let data = {
							id         : this.tempRecord.id,
							startDate  : this.toGregorian(this.tempRecord.startDate),
							endDate    : this.toGregorian(this.tempRecord.endDate),
							port       : this.tempRecord.port,
							emergency  : this.tempRecord.emergency,
							genzonew_id: this.tempRecord.gatezonew.id,
							genzonem_id: this.tempRecord.gatezonem.id,
						};

						this.isLoading = true;

						// Try to save
						this.$store.dispatch('saveRecord', data)
							.then(res => {
								this.isLoading = false;

								if (res) {
									demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

									this.registerCancel();
								}
								else {
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

				 alert('خطا', 'خطاها را بر طرف نمایید');
				});
		},
        /**
         * Set Gatedevice to record
         */
        setGateDevice(record) {
            this.formMode = Enums.FormMode.assignGateDevice;

            this.errors.clear();
            this.tempRecord = Object.assign({}, record);

            // Update Gatedevices checked state
            this.gatedevices.forEach(gatedevice => {
                gatedevice.checked = false;

                let res = record.gatedevices.filter(groupDevice => groupDevice.id == gatedevice.id);

                gatedevice.checked = (res.length > 0);
            });
        },
        /**
         * Save Gatedevice Record
         */
        saveGateDeviceRecord(){
            this.$validator.validateAll()
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            gateoption_id: this.tempRecord.id,
                            gatedevices: []
                        };

                        data.gatedevices = this.gatedevices.filter(el => el.checked == true)
                                                           .map(el => el.id);
                        this.isLoading = true;

                        // Try to save
                        this.$store.dispatch('saveGateDeviceRecord', data)
                            .then(res => {
                                this.isLoading = false;

                                if (res) {
                                    demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

                                    this.registerCancel();
                                }
                                else {
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
                    demo.showNotification('خطا', 'خطاها را بر طرف نمایید');
                });
        }
	}
});
