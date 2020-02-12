export default {
    namespaced: true,

    actions: {
        /**
         * deletes Car Color.
         *
         * @param      {<type>}   context  The context
         * @return     {Promise}  { description_of_the_return_value }
         */
        deleteRecords(context, data) {
            return new Promise((response, reject) => {
                let url = data.url;
                axios.delete(url)
                    .then(res => response(res),
                          err => reject(err));
            })
        },
    }
};
