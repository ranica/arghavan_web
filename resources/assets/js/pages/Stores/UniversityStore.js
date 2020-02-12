Vue.use(Vuex);

const state = 
{
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
	},
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
	 * Insert a record
	 */
	insertRecord: (state, record) =>
	{
		state._data.data.push(record);
	},

	/**
	 * Update an existing universities
	 */
	updateRecord: (state, payload) =>
	{
		let getters = payload.getters;
		let record = payload.record;

		let index = getters.records
			.map(el => el.id)
			.indexOf(record.id);

		// Update record
		state._data.data[index].name = record.name;
	},

	/**
	 * Delete a record
	 */
	deleteRecord: (state, index) =>
	{
		state._data.data.splice(index, 1);
	}
};


const actions = 
{
	/**
	 * Load records data
	 */
	loadRecords(context, page)
	{
		return new Promise((resolve, reject) =>
		{
			axios.get('/universities?page=' + page)
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
	 * Delete a record
	 */
	delete(context, id)
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
			axios.delete('/universities/' + id)
				.then(res =>
				{
					if (0 == res.data.status)
					{
						// Remove form universities list
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
	},

	saveRecord: (context, record) =>
	{
		return new Promise((resolve, reject) =>
		{
			// New record
			if (0 == record.id)
			{
				axios.post('/universities', record)
					.then(res =>
					{
						let status      = (0 == res.data.status);
						let newRecord = res.data.university;

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
				axios.put('/universities/' + record.id, record)
					.then(res =>
					{
						let status          = (0 == res.data.status);
						let updatedRecord = res.data.university;

						if (null != updatedRecord)
						{
							context.commit('updateRecord',
								{
									getters: context.getters,
									record: updatedRecord
								});
						}

						resolve(status);
					})
					.catch(err => reject(err));
			}
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
