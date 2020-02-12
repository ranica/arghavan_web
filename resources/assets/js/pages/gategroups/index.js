import Store from '../Stores/GategroupStore';

window.v = new Vue({
	el: '#app',

	store: Store,

	data: {
		formMode: Enums.FormMode.normal,
		page      : 1,
		isLoading : true,
		insertMode: false,
		tempRecord: {},
	},

	created() {
		this.tempRecord = this.emptyRecord;
	},

	mounted() {
		this.loadRecords(this.page);
	},

	computed: {
		/**
		 * Generate new Empty record
		 */
		emptyRecord: () => { return {
									id: 0,
									name: '',
									description: '',
								}
							},

		isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,
        isAssignGatedevice: state => state.formMode == Enums.FormMode.assignGatedevice,

		records: state => state.$store.getters.records,
		allData: state => state.$store.getters.allData,
		hasRow: state => (0 < state.records.length),

		gatedevices: state => state.$store.getters.gatedevices,
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
			this.page      = page;
			this.isLoading = true;

			this.$store.dispatch('loadGatedevices');

			this.$store.dispatch('loadRecords', page)
				.then(res => {
					this.isLoading = false;
				})
				.catch(err => {
					this.isLoading = false;
				});
		},
		/**
		 * New record dialog
		 */
		newRecord()	{
			this.errors.clear();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);
            this.changeFormMode(Enums.FormMode.register);
		},

		/**
		 * Edit a record
		 */
		editRecord(record) {
			 this.errors.clear();

			this.tempRecord = {
					id: record.id,
					name: record.name,
					description: record.description,
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
				.then(result =>	{
					if (result)	{
						// Prepare data
						let data = {
							id      : this.tempRecord.id,
							name    : this.tempRecord.name,
							description: this.tempRecord.description,
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

					 let err = Helper.generateErrorString();

                    demo.showNotification(err, 'warning');
				});
		},

		/**
		 * Set Gatedevice to record
		 */
		setGatedeviceRecord(record) {
			this.formMode = Enums.FormMode.assignGatedevice;

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
		saveGatedeviceRecord(){
			this.$validator.validateAll()
				.then(result =>	{
					if (result)	{
						// Prepare data
						let data = {
							gategroup_id: this.tempRecord.id,
							gatedevices: []
						};

						data.gatedevices = this.gatedevices.filter(el => el.checked == true)
												           .map(el => el.id);
						this.isLoading = true;

						// Try to save
						this.$store.dispatch('saveGatedeviceRecord', data)
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
