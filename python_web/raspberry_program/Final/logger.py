import sys
import time
import socket
import threading
import requests
import mysql.connector
import logging
import logging.config
import configparser
from datetime import datetime
import os

offDict = dict()
def init():
    global logger

    # ensure log folder exists
    log_dir = "logs"
    if not os.path.exists(log_dir):
        os.mkdir(log_dir)

    session = requests.Session()
    session.trust_env = False

    config = configparser.ConfigParser()
    config.read('file.conf')
    logging.basicConfig(level=logging.DEBUG)
    logger = logging.getLogger(__name__)
    logFile = log_dir + '/{:%Y-%m-%d}.log'
    f_handler = logging.FileHandler(logFile.format(datetime.now()))

    f_format = logging.Formatter(
        '%(asctime)s - %(name)s - %(levelname)s - %(message)s')
    f_handler.setFormatter(f_format)
    logger.addHandler(f_handler)

def createNewLog():
    logger.warning('This is a warning')
    logger.error('This is an error')
    logger.debug('This is an debug')
    logger.info('This is an info')
   
    logger.info(offDict)

def addCounter():
    time.sleep(2)
    offDict[1][0] += 1
    offDict[1][1] = datetime.now()
    print(offDict)
 
 

def mainThread():
    counter = 0;
   
    logger.info('Welcome Thread ' )
    counter += 1
    if (counter == 2):
        print("Marjan")

def main():
    offDict[1] = [0, datetime.now()]
    threading.Thread(target = mainThread).start()

init()
main()
# createNewLog()
addCounter()
