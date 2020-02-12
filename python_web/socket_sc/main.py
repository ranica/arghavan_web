import asyncio
import websockets
import classes.tcp_client as client

#pip3.8.exe install requests
#python -m pip install --upgrade pip
#pip install websockets
#pip install mysql
#pip install mysql-connector-python



python_server_port = 20000;
python_server_ip = '127.0.0.1';
socket_server_ip = '127.0.0.1';
socket_server_port = 10000;

##
## @brief      Accept User Conneciton
##
async def acceptUser(websocket,
                     path):
    data = await websocket.recv();

    try:
        client.connect (socket_server_ip,
                        socket_server_port);
        client.send (data);
    except:
        print ("Client Connection/Send error");
    finally:
        client.disconnect ();
        print ("Client disconnected");

##
## @brief      Main loop
##
def main ():
    # Start Web-Socket Server
    start_server = websockets.serve(acceptUser,
                                    python_server_ip,
                                    python_server_port);

    asyncio.get_event_loop() \
           .run_until_complete(start_server);

    asyncio.get_event_loop() \
           .run_forever();


# Start point
if (__name__ == '__main__'):
    main ();
