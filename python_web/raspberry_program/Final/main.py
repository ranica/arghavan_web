import sys
import time
import socket
import threading
import requests
import mysql.connector
import logging
import logging.config
import configparser
import datetime
from datetime import timedelta
import os
# from pathlib import Path


gateServer = None
lockServer = None
listClients = []
trafficDict = dict()
offDict = dict()
flag_connect = 1
flag_disconnect = 0


def init():
    global logger
    global configMySQLTemp
    global session
    global config
    
    # Counter Offline Events
    offDict[1] = [0, datetime.datetime.now()]
    log_dir = r'C:\Users\ma.ghobadifard\Desktop\logs'
    # Path(r'C:\Users\ma.ghobadifard\Desktop\logs').mkdir(parents=True, exist_ok=True)

    if not os.path.exists(log_dir):
        os.makedirs(log_dir)


    session = requests.Session()
    session.trust_env = False

    config = configparser.ConfigParser()
    config.read('file.conf')

    # Create a custom logger
    logging.basicConfig(level=logging.DEBUG)

    logger = logging.getLogger(__name__)
    logFile = log_dir + '/{:%Y-%m-%d}.log'
    # Create handlers
    f_handler = logging.FileHandler(logFile.format(datetime.datetime.now()))
    # f_handler = logging.FileHandler('{:%Y-%m-%d}_log.log'.format(datetime.datetime.now()))

    # Create formatters and add it to handlers
    f_format = logging.Formatter(
        ' %(asctime)s - %(name)s - %(levelname)s - %(message)s')
    f_handler.setFormatter(f_format)
    # Add handlers to the logger
    logger.addHandler(f_handler)

    configMySQLTemp = {
        'host': str(config['topsecret.serverTemp']['host']),
        'user': str(config['topsecret.serverTemp']['user']),
        'passwd': str(config['topsecret.serverTemp']['passwd']),
        'database': str(config['topsecret.serverTemp']['database']),
    }

# Init Gate Server
def initGateServer():
    global gateServer
    logger.info('Gate Server Starting ....\r')

    bind_ip = str(config['GateServer']['IP'])
    bind_port = int(config['GateServer']['Port'])

    gateServer = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    gateServer.setsockopt(socket.SOL_SOCKET, socket.SO_KEEPALIVE, 1)

    gateServer.bind((bind_ip, bind_port))
    gateServer.listen(5)

# Init Lock Server
def initLockServer():
    global lockServer
    logger.info('Lock Server Starting....\r')

    bind_ip = str(config['LockServer']['IP'])
    bind_port = int(config['LockServer']['Port'])

    lockServer = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    lockServer.setsockopt(socket.SOL_SOCKET, socket.SO_KEEPALIVE, 1)

    lockServer.bind((bind_ip, bind_port))
    lockServer.listen(5)


