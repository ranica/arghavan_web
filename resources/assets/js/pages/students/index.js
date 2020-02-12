import Store from '../Stores/StudentStore';

window.v = new Vue(
{
	el: '#app',

	store: Store,

	data:
	{
		page      : 1,
		isLoading : true,
		insertMode: false,
		tempRecord  : {}
	},

	created()
	{
		this.tempRecord = this.emptyRecord;
	},

	mounted()
	{		
		this.loadRecords(this.page);
	},

	computed:
	{
		/**
		 * Generate new Empty record 
		 */
		emptyRecord()
		{
			return {
				id      : 0,
				suit    : 0,
				native: 0,
				field:
				{
					id: 0
				},
				part:
				{
					id: 0
				},
				degree:
				{
					id: 0
				},
				university:
				{
					id: 0
				}
			};
		},

		fields()
		{
			return this.$store.getters.fields;
		},

		parts()
		{
			return this.$store.getters.parts;
		},

		degrees()
		{
			return this.$store.getters.degrees;
		},

		universities()
		{
			return this.$store.getters.universities;
		},

		records()
		{
			return this.$store.getters.records;
		},

		allData()
		{
			return this.$store.getters.allData;
		},

		hasRow()
		{
			return (this.records.length > 0);
		}
	},

	methods:
	{
		/**
		 * Load Fields list
		 */
		loadFields()
		{
			this.$store.dispatch('loadFields')
				.then(res =>
				{
					this.isLoading = false;
				})
				.catch(err =>
				{
					this.isLoading = false;
				});
		},

		/**
		 * Load Parts list
		 */
		loadParts()
		{
			this.$store.dispatch('loadParts')
				.then(res =>
				{
					this.isLoading = false;
				})
				.catch(err =>
				{
					this.isLoading = false;
				});
		},

		/**
		 * Load Degrees list
		 */
		loadDegrees()
		{
			this.$store.dispatch('loadDegrees')
				.then(res =>
				{
					this.isLoading = false;
				})
				.catch(err =>
				{
					this.isLoading = false;
				});
		},

		/**
		 * Load Universities list
		 */
		loadUniversities()
		{
			this.$store.dispatch('loadUniversities')
				.then(res =>
				{
					this.isLoading = false;
				})
				.catch(err =>
				{
					this.isLoading = false;
				});
		},
		/**
		 * Load Records list
		 */
		loadRecords(page)
		{
			this.page      = page;
			this.isLoading = true;

			this.$store.dispatch('loadRecords', page)
				.then(res =>
				{
					this.loadFields();
					this.loadParts();
					this.loadDegrees();
				})
				.catch(err =>
				{
					this.isLoading = false;
				});
		},

		/**
		 * Clear errors
		 */
		clearErrors()
		{
			this.errors.clear();

			document.querySelectorAll('.form-control').forEach(x =>
			{
				$(x).removeClass('has-error')
					.parent()
					.addClass('label-floating is-empty');
			});
		},

		/**
		 * New record dialog
		 */
		newRecord()
		{
			this.clearErrors();

			this.insertMode = true;
			this.tempRecord =
				{
					id    : 0,
					suit  : 0,
					native: 0,
					field:
					{
						id: 0
					},
					part:
					{
						id: 0
					},
					degree:
					{
						id: 0
					},
					university:
					{
						id: 0
					}
				};

			alertify.genericDialog($('#registerForm').get(0))
				.set({
					selector  : '#name',
					transition: 'flipx',
				});
		},

		/**
		 * Edit a record
		 */
		editRecord(record)
		{
			this.clearErrors();

			this.insertMode = true;
			this.tempRecord =
				{
					id    : record.id,
					suit  : record.suit,
					native: record.native,
					field: 
					{
						id  : record.field.id,
						name: record.field.name
					},
					part: 
					{
						id  : record.part.id,
						name: record.part.name
					},
					degree: 
					{
						id  : record.degree.id,
						name: record.degree.name
					},
					university: 
					{
						id  : record.university.id,
						name: record.university.name
					}
				};

			alertify.genericDialog($('#registerForm').get(0))
				.set({
					selector  : '#name',
					transition: 'flipx',
				});
		},

		/**
		 * Hide insert/update modal
		 */
		hideModal()
		{
			this.tempRecord = this.emptyRecord;

			alertify.genericDialog()
				.close();
		},

		/**
		 * Delete a record
		 */
		deleteRecord(record)
		{
			let confirmed = () =>
			{
				this.isLoading = true;

				this.$store.dispatch('deleteRecord', record.id)
					.then(res =>
					{
						this.isLoading = false;

						demo.showNotification('حذف رکورد با موفقیت انجام شد', 'success');
					})
					.catch(err =>
					{
						demo.showNotification('خطا در حذف رکورد! این خطا در سامانه ذخیره شد و مورد بررسی قرار خواهد گرفت', 'danger');
					});
			};

			// Setup Alertify
			alertify.confirm("آبا برای حذف اطمینان دارید؟", confirmed);
		},

		/**
		 * Save record
		 */
		saveRecord()
		{
			this.$validator.validateAll()
				.then(result =>
				{
					if (result)
					{
						// Prepare data
						let data = {
							id       : this.tempRecord.id,
							suit     : this.tempRecord.suit,
							native   : this.tempRecord.native,
							field_id : this.tempRecord.field.id,
							part_id  : this.tempRecord.part.id,
							degree_id: this.tempRecord.degree.id,
						};
						
						this.isLoading = true;

						// Try to save
						this.$store.dispatch('saveRecord', data)
							.then(res =>
							{
								this.isLoading = false;

								if (res)
								{
									demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

									this.hideModal();
								}
								else
								{
									demo.showNotification('این نام قبلا ثبت شده است', 'warning');
								}
							})
							.catch(err =>
							{
								this.isLoading = false;

								if (err.response.status)
								{
									demo.showNotification('این نام قبلا ثبت شده است', 'danger');
								}
								else
								{
									demo.showNotification(err.message, 'danger');
								}
							});

						return;
					}

					alertify.alert('خطا', 'خطاها را بر طرف نمایید');
				});
		}
	}
});
