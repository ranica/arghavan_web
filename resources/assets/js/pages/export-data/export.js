export default {
    namespaced: true,

    actions: {

        /**
         * export data
         */
        exportData(context, data) {
            return new Promise((response, reject) => {
                let url = data.url;
                let exportData = data.exportData;

                Helper.downloadFile (url, exportData);
            });
        },
    }
};