def handle_gate_client_connection(client_socket, ip):
    try:
        stateOffline = False
        while True:

            request = client_socket.recv(1024)

            if (len(request) == 0):
                break

            data = str(request)

            if (data == "b'[5000]'"):
                continue

            logger.info('Client Received : ' +
                        client_socket.getpeername()[0] + '->' + data)

            try:
                # Get Code Cart
                if (len(data) > 10):
                    show_dic()

                    cart = str(int(data[7:15], 16))
                    command = data[3:7]

                    logger.info("Cart: " + cart + " :: Command: " + command)

                    result = add_item(cart, ip, datetime.datetime.now()) # True = Add Item or False = Duplicate Cart

                    #region Check Duplicate Pass
                    if (not result):
                        try:
                            if (command == '5308'):
                                snd = str('[53010]').encode()
                                direct = 1

                            elif (command == '5408'):
                                snd = str('[54010]').encode()
                                direct = 2
                                
                            r = session.get(str(config['DEFAULT']['ServerDuplicate']) +
                                            cart + '/' + ip + '/' + command, timeout=0.75)

                            client_socket.send(snd)
                            logger.info('duplicate :: Send to Client  : ' +
                                        client_socket.getpeername()[0] + ' -> ' + str(snd))
                            continue
                        except Exception as error:
                            stateOffline = True
                            add_offline_counter()
                            offline_counter = offline_counter + 1
                            register_traffic(cart, ip, direct, config['Message']['duplicate'])

                            client_socket.send(snd)
                            logger.info('Offline::Duplicated:: Send to Client  : ' +
                                        client_socket.getpeername()[0] + ' -> ' + str(snd))
                            continue

                    #endregion

                    try:
                        # r = session.get('http://192.168.10.90/accesscontrol/'+cart+'/'+ip+'/'+command, timeout=0.75);
                        logger.info(str(config['DEFAULT']['ServerURL']) +
                                    cart + '/' + ip + '/' + command)
                                
                        r = session.get(str(config['DEFAULT']['ServerURL']) +
                                        cart + '/' + ip + '/' + command, timeout=0.75)
                        logger.info(r.json()["data"]["command"])

                        stateOffline = False
                        check_offline_data()

                        snd = str(r.json()["data"]["command"]).encode()
                        
                        client_socket.send(snd)

                        logger.info('Send to Client  : ' +
                                    client_socket.getpeername()[0] + ' -> ' + str(snd))
                        
                        # Delete Cart From List
                        if (str(snd)[2:9] == '[53010]' or str(snd)[2:9] == '[54010]'):
                            delete_item_by_ip(ip)
                            logger.info(
                                ip + " :: " + str(snd)[2:9] + " :: Delete from list")

                    except Exception as error:
                        logger.error(error)

                        stateOffline = True
                        snd = str(
                            '[' + read_data_from_tempdb(cart, ip, command) + ']').encode()

                        
                        client_socket.send(snd)

                        logger.info('Offline::Response, Send Client: ' +
                                    client_socket.getpeername()[0] + ' -> ' + str(snd))
                        
                        # Delete Cart From List
                        if (str(snd)[2:9] == '[53010]' or str(snd)[2:9] == '[54010]'):
                            delete_item_by_ip(ip)
                            logger.info("offline:: " +
                                ip + " :: " + str(snd)[2:9] + " :: Delete from list")


                elif (data[2:9] == '[63011]' or
                      data[2:9] == '[63010]' or
                      data[2:9] == '[64011]' or
                      data[2:9] == '[64010]'):

                    data = data[3:8]

                    logger.info("command: " + data + " :: Cart: " + cart)

                    if(get_key(ip) == None):
                        continue

                    try:
                        if(stateOffline == True):
                            logger.info('Offline: state is ture passing user')

                            update_traffic(cart, ip, data)
                        else:
                            logger.info(str(config['DEFAULT']['ServerURL']) + cart + '/' + ip + '/' + data)
                            logger.info("update traffic")
                            r = requests.get(
                                str(config['DEFAULT']['ServerURL']) + cart + '/' + ip + '/' + data)

                    except Exception as e:
                        logger.error(e)

                        # TODO: Check Function update traffic
                        # update_traffic(cart, ip, data)
                    
                    delete_item_by_ip(ip)
                    logger.info(ip +  " :: " + data + " :: Delete from list")

               

            except Exception as e:
                logger.error(e)

        update_status_network_gate(client_socket.getpeername()[0], flag_disconnect)
        logger.info('Client is close ' + client_socket.getpeername()[0])

        client_socket.close()

    except Exception as e:
        logger.error(e)

    finally:
       pass
        # logger.info('Client finally is close ' + client_socket.getpeername()[0])



def handle_lock_client_connection(client_socket, ip):
    try:

        while True:
            request = client_socket.recv(1024)

            if (len(request) == 0):
                break

            # Receive Data from Client
            data = str(request)
            logger.info('Lock Client Received : ' +
                        client_socket.getpeername()[0] + ' -> ' + data)

            # Sent Data to Gate
            unlock_gate(data)

        client_socket.close()
        logger.info('Unlock Client is close ' + client_socket.getpeername()[0])

    except Exception as e:
        logger.error(e)
        logger.error("Failed to execute handle_lock_client_connection")
    
    finally:
        client_socket.close()


def unlock_gate(unlock):
    try:
        mydb = mysql.connector.connect(**configMySQLTemp)
        if (len(unlock) == 12):
            gateId = unlock[3:5]
            command = '[' + unlock[5:10] + ']'

            print(str(gateId), str(command))

            mycursor = mydb.cursor()
            query = "select * from gate_devices where id = %s"
            mycursor.execute(query, [gateId])
           
            myresult = mycursor.fetchone()

            if (myresult != None):
                print('myresult', myresult)
                for client in listClients:
                    if (client.getpeername()[0] == myresult):
                        snd = str(command).encode()
                        client.send(snd)
                        logger.info('Unlock Send Command to ' +
                                    client.getpeername()[0] + ' -> ' + str(command))
            else:
                logger.info("Not Found Gate")

    except Exception as e:
        logger.error(e)
        logger.error("Failed to execute send unlock command")
    
    finally:
        if (mydb.is_connected()):
            mycursor.close()
            mydb.close()
            print("sendToGate :: MySQL connection is closed")

