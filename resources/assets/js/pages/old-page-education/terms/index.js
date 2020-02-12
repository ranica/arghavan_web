import Store from '../Stores/TermStore';
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
				year    : '',
				startDate  : '',
				endDate    : '',
				semester:	{
					id: 0
				}
			};
		},

		semesters: state => state.$store.getters.semesters,
		records: state => state.$store.getters.records,
		allData: state => state.$store.getters.allData,
		hasRow: state => (0 < state.records.length),
	},

	methods: {

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
		 * Load Semesters list
		 */
		loadSemesters() {
			this.$store.dispatch('loadSemesters')
				.then(res => {
					if (null != this.$store.getters.semesters[0].id) {
						this.tempRecord.semester.id = this.$store.getters.semesters[0].id;
					}
						this.isLoading = false;
					})
					.catch(err =>{
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
		loadRecords(page){
			this.page      = page;
			this.isLoading = true;

			this.$store.dispatch('loadRecords', page)
				.then(res =>{
					this.loadSemesters();
					this.showInvisibleItems();
				})
				.catch(err =>{
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
			
			// this.clearErrors();

			// this.insertMode = true;
			// this.tempRecord.id = 0;
			// this.tempRecord.year = '';
			// this.tempRecord.startDate = '';
			// this.tempRecord.endDate = '';

			// if (null != this.$store.getters.semesters[0].id){
			// 	this.tempRecord.semester.id = this.$store.getters.semesters[0].id;
			// }
			// else {
			// 	this.tempRecord.semester.id = 0;
			// }

			// this.changeFormMode(Enums.FormMode.register);
		},

		/**
		 * Edit a record
		 */
		editRecord(record){
			this.clearErrors();

			this.tempRecord = {
					id      : record.id,
					year    : record.year,
					startDate: Helper.gregorianToJalaali(record.startDate),
					endDate: Helper.gregorianToJalaali(record.endDate),
					semester: {
						id  : record.semester.id,
						name: record.semester.name
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
		deleteRecord(){

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
							id           : this.tempRecord.id,
							year         : this.tempRecord.year,
							startDate: Helper.jalaaliToGregorian(this.tempRecord.startDate),
                            endDate: Helper.jalaaliToGregorian(this.tempRecord.endDate),
							semester_id: this.tempRecord.semester.id,
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
