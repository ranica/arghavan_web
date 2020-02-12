import ExportDataModule from "../export-data/export";
Vue.use(Vuex);
const modules = {
    export_data: ExportDataModule,
};


const state = {
	searchMode: false,
	_userData: [],
	_baseInformation: {},

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
	},
};

const getters = {
	userData: state => state._userData,
	/**
	 * Return BaseInformation
	 */
	baseInformation: state => state._baseInformation,
	searchMode : state => state.searchMode,
	/**
	 * Return record list
	 */
	records: state => state._data.data,

	/**
	 * Return all data
	 */
	allData: state => state._data,
};

const mutations = {
	/**
	 * Turn off search mode
	 * @param  {[type]} state [description]
	 * @return {[type]}       [description]
	 */
	turnOffSearchMode: (state) => {
		state.searchMode = false;
	},
	/**
	 * Set baseInformation
	 */
	setBaseInformation: (state, data) =>{
		state._baseInformation = {
			groups: data.groups,
			genders: data.genders,
			gateDevices: data.gateDevices,
			gateDirects: data.gateDirects,
			gateMessages: data.gateMessages,
			gatePasses: data.gatePasses,
			commonRanges: data.commonRanges,
		};
	},

	/**
	 * Set User Data
	 */
	setUser:(state, data) => {
		state._userData = data;
	},

	/**
	 * Set data
	 */
	setData: (state, data) => {
		state._data = data;
	},

	/**
	 * Set Search Data
	 */
	setSearch: (state, data) => {
		state._data = data;
	},

	/**
	 * Insert a new record
	 */
	insertRecord: (state, record) => {
		let index = state._data.data.map(el => el.id)
		      							.indexOf(record.id);
        if (-1 == index){
            state._data.data.unshift(record);
        }
        else {
        	let oldRecord = state._data.data[index];

        	//oldRecord.field = value
        	/// TODO: Update old record
        }
	},

	/**
	 * Delete a People
	 */
	deleteRecord: (state, index) => {
		state._data.data.splice(index, 1);
	}
};
const actions = {
	/**
	 * Load User
	 */
	loadUser(context, data){
		return new Promise((resolve, reject) => {
				axios.post('/people/loaduser',data.data)
					.then(res => {
						//TODO: check data
						context.commit('setUser', res.data);

						resolve(res);
					})
					.catch(res => reject(res));
			});
	},
	/**
	 * Load all base information
	 */
	loadBaseInformation(context, data) {
		let url = data.url;
		return new Promise((resolve, reject) => {
			axios.get(url)
				.then(res => {
					context.commit('setBaseInformation', res.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load records data
	 */
	loadRecords(context, page) {
		return new Promise((resolve, reject) =>	{
			let url = '/report/showTraffic?page=' + page;

			axios.get(url)
				.then(res => {
					// Add "selected" property to items
					let allData = res.data;
					let rowData = allData.data;

					rowData = rowData.map(x => {
						x.selected = false;

						return x;
					});

					// Update data
					let data = {
						data : allData.data
					};
					data = Object.assign(data, allData.links);
					data = Object.assign(data, allData.meta);

					// Set data
					context.commit('setData', data);

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
	 * Search record
	 */
	searchMyRecord(context, data) {
		return new Promise((resolve, reject) => {
			let url = '/report/searchMyTraffic?page=' + data.page;

			context.state.searchMode = true;
			axios.post(url, data.data)
				.then(res => {
					let allData = res.data;
					let rowData = allData.data;

					rowData = rowData.map(x => {
						x.selected = false;

						return x;
					});

					// Update data
					let data = {
						data : allData.data
					};

					data = Object.assign(data, allData.links);
					data = Object.assign(data, allData.meta);
					context.commit('setSearch', data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Export traffic to PDF
	 */
	exportTrafficPDF(context, data) {
		return new Promise((response, reject) => {
            context.dispatch('export_data/exportData', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
	},
	 /**
     * export traffic to excel
     */
    exportTrafficExcel(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('export_data/exportData', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

	/**
	 * Search record
	 */
	searchRecord(context, data) {
		return new Promise((resolve, reject) => {
			let url = '/report/searchTraffic?page=' + data.page;

			context.state.searchMode = true;

			axios.post(url, data.data)
				.then(res => {
					let allData = res.data;
					let rowData = allData.data;

					rowData = rowData.map(x => {
						x.selected = false;

						return x;
					});

					// Update data
					let data = {
						data : allData.data
					};

					data = Object.assign(data, allData.links);
					data = Object.assign(data, allData.meta);
					context.commit('setSearch', data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Update an existing record
	 */
	updateRecord: (state, payload) => {
		let getters = payload.getters;
		let record  = payload.record;

		let index   = getters.records.map(el => el.id )
									.indexOf(record.id);
		if (-1 == index){
			return;
		}

		getters.records[index] = record;
	},
	/**
	 * save Record
	 */
	saveRecord: (context, record) => {
		return new Promise((resolve, reject) =>	{
			// New record
			if (0 == record.id)	{
				axios.post('/gatetraffics', record)
					.then(res => {
						let status   = (0 == res.data.status);
						let newRecord = res.data.gatetraffic;

						if (null != newRecord) {
							context.commit('insertRecord', newRecord);
						}

						resolve(res.data);
					})
					.catch(err => reject(err));
			}

			// Update record
			else {
				axios.put('/gatetraffics/' + record.id, record)
					.then(res => {
						let status       = (0 == res.data.status);
						let updatedRecord = res.data.gatetraffic;

						if (null != updatedRecord) {
							context.commit('updateRecord', {
									getters: context.getters,
									record : updatedRecord
								});
						}

						resolve(res.data);
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
			axios.delete('/gatetraffics/' + id)
				.then(res => {
					if (0 == res.data.status) {
						// Remove form traffic list
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
};

export default new Vuex.Store({
	state,
	getters,
	mutations,
	actions,
	modules,
});
