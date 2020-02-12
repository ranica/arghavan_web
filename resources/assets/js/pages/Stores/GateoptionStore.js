Vue.use(Vuex);

const state = {
	_gatezones: [],
	_gatedevices: [],

	_data: {
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

const getters = {
	/**
	 * Return records list
	 */
	records: state => state._data.data,

	/**
	 * Return all data
	 */
	allData: state => state._data,

	/**
	 * Return gateZoneStates
	 */
	gatezones: state => state._gatezones,
	/**
	 * Gate devices
	 */
	gatedevices: state => state._gatedevices,
};

const mutations = {
	/**
	 * Set data
	 */
	setData: (state, data) => {
		state._data = data;
	},

	/**
	 * Set GateZone
	 */
	setGatezones: (state, data) => {
		state._gatezones = data;
	},

	/**
	 * Set Gate device
	 */
	setGatedevices: (state, data) => {
		state._gatedevices = data;
	},

	/**
	 * Insert a new record
	 */
	insertRecord: (state, record) => {
		state._data.data.push(record);
	},

	/**
	 * Update an existing record
	 */
	updateRecord: (state, payload) => {
		let getters = payload.getters;
		let record  = payload.record;
		let index   = getters.records
			.map(el => el.id)
			.indexOf(record.id);

		// Update record
		state._data.data[index].startDate  = record.startDate;
		state._data.data[index].endDate    = record.endDate;
		state._data.data[index].port       = record.port;
		state._data.data[index].emergency  = record.emergency;
		state._data.data[index].gatezone_w = record.gatezone_w;
		state._data.data[index].gatezone_m = record.gatezone_m;
		state._data.data[index].gatedevices = record.gatedevices;

	},

	/**
	 * Delete a field
	 */
	deleteRecord: (state, index) =>	{
		state._data.data.splice(index, 1);
	}
};

const actions = {
	/**
	 * Load all gateZone
	 */
	loadGatezones(context) {
		return new Promise((resolve, reject) =>	{
			axios.get('/gatezones')
				.then(res => {
					context.commit('setGatezones', res.data.data);
					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load Gatedevices
	 */
	loadGateDevices(context){
		return new Promise((resolve, reject) => {
			axios.get('/gatedevices/data/all')
				.then(res => {

					context.commit ('setGatedevices', res.data);

					resolve(res);
				})
				.catch(err => reject(err) );
		});
	},

	/**
	 * Load records data
	 */
	loadRecords(context, page) {
		return new Promise((resolve, reject) => {
			axios.get('/gateoptions?page=' + page)
				.then(res =>
				{
					// Add "selected" property to items
					let allData = res.data;
					let rowData = allData.data;

					rowData = rowData.map(x => {
						x.selected = false;

						return x;
					});

					// Set data
					context.commit('setData', allData);

					resolve(res);
				})
				.catch(err => {
					// Empty List
					context.commit('setData', []);

					resolve(err);
				});
		});
	},

	/**
	 * save Field
	 */
	saveRecord: (context, record) => {
		return new Promise((resolve, reject) =>	{
			// New record
			if (0 == record.id)	{
				axios.post('/gateoptions', record)
					.then(res => {
						let status   = (0 == res.data.status);
						let newRecord = res.data.gateoption;

						if (null != newRecord) {
							context.commit('insertRecord', newRecord);
						}

						resolve(status);
					})
					.catch(err => reject(err));
			}

			// Update record
			else {
				axios.put('/gateoptions/' + record.id, record)
					.then(res => {
						let status       = (0 == res.data.status);
						let updatedRecord = res.data.gateoption;

						if (null != updatedRecord) {
							context.commit('updateRecord', {
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
	deleteRecord(context, id) {
		return new Promise((resolve, reject) =>	{
			// Get item index
			let index = context.getters.records
				.map(el => el.id)
				.indexOf(id);

			// Record not found!
			if (-1 == index) {
				reject({
					message: 'رکورد مورد نظر یافت نشد',
				});

				return;
			}

			// Try to delete
			axios.delete('/gateoptions/' + id)
				.then(res => {
					if (0 == res.data.status) {
						// Remove form gate option list
						context.commit('deleteRecord', index);

						resolve(res);

						return;
					}

					reject({
						message: 'امکان حذف وجود ندارد'
					});
				})
				.catch(err => {
					reject(err);
				});
		});
	},
		/**
	 * save Gate device
	 */
	saveGateDeviceRecord: (context, record) => {
		return new Promise((resolve, reject) =>	{
			let url = '/gateoptions/' + record.gateoption_id + '/setGatedevice';
			let data = { gatedevices: record.gatedevices };

			axios.put(url, data)
				.then(res => {
					let status = (0 == res.data.status);
					let record = res.data.gateoption;

					if (null != record) {
						context.commit ('updateRecord', {
									getters: context.getters,
									record : record
								});
					}

					resolve(status);
				})
				.catch(err => reject(err));
		});
	},
};

export default new Vuex.Store({
	state,
	getters,
	mutations,
	actions,
});
