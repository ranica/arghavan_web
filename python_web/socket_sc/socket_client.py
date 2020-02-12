import classes.tcp_client as client

server_ip = '172.20.20.143';
server_ip = '127.0.0.1';
server_port = 10000;

if (__name__ == '__main__'):
    client.connect (server_ip,
                    server_port);

    msg = input('Enter Message:');
    msg = msg + "\n";
    client.send (msg);

    data = client.read ();
    print ("Receivedi %s" % data);

    client.disconnect ();
    
