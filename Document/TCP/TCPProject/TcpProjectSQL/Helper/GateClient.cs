 using BaseDAL.Model;
using Common.BLL.Logic.XGate;
using Common.Enum;
using Common.Network.Core;
using Common.Network.Command;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading;
using Common.BLL.Entity.XGate;

namespace TcpProjectSQL.Helper
{
    public class GateClient
    {
        #region Events
        public event Common.Network.Core.NetTcpClient.Connect onConnect;
        public event Common.Network.Core.NetTcpClient.Disconnect onDisconnect;
        public event Common.Network.Core.NetTcpClient.ReceiveData onReceiveData;
        public event Common.Network.Core.NetTcpClient.SendData onSendData;
        public event Common.Network.Core.NetTcpClient.Error onError;


        public event Common.Network.Core.NetTcpServer.SendData onServerSendData;
        #endregion

        #region Variables
        private ManualResetEvent msr;
        private Thread connectorThread, writeThread;
        private Thread pingThread;
        private TimeSpan _connectorInterval, _writeInterval;
        private NetTcpClient tcpClient;
        private int connectCount = 0;

        List<Common.Model.UserFeature> listUserFeature = new List<Common.Model.UserFeature>();
        Dictionary<String, Common.Model.UserFeature> dicUser = new Dictionary<string, Common.Model.UserFeature>();
        private Common.BLL.Entity.XGate.gateoperator serviceUser;
        Common.Model.UserFeature data;
        private Dictionary<String, object> dic;
        private DataTable resultBase;
        private DataTable resultData;
        private bool reconnect = false;
        private bool receiveData = false;
        private int user_id = 0;

        #endregion

        #region Properties
        /// <summary>
        /// Connect interval
        /// </summary>		
        public TimeSpan connectorInterval
        {
            get
            {
                if (null == _connectorInterval)
                    _connectorInterval = new TimeSpan(0, 0, 15);

                return _connectorInterval;
            }
            set
            {
                _connectorInterval = value;
            }
        }

        /// <summary>
        /// Write Interval
        /// </summary>		 
        public TimeSpan writeInterval
        {
            get
            {
                if (null == _writeInterval)
                    _writeInterval = new TimeSpan(0, 0, 5);

                return _writeInterval;
            }
            set
            {
                _writeInterval = value;
            }
        }

        #endregion

        #region Methods
        public GateClient(string host, int port, int bufferSize)
        {
            prepare();

            tcpClient = new NetTcpClient(host, port, bufferSize);

            tcpClient.onConnect += tcpClient_onConnect;
            tcpClient.onDisconnect += tcpClient_onDisconnect;
            tcpClient.onError += tcpClient_onError;
            tcpClient.onReceiveData += tcpClient_onReceiveData;
            tcpClient.onSendData += tcpClient_onSendData;

        }

        private void prepare()
        {
            #region Get Service User
            Common.BLL.Logic.XGate.gateoperator lOpertor =
                new Common.BLL.Logic.XGate.gateoperator(Common.Enum.EDatabase.xGate);
            CommandResult opResult = lOpertor.getServiceUser();

            serviceUser = opResult.model as Common.BLL.Entity.XGate.gateoperator;
            #endregion

            msr = new ManualResetEvent(false);
            connectorInterval = TimeSpan.Parse(ConfigurationManager.AppSettings["Interval"]);
            writeInterval = new TimeSpan(0, 0, 20);

            // Default User id unkown card
            user_id = Convert.ToInt32(ConfigurationManager.AppSettings["user_id"]);

        }

        /// <summary>
        /// On Send data
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="data"></param>
        void tcpClient_onSendData(NetTcpClient sender, CommandResult data)
        {
            if (null != onSendData)
                onSendData(sender, data);
        }

        /// <summary>
        /// OnError
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="data"></param>
        void tcpClient_onError(NetTcpClient sender, CommandResult data)
        {
            if (null != onError)
            {
                onError(sender, data);

                if (null != writeThread)
                    writeThread.Abort();
                connectCount++;
            }

            ///TODO : PARSE ERROR
            if (data.id == 999)
            {
                //if (connectCount < 10)
                //{ 
                tryToConnect();
                if (msr.WaitOne())
                    connect();
                //}				
            }
        }

        /// <summary>
        /// OnDisConnect
        /// </summary>
        /// <param name="sender"></param>
        void tcpClient_onDisconnect(NetTcpClient sender)
        {
            if (null != onDisconnect)
            {
                onDisconnect(sender);

                if (null != writeThread)
                    writeThread.Abort();
            }
        }

        /// <summary>
        /// On Connect
        /// </summary>
        /// <param name="sender"></param>
        void tcpClient_onConnect(NetTcpClient sender)
        {
            if (null != onConnect)
            {
                onConnect(sender);
                tryToWriteData();
               // tryToCheckPing();
            }

        }

