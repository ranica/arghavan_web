const WebSocketClient = {
    webClient: null,
    onReceiveCallback: null,

    /**
     * Connect method
     */
    connect(ip, port, onReceiveCallback) {
        if (!this.canUseWebSocket()) {
            console.log('WebSocket Error');

            return;
        }

        // Set callback
        this.onReceiveCallback = onReceiveCallback;

        let url = "ws://" + ip + ":" + port;
        this.webClient = new WebSocket(url);

        if (null == this.webClient){
            return;
        }

        this.webClient.onopen = this.socketOpened;
        this.webClient.onmessage = this.socketDataRecieved;
        this.webClient.onclose = this.socketClosed;
    },

    /**
     * Disconnect
     */
    disconnect() {
        if (null == this.webClient) {
            return;
        }

        this.webClient.close();
    },

    /**
     * Send message
     */
    send(msg) {
        if (null == this.webClient) {
            return;
        }

        this.webClient.send(msg);
    },

    /**
     * On Receive message
     */
    socketDataRecieved(evt) {
        let received_msg = evt.data;

        if (null != this.onReceiveCallback){
            this.onReceiveCallback (received_msg);
        }
    },

    /**
     * Socket Closed
     */
    socketClosed() {},

    /**
     * Socket Opened
     */
    socketOpened(initMsg) {
        // if (null != initMsg) {
        //     this.send(initMsg);
        // }
    },

    /**
     * Check WebSocket capability
     */
    canUseWebSocket() {
        return ("WebSocket" in window);
    }
};

export default WebSocketClient;
