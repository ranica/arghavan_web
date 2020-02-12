Vue.use(Vuex);

const state = {
    _carColors: [],
    _carTypes: [],
    _carLevels: [],
    _carSystems: [],
    _carModels: [],
    _carFuels: [],
    _carPlateCities: [],
    _carPlateTypes: [],
    _cards: [],
    _groups: [],
    _searchdata: [],
    _searchDataCar: [],


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
     * Return groups
     */
    groups: state => state._groups,
    /**
     * Return Search Data
     */
    searchdata: state => state._searchdata,
    searchDataCar: state => state._searchDataCar,

    /**
     * Return Car Color
     */
    car_colors: state => state._carColors,
    /**
     * Return Car Type
     */
    car_types: state => state._carTypes,
    /**
     * Return Car Model
     */
    car_models: state => state._carModels,
    /**
     * Return  Car System
     */
    car_systems: state => state._carSystems,
    /**
     * Return  Car Level
     */
    car_levels: state => state._carLevels,
    /**
     * Return  Car Fuel
     */
    car_fuels: state => state._carFuels,

    /**
     * Return  Plate City
     */
    car_plate_cities: state => state._carPlateCities,

    /**
     * Return Car Plate Type
     */
    car_plate_types: state => state._carPlateTypes,
};

const mutations = {
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
        if(data.length > 0){
            state._searchDataCar =  data[0].cars;
        }
        state._searchdata = data;
    },
      /**
     * Set groups
     */
    setGroups: (state, data) => {
        state._groups = data;
    },

    /**
     * Set Car Car Color
     */
    setCarColors: (state, data) => {
        state._carColors = data;
    },

    /**
     * Set Car Type
     */
    setCarTypes: (state, data) => {
        state._carTypes = data;
    },

    /**
     * Set Car Level
     */
    setCarLevels: (state, data) => {
        state._carLevels = data;
    },

    /**
     * Set Car System
     */
    setCarSystems: (state, data) => {
        state._carSystems = data;
    },

    /**
     * Set Car Model
     */
    setCarModels: (state, data) => {
        state._carModels = data;
    },

    /**
     * Set Car Fuel
     */
    setCarFuels: (state, data) => {
        state._carFuels = data;
    },

    /**
     * Set Plate Type
     */
    setCarPlateCities: (state, data) => {
        state._carPlateCities = data;
    },
    /**
     * Set Car Plate Type
     */
    setCarPlateTypes: (state, data) => {
        state._carPlateTypes = data;
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
        // Update Data Car
        state._data.data[index].plate_first         = record.plate_first;
        state._data.data[index].plate_second        = record.plate_second;
        state._data.data[index].plate_word          = record.plate_word;
        state._data.data[index].plate_word          = record.plate_word;
        state._data.data[index].car_plate_city      = record.car_plate_city;
        state._data.data[index].car_plate_type      = record.car_plate_type;
        state._data.data[index].car_system          = record.car_system;
        state._data.data[index].car_model           = record.car_model;
        state._data.data[index].car_color           = record.car_color;
        state._data.data[index].car_fuel            = record.car_fuel;
        state._data.data[index].car_level           = record.car_level;
        state._data.data[index].car_type            = record.car_type;
        state._data.data[index].chasiscode          = record.chasiscode;
        state._data.data[index].capacity            = record.chasiscode;
        state._data.data[index].enginecode          = record.chasiscode;

        // Update Data Card
        state._data.data[index].card.cdn            = record.card.cdn;
        state._data.data[index].card.startDate      = record.card.startDate;
        state._data.data[index].card.endDate        = record.card.endDate;
        state._data.data[index].card.state          = record.card.state;
        state._data.data[index].card.stateStr       = record.card.stateStr;
        state._data.data[index].card.cardtype_id    = record.card.cardtype.id;
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
     * Load Car Color
     */
    loadCarColors(context){
        return new Promise((resolve, reject) => {
            axios.get('/carColors')
                .then(res => {
                    context.commit ('setCarColors', res.data.data);

                    resolve(res);
                })
                .catch(err => reject(err) );
        });
    },

    /**
     * Load Car Type
     */
    loadCarTypes(context){
        return new Promise((resolve, reject) => {
            axios.get('/carTypes')
                .then(res => {
                    context.commit ('setCarTypes', res.data.data);

                    resolve(res);
                })
                .catch(err => reject(err) );
        });
    },

    /**
     * Load Car Level
     */
    loadCarLevels(context){
        return new Promise((resolve, reject) => {
            axios.get('/carLevels')
                .then(res => {
                    context.commit ('setCarLevels', res.data.data);

                    resolve(res);
                })
                .catch(err => reject(err) );
        });
    },

    /**
     * Load Car System
     */
    loadCarSystems(context){
        return new Promise((resolve, reject) => {
            axios.get('/carSystems')
                .then(res => {
                    context.commit ('setCarSystems', res.data.data);

                    resolve(res);
                })
                .catch(err => reject(err) );
        });
    },

    /**
     * Load Car Model
     */
    loadCarModels(context){
        return new Promise((resolve, reject) => {
            axios.get('/carModels')
                .then(res => {
                    context.commit ('setCarModels', res.data.data);

                    resolve(res);
                })
                .catch(err => reject(err) );
        });
    },

    /**
     * Load Car Fuel
     */
    loadCarFuels(context){
        return new Promise((resolve, reject) => {
            axios.get('/carFuels')
                .then(res => {
                    context.commit ('setCarFuels', res.data.data);

                    resolve(res);
                })
                .catch(err => reject(err) );
        });
    },

    /**
     * Load Plate Type
     */
    loadCarPlateCities(context){
        return new Promise((resolve, reject) => {
            axios.get('/carPlateCities')
                .then(res => {
                    context.commit ('setCarPlateCities', res.data);

                    resolve(res);
                })
                .catch(err => reject(err) );
        });
    },

    /**
     * Load Car Plate Type
     */
    loadCarPlateTypes(context){
        return new Promise((resolve, reject) => {
            axios.get('/carPlateTypes')
                .then(res => {
                    context.commit ('setCarPlateTypes', res.data.data);

                    resolve(res);
                })
                .catch(err => reject(err) );
        });
    },


    /**
     * Load records data
     */
    loadCar(context, data) {
        return new Promise((resolve, reject) => {
            axios.post('/cars/loadCar', data)
                .then(res => {
                    let carData = res.data[0];

                    // carData = carData ? carData : {
                    //                                     id: null,
                    //                                     cdn: null,
                    //                                     state: null,
                    //                                     startDate: null,
                    //                                     endDate: null,
                    //                                 };

                    resolve(carData);
                })
                .catch(err => {
                    // Empty List
                    context.commit('setData', []);

                    resolve(err);
                });
        });
    },
    /**
     * Search info
     */
    searchRecord(context, data) {
        return new Promise((resolve, reject) => {
            let url = '/car/search';
            axios.post(url, data)
                .then(res => {
                    let allData = res.data;
                    // let rowData = allData.data;


                    // rowData.forEach(row => {
                    //     row.card_cdn            = row.card_cdn ? row.card_cdn : '';
                    //     row.card_start_date     = row.card_start_date ? row.card_start_date : '';
                    //     row.card_end_date       = row.card_end_date ? row.card_end_date : '';
                    //     row.card_state          = row.card_state ? row.card_state : '';
                    //     row.cardtype_id         = row.cardtype_id   ? row.cardtype_id : '';
                    //     row.cardtype_name       = row.cardtype_name  ? row.cardtype_name : '';
                    // });

                    // rowData = rowData.map(x =>
                    // {
                    //     x.selected = false;

                    //     return x;
                    // });

                    context.commit('setSearch', allData);

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
        return new Promise((resolve, reject) => {
            let searchWord = data.searchWord;
            let url ='/carLoad?page=' + page;

            if (searchWord != null){
                url += "&search=" + searchWord;
            }

            axios.get(url)
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
            axios.delete('/cars/' + id)
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
                axios.post('/cars', record)
                    .then(res => {
                        let status = (0 == res.data.status);
                        let newRecord = res.data.car;

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

            // Update Record
            else {
                axios.put('/cars/' + record.id, record)
                    .then(res => {
                        let status = (0 == res.data.status);
                        let updatedRecord = res.data.car;

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
    }
};

export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions,
});