        /// <summary>
        /// Parse recieved data
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="data"></param>
        void tcpClient_onReceiveData(Common.Network.Core.NetTcpClient sender, CommandResult data)
        {
            if (null != onReceiveData)
            {
                onReceiveData(sender, data);
                receiveData = true;

                if ("[5000]" != Encoding.UTF8.GetString(data.model as byte[]))
                {
                    parseData(sender, data);
                }
            }
        }

        /// <summary>
        /// Connect
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        public void connect()
        {
            tcpClient.connect();
        }

        /// <summary>
        /// Disconnect
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        public void disconnect()
        {
            tcpClient.disconnect();
        }

        /// <summary>
        /// Write data
        /// </summary>
        /// <param name="data"></param>
        public void write(string data)
        {
            try
            {
                tcpClient.write(data, Encoding.UTF8);
            }
            catch (Exception ex)
            {
                if (null != writeThread)
                    writeThread.Abort();
            }
        }

        /// <summary>
        /// Try to connect
        /// </summary>
        private void tryToConnect()
        {
            msr.Reset();

            try
            {
                connectorThread?.Abort();
            }
            finally
            {
                connectorThread = null;
            }

            connectorThread = new Thread(new ThreadStart(() =>
            {
                while (true)
                {

                    Thread.Sleep(connectorInterval);
                    msr.Set();
                }

            }));

            connectorThread.Start();


            //connectorThread = new Thread(new ThreadStart(() =>
            //{
            //    try
            //    {
            //        Thread.Sleep(connectorInterval);
            //        msr.Set();
            //    }
            //    catch (Exception ex)
            //    {

            //    }
            //}));
            //connectorThread.Start();
        }
     
        /// <summary>
        /// Ping Gate
        /// </summary>
        private void tryToCheckPing()
        {
            try
            {
                try
                {
                    pingThread?.Abort();
                }
                finally
                {
                    pingThread = null;
                }

                pingThread = new Thread(new ThreadStart(() =>
                {
                    while (true)
                    {

                        Thread.Sleep(10000);

                        // check when the ping is not success
                        if (receiveData)
                        {
                            reconnect = false;
                            receiveData = false;
                        }
                        else
                        {
                            reconnect = true;
                            break;
                        }
                    }

                    if (reconnect)
                    {

                        try
                        {
                            pingThread?.Abort();
                        }
                        finally
                        {
                            pingThread = null;
                            
                            disconnect();

                            tryToConnect();
                        }

                    }

                }));

                pingThread.Start();

            }
            catch (Exception ex)
            {
                LoggerExtensionSQL.logMain(ex);
            }
        }

        /// <summary>
		/// Try to write data
		/// </summary>
		private void tryToWriteData()
        {
            writeThread = new Thread(new ThreadStart(() =>
            {
                try
                {
                    while (true)
                    {
                        Thread.Sleep(writeInterval);
                        write("[5000]");
                    }

                }
                catch (Exception ex)
                {

                }
            }));
            writeThread.Start();
        }

        /// <summary>
        /// Parse data
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="data"></param>
        /// 

        private void parseData(Common.Network.Core.NetTcpClient sender, CommandResult data)
        {
            if ((null != data) && (null != data.model))
            {
                string cmd = Encoding.UTF8.GetString(data.model as byte[]);

                if (cmd.ToLower().StartsWith("[5308") && cmd.ToLower().Length == 14 && cmd.ToLower().StartsWith("[") && cmd.ToLower().EndsWith("]"))
                {
                    ValidateData((int)EnumDirection.input, sender.host, cmd);
                }
                else if (cmd.ToLower().StartsWith("[5408") && cmd.ToLower().Length == 14 && cmd.ToLower().StartsWith("[") && cmd.ToLower().EndsWith("]"))
                {
                    ValidateData((int)EnumDirection.output, sender.host, cmd);

                }


                #region traffic done or dont done

                // Pass Input
                if (cmd.ToLower().StartsWith("[5309") && cmd.ToLower().EndsWith("]") ||
                    cmd.ToLower().StartsWith("[5409") && cmd.ToLower().EndsWith("]"))
                {
                    int passStatus = (int)(Int64.Parse(cmd.Substring(13, 1), System.Globalization.NumberStyles.HexNumber));

                    if (dicUser.Count > 0)
                    {
                        Common.BLL.Logic.XGate.gatetraffic lGateTraffic =
                            new Common.BLL.Logic.XGate.gatetraffic(Common.Enum.EDatabase.xGate);
                        CommandResult result = lGateTraffic.UpdateResponseTraffic(sender.host, dicUser, passStatus == 0 ? false : true); 
                   
                        deleteCard(sender.host);
                    }
                }

                #endregion
            }
        }

        /// <summary>
        /// Delete Card from list
        /// </summary>
        /// <param name="kart"></param>
        private void deleteCard(string ip)
        {
            var item = dicUser.First(r => r.Key == ip);
            if (null != item.Value)
                dicUser.Remove(item.Key);
        }
       
