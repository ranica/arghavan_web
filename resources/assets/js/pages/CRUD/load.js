export default {
    namespaced: true,

    actions: {
        /**
         * Loads Car Color.
         *
         * @param      {<type>}   context  The context
         * @return     {Promise}  { description_of_the_return_value }
         */
        loadRecords(context, data) {
            return new Promise((response, reject) => {
                let url = data.url;
                axios.get(url)
                    .then(res => response(res))
                    .catch(err => reject(err));
            })
        },

    }
};
