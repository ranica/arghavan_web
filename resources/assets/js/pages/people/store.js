Vue.use(Vuex);

const state =
{
	_baseInformation: {},
	_cities      : [],
	_fieldData   : [],
	_terms : [],
	_parents : [],
	_peopleData : [],

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

const getters =
{
	/**
	 * Return records list
	 */
	records: state => state._data.data,
	/**
	 * Return BaseInformation
	 */
	baseInformation: state => state._baseInformation,

	/**
	 * Return all data
	 */
	allData: state => state._data,
	/**
	 * KinType Parent
	 */
	kintypes: state => state._kintypes,

	/**
	 * Parent Data
	 */
	parents: state => state._parents,
	/**
	 * Terms
	 */
	terms: state => state._terms,

	/**
	 * Return cities
	 */
	cities: state => state._cities,

	/**
	 * Return fields
	 */
	fieldData: state => state._fieldData,

	/**
	 * Return people data by code
	 */
	peopleData: state => state._peopleData,
};


const mutations =
{
	/**
	 * Set baseInformation
	 */
	setBaseInformation: (state, data) =>{
		state._baseInformation = {
			groups: data.groups,
			genders: data.genders,
			melliats: data.melliats,
			situations: data.situations,
			provinces: data.provinces,
			degrees: data.degrees,
			parts: data.parts,
			universities: data.universities,
			departments: data.departments,
			contracts: data.contracts,
			cardtypes: data.cardtypes,
			grouppermits: data.grouppermits,
			terms: data.terms,
			gategroups: data.gategroups,
			gateplans: data.gateplans,
			kintypes: data.kintypes,
		};
	},
	/**
	 * Sets the image url.
	 */
	setImageUrl(state, data){
		// data.people.pictureUrl = data.thumb_url;
		// data.people.people.pictureThumbUrl = data.thumb_url;
	},

	/**
	 * Set data
	 */
	setData: (state, data) => {
		state._data = data;
	},

	/**
	 * Set people data by code
	 */
	setPeopleData: (state, data) => {
		state._peopleData = data;
		state._cities = data.cities;
	},
	/**
	 * Set Parent
	 */
	setParents: (state, data) => {
		state._parents = data;
	},
	/**
	 * Set term
	 */
	setTerms: (state, data) => {
		state._terms = data;
	},
	/**
	 * Set cities
	 */
	setCities: (state, data) =>	{
		state._cities = data;
	},
	/**
	 * Set fields
	 */
	setFields: (state, data) => {
		state._fieldData = data;
	},
	/**
	 * Update an existing Parent record
	 */
	updateParentRecord: (state, payload) => {
		let getters = payload.getters;
		let record  = payload.record;

		let index   = getters._parents.map(el => el.id )
									.indexOf(record.id);

		if (-1 == index){
			return;
		}

		getters._parents[index] = record;
	},

	/**
	 * Insert a new record
	 */
	insertRecord: (state, record) =>
	{
		let oldRecord = state._data.data.filter(el => el.id == record.id);

        if (null == oldRecord){
            oldRecord == [];
        }

        if (0 == oldRecord.length){
            state._data.data.unshift(record);
        }
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
	 * Update data
	 */
	// updateData: (state, data) => {

	// 	state._data[data.index] = data.data;
	// },


	/**
	 * Delete a People
	 */
	deleteRecord: (state, index) => {
		state._data.data.splice(index, 1);
	}
};

const actions = {
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

						// if (null != updatedRecord) {
						// 	context.commit('updateParentRecord', {
						// 			getters: context.getters,
						// 			record : updatedRecord
						// 		});
						// }

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
	 * Load Terms
	 */
	loadTerms(context){
		return new Promise((resolve, reject) => {
			let url = '/terms/data/all';
			axios.get(url)
				.then(res => {
					context.commit ('setTerms', res.data);
					resolve(res);
				})
				.catch(err => reject(err) );
		});
	},

	/*
	Upload Image
	 */
	uploadImage(context, record){
		return new Promise((resolve, reject) => {
			let url = '/people/uploadImage';
			axios.post(url, record.formData, record.config)
				.then(res => {
					resolve(res);
				})
				.catch(err => reject(err) );
		});
	},

	/**
	 * Load Data by national code
	 */
	loadDataByNationaId(context, data) {
		return new Promise((resolve, reject) =>	{
			let url = data.url;
			axios.get(url, data)
				.then(res => {
					context.commit('setPeopleData', res.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load Data by national code
	 */
	existsCodeUser(context, data) {
		return new Promise((resolve, reject) =>	{
			let url = data.url + '?code=' + data.code;
			axios.get(url)
				.then(res => {
					// context.commit('setPeopleData', res.data);
					resolve(res);
				})
				.catch(res => reject(res));
		});
	},
	/**
	 * Determines if it exists national user.
	 *
	 * @param      {<type>}   context  The context
	 * @param      {<type>}   data     The data
	 * @return     {Promise}  True if exists national user, False otherwise.
	 */
	existsNationalUser(context, data) {
		return new Promise((resolve, reject) =>	{
			let url = data.url + '?nationalId=' + data.nationalId;
			axios.get(url)
				.then(res => {
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
			axios.get('/province/allProvince')
				.then(res => {

					context.commit('setProvinces', res.data);

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
	 * Load records data
	 */
	loadRecords(context, data) {
		let page = data.page;
		let id = data.id;

		return new Promise((resolve, reject) =>	{
			let searchWord = data.searchWord;
			let url = document.pageData.people.load_url + '/' + id +
							'?page=' + page;

			if (searchWord != null) {
				url += "&search=" + searchWord;
			}

			axios.get(url)
				.then(res => {
					// Add "selected" property to items
					let allData = res.data;
					console.log('allData', allData);
					// let rowData = allData.data;

					// rowData = rowData.map(x => {
					// 	x.selected = false;

					// 	return x;
					// });

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
	// loadUsers(context, data) {
	// 	return new Promise((resolve, reject) =>	{
	// 		let url = '/people/loaduser';
	// 		data = { 'code': data };

	// 		axios.post(url, data)
	// 			.then(res => {
	// 				let allData = res.data;
	// 				let rowData = allData.data;

	// 				rowData = rowData.map(x => {
	// 					x.selected = false;

	// 					return x;
	// 				});

	// 				// Set data
	// 				context.commit('setData', allData);
	// 				resolve(res);
	// 			})
	// 			.catch(err => {
	// 				// Empty List
	// 				context.commit('setData', []);

	// 				resolve(err);
	// 			});
	// 	});
	// },

	/**
	 * save Record
	 */
	saveRecord: (context, record) => {
		return new Promise((resolve, reject) =>	{
			// New record
			if (0 == record.id)	{
				axios.post('/registration', record)
					.then(res => {
						let status   = (0 == res.data.status);
						let newRecord = res.data.register;

						if ((null != newRecord) && (record.lastGroupId == newRecord.group.id)) {
							context.commit('insertRecord', newRecord);
						}

						resolve(res.data);
					})
					.catch(err => reject(err));
			}

			// Update record
			else {
				axios.put('/registration/' + record.id, record)
					.then(res => {
						let status       = (0 == res.data.status);
						let updatedRecord = res.data.register;

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
			axios.delete('/registration/' + id)
				.then(res => {
					if (0 == res.data.status) {
						// Remove form people list
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
	 * save Terms
	 */
	saveTermRecord: (context, record) => {
		return new Promise((resolve, reject) =>	{
			let url = '/people/' + record.user_id + '/setTerm';
			let data = {
				terms: record.terms
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
	 * save Gate Plan
	 */
	saveGatePlanRecord: (context, record) => {
		return new Promise((resolve, reject) =>	{
			let url = '/people/' + record.user_id + '/setGatePlan';
			let data = {
				gateplans: record.gateplans
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
	 * Upload Image From folder
	 * @param {*} context
	 */
	uploadImageRecord(context) {
		return new Promise((resolve, reject) =>	{
			// Try to delete
			axios.get('/uploadImageFromFolder')
				.then(res => {
					if (0 == res.data.status) {

						resolve(res);
						return;
					}

					reject({
						message: 'امکان بارگذاری وجود ندارد'
					});
				})
				.catch(err => {
					reject(err);
				});
		});
	},

	/**
	 * Load Data by national code
	 */
	loadPicFingerprint(context, data) {
		return new Promise((resolve, reject) =>	{
			//let url = data.url;
			 let url = data.url + '?userId=' + data.userId;
			//console.log('store -> data.userId', data);
			axios.get(url)
				.then(res => {
					//console.log('store -> loadPicFingerprint -> res', res);
					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

};

export default new Vuex.Store({
	state,
	getters,
	mutations,
	actions,
});
