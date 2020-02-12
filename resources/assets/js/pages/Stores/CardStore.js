Vue.use(Vuex);

const state = {
	_groups: [],
	_cardtypes: [],
	_searchdata: [],
	_searchDataCard: [],
	_carddata: [],

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
	 * Return groups
	 */
	groups: state => state._groups,

	/**
	 * Return types card
	 */
	cardtypes: state => state._cardtypes,

	/**
	 * Return Search Data
	 */
	searchdata: state => state._searchdata,
	searchDataCard: state => state._searchDataCard,

	/**
	 * Return Card Data
	 */
	carddata: state => state._carddata,
};

const mutations = {
	/**
	 * Set Search Data
	 */
	setSearch: (state, data) => {

		if(data.length > 0){
			state._searchDataCard =  data[0].cards;
		}
		state._searchdata = data;
	},

	/**
	 * Set Card Data
	 */
	setCard: (state, data) => {
		state._carddata = data;
	},

	/**
	 * Set data
	 */
	setData: (state, data) => {
		state._data = data;
	},

	/**
	 * Set groups
	 */
	setGroups: (state, data) =>	{
		state._groups = data;
	},

	/**
	 * Set type card
	 */
	setCardtypes: (state, data) => {
		state._cardtypes = data;
	},

	/**
     * Insert a Record
     */
    insertRecord: (state, record) => {
        let oldRecord = state._data.data.filter(el => el.id == record.id);

        if (null == oldRecord){
            oldRecord == [];
        }

        if (0 == oldRecord.length){
            state._data.data.push(record);
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
	 * Delete a cards
	 */
	deleteRecord: (state, index) =>	{
		state._data.data.splice(index, 1);
	}
};

const actions = {
	/**
	 * Load all groups
	 */
	loadGroups(context) {
		return new Promise((resolve, reject) => {
			axios.get('/groups')
				.then(res => {
					context.commit('setGroups', res.data.data);

					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load all type Card
	 */
	loadCardtypes(context) {
		return new Promise((resolve, reject) => {
			axios.get('/cardtypes')
				.then(res => {
					context.commit('setCardtypes', res.data.data);

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
			let url = document.pageData.load_url + '/' + id +
							'?page=' + page;

			if (searchWord != null)
			{
				url += "&search=" + searchWord;
			}

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
	 * save cards
	 */
	 saveRecord: (context, record) => {
        return new Promise((resolve, reject) => {
            // New record
            if (0 == record.id) {
                axios.post('/cards', record)
                    .then(res => {
                        let status = (0 == res.data.status);
                        let newRecord = res.data.card;

                        if (null != newRecord) {
                            context.commit('insertRecord', newRecord);
                        }

                        resolve(status);
                    })
                    .catch(err => reject(err));
            }

            // Update Record
            else {
                axios.put('/cards/' + record.id, record)
                    .then(res => {

                        let status = (0 == res.data.status);
                        let updatedRecord = res.data.card;

                        if (null != updatedRecord) {

                            context.commit('updateRecord', {
                                getters: context.getters,
                                record: updatedRecord.card
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
			axios.delete('/cards/' + id)
				.then(res => {
					if (0 == res.data.status) {
						// Remove form cards list
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
	 * Search info
	 */
	searchRecord(context, data) {
		return new Promise((resolve, reject) => {
			axios.post('/card/search', data)
				.then(res => {

					let allData = res.data;
					let rowData = allData.data;

					rowData = rowData.map(x =>
					{
						x.selected = false;

						return x;
					});

					context.commit('setSearch', allData.data);
					resolve(res);
				})
				.catch(res => reject(res));
		});
	},

	/**
	 * Load records data
	 */
	loadCard(context, data) {
		return new Promise((resolve, reject) =>	{
			axios.post('/card/loadCard', data)
				.then(res => {
					// Add "selected" property to items
					// let allData = res.data[0];

					// let rowData = allData.data;

					// rowData = rowData.map(x => {
					// 	x.selected = false;

					// 	return x;
					// });

					// Set data
					// context.commit('setCard', allData);

					let cardData = res.data[0];

					cardData = cardData ? cardData : {
														id: null,
														cdn: null,
														state: null,
														startDate: null,
														endDate: null,
													};

					resolve(cardData);
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
	searchCard(context, data) {
		return new Promise((resolve, reject) => {
			let url = '/cards/searchCard?page=' + data.page;

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
					context.commit('setData', data);

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
