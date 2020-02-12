import Store from '../Stores/CityStore';

window.v = new Vue({
	el: '#app',
	store: Store,

	data: {
        formMode: Enums.FormMode.normal,
        page: 1,
        isLoading: true,
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
		emptyRecord: () => { return {id: 0, name: '', province:{ id: 0} } },

		isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,

		records: state => state.$store.getters.records,
        allData: state => state.$store.getters.allData,
        hasRow: state => (0 < state.records.length),

        provinces: state => state.$store.getters.provinces
	},

	methods:
	{
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
                    $(x)
                        .removeClass('has-error')
                        .parent()
                        .addClass('label-floating is-empty');
                });
        },

		/**
		 * Load Provinces list
		 */
		loadProvinces()	{
			this.$store.dispatch('loadProvinces')
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
         * New record dialog
         */
        newRecord() {
            this.errors.clear();

            this.tempRecord.id = 0;
            this.tempRecord.name = '';
          	if (null != this.$store.getters.provinces[0].id){
				this.tempRecord.province.id = this.$store.getters.provinces[0].id;
			}
			else {
				this.tempRecord.province.id = 0;
			}

            this.changeFormMode(Enums.FormMode.register);
        },

		/**
		 * Edit a record
		 */
		editRecord(record)	{
			this.clearErrors();

			this.tempRecord = {
					id      : record.id,
					name    : record.name,
					province: {
						id  : record.province.id,
						name: record.province.name
					}
				};

			this.insertMode = true;
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
		 * Load Records list
		 */
		loadRecords(page) {
			this.page      = page;
			this.isLoading = true;

			this.$store.dispatch('loadRecords', page)
				.then(res => {
					this.loadProvinces();

					this.showInvisibleItems();
				})
				.catch(err => {
					this.isLoading = false;

					this.showInvisibleItems();
				});
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
							id         : this.tempRecord.id,
							name       : this.tempRecord.name,
							province_id: this.tempRecord.province.id,
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
	},
});