#read data from TempDB
def read_data_from_tempdb(cartid, ip, command):
    try:
        mydb = mysql.connector.connect(**configMySQLTemp)
        mycursor = mydb.cursor()
        query = "select * from gate_datas where cart_number = %s"  # "' and  DATE_ADD(`create_at`, INTERVAL 4 HOUR) > NOW()"

        mycursor.execute(query, [cartid])
        myresult = mycursor.fetchone()
        
        if(command == '5308'):
            direct = 1
            result_allow = '53011'
            result_dontallow = '53010'
        elif(command == '5408'):
            direct = 2
            result_allow = '54011'
            result_dontallow = '54010'

        if(myresult == None):
            register_traffic(cartid, ip, direct, config['Message']['unknowncard'])
            return result_dontallow

        else:
            register_traffic(cartid, ip, direct, config['Message']['allow'])
            return result_allow

       
    except mysql.connector.Error as error:
        logger.error(error)
        logger.error("Failed to execute read_data_from_tempdb")

    finally:
        if (mydb.is_connected()):
            mycursor.close()
            mydb.close()
            print("read_data_from_tempdb :: MySQL connection is closed")
    
# register tarffic in raspberry
def register_traffic(cartid, gateip, direct, message):
    logger.info("register_traffic ::  cartid:" + str(cartid) + "  ::  gateip:" + gateip + " :: direct:" + str(direct) + " :: message:" + str(message))

    try:
        mydb = mysql.connector.connect(**configMySQLTemp)
        mycursor = mydb.cursor()

        query = "INSERT INTO `traffic_histories` ( `cart_number`, `gate_ip`, `sync_status`, `direct_id`, `message_id` ) VALUES ( %s , %s , 0, %s, %s);"

        mycursor.execute(query, [cartid, gateip, direct, message])
        mydb.commit()
        logger.info(str(mycursor.rowcount) + ' -> ' + "record inserted.")

    except mysql.connector.Error as error:
        logger.error(error)
        logger.error("error register tarffic")

    finally:
        if (mydb.is_connected()):
            mycursor.close()
            mydb.close()
            logger.info("register tarffic :: MySQL connection is closed")

# update tarffic in raspberry
def update_traffic(cartid, gateip, command):
    try:
        mydb = mysql.connector.connect(**configMySQLTemp)

        mycursor = mydb.cursor()

        if(command == '63011' or command == '64011'):
            message = config['Message']['pass']
        elif(command == '63010' or command == '64010'):
            message = config['Message']['dontpass']

        query = "UPDATE `traffic_histories` SET `message_id` = %s WHERE `traffic_histories`.`cart_number` = %s AND `traffic_histories`.`gate_ip` = %s AND `traffic_histories`.`message_id` = 3 ORDER BY  `traffic_histories`.`traffic_date` DESC LIMIT 1;"

        # query = "UPDATE `traffic_histories` SET `message_id` = '" + str(message) + "' WHERE `traffic_histories`.`cart_number` = '"+cartid+"' AND `traffic_histories`.`gate_ip` = '" + \
        #     gateip + "' AND `traffic_histories`.`message_id` = 3 ORDER BY  `traffic_histories`.`traffic_date` DESC LIMIT 1;"


        mycursor.execute(query, [message, cartid, gateip])
        mydb.commit()
        logger.info(str(mycursor.rowcount) + " -> " + "record updated.")

    except mysql.connector.Error as error:
        logger.error(error)
        logger.error("error traffic_histories table update")

    finally:
        if (mydb.is_connected()):
            mycursor.close()
            mydb.close()
            logger.info("Upadte Traffic :: MySQL connection is closed")



# Add cdn in Dictionary
def add_item(cdn, ip, date):

    if (not key_exists(cdn)):
        trafficDict[cdn] = [ip, date]
        logger.info("Add item: " + cdn)

        return True

    else:
        # cdn is exists
        data = trafficDict.get(cdn)
        mytime = date_diff_in_Seconds(datetime.datetime.now(), data[1])
        # print(mytime.seconds)
        if (mytime.seconds > 15):
            delete_item_by_cdn(cdn)
            trafficDict[cdn] = [ip, date]
            
            logger.info("Add item: " +  cdn)

            return True
        else:
            # send to server insert Duplicate row
            logger.info(cdn + " is duplicate")
            return False

def key_exists(key):
    if key in trafficDict.keys():
        return True
    else:
        return False


def value_exists(value):
    # x = trafficDict.get("10")
    # print(x[1])
    if value in [x for v in trafficDict.values() for x in v if type(v) == list]:
        print(" value OK")
    # if value in trafficDict.values():
    #     return True;
    # else:
    #     return False;

# Delete key from Dictionary


def delete_item_by_cdn(key):
    if (key_exists(key)):
        trafficDict.pop(key)
        logger.info("Delete by cdn " + key + " Successfully")


