using GateService.Helper;
using Common.Network.Core;
using System;
using System.Configuration;
using System.Data.SqlClient;
using System.Diagnostics;
using System.ServiceProcess;
using System.Threading;
using System.Text;
using System.Windows.Forms;
using System.IO;
using Common.Helper.Logger;
using Common.Model;
using BaseDAL.Model;
using System.Data;
using System.Net;

namespace GateService
{
	public partial class GateService : ServiceBase
	{
        #region Constants
        /// <summary>
        /// Gate Event Log name 
        /// </summary>
        public const string C_GATE_EVENT_LOG = "LoggerXGateService";
        public const string C_GATE_EVENT_SOURCE = "XGateService";
        /// <summary>
        /// Buffer size
        /// </summary>
        private const int C_BufferSize = 1024;

        #endregion

        #region Variables
        private EventLog eventLog;
        private ManualResetEvent mrs = null;
        private TimeSpan _readInterval, _writeInterval;
        private GateClient gClient = null;
        private GateServer gServer = null;
        private Thread connectThread = null, readGitOptionThread = null;
        private int prt;
        private int prtServer;
        private NetTcpServer tcpServer;
        #endregion

        #region Properties

        public int clientCount
        {
            get;
            private set;
        }

        /// <summary>
        /// Write Interval
        /// </summary>		 
        public TimeSpan writeInterval
        {
            get
            {
                if (null == _writeInterval)
                    _writeInterval = new TimeSpan(0, 0, 10);

                return _writeInterval;
            }
            set
            {
                _writeInterval = value;
            }
        }

        /// <summary>
        /// Raed Interval
        /// </summary>		 
        public TimeSpan readInterval
        {
            get
            {
                if (null == _readInterval)
                    _readInterval = new TimeSpan(0, 1, 0);

                return _readInterval;
            }
            set
            {
                _readInterval = value;
            }
        }

        #endregion

        #region Method

        public GateService()
        {
            InitializeComponent();

            Init();
        }

        /// <summary>
        /// Initializer
        /// </summary>
        private void Init()
        {
            prepare();
        }

        /// <summary>
        /// Prepare
        /// </summary>
        private void prepare()
        {
            prt = Convert.ToInt32(ConfigurationManager.AppSettings["port"]);
            prtServer = Convert.ToInt32(ConfigurationManager.AppSettings["portServer"]);

            mrs = new ManualResetEvent(true);

            makeEventLog();
        }


        /// <summary>
        /// Make event log
        /// </summary>
        private void makeEventLog()
        {
            try
            {
                eventLog = new EventLog();
                eventLog.Source = C_GATE_EVENT_SOURCE;
                eventLog.Log = C_GATE_EVENT_LOG;

                if (!EventLog.Exists(C_GATE_EVENT_LOG))
                    EventLog.CreateEventSource(C_GATE_EVENT_SOURCE, C_GATE_EVENT_LOG);
            }
            catch (Exception ex)
            {
                LoggerExtensionSQL.logMain(ex);
            }

        }

        /// <summary>
        /// Write log 
        /// </summary>
        /// <param name="log"></param>
        private void writeLog(string log)
        {
            if (null != eventLog)
            {
                log += "\r\n" + DateTime.Now.ToString("yyyy/MM/dd HH:mm:ss");
                eventLog.WriteEntry(log);
                //EventLogHandler.CreateEventLog(log);
            }
        }


        /// <summary>
        /// On Start Service
        /// </summary>
        /// <param name="args"></param>
        protected override void OnStart(string[] args)
        {
            try
            {
                writeLog("Service Starting . . .");

                readInterval = new TimeSpan(0, 1, 0);

                tryToConnect();
            }
            catch (Exception ex)
            {
                LoggerExtensionSQL.logMain(ex);
                writeLog("ERR: INVALID On Start" + ex.Message.ToString());
            }
        }

        /// <summary>
        /// On Stop Service
        /// </summary>
        protected override void OnStop()
        {
            stop();
        }

        /// <summary>
        /// Try to Connect
        /// </summary>
		private void tryToConnect()
        {
            connectThread = new Thread(new ThreadStart(connectToGate));
            connectThread.Start();
        }

        /// <summary>
        /// Connect To Gate
        /// </summary>
		private void connectToGate()
        {
            DataTable resultData = getListGate();

            if ((0 < resultData.Rows.Count) && (null != resultData))
            {
                for (int i = 0; i < resultData.Rows.Count; i++)
                {
                    //writeLog("IP " + resultData.Rows[i]["ip"].ToString());
                    gClient = new GateClient(resultData.Rows[i]["ip"].ToString(), prt, 1024);
                    gClient.onConnect += tcpClient_onConnect;
                    gClient.onDisconnect += tcpClient_onDisconnect;
                    gClient.onError += tcpClient_onError;
                    gClient.onReceiveData += tcpClient_onReceiveData;
                    gClient.onSendData += tcpClient_onSendData;

                    gClient.connect();
                    writeLog("connect to Gate");
                }
            }

            gServer = new GateServer(prtServer, C_BufferSize);
            gServer.onStart += tcpSever_onStart;
            gServer.onStop += tcpSever_onStop;
            gServer.onReceiveData += tcpServer_onReceiveData;
            gServer.onSendData += tcpServer_onSendData;

            gServer.start();

        }

