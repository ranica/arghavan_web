import sys, time,datetime
import socket
import threading
import requests
import mysql.connector

#pip install mysql-connector-python
#pip3.7.exe install requests
#pip install mysql
#pip install mysql-connector-python

session = requests.Session()
session.trust_env = False

bind_ip = '0.0.0.0'
bind_port = 1470
bind_port_unlock = 50000
server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
server.bind((bind_ip, bind_port))

server.listen(5)


# Server Listen with port 10000 , get data from application
server_unlock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
server_unlock.bind(('127.0.0.1', bind_port_unlock))
server_unlock.listen(1)

def handle_client_connection(client_socket,ip):
#    try:
        state = False
        while True:
                request =client_socket.recv(1024)
                data=str(request)
                
                print(data)
                print('ip', ip)
		
                if (len(data)>10):
                        cart=data[5:13]
                        command=data[1:5]
                        print(cart)
                        try:
                                print(datetime.datetime.now())

                                r = session.get('http://192.168.10.90/accesscontrol/'+cart+'/'+ip+'/'+command, timeout=0.75);
                                state = False
                            
                                print(datetime.datetime.now())
                                print(r.json())
                                
                                snd=str('['+r.json()["command"]+']').encode()
                                client_socket.send(snd)
                                #insertcart(cart, ip)
                        except:
                                #trafficlog(cart, ip)
                                state = True
                                print("offline response")
                                snd=str('['+readdatafromtempdb(cart, ip, command)+']').encode()
                                print('snd', snd)
                                client_socket.send(snd)
                                                         
                elif (data[0:7]=='[63011]' or data[0:7] == '[63010]' or data[0:7] == '[64011]' or data[0:7] == '[64010]'):
                        print('elif data', data)
                        data=data[1:6]
                        print("command data[1:6]"+data)
			
                        try:
                                if(state == True):
                                    print('state is ture passing user')
                                    trafficlogupdate(cart, ip, data)
                                else:
                                    print('request from web')
                                    r = requests.get('http://192.168.10.90/accesscontrol/'+cart+'/'+ip+'/'+data)
                        except:
                                print('log data except')
                                trafficlogupdate(cart, ip, data)
                                
#        data=data[3:]
#        data=data[:len(data)-2]
#        print(type(data))
                #print(data)
                
#        client_socket.send(('['+data[1:3]+'011]').encode())
#    except:
#        client_socket.send(('err').encode())
#        print ("error to Write data")
    
        client_socket.close()
# insert data into temprory database

def handle_client_unlock(client_socket,ip):
        while True:
                request =client_socket.recv(1024)
                data=str(request)
                
                print(data)
                print('ip', ip)
        client_socket.close()


def insertcart(cartid, ip):
    mydb = mysql.connector.connect(
      host="localhost",
      user="user",
      passwd="user",
      database="tempDB"
    )
   
    mycursor = mydb.cursor()
    sql = "INSERT INTO `gate_datas` ( `gate_ip`, `cart_number`) VALUES ('"+ip+"', '"+cartid+"')"

    mycursor.execute(sql)

    mydb.commit()

def readdatafromtempdb(cartid, ip, command):
    mydb = mysql.connector.connect(
      host="localhost",
      user="user",
      passwd="user",
      database="tempDB"
    )

    mycursor = mydb.cursor()
    sql="select * from gate_datas where cart_number='"+cartid+"'"#"' and  DATE_ADD(`create_at`, INTERVAL 4 HOUR) > NOW()"
    mycursor.execute(sql)
    myresult = mycursor.fetchall()
    if(command == '5308'):
            direct = 1
            dontallow = '53010'
    elif(command == '5408'):
            direct = 2
            dontallow = '54010'
            
    for x in myresult:
        if(command == '5308'):
           result = '53011'
        elif(command == '5408'):
            result = '54011'
        
        trafficlog(cartid,ip, direct)
        return result
    
    return dontallow
def trafficlog(cartid,gateip, direct):
     mydb = mysql.connector.connect(
      host="localhost",
      user="user",
      passwd="user",
      database="tempDB"
    )
     mycursor = mydb.cursor()
    
     sql = "INSERT INTO `traffic_histories` ( `cart_number`, `gate_ip`, `sync_status`, `direct_id`, `message_id` ) VALUES ('"+cartid+"','"+gateip+"', 0, '"+str(direct)+"', 3);"
     mycursor.execute(sql)
     mydb.commit()
     print(mycursor.rowcount, "record inserted.")
     
def trafficlogupdate(cartid,gateip, command):
     mydb = mysql.connector.connect(
      host="localhost",
      user="user",
      passwd="user",
      database="tempDB"
    )
     mycursor = mydb.cursor()
     
     if(command == '63011' or command == '64011'):
         message = 1
     elif(command == '63010' or command == '64010'):
        message = 2
     
     
     sql = "UPDATE `traffic_histories` SET `message_id` = '"+str(message)+"' WHERE `traffic_histories`.`cart_number` = '"+cartid+"' AND `traffic_histories`.`gate_ip` = '"+gateip+"' AND `traffic_histories`.`message_id` = 3 ORDER BY  `traffic_histories`.`traffic_date` DESC LIMIT 1;"
    
     
     mycursor.execute(sql)
     mydb.commit()
     print(mycursor.rowcount, "record updated.")
     
while True: 
         
         client_sock, address = server.accept()
         client_unlock, address_unlock = server_unlock.accept()
         print ('Accepted connection from {}:{}'.format(address[0], address[1]))
         client_handler = threading.Thread(
                target=handle_client_connection,
                args=(client_sock,address[0])  # without comma you'd get a... TypeError: handle_client_connection() argument after * must be a sequence, not _socketobject
         )
         client_handler.start()

         
        