Vue.use(Vuex);

const state = {
    _vacationTypes : [],
    _vacationStatuses: [],

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

    /*
    * Return Vacation Type
     */
    vacationTypes: state => state._vacationTypes,

    /*
    * Return Vacation Statuses
     */
    vacationStatuses: state => state._vacationStatuses,
};

const mutations = {
    /**
     * Set data
     */
    setData: (state, data) => {
        state._data = data;
    },

    /*
    * Set Vacation Type
     */
    setVacationType: (state, data) =>{
        state._vacationTypes = data;
    },

    /*
    * Set Vacation Statuses
     */
    setVacationStatuses: (state, data) => {
        state._vacationStatuses = data;
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
     * Delete a record
     */
    deleteRecord: (state, index) => {
        state._data.data.splice(index, 1);
    }
};

const actions = {
    /**
     * Load all Vacation Type
     */
    loadVacationTypes(context) {
        return new Promise((resolve, reject) => {
            axios.get('/vacationTypes')
                .then(res => {

                    context.commit('setVacationType', res.data.data);

                    resolve(res);
                })
                .catch(res => reject(res));
        });
    },

    /**
     * Load all Vacation Statues
     */
    loadVacationStatuses(context) {
        return new Promise((resolve, reject) => {
            axios.get('/vacationStatuses')
                .then(res => {

                    context.commit('setVacationStatuses', res.data.data);

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
            axios.get('/vacationRequests?page=' + page)
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
            axios.delete('/vacationRequests/' + id)
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

    /*
    * Update field  readed
    */
    updateReaded:(context, record) =>{
        return new Promise((resolve, reject) => {
            let url = '/vacationRequests/' + record.id + '/updateField';
            axios.put(url, record)
                .then(res => {
                    let status = (0 == res.data.status);
                    let updatedRecord = res.data.vacationRequest;

                    if (null != updatedRecord) {
                        context.commit('updateRecord', {
                            getters: context.getters,
                            record: updatedRecord
                        });
                    }

                    resolve(status);
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
                axios.post('/vacationRequests', record)
                    .then(res => {
                        let status = (0 == res.data.status);
                        let newRecord = res.data.vacationRequest;

                        if (null != newRecord) {
                            context.commit('insertRecord', newRecord);
                        }

                        resolve(status);
                    })
                    .catch(err => reject(err));
            }

            // Update Record
            else {
                axios.put('/vacationRequests/' + record.id, record)
                    .then(res => {
                        let status = (0 == res.data.status);
                        let updatedRecord = res.data.vacationRequest;

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
       /*
    * Update field  readed
    */
    responseRequest:(context, record) =>{
        return new Promise((resolve, reject) => {
            let url = '/vacationRequests/' + record.id + '/updateRequest';
            axios.put(url, record)
                .then(res => {
                    let status = (0 == res.data.status);
                    let updatedRecord = res.data.vacationRequest;

                    if (null != updatedRecord) {
                        context.commit('updateRecord', {
                            getters: context.getters,
                            record: updatedRecord
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