        /// <summary>
        /// Server Send Data
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="client"></param>
        /// <param name="data"></param>
        private void tcpServer_onSendData(NetTcpServer sender, NetTcpClient client, CommandResult data)
        {
            IPEndPoint remoteIpEndPoint = client.Client.Client.LocalEndPoint as IPEndPoint;
            writeLog("INF:" + remoteIpEndPoint + "-> Server Send to Client " + data.message);
        }

        /// <summary>
        /// Server Receive data
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="client"></param>
        /// <param name="data"></param>
        private void tcpServer_onReceiveData(NetTcpServer sender, NetTcpClient client, CommandResult data)
        {
            IPEndPoint remoteIpEndPoint = client.Client.Client.LocalEndPoint as IPEndPoint;
            writeLog("INF:" + remoteIpEndPoint + "-> Server Receive from Client " 
                + Encoding.UTF8.GetString(data.model as byte[]));
        }

        /// <summary>
        /// Server Stop
        /// </summary>
        /// <param name="sender"></param>
        private void tcpSever_onStop(NetTcpServer sender)
        {
            writeLog("Server Stoped");
        }

        /// <summary>
        /// Server Start
        /// </summary>
        /// <param name="sender"></param>
        private void tcpSever_onStart(NetTcpServer sender)
        {
            writeLog("Server Start with port" + sender.port.ToString());
        }

        /// <summary>
        /// Get List Gates
        /// </summary>
        /// <returns></returns>
        private DataTable getListGate()
        {
            DataTable resultData = null;


            Common.BLL.Entity.XGate.gatedevice deviceModel = new Common.BLL.Entity.XGate.gatedevice()
            {
                state = 1
            };

            Common.BLL.Logic.XGate.gatedevice lDevice = new Common.BLL.Logic.XGate.gatedevice(Common.Enum.EDatabase.xGate);

            BaseDAL.Model.CommandResult opResult = lDevice.read(deviceModel, "state");

            if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
            {
                resultData = opResult.model as DataTable;
            }

            return resultData;
        }


        /// <summary>
        /// Coonnect
        /// </summary>
        /// <param name="sender"></param>
        void tcpClient_onConnect(NetTcpClient sender)
        {
            writeLog(sender.host + "- > Connect");
            SetStatusConnection(sender.host, 1);
        }

        /// <summary>
        /// Send Data
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="data"></param>
        void tcpClient_onSendData(NetTcpClient sender, CommandResult data)
        {
            writeLog(sender.host + "- > Send data " + Encoding.UTF8.GetString(data.model as byte[]));
        }

        /// <summary>
        /// Receive Data
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="data"></param>
		void tcpClient_onReceiveData(NetTcpClient sender, CommandResult data)
        {
            writeLog(sender.host + "- > Recieve data " + Encoding.UTF8.GetString(data.model as byte[]));
        }

        /// <summary>
        /// Error
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="data"></param>
		void tcpClient_onError(NetTcpClient sender, CommandResult data)
        {
            writeLog(sender.host + "- > Error : " + data.message);
        }

        /// <summary>
        /// Disconnect
        /// </summary>
        /// <param name="sender"></param>
		void tcpClient_onDisconnect(NetTcpClient sender)
        {
            writeLog(sender.host + "- > DisConnect");
            SetStatusConnection(sender.host, 0);
        }


        /// <summary>
        /// Stop All Gate Device
        /// </summary>
        private void stop()
        {
            DataTable resultData = getListGate();

           
            for (int i = 0; i < resultData.Rows.Count; i++)
            {
                string ip = resultData.Rows[i]["ip"].ToString();

                gClient = new GateClient(ip, prt, 1024);
                gClient.disconnect();
                

                DisconnectStatusGate();
            }


            //stopClientListener();

            gServer.stop();

            //if (null != readGitOptionThread)
            //    readGitOptionThread.Abort();
        }

        /// <summary>
        /// Disconnect Status Gates
        /// </summary>
        private void DisconnectStatusGate()
        {
            Common.BLL.Logic.XGate.gatedevice lGateDevice = new
               Common.BLL.Logic.XGate.gatedevice(Common.Enum.EDatabase.xGate);

            BaseDAL.Model.CommandResult opResult = lGateDevice.DisconnectStatusGate();
        }

        /// <summary>
        /// Set Statue Gate device
        /// </summary>
        /// <param name="state"></param>
        private void SetStatusConnection(string ip, Byte state)
        {

            Common.BLL.Logic.XGate.gatedevice lGateDevice = new
                Common.BLL.Logic.XGate.gatedevice(Common.Enum.EDatabase.xGate);

            BaseDAL.Model.CommandResult opResult = lGateDevice.UpdateStatusGate(ip, state);

        }

        /// <summary>
        /// Start Client Listener
        /// </summary>
        private void startClientListener()
        {
            if (null == tcpServer)
            {
                tcpServer = new NetTcpServer(prt, C_BufferSize);
                tcpServer.onReceiveData += TcpServer_onReceiveData;
                tcpServer.start();


                writeLog("INF: start tcpServer ");

            }
        }

        /// <summary>
        /// Stop Client Listener
        /// </summary>
        private void stopClientListener()
        {
            if (null != tcpServer)
                tcpServer.stop();
            tcpServer = null;
        }

        /// <summary>
        /// TcpServer Receive Data
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="client"></param>
        /// <param name="data"></param>
        private void TcpServer_onReceiveData(NetTcpServer sender, NetTcpClient client, CommandResult data)
        {

            writeLog("INF: " + client.host + "- > Receive: " + Encoding.UTF8.GetString(data.model as byte[]));
            Helper.ClientMethodParser.parseCmd(client, data);
        }


    }
    #endregion
}

