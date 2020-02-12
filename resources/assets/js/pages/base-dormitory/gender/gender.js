import loadModule from "../../CRUD/load";

const modules = {
    loadModule,
};

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
};

const mutations = {
    /**
     * Set Data
     */
    setData: (state, data) => state._data = data.data,
};

const actions = {
    /**
     * Load Record
     */
    loadRecords(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('loadModule/loadRecords', data)
                .then(res => {
                    context.commit('setData', res);
                    response(res);
                })
                .catch(err => reject(err));
        });
    },
};


export default {
    namespaced: true,
    modules,
    state,
    mutations,
    getters,
    actions
};
