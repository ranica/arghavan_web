export default {
    namespaced: true,

    actions: {
        /**
         * updates Records
         *
         * @param      {<type>}   context  The context
         * @return     {Promise}  { description_of_the_return_value }
         */
        updateRecords(context, data) {
            return new Promise((response, reject) => {
                let url = data.url;
               axios.put(url, data)
                    .then(res => response(res),
                          err => reject(err));
            })
        },
    }
};
