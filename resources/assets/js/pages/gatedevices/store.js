Vue.use(Vuex);

const state = {
	_gategenders: [],
	_gatepasses: [],
	_gatedirects: [],
	_zones: [],
	_deviceTypes: [],

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
	 * Return gategenders
	 */
	gategenders: state => state._gategenders,

	/**
	 * Return gatepasses
	 */
	gatepasses: state => state._gatepasses,

	/**
	 * Return gatedirects
	 */
	gatedirects: state => state._gatedirects,

	/**
	 * Return zones
	 */
	zones: state => state._zones,
	deviceTypes: state => state._deviceTypes,
};

const mutations = {
	/**
	 * Set data
	 */
	setData: (state, data) => {
		state._data = data;
	},

	/**
	 * Set Gategenders
	 */
	setGategenders: (state, data) => {
		state._gategenders = data;
	},

	/**
	 * Set Gatedirects
	 */
	setGatedirects: (state, data) => {
		state._gatedirects = data;
	},

	/**
	 * Set Gatepasses
	 */
	setGatepasses: (state, data) => {
		state._gatepasses = data;
	},

	/**
	 * Set Zones
	 */
	setZones: (state, data) => {
		state._zones = data;
	},
	/**
	 * Set ZonesDeviceTypes
	 */
	setDeviceTypes: (state, data) => {
		state._deviceTypes = data;
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
		 if (-1 == index){
            return;
        }

		// Update record
		state._data.data[index].name       = record.name;
		state._data.data[index].ip         = record.ip;
		state._data.data[index].state      = record.state;
		state._data.data[index].timeserver = record.timeserver;
		state._data.data[index].timepass   = record.timepass;

		state._data.data[index].gategender = record.gategender;
		state._data.data[index].gatepass = record.gatepass;
		state._data.data[index].gatedirect = record.gatedirect;
		state._data.data[index].zone       = record.zone;
		state._data.data[index].deviceType       = record.deviceType;

	},

	/**
	 * Delete a gatedevice
	 */
	deleteRecord: (state, index) => {
		state._data.data.splice(index, 1);
	}
};

const actions = {
	/**
	 * Load all gategenders
	 */
	loadGategenders(context) {
		return new Promise((resolve, reject) => {
			axios.get('/gategenders')
				.then(res => {
					context.commit('setGategenders', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all gatepasses
	 */
	loadGatepasses(context) {
		return new Promise((resolve, reject) =>	{
			axios.get('/gatepasses')
				.then(res => {
					context.commit('setGatepasses', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all gatedirects
	 */
	loadGatedirects(context) {
		return new Promise((resolve, reject) => {
			axios.get('/gatedirects')
				.then(res => {
					context.commit('setGatedirects', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all zones
	 */
	loadZones(context) {
		return new Promise((resolve, reject) =>
		{
			axios.get('/zones')
				.then(res =>
				{
					context.commit('setZones', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all DeviceTypes
	 */
	loadDeviceTypes(context) {
		return new Promise((resolve, reject) =>
		{
			axios.get('/deviceTypes')
				.then(res =>
				{
					context.commit('setDeviceTypes', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load records data
	 */
	loadRecords(context, page) {
		return new Promise((resolve, reject) => {
			axios.get('/gatedevices?page=' + page)
				.then(res => {
					// Add "selected" property to items
					let allData = res.data;
					let rowData = allData.data;

					rowData = rowData.map(x => {
						x.selected = false;
					    x.refreshMode = false;
    					x.editMode = true;
    					x.deleteMode = true;

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
	 * save gatedevice
	 */
	saveRecord: (context, record) => {
		return new Promise((resolve, reject) => {
			// New record
			if (0 == record.id) {
				axios.post('/gatedevices', record)
					.then(res => {

						let status    = (0 == res.data.status);
						let newRecord = res.data.gatedevice;

						newRecord.refreshMode = false;
						newRecord.editMode = true;
						newRecord.deleteMode = true;

						if (null != newRecord) {
							context.commit('insertRecord', newRecord);
						}

						resolve(status);
					})
					.catch(err => reject(err));
			}

			// Update record
			else {
				axios.put('/gatedevices/' + record.id, record)
					.then(res => {
						let status       = (0 == res.data.status);
						let updatedRecord = res.data.gatedevice;

						if (null != updatedRecord) {
							context.commit('updateRecord',{
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
		return new Promise((resolve, reject) => {
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
			axios.delete('/gatedevices/' + id)
				.then(res => {
					if (0 == res.data.status){
						// Remove form nationalities list
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
	}
};

export default new Vuex.Store({
	state,
	getters,
	mutations,
	actions,
});
