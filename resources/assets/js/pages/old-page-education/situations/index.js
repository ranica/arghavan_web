import Store from '../Stores/SituationStore';

window.v = new Vue({
	el: '#app',

	store: Store,

	data: {
		formMode: Enums.FormMode.normal,
		page      : 1,
		isLoading : true,
		insertMode: false,
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
		/**
		 * Generate new Empty record
		 */
		emptyRecord(){
			return {
				id      : 0,
				name    : '',
				state	: 0
			};
		},

		records() {
			return this.$store.getters.records;
		},

		allData() {
			return this.$store.getters.allData;
		},

		hasRow() {
			return (this.records.length > 0);
		}
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
		newRecord()	{
			this.clearErrors();

			this.tempRecord = {
					id      : 0,
					name    : '',
					state   : 0
				};

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
		 * Load Records list
		 */
		loadRecords(page) {
			this.page      = page;
			this.isLoading = true;

			this.$store.dispatch('loadRecords', page)
				.then(res =>
				{
					this.isLoading = false;

                    this.showInvisibleItems();
				})
				.catch(err =>
				{
					this.isLoading = false;

					this.showInvisibleItems();
				});
		},

		/**
		 * Edit a record
		 */
		editRecord(record)	{
			this.clearErrors();

			this.insertMode = true;
			this.tempRecord = {
					id      : record.id,
					name    : record.name,
					state   : record.state
				};

			 this.formMode = Enums.FormMode.register;
		},

		/**
         * Prepare to delete
         */
        readyToDelete(record){
            this.tempRecord = record;

            // document.getElementById('removeRecordModal').modal('show');
        },

		/**
		 * Delete a record
		 */
		deleteRecord() {
			this.isLoading = true;

			this.$store.dispatch('deleteRecord', this.tempRecord.id)
				.then(res =>
				{
					this.isLoading = false;

					demo.showNotification('حذف رکورد با موفقیت انجام شد', 'success');
					this.tempRecord = {};
				})
				.catch(err =>
				{
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
							id      : this.tempRecord.id,
							name    : this.tempRecord.name,
							state   : this.tempRecord.state,
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
		}
	}
});