        /// <summary>
        /// Validate data
        /// </summary>
        /// <returns></returns>
        /// <summary>
        /// Validate data
        /// </summary>
        /// <returns></returns>
        private int ValidateData(int typeDirect, string ip, string commandGate)
        {
            data = new Common.Model.UserFeature();


            int resultValidate = 0;

            string kart = Convert.ToString((Int64.Parse(commandGate.Substring(5, 8), 
                                            System.Globalization.NumberStyles.HexNumber)));


            data.card = kart;

            if (dicUser.Count > 0)
            {

                var item = dicUser.First(kvp => kvp.Value.card == kart);
                if (item.Value != null)
                {
                    resultValidate = (int)Common.Enum.EnumMessageType.duplicatPass;

                }
            }
            else
            {
                dic = new Dictionary<string, object>();
                Validator validator = makeChain();

                resultBase = loadBaseData(ip);
                resultData = loadUserData(kart);


                dic.Add("direct", typeDirect);
                dic.Add("serviceId", serviceUser);
                dic.Add("cdn", kart);

                if (resultData.Rows.Count == 1)
                {
                    data.user_id = resultData.Rows[0]["user_id"].ToString();
                    data.card = kart;
                    dicUser.Add(ip, data);
                    resultValidate = validator.validate(resultBase.Rows[0], resultData.Rows[0], dic);

                }
                else
                    resultValidate = (int)Common.Enum.EnumMessageType.unkownCard;
            }

            switch (resultValidate)
            {
                case 0:
                    {
                        if (typeDirect == (int)Common.Enum.EDirection.input)
                            write(SendReceiveData.sendDataInput);
                        else if (typeDirect == (int)Common.Enum.EDirection.output)
                            write(SendReceiveData.sendDataOutput);

                    }
                    break;

                case 4:
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                case 10:
                case 11:
                
                    {
                        if (typeDirect == (int)Common.Enum.EDirection.input)
                            write(SendReceiveData.sendDataDonotInput);
                        else if (typeDirect == (int)Common.Enum.EDirection.output)
                            write(SendReceiveData.sendDataDonotOutput);

                        deleteCard(ip);
                    }
                    break;
                case 12:
                case 16:
                    {
                        if (typeDirect == (int)Common.Enum.EDirection.input)
                            write(SendReceiveData.sendDataDonotInput);
                        else if (typeDirect == (int)Common.Enum.EDirection.output)
                            write(SendReceiveData.sendDataDonotOutput);
                    }
                    break;

                default:
                    break;
            }

            if (0 != resultValidate)
            {
               
                Common.BLL.Logic.XGate.gatetraffic lGateTraffic =
                    new Common.BLL.Logic.XGate.gatetraffic(Common.Enum.EDatabase.xGate);
               
                if (12 != resultValidate )
                {
                    user_id = Convert.ToInt16(resultData.Rows[0]["user_id"]);
                }
               
               
                CommandResult opResult = lGateTraffic.RegisterTraffic(resultBase.Rows[0], 
                                                            user_id, 
                                                            dic, resultValidate);
            }

            return resultValidate;

        }


        /// <summary>
        /// Make Chain
        /// </summary>
        /// <returns></returns>
        Validator makeChain()
        {
           
            DateOptionValidator dateOptionChecker = new DateOptionValidator();
            UserStateValidator userStateChecker = new UserStateValidator();
            CardValidator cardChecker = new CardValidator();
            GenderValidate genderChecker = new GenderValidate();
            ZoneValidate zoneChecker = new ZoneValidate();
            TrafficStateValidate trafficStateChecker = new TrafficStateValidate();
            TrafficValidate trafficChecker = new TrafficValidate();

           
            dateOptionChecker.setValidator(userStateChecker);
            userStateChecker.setValidator(cardChecker);
            cardChecker.setValidator(genderChecker);
            genderChecker.setValidator(trafficStateChecker);
            trafficStateChecker.setValidator(trafficChecker);

            return dateOptionChecker;
        }

        /// <summary>
        /// Load Base Data by Ip device
        /// </summary>
        /// <returns></returns>
        private DataTable loadBaseData(string ip)
        {
            Common.BLL.Logic.XGate.gatedevice lGateDevice =
                 new Common.BLL.Logic.XGate.gatedevice(Common.Enum.EDatabase.xGate);

            CommandResult opResult = lGateDevice.loadDevice(ip);
            return opResult.model as DataTable;
        }
        /// <summary>
        /// Load User Data by cdn 
        /// </summary>
        /// <returns></returns>

        private DataTable loadUserData(string kart)
        {
            Common.BLL.Logic.XGate.gatedevice lGateDevice =
                 new Common.BLL.Logic.XGate.gatedevice(Common.Enum.EDatabase.xGate);

            CommandResult opResult = lGateDevice.loadUser(kart);
            return opResult.model as DataTable;
        }

        #endregion
    }
}
