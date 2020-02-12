let MessageHelper = {
    /**
     * Show Info messagebox
     *
     * @param      {<type>}  msg     The message
     */
    info(msg) {
        this.showMessage(msg, 1);
    },

    /**
     * Show Warning messagebox
     *
     * @param      {<type>}  msg     The message
     */
    warning(msg) {
        this.showMessage(msg, 2);
    },

    /**
     * Show Erorr messageBox
     *
     * @param      {<type>}  msg     The message
     */
    error(msg) {
        this.showMessage(msg, 3);
    },

    /**
     * Show Message
     *
     * @param      {<type>}  msg     The message
     * @param      {<type>}  type    The type
     */
    showMessage(msg, type) {
        // TODO: Check type

        // Show message
        alert(msg);
    }
};

export default MessageHelper;
