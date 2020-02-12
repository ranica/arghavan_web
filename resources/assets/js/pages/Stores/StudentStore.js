Vue.use(Vuex);

const state =
{
	_fields      : [],
	
	_degrees     : [],
	
	_universities: [],
	
	_parts       : [],	

	_data:
	{
		data         : [],
		current_page : 1,
		from         : 1,
		last_page    : 1,
		next_page_url: null,
		per_page     : 25,
		prev_page_url: null,
		to           : 1,
		total        : 0,
	}
};

const getters =
{
	/**
	 * Return records list
	 */
	records: state => state._data.data,

	/**
	 * Return all data
	 */
	allData: state => state._data,

	/**
	 * Return fields
	 */
	fields: state => state._fields,

	/**
	 * Return degrees
	 */
	degrees: state => state._degrees,

	/**
	 * Return universities
	 */
	universities: state => state._universities,

	/**
	 * Return parts
	 */
	parts: state => state._parts
};

const mutations =
{
	/**
	 * Set data
	 */
	setData: (state, data) =>
	{
		state._data = data;
	},

	/**
	 * Set fields
	 */
	setFields: (state, data) =>
	{
		state._fields = data;
	},

	/**
	 * Set degrees
	 */
	setDegrees: (state, data) =>
	{
		state._degrees = data;
	},

	/**
	 * Set university
	 */
	setUniversities: (state, data) =>
	{
		state._universities = data;
	},

	/**
	 * Set parts
	 */
	setParts: (state, data) =>
	{
		state._parts = data;
	},

	/**
	 * Insert a new record
	 */
	insertRecord: (state, record) =>
	{
		state._data.data.push(record);
	},

	/**
	 * Update an existing record
	 */
	updateRecord: (state, payload) =>
	{
		let getters = payload.getters;
		let record  = payload.record;
		let index   = getters.records
			.map(el => el.id)
			.indexOf(record.id);

		// Update record
		state._data.data[index].suit   = record.suit;
		state._data.data[index].native = record.native;
		state._data.data[index].field  = record.field;
		state._data.data[index].part   = record.part;
		state._data.data[index].degree = record.degree;
	},

	/**
	 * Delete a student
	 */
	deleteRecord: (state, index) =>
	{
		state._data.data.splice(index, 1);
	}
};

const actions =
{
	/**
	 * Load all Fields
	 */
	loadFields(context)
	{
		return new Promise((resolve, reject) =>
		{
			axios.get('/fields')
				.then(res =>
				{
					context.commit('setFields', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all Parts
	 */
	loadParts(context)
	{
		return new Promise((resolve, reject) =>
		{
			axios.get('/parts')
				.then(res =>
				{
					context.commit('setParts', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all Degrees
	 */
	loadDegrees(context)
	{
		return new Promise((resolve, reject) =>
		{
			axios.get('/degrees')
				.then(res =>
				{
					context.commit('setDegrees', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all Universities
	 */
	loadUniversities(context)
	{
		return new Promise((resolve, reject) =>
		{
			axios.get('/universities')
				.then(res =>
				{
					context.commit('setUniversities', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load records data
	 */
	loadRecords(context, page)
	{
		return new Promise((resolve, reject) =>
		{
			axios.get('/students?page=' + page)
				.then(res =>
				{
					// Add "selected" property to items
					let allData = res.data;
					let rowData = allData.data;

					rowData = rowData.map(x =>
					{
						x.selected = false;

						return x;
					});

					// Set data
					context.commit('setData', allData);

					resolve(res);
				})
				.catch(err =>
				{
					// Empty List
					context.commit('setData', []);

					resolve(err);
				});
		});
	},

	/**
	 * save Student
	 */
	saveRecord: (context, record) =>
	{
		return new Promise((resolve, reject) =>
		{
			// New record
			if (0 == record.id)
			{
				axios.post('/students', record)
					.then(res =>
					{
						let status   = (0 == res.data.status);
						let newRecord = res.data.student;

						if (null != newRecord)
						{
							context.commit('insertRecord', newRecord);
						}

						resolve(status);
					})
					.catch(err => reject(err));
			}

			// Update record
			else
			{
				axios.put('/students/' + record.id, record)
					.then(res =>
					{
						let status       = (0 == res.data.status);
						let updatedRecord = res.data.student;

						if (null != updatedRecord)
						{
							context.commit('updateRecord',
								{
									getters: context.getters,
									record : updatedRecord
								});
						}

						resolve(status);
					})
					.catch(err => reject(err));
			}
		});
	},

	/**
	 * Delete a Record
	 */
	deleteRecord(context, id)
	{
		return new Promise((resolve, reject) =>
		{
			// Get item index
			let index = context.getters.records
				.map(el => el.id)
				.indexOf(id);

			// Record not found!
			if (-1 == index)
			{
				reject({
					message: 'رکورد مورد نظر یافت نشد',
				});

				return;
			}

			// Try to delete
			axios.delete('/students/' + id)
				.then(res =>
				{
					if (0 == res.data.status)
					{
						// Remove form students list
						context.commit('deleteRecord', index);

						resolve(res);

						return;
					}

					reject(
					{
						message: 'امکان حذف وجود ندارد'
					});
				})
				.catch(err =>
				{
					reject(err);
				});
		});
	}
};

export default new Vuex.Store(
{
	state,
	getters,
	mutations,
	actions,
});
