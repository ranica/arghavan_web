Vue.use(Vuex);

const state = {
    _data: {
        data: [],
        current_page: 1,
        from: 1,
        last_page: 1,
        next_page_url: null,
        per_page: 25,
        prev_page_url: null,
        to: 1,
        total: 0,
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

    /**
     * Roles
     */
    roles: state => state._roles,
};

const mutations = {
    /**
     * Set roles
     */
    setRoles: (state, data) => {
        state._roles = data;
    },

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
     * Update an existing record
     */
    updateRecord: (state, payload) => {
        let getters = payload.getters;
        let record  = payload.record;
        
        let currentRecord   = getters.records.filter(el => el.id == record.id)[0];

        if (null != currentRecord){
            currentRecord.name     = record.name;
            currentRecord.description     = record.description;
            currentRecord.roles = record.roles;
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
     * Load roles
     */
    loadRoles(context){
        return new Promise((resolve, reject) => {
            axios.get('/roles/data/all')
                .then(res => {
                    context.commit ('setRoles', res.data);

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
            axios.get('/grouppermits?page=' + page)
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
            axios.delete('/grouppermits/' + id)
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

    /**
     * save a record
     */
    saveRecord: (context, record) => {
        return new Promise((resolve, reject) => {
            // New record
            if (0 == record.id) {
                axios.post('/grouppermits', record)
                    .then(res => {
                        let status = (0 == res.data.status);
                        let newRecord = res.data.grouppermit;

                        if (null != newRecord) {
                            context.commit('insertRecord', newRecord);
                        }

                        resolve(status);
                    })
                    .catch(err => reject(err));
            }

            // Update Record
            else {
                axios.put('/grouppermits/' + record.id, record)
                    .then(res => {
                        let status = (0 == res.data.status);
                        let updatedRecord = res.data.grouppermit;

                        if (null != updatedRecord) {
                            context.commit('updateRecord', {
                                getters: context.getters,
                                record: updatedRecord
                            });
                        }

                        resolve(status);
                    })
                    .catch(err => reject(err));
            }
        });
    },

    /**
     * save Role
     */
    saveRoleRecord: (context, record) =>
    {
        return new Promise((resolve, reject) =>
        {
            let url = '/grouppermits/' + record.grouppermit_id + '/setRole';
            let data = { roles: record.roles };

            axios.put(url, data)
                .then(res =>
                {
                    let status = (0 == res.data.status);
                    let record = res.data.grouppermit;

                    if (null != record)
                    {
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
