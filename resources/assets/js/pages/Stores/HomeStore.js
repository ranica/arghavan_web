Vue.use(Vuex);

const state = {
    _data: {
        data: [],
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
};

const actions = {
    // login({commit, state}, loginData)
    // {
    //     return axios.post('/login', loginData);
    // },
     login(context, data) {
        return new Promise((resolve, reject) => {
            let url = document.pageData.lock.unlock_url;

            axios.post(url, data)
                .then(res => {
                    let allData = res.data;
                    resolve(res);
                })
                .catch(res => reject(res));
        });
    },
    /**
     * Load records data
     */
    loadRecords(context) {
        return new Promise((resolve, reject) => {
            // let url = '/auth/edit' ;
            let url = document.pageData.edit.load_url;
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
     * Load records data
     */
    loadLock(context) {
        return new Promise((resolve, reject) => {
            // let url = '/auth/lock' ;
            let url = document.pageData.lock.load_url;
            axios.get(url)
                .then(res => {
                    // Add "selected" property to items
                    let allData = res.data;

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
};

export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions,
});
