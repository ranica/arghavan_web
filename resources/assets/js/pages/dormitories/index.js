import Store from './store';
import DormitoryMobile from '../Components/DormitoryWidget';


window.v = new Vue({
	el: '#app',

	store: Store,

     components: {
        DormitoryMobile,
    },

	data: {
		formMode: Enums.FormMode.normal,
		page      : 1,
		isLoading : true,
		tempRecord: {}
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

        groups: state => state.$store.getters.dormitoryInformation.groups,
        terms : state => state.$store.getters.dormitoryInformation.terms,
        degrees : state => state.$store.getters.dormitoryInformation.degrees,
        buildings : state => state.$store.getters.dormitoryInformation.buildings,
        gatePlans : state => state.$store.getters.dormitoryInformation.gatePlans,
		records: state => state.$store.getters.records,
		allData: state => state.$store.getters.allData,
		hasRow:  state => (0 < state.records.length),

		/**
		 * Generate new Empty record
		 */
		emptyRecord() {
			return {
				id       : 0,
				building: {
					id: 0
				},
				term: {
					id: 0,
                    semester: {
                            id: 0,
                        }
				},
				degree: {
					id: 0
				},
				semester: {
					id: 0
				},
				gatePlan: {
					id: 0
				},
			};
		},
	},

	methods: {

          prepare() {
            this.isLoading = true;
            this.loadDormitoryInformation();
        },

         /**
         * Load Dormitory Information
         */
        loadDormitoryInformation() {
            let data = {
                url: document.pageData.dormitory.dormitoryInformation
            };
            this.$store.dispatch('loadDormitoryInformation', data)
                .then(res => {
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
		 * Load Records list
		 */
		loadRecords(page) {
			this.page      = page;
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

					building: {
						id  : record.building.id,
						name: record.building.name
					},
					term: {
						id  : record.term.semester.id,
						name: record.term.year
					},
                    degree: {
                        id  : record.degree.id,
                        name: record.degree.name
                    },
                    gatePlan: {
                        id  : record.gate_plan.id,
                        name: record.gate_plan.name
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
							id           : this.tempRecord.id,
							building_id  : this.tempRecord.building.id,
							degree_id    : this.tempRecord.degree.id,
							term_id      : this.tempRecord.term.id,
                            gatePlan_id : this.tempRecord.gatePlan.id,
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
	}
});
