Vue.use(Vuex);

const state = {
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
	 * Set data
	 */
	setData: (state, data) => {
		state._data = data;
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
     * Delete a record
     */
    deleteRecord: (state, index) => {
        state._data.data.splice(index, 1);
    }
};

const actions = {
	/**
	 * Load records data
	 */
	loadRecords(context, page){
		return new Promise((resolve, reject) =>{
			let url = document.pageData.sms.url.sms_index + 
						'?page=' + page;

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
	 * Save Record
	 */
	saveRecord: (context, data) => {
		return new Promise((resolve, reject) =>	{
			let url = document.pageData.sms.url.sms_send;

			axios.post(url, data)
				.then(res => {
					let status = (0 == res.data.status);

					resolve(status);
				})
				.catch(err => reject(err));			
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
            axios.delete('/sms/' + id)
                .then(res => {
                    if (0 == res.data.status) {
                        // Remove form records list
                        context.commit('deleteRecord', index);

                        resolve(res);

                        return;
                    }

                    reject({
                        message: 'امکان حذف وجود ندارد'
                    });
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
