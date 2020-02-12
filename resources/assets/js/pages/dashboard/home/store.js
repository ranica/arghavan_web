Vue.use(Vuex);

const state = {
	_gategenders: [],
	_gatepasses: [],
	_gatedirects: [],
	_zones: [],
	_presentData: [],
	_gateActiveData: [],
	_smsData: [],

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

	records: state => state._data.data,
	/**
	 * Return gaterecords list
	 */
	gaterecords: state => state._data.data,
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
	/**
	 * Return Present report
	 */
	presentReports: state => state._presentData,
	/**
	 * Return gate_active report
	 */
	gateActiveReports: state => state._gateActiveData,
	/**
	 * Return sms report
	 */
	smsReports: state => state._smsData,
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
	 * Insert a new record
	 */
	insertRecord: (state, record) => {
		state._data.data.push(record);
	},

	/**
	 * Sets the present report.
	 */
	setPresentReport:(state, data) =>{
		state._presentData = data.data;
	},

	/**
	 * Sets the gate active report.
	 */
	setReportGateActiveData:(state, data) =>{
		state._gateActiveData = data.data;
	},

	/**
	 * Sets sms report.
	 */
	setReportSMSData:(state, data) =>{
		state._smsData = data;
	},

};

const actions = {

	/**
	 * Unlocks the input gate device.
	 *
	 * @param      {<type>}   context  The context
	 * @return     {Promise}  { description_of_the_return_value }
	 */
	unlockGate(context, data) {
        let url = document.pageData.home.tcp_client_unlock ;
		return new Promise((resolve, reject) => {
			axios.post(url, data)
				.then(res => {
					resolve(res);
				})
				.catch(res => reject(res));
		});
	},
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
					    x.refreshMode = true;
    					x.editMode = false;
    					x.deleteMode = false;

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
	 * Load records data
	 */
	loadReportPresents(context, data) {
		return new Promise((resolve, reject) =>	{
			let url = data.url;

			axios.get(url)
				.then(res => {
					// Add "selected" property to items
					let allData = res.data;
					let rowData = allData.data;

					rowData = rowData.map(x => {
						x.selected = false;

						return x;
					});

					// Set data
					context.commit('setPresentReport', allData);

					resolve(res);
				})
				.catch(err => {
					// Empty List
					context.commit('setPresentReport', []);

					resolve(err);
				});
		});
	},

	/**
	 * Load records data
	 */
	loadReportGateActives(context, data) {
		return new Promise((resolve, reject) =>	{
			let url = data.url;

			axios.get(url)
				.then(res => {
					// Add "selected" property to items
					let allData = res.data;
					let rowData = allData.data;

					rowData = rowData.map(x => {
						x.selected = false;

						return x;
					});

					// Set data
					context.commit('setReportGateActiveData', allData);

					resolve(res);
				})
				.catch(err => {
					// Empty List
					context.commit('setReportGateActiveData', []);

					resolve(err);
				});
		});
	},

	/**
	 * Load report SMS data
	 */
	loadReportSMS(context, data) {
		return new Promise((resolve, reject) =>	{
			let url = data.url;

			axios.get(url)
				.then(res => {
					// Add "selected" property to items
					let allData = res.data;
					// let rowData = allData.data;

					// rowData = rowData.map(x => {
					// 	x.selected = false;

					// 	return x;
					// });

					// Set data
					context.commit('setReportSMSData', allData);

					resolve(res);
				})
				.catch(err => {
					// Empty List
					context.commit('setData', []);

					resolve(err);
				});
		});
	},


};

export default new Vuex.Store({
	state,
	getters,
	mutations,
	actions,
});
