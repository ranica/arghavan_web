import socket;
import sys;

# Global data
socket_client = None;

##
## Connect
##
def connect(ip,
            port):
    print ("Connecting to %s:%s" % (ip, port));
    global socket_client;

    socket_client = socket.socket (socket.AF_INET,
                                   socket.SOCK_STREAM);

    server_addr = (ip,
                   port);

    socket_client.connect (server_addr);

    print ('Socket client connecting finished');



##
## DisConnect
##
def disconnect():
    global socket_client;

    if (None != socket_client):
        socket_client.close ();
        socket_client = None;

    print ('Socket client disconnected');



##
## Connect
##
def send (data):
    global socket_client;

    if (None != socket_client):
        socket_client.sendall (data.encode ());

    print ('Socket client send %s' % data);



##
## Connect
##
def read ():
    global socket_client;

    if (None != socket_client):
        data = socket_client.recv (1024);

        if (len(data) > 0):
            print ("Socket client receive data %s" %data);
            return data;

    return "";