def delete_item_by_ip(ip):
    key = get_key(ip)
    if (key != None):
        trafficDict.pop(key)

        logger.info("Delete by ip " + ip + " Successfully")

def get_key(val):
    for key, value in trafficDict.items():
        if val == value[0]:
            return key
    return None

# Show item's Dictionary
def show_dic():
    if(not bool(trafficDict)):
        logger.warning("Dic is empty")
        return

    for (key, value) in trafficDict.items():
        logger.warning("Modified Dict : " + key + " :: " + value[0])

# Diff two Datetime
def date_diff_in_Seconds(dt2, dt1):
    timedelta = dt2 - dt1
    return timedelta
    # date1 = datetime.strptime('2015-01-01 01:00:00', '%Y-%m-%d %H:%M:%S')

# Add Counter Offline 
def add_offline_counter():
    offDict[1][0] += 1
    offDict[1][1] = datetime.now()


def gateServerHandler():
    initGateServer()

    while True:
        try:

            client_sock, address = gateServer.accept()
            logger.info('GATE/ Accepted connection from ' +
                        str(address[0]) + " : " + str(address[1]))
            update_status_network_gate(str(address[0]), flag_connect)
            # Add Clients in List
            listClients.append(client_sock)

            threading.Thread(
                target=handle_gate_client_connection,
                args=(client_sock, address[0])
            ).start()
        except Exception as e:
            logger.error(e)
            logger.info('socket connection broken')


def lockServerHandler():
    initLockServer()

    while True:
        client_sock, address = lockServer.accept()
        logger.info('LOCK/ Accepted connection from ' +
                    str(address[0]) + " : " + str(address[1]))

        threading.Thread(
            target=handle_lock_client_connection,
            args=(client_sock, address[0])
        ).start()

# Update status client
def update_status_network_gate(ip, state):
    try:
        r = session.get(str(config['DEFAULT']['ServerUpdateGate']) +
                                            ip + '/' + str(state), timeout=0.75)

        logger.info("Update Network Client :: " + str(ip) + " :: " + str(state))

    except Exception as error:
        logger.error(error)
            # try:
            #     mydb = mysql.connector.connect(**configMySQLTemp)
            #     mycursor = mydb.cursor()
            #     mycursor.callproc('sp_update_network_status_gateDevice', [ip, state])
            #     mydb.commit()
            # except mysql.connector.Error as error:
            #     logger.error(error)
            #     logger.error("error update status network gate")

            # finally:
            #     if (mydb.is_connected()):
            #         mycursor.close()
            #         mydb.close()
            #         logger.info("update status network gate :: MySQL connection is closed")

def check_offline_data():
    try:   
        dic_date = offDict[1][1]
        counter = offDict[1][0]
        mytime = date_diff_in_Seconds(datetime.datetime.now(), dic_date)
        
        if ((mytime.minute > 10) and (counter > 0)):
           send_data_to_server()

    except Exception as error:
        logger.error(error) 

def send_data_to_server():
    try:
        mydb = mysql.connector.connect(**configMySQLTemp)
        mycursor = mydb.cursor()
        query = "select * from `traffic_histories` where `sync_status` = 0"

        mycursor.execute(query)
        myresult = mycursor.fetchall()

        if not myresult:
            # empty set returned
            logger.info("Not Found Data sync = 0 in tempDB")
            return

        for data in myresult:
            logger.warning(data)
            logger.warning(data[1])
            r = session.get(str(config['DEFAULT']['ServerURL']) +
                                        data[1] + '/' +  # card
                                        data[2] + '/' +  # ip gate
                                        data[3] + '/' +  # date
                                        data[4] + '/' +  # direct_id
                                        data[5], timeout=0.75) # message_id

            
        

        # TODO:: Update sync_status = 1
        # update_offline_data()
    except Exception as error:
        logger.error(error) 
    finally:
        if (mydb.is_connected()):
            mycursor.close()
            mydb.close()
            print("send_data_to_server :: MySQL connection is closed")


# Update status client
def disconnect_all_gate():
    try:
        r = session.get(str(config['DEFAULT']['ServerDisconnectGate']) + "ok" , timeout=0.75)

        logger.info("Disconnect All Statue Gate Devices")

    except Exception as error:
        logger.error(error)     

def main():
    try:
        disconnect_all_gate()

        send_data_to_server()
        # Gate thread
        threading.Thread(target=gateServerHandler).start()

        # Lock thread
        threading.Thread(target=lockServerHandler).start()

        # sys.exit("Error message")
    except Exception as error:
        logger.error(error)


if __name__ == '__main__':
    init()
    main()
