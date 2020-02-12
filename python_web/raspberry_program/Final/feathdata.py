# pip install mysql-connector-python
import mysql.connector
import requests
import os
import logging
import logging.config
import configparser
from datetime import datetime

# TODO: insert picture image check in raspberry

os.environ['no_proxy'] = '*'

config = configparser.ConfigParser()
config.read('file.conf')


# Create a custom logger
logging.basicConfig(level=logging.DEBUG)

logger = logging.getLogger(__name__)

# Create handlers
f_handler = logging.FileHandler('{:%Y-%m-%d} feathdata.log'.format(datetime.now()))

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


# RASP_IP="192.168.10.100"  #raspberry Ip address
RASP_IP = str(config['Amoba']['IP'])





# delete all valid person data for fatch new data
def delete_all_person():
    try:
        mydb = mysql.connector.connect(**configMySQLTemp)

        mycursor = mydb.cursor()
        sql = "delete from user_datas"
        mycursor.execute(sql)
        mydb.commit()

    except mysql.connector.Error as error:
        logger.error(error)
        logger.error("error in delete data person")

    finally:
        if (mydb.is_connected()):
            mycursor.close()
            mydb.close()
            logger.info("Delete All Person :: MySQL connection is closed")


# delete all cart from for fatch new data
def delete_all_cart():
    try:
        mydb = mysql.connector.connect(**configMySQLTemp)

        mycursor = mydb.cursor(buffered = True)
        sql = "delete from gate_datas"
        mycursor.execute(sql)
        mydb.commit()

    except mysql.connector.Error as error:
        logger.error(error)
        logger.error("error in delete data delete all cart")

    finally:
        if (mydb.is_connected()):
            mycursor.close()
            mydb.close()
            logger.info("Delete All Cart :: MySQL connection is closed")

def load_valid_cart():
    try:
        i = 0
        r = requests.get(str(config['Amoba']['ServerURL']
                            ) + 'listAllowTraffic/'+RASP_IP)

        data = r.json()["data"]

        for item in data:
            result = insert_cart(item["cdn"], item["ip"])
            if(result):
                i = i + 1

    except Exception as error:
        logger.error(error)
    
    logger.info("Insert Count Cart: " + str(i))


# insert valid cart into temp database
def insert_cart(cartid, gate_ip):
    flag = False
    try:
        mydb = mysql.connector.connect(**configMySQLTemp)
        mycursor = mydb.cursor(buffered = True)
        query = "SELECT id FROM `gate_datas` WHERE`cart_number` = %s and `gate_ip` = %s;"
        mycursor.execute(query, [cartid, gate_ip])

        if (mycursor.rowcount):
            flag = False
        else:
            query = "INSERT INTO `gate_datas` (`cart_number`,`gate_ip`) VALUES (%s, %s)"
            mycursor.execute(query, [cartid, gate_ip])
            mydb.commit()
            flag = True

    except mysql.connector.Error as error:
        logger.error(error)
        logger.error("error in insert data cart")
        flag = True

    finally:
        if (mydb.is_connected()):
            mycursor.close()
            mydb.close()
            logger.info("insert data cart:: MySQL connection is closed")

    return flag


def load_valid_person():
    try:
        r = requests.get(str(config['Amoba']['ServerURL']) + 'listDataUser/' + RASP_IP)

        data = r.json()["data"]

        print(data)
        i = 0

        for item in data:
            if(item == None):
                continue
            result = insert_person(item["code"], item["name"], item["lastname"], item["cdn"])
            if(result):
                i = i + 1
            # try:

            #resource = urllib.request.urlretrieve("http://riratech.ir/getUserCDN/"+item["cdn"]+"/image","/tmp/"+itemp["cdn"]+".jpg")
            print(str(config['Amoba']['ServerURL']) +
                "getUserCDN/" + item["cdn"] + "/image")
            # os.system("wget -O /var/www/html/storage/app/public/" +
            #         item["cdn"]+".jpg " + str(config['Amoba']['ServerURL']) + "getUserCDN/"+item["cdn"]+"/image")
    
    except Exception as error:
        logger.error(error)

    logger.info("Insert Person valid count: " + str(i))



# insert personal data for show in web ui
def insert_person(code, name, lastname, card):
    try:
        mydb = mysql.connector.connect(**configMySQLTemp)
        mycursor = mydb.cursor(buffered = True)
        query = "SELECT id FROM `user_datas` WHERE `cart_number` = %s AND `name` = %s AND `lastname` = %s AND `user_code` = %s; "

        mycursor.execute(query, [card, name, lastname, code])

        if (mycursor.rowcount):
            flag = False
        else:
            mycursor = mydb.cursor(buffered = True)

            query = "INSERT INTO `user_datas` ( `cart_number`, `name`, `lastname`, `user_code`) VALUES (%s, %s, %s, %s)"
            mycursor.execute(query, [card, name, lastname, code])

            mydb.commit()
            flag = True

    except mysql.connector.Error as error:
        logger.error(error)
        logger.error("error in insert person")
        flag = False

    finally:
        if (mydb.is_connected()):
            mycursor.close()
            mydb.close()
            logger.info("Insert Person:: MySQL connection is closed")

    return flag

def main():
    delete_all_cart()
    load_valid_cart()
    delete_all_person()
    load_valid_person()

if __name__ == '__main__':
    main()
