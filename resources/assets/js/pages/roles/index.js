import Store from './store';
import LiquorTree from 'liquor-tree'

window.v = new Vue({
	el: '#app',

	store: Store,

	  components: {
        LiquorTree
    },

	data: {
		toggleAllBoolean: false,
		formMode: Enums.FormMode.normal,
		page: 1,
		isLoading: true,
		insertMode: false,
		tempRecord: {},

		// treeOptions: {
  //         	checkbox: true,
  //           deletion(node) {
  //           	return node.checked()
  //           }
  //       },
		// tree:[
  //         { text: 'JS: The Right Way',   state: { expanded: true },

  //           children: [
  //             { text: 'Getting Started', state: { checked: true } },
  //             { text: 'JavaScript Code Style', state: { selected: true } },
  //             { text: 'The Good Parts', children: [
  //               { text: 'OBJECT ORIENTED', state: { checked: true }  },
  //               { text: 'ANONYMOUS FUNCTIONS', state: { checked: true }  },
  //               { text: 'FUNCTIONS AS FIRST-CLASS OBJECTS', state: { checked: true }  },
  //               { text: 'LOOSE TYPING', state: { checked: true }  }
  //             ]},
  //             { text: 'Patterns', children: [
  //               { text: 'DESIGN PATTERNS', state: { expanded: true }, children: [
  //                 { text: 'Creational Design Patterns', children: [
  //                   { text: 'Factory' },
  //                   { text: 'Prototype' },
  //                   { text: 'Mixin' },
  //                   { text: 'Singleton' }
  //                 ]},
  //                 { text: 'Structural Design Patterns'}
  //               ]},
  //               { text: 'MV* PATTERNS', cildren: [
  //                 { text: 'MVC Pattern' },
  //                 { text: 'MVP Pattern' },
  //                 { text: 'MVVM Pattern' }
  //               ]}
  //             ]}
  //           ],
  //           }
  //       ],
	},

	watch: {
		toggleAllBoolean(newVal, oldVal) {
			this.toggleAll(newVal);
		}
	},

	created() {
		this.tempRecord = this.emptyRecord;
		// this.treeData = this.getTreeData();
	},

	mounted() {
		this.loadRecords(this.page);
	},

	computed: {
		/**
		 * Generate new Empty record
		 */
		emptyRecord: () => {
			return {
				id: 0,
				name: '',
				description: '',
				state: 0
			}
		},

		isNormalMode: state => state.formMode == Enums.FormMode.normal,
		isRegisterMode: state => state.formMode == Enums.FormMode.register,
		isAssignPermission: state => state.formMode == Enums.FormMode.assignPermission,

		records: state => state.$store.getters.records,
		allData: state => state.$store.getters.allData,
		hasRow: state => (0 < state.records.length),
		permissions: state => state.$store.getters.permissions,
		dashboards: state => state.$store.getters.dashboards,
		//menuBases: state => state.$store.getters.menuBases,
		menuStructures: state => state.$store.getters.menuStructures,
		menuUsers: state => state.$store.getters.menuUsers,
		menuGates: state => state.$store.getters.menuGates,
		menuSettingGates: state => state.$store.getters.menuSettingGates,
		menuSettingSystems: state => state.$store.getters.menuSettingSystems,
		menuReports: state => state.$store.getters.menuReports,
		menuReferrals: state => state.$store.getters.menuReferrals,
		menuDormitories: state => state.$store.getters.menuDormitories,
		menuRequests: state => state.$store.getters.menuRequests,
		menuSMS: state => state.$store.getters.menuSMS,
		menuParking: state => state.$store.getters.menuParking,
		listButtons: state => state.$store.getters.listButtons,
	},

	methods: {

		toggleAll(value) {
			$(".permission-flag").prop('checked', value);
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

			this.$store.dispatch('loadPermissions');


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
		newRecord() {
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
				state: record.state
			};
			this.formMode = Enums.FormMode.register;
		},

		/**
         * Prepare to delete
         */
		readyToDelete(record) {
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
					if (result) {
						// Prepare data
						let data = {
							id: this.tempRecord.id,
							name: this.tempRecord.name,
							description: this.tempRecord.description,
							state: this.tempRecord.state
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
		 * Set Permission to record
		 */
		setPermissionRecord(record) {
			this.formMode = Enums.FormMode.assignPermission;

			this.errors.clear();
			this.tempRecord = Object.assign({}, record);

			// Update permissions checked state
			this.permissions.forEach(permission => {
				permission.checked = false;

				let res = record.permissions.filter(rolePermission => rolePermission.id == permission.id);

				permission.checked = (res.length > 0);
			});

			// Update dashboards checked state
			this.dashboards.forEach(dashboard => {
				dashboard.checked = false;

				let res = record.permissions.filter(rolePermissionDashboard =>
				                                    		rolePermissionDashboard.id == dashboard.id);

				dashboard.checked = (res.length > 0);
			});

			// // Update menu_base checked state
			// this.menuBases.forEach(menuBase => {
			// 	menuBase.checked = false;

			// 	let res = record.permissions.filter(rolePermissionMenuBase => rolePermissionMenuBase.id == menuBase.id);

			// 	menuBase.checked = (res.length > 0);
			// });

			// Update menu structure checked state
			this.menuStructures.forEach(menuStructure => {
				menuStructure.checked = false;

				let res = record.permissions.filter(rolePermissionMenuStructure =>
				                                    		rolePermissionMenuStructure.id == menuStructure.id);

				menuStructure.checked = (res.length > 0);
			});

			// Update menu user checked state
			this.menuUsers.forEach(menuUser => {
				menuUser.checked = false;

				let res = record.permissions.filter(rolePermissionMenuUser =>
				                                    		rolePermissionMenuUser.id == menuUser.id);

				menuUser.checked = (res.length > 0);
			});

			// Update menu Gate checked state
			this.menuGates.forEach(menuGate => {
				menuGate.checked = false;

				let res = record.permissions.filter(rolePermissionMenuGate =>
				                                    		rolePermissionMenuGate.id == menuGate.id);

				menuGate.checked = (res.length > 0);
			});

			// Update menu Setting Gate checked state
			this.menuSettingGates.forEach(menuSettingGate => {
				menuSettingGate.checked = false;

				let res = record.permissions.filter(rolePermissionMenuSettingGate =>
				                                    		rolePermissionMenuSettingGate.id == menuSettingGate.id);

				menuSettingGate.checked = (res.length > 0);
			});

			// Update menu Setting System checked state
			this.menuSettingSystems.forEach(menuSettingSystem => {
				menuSettingSystem.checked = false;

				let res = record.permissions.filter(rolePermissionMenuSettingSystem =>
			                                    			rolePermissionMenuSettingSystem.id == menuSettingSystem.id);

				menuSettingSystem.checked = (res.length > 0);
			});

			// Update menu Report checked state
			this.menuReports.forEach(menuReport => {
				menuReport.checked = false;

				let res = record.permissions.filter(rolePermissionMenuReport =>
				                                    		rolePermissionMenuReport.id == menuReport.id);

				menuReport.checked = (res.length > 0);
			});

			// Update menu Referral checked state
			this.menuReferrals.forEach(menuReferral => {
				menuReferral.checked = false;

				let res = record.permissions.filter(rolePermissionMenuReferral =>
				                                    		rolePermissionMenuReferral.id == menuReferral.id);

				menuReferral.checked = (res.length > 0);
			});

			// Update menu Dormitory checked state
			this.menuDormitories.forEach(menuDormitory => {
				menuDormitory.checked = false;

				let res = record.permissions.filter(rolePermissionMenuDormitory =>
				                                    		rolePermissionMenuDormitory.id == menuDormitory.id);

				menuDormitory.checked = (res.length > 0);
			});

			// Update menu Request checked state
			this.menuRequests.forEach(menuRequest => {
				menuRequest.checked = false;

				let res = record.permissions.filter(rolePermissionMenuRequest =>
				                                    		rolePermissionMenuRequest.id == menuRequest.id);

				menuRequest.checked = (res.length > 0);
			});

			// Update menu SMS checked state
			this.menuSMS.forEach(obj => {
				obj.checked = false;

				let res = record.permissions.filter(rolePermissionMenuSMS =>
				                                    		rolePermissionMenuSMS.id == obj.id);

				obj.checked = (res.length > 0);
			});
			// Update menu Parking checked state
			this.menuParking.forEach(obj => {
				obj.checked = false;

				let res = record.permissions.filter(rolePermissionMenuParking =>
				                                    		rolePermissionMenuParking.id == obj.id);

				obj.checked = (res.length > 0);
			});

			// Update list Button checked state
			this.listButtons.forEach(listButton => {
				listButton.checked = false;

				let res = record.permissions.filter(rolePermissionListButton =>
				                                    		rolePermissionListButton.id == listButton.id);

				listButton.checked = (res.length > 0);
			});
		},

		/**
		 * Save Permission Record
		 */
		savePermissionRecord() {
			// let resRecord = this.permissions.filter(el => el.checked == true).map(el => el.id);

			this.$validator.validateAll()
				.then(result => {
					if (result) {
						// Prepare data
						let data = {
							role_id: this.tempRecord.id,
							permissions: []
						};


						// data.permissions = this.permissions.filter(el => el.checked == true)
						// 	.map(el => el.id);
						let dashboard = this.dashboards.filter(el => el.checked == true)
								.map(el => el.id);
						let menu_structure = this.menuStructures.filter(el => el.checked == true)
									.map(el => el.id);
						let menu_user = this.menuUsers.filter(el => el.checked == true)
									.map(el => el.id);

						let menu_gate = this.menuGates.filter(el => el.checked == true)
									.map(el => el.id);

						let menu_setting_traffic = this.menuSettingGates.filter(el => el.checked == true)
									.map(el => el.id);

						let menu_setting_system = this.menuSettingSystems.filter(el => el.checked == true)
									.map(el => el.id);

						let menu_report = this.menuReports.filter(el => el.checked == true)
									.map(el => el.id);

						let menu_referral = this.menuReferrals.filter(el => el.checked == true)
									.map(el => el.id);

						let menu_dormitory = this.menuDormitories.filter(el => el.checked == true)
									.map(el => el.id);

						let menu_request = this.menuRequests.filter(el => el.checked == true)
									.map(el => el.id);

						let menu_sms= this.menuSMS.filter(el => el.checked == true)
									.map(el => el.id);
						let menu_parking = this.menuParking.filter(el => el.checked == true)
									.map(el => el.id);

						let list_button = this.listButtons.filter(el => el.checked == true)
									.map(el => el.id);

						data.permissions = dashboard.concat( menu_structure,
					                                    	 menu_user,
					                                    	 menu_gate,
					                                    	 menu_setting_traffic,
					                                    	 menu_setting_system,
					                                    	 menu_report,
					                                    	 menu_referral,
					                                    	 menu_dormitory,
					                                    	 menu_request,
					                                    	 menu_sms,
					                                    	 menu_parking,
					                                    	 list_button);

						this.isLoading = true;

						// Try to save
						this.$store.dispatch('savePermissionRecord', data)
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
