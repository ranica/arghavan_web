Vue.use(Vuex);

const state = {
	_melliats    : [],
	_groups      : [],
	_genders     : [],
	_situations  : [],
	_provinces   : [],
	_cities      : [],
	_universities: [],
	_fields      : [],
	_degrees     : [],
	_parts       : [],
	_contracts   : [],
	_departments   : [],
	_cardtypes : [],
	_kintypes: [],
	_parents: [],

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
	 * KinType Parent
	 */
	kintypes: state => state._kintypes,

	/**
	 * Return  Parent data
	 */
	parents: state => state._parents,

	/**
	 * Return melliats
	 */
	melliats: state => state._melliats,

	/**
	 * Return genders
	 */
	genders: state => state._genders,

	/**
	 * Return groups
	 */
	groups: state => state._groups,

	/**
	 * Return situations
	 */
	situations: state => state._situations,

	/**
	 * Return provinces
	 */
	provinces: state => state._provinces,

	/**
	 * Return cities
	 */
	cities: state => state._cities,

	/**
	 * Return degrees
	 */
	degrees: state => state._degrees,

	/**
	 * Return parts
	 */
	parts: state => state._parts,

	/**
	 * Return fields
	 */
	fields: state => state._fields,

	/**
	 * Return universities
	 */
	universities: state => state._universities,

	/**
	 * Return departments
	 */
	departments: state => state._departments,

	/**
	 * Return contracts
	 */
	contracts: state => state._contracts,

	/*
	CardTypes
	 */
	cardtypes: state => state._cardtypes,

};

const mutations = {

	/**
	 * Set Kintypes
	 */
	setKintypes: (state, data) => {
		state._kintypes = data;
	},

	/**
	 * Set Parent
	 */
	setParents: (state, data) => {
		state._parents = data;
	},

	/**
	 * Update an existing record
	 */
	updateRecord: (state, payload) => {
		let getters = payload.getters;
		let record  = payload.record;

		let index   = getters.records.map(el => el.id)
									.indexOf(record.id);

		if (-1 == index){
			return;
		}

		getters.records[index] = record;
	},
	/**
	 * Set Search Data
	 */
	setSearch: (state, data) => {
		if (data.card == null){

			data.card = {
				id : 0,
				cdn: '',
			}
		}
		state._data = data;
	},

	/**
	 * Set melliats
	 */
	setMelliats: (state, data) => {
		state._melliats = data;
	},

	/**
	 * Set groups
	 */
	setGroups: (state, data) => {
		state._groups = data;
	},

	/**
	 * Set genders
	 */
	setGenders: (state, data) => {
		state._genders = data;
	},

	/**
	 * Set situations
	 */
	setSituations: (state, data) =>	{
		state._situations = data;
	},
	/**
	 * Set provinces
	 */
	setProvinces: (state, data) => {
		state._provinces = data;
	},

	/**
	 * Set cities
	 */
	setCities: (state, data) =>	{
		state._cities = data;
	},

	/**
	 * Set universities
	 */
	setUniversities: (state, data) => {
		state._universities = data;
	},

	/**
	 * Set fields
	 */
	setFields: (state, data) => {
		state._fields = data;
	},

	/**
	 * Set degrees
	 */
	setDegrees: (state, data) => {
		state._degrees = data;
	},

	/**
	 * Set parts
	 */
	setParts: (state, data) => {
		state._parts = data;
	},

	/**
	 * Set departments
	 */
	setDepartments: (state, data) => {
		state._departments = data;
	},

	/**
	 * Set contracts
	 */
	setContracts: (state, data) => {
		state._contracts = data;
	},

	/**
	 * Set cardtypes
	 */
	setCardtypes: (state, data) => {
		state._cardtypes = data;
	},

	/**
	 * Delete Parent record
	 */
	deleteParentRecord: (state, index) => {
		state._dataParent.data.splice(index, 1);
	},

};

const actions = {
	/**
	 * Search Record
	 *
	 */
	searchRecord(context, data) {
		return new Promise((resolve, reject) => {

			axios.post('/report/search', data)
				.then(res => {

					let allData = res.data;

					let rowData = allData.data;

					rowData = rowData.map(x => {
						x.selected = false;

						return x;
					});

					context.commit('setSearch', allData);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Search edit user
	 *
	 */
	searchEditRecord(context, data) {
		return new Promise((resolve, reject) => {
			axios.post('/report/search/edit', data)
				.then(res => {
					let allData = res.data;

					let rowData = allData.data;

					rowData = rowData.map(x => {
						x.selected = false;

						return x;
					});
					resolve(res.data);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all melliats
	 */
	loadMelliats(context) {
		return new Promise((resolve, reject) => {
			axios.get('/melliats')
				.then(res => {
					context.commit('setMelliats', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all groups
	 */
	loadGroups(context) {
		return new Promise((resolve, reject) =>	{
			axios.get('/groups')
				.then(res => {
					context.commit('setGroups', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all genders
	 */
	loadGenders(context) {
		return new Promise((resolve, reject) => {
			axios.get('/genders')
				.then(res => {
					context.commit('setGenders', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all situations
	 */
	loadSituations(context) {
		return new Promise((resolve, reject) =>	{
			axios.get('/situations')
				.then(res => {
					context.commit('setSituations', res.data.data);
					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all provinces
	 */
	loadProvinces(context) {
		return new Promise((resolve, reject) =>	{
			axios.get('/provinces')
				.then(res => {
					context.commit('setProvinces', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all cities
	 */
	loadCities(context, provinceId)	{
		return new Promise((resolve, reject) =>	{
			axios.get('/cities/' + provinceId)
				.then(res => {

					context.commit('setCities', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all fields
	 */
	loadFields(context, universityId) {
		return new Promise((resolve, reject) =>	{
			axios.get('/fields/' + universityId)
				.then(res => {
					context.commit('setFields', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all degrees
	 */
	loadDegrees(context) {
		return new Promise((resolve, reject) =>	{
			axios.get('/degrees')
				.then(res => {
					context.commit('setDegrees', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all universities
	 */
	loadUniversities(context) {
		return new Promise((resolve, reject) =>	{
			axios.get('/universities')
				.then(res => {
					context.commit('setUniversities', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all parts
	 */
	loadParts(context) {
		return new Promise((resolve, reject) =>	{
			axios.get('/parts')
				.then(res => {
					context.commit('setParts', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all contract
	 */
	loadContracts(context) {
		return new Promise((resolve, reject) =>	{
			axios.get('/contracts')
				.then(res => {
					context.commit('setContracts', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all departments
	 */
	loadDepartments(context) {
		return new Promise((resolve, reject) =>	{
			axios.get('/departments')
				.then(res => {
					context.commit('setDepartments', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all departments
	 */
	loadCardtypes(context) {
		return new Promise((resolve, reject) =>	{
			axios.get('/cardtypes')
				.then(res => {
					context.commit('setCardtypes', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all Kintypes
	 */
	loadKintypes(context) {
		return new Promise((resolve, reject) =>	{
			axios.get('/kintypes')
				.then(res => {

					context.commit('setKintypes', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * save Record
	 */
	saveRecord: (context, record) => {
		return new Promise((resolve, reject) =>	{
			// New record
		axios.put('/registration/' + record.id, record)
			.then(res => {
				let status       = (0 == res.data.status);
				//let updatedRecord = res.data.register;

				// if (null != updatedRecord) {
				// 	context.commit('updateRecord', {
				// 			getters: context.getters,
				// 			record : updatedRecord
				// 		});
				// }

				resolve(res.data);
			})
			.catch(err => reject(err));
		});
	},

	/**
	 * save Grouppermit
	 */
	saveGroupPermitRecord: (context, record) => {
		return new Promise((resolve, reject) =>
		{
			let url = '/people/' + record.user_id + '/setGrouppermit';
			let data = {
				grouppermits: record.grouppermits
			};

			axios.put(url, data)
				.then(res => {

					let status = (0 == res.data.status);
					let record = res.data.user;

					if (null != record) {
						context.commit ('updateRecord', {
									getters: context.getters,
									record : record[0]
								});
					}
					resolve(status);
				})
				.catch(err => reject(err));
		});
	},


	/**
	 * save Gate Group
	 */
	saveGateGroupRecord: (context, record) => {
		return new Promise((resolve, reject) =>	{
			let url = '/people/' + record.user_id + '/setGateGroup';
			let data = {
				gategroups: record.gategroups
			};

			axios.put(url, data)
				.then(res => {

					let status = (0 == res.data.status);
					let record = res.data.user;

					if (null != record) {
						context.commit ('updateRecord', {
							 		getters: context.getters,
									record : record[0]
								});
					}
					resolve(status);
				})
				.catch(err => reject(err));
		});
	},

	/**
	 * Load Parent records data
	 */
	loadParentRecords(context, data) {
		return new Promise((resolve, reject) => {
			let url = '/people/' + data + '/loadParent';
			axios.get(url)
				.then(res => {

					let status   = (0 == res.data.status);
					let record = res.data.relative;

					if (null != record) {
						// Set data
						context.commit('setParents', record);
					}
					resolve(res);
				})
				.catch(err => {
					// Empty List
					context.commit('setParents', []);

					resolve(err);
				});
		});
	},

	/**
	 * save Parnet
	 */
	saveParentRecord: (context, record) => {
		return new Promise((resolve, reject) =>	{
			// New record
			if (0 == record.id)	{
				axios.post('/relatives', record)
					.then(res => {
						let status   = (0 == res.data.status);
						let record = res.data.relative;

						// if (null != record) {
						// 	this.loadParentRecords(record.people_id);
						// }

						resolve(status);
					})
					.catch(err => reject(err));
			}

			// Update record
			else {
				axios.put('/relatives/' + record.id, record)
					.then(res => {
						let status       = (0 == res.data.status);
						let updatedRecord = res.data.relative;

						resolve(status);
					})
					.catch(err => reject(err));
			}
		});
	},

	/**
	 * Delete a Record
	 */
	deleteParentRecord(context, id) {
		return new Promise((resolve, reject) =>	{
			// Try to delete
			axios.delete('/relatives/' + id)
				.then(res => {
					if (0 == res.data.status) {
						// Remove form  list
						//context.commit('deleteParentRecord', index);
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
	* Load Group Permit By User_id
	*/
	loadGrouppermitsByUserId(context, data) {
		return new Promise((resolve, reject) => {
			let url = '/grouppermit/' + data + '/loadGroupPermit';
			axios.get(url)
				.then(res => {

					resolve(res.data);
				})
				.catch(err => {

					resolve(err);
				});
		});
	},

	/**
	* Load Group Permit By User_id
	*/
	loadGateGroupByUserId(context, data) {
		return new Promise((resolve, reject) => {
			let url = '/gategroup/' + data + '/loadGateGroup';
			axios.get(url)
				.then(res => {

					resolve(res.data);
				})
				.catch(err => {

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
