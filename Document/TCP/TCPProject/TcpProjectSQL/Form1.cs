using BaseDAL.Model;
using Common.BLL.Logic.XGate;
using Common.Model;
using Common.Network.Core;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Configuration;
using System.Data;
using System.Diagnostics;
using System.Drawing;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading;
using System.Windows.Forms;
using TcpProjectSQL.Helper;
using System.Net.Sockets;

namespace TcpProjectSQL
{
    public partial class Form1 : Form
    {

     
        #region Variables
        /// <summary>
        /// Gate Event Log name 
        /// </summary>
        public const string C_GATE_EVENT_LOG = "LoggerGateServiceLog";

        public const string C_GATE_EVENT_SOURCE = "LoggerGateService";

        private EventLog eventLog;
        private ManualResetEvent mrs = null;
        private TimeSpan _readInterval, _writeInterval;
        private GateClient gClient = null;
        private GateServer gServer = null;
        private Thread connectThread = null, readGitOptionThread = null;
      
        private const int C_BufferSize = 1024;

        private int prt;
       

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

        #region Methods
        public Form1()
        {
            InitializeComponent();

            init();
           
        }

        private void init()
        {
            prepare();
        }

        private void prepare()
        {
            prt = Convert.ToInt32(ConfigurationManager.AppSettings["port"]);


            mrs = new ManualResetEvent(true);
            //makeEventLog();

          
        }

        void t_onReceiveData(NetTcpClient sender, CommandResult data)
        {
            string s = Encoding.UTF8.GetString(data.model as byte[]);
            
            Invoke((Action)delegate
            {
                listBox1.Items.Insert(0, s);
            });
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
                System.Windows.Forms.MessageBox.Show(ex.Message);
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


        private void button1_Click(object sender, EventArgs e)
        {
            
            try
            {
                readInterval = new TimeSpan(0, 1, 0);

                tryToConnect();

            }
            catch (Exception)
            {
                listBox1.Items.Add("ERR: INVALID CONFIG DATA");
            }
        }

        private void tryToConnect()
        {
            connectThread = new Thread(new ThreadStart(connectToGate));
            connectThread.Start();
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
                state = 1,
                type = 0
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
        /// Connect To Gate
        /// </summary>
        private void connectToGate()
        {
            int prtServer = Convert.ToInt32(ConfigurationManager.AppSettings["portServer"]);
            DataTable resultData = getListGate();

            if ((0 < resultData.Rows.Count) && (null != resultData))
            {
                for (int i = 0; i < resultData.Rows.Count; i++)
                {
                    gClient = new GateClient(resultData.Rows[i]["ip"].ToString(), prt, 1024);
                    gClient.onConnect += tcpClient_onConnect;
                    gClient.onDisconnect += tcpClient_onDisconnect;
                    gClient.onError += tcpClient_onError;
                    gClient.onReceiveData   += tcpClient_onReceiveData;
                    gClient.onSendData      += tcpClient_onSendData;

                    gClient.connect();
                }
            }


            gServer = new GateServer (prtServer, C_BufferSize);
            gServer.onStart += tcpSever_onStart;
            gServer.onStop += tcpSever_onStop;
            gServer.onReceiveData += tcpServer_onReceiveData;
            //tcpServer.onAcceptClient += Tcp-Server_onAcceptClient;
            gServer.onSendData += tcpServer_onSendData;

            gServer.start();
           
        }

        /// <summary>
        /// Tcp Sever On Receive Data
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="client"></param>
        /// <param name="data"></param>
        private void tcpServer_onReceiveData(NetTcpServer sender, NetTcpClient client, CommandResult data)
        {
            Invoke((Action)delegate
            {
                IPEndPoint remoteIpEndPoint = client.Client.Client.LocalEndPoint as IPEndPoint;
                listBox1.Items.Insert(0, "INF:" + remoteIpEndPoint + "-> Server Receive from Client " + Encoding.UTF8.GetString(data.model as byte[]));

            });
        }

        /// <summary>
        /// Tcp Server om Stop
        /// </summary>
        /// <param name="sender"></param>
        private void tcpSever_onStop(NetTcpServer sender)
        {
            Invoke((Action)delegate
            {
                listBox1.Items.Insert(0, "Server Stop");

            }); 
        }

        /// <summary>
        /// Tcp Server on Start
        /// </summary>
        /// <param name="sender"></param>
        private void tcpSever_onStart(NetTcpServer sender)
        {
            Invoke((Action)delegate
            {
                listBox1.Items.Insert(0, "Server Start with port" + sender.port.ToString());
            });
        }

        /// <summary>
        /// Send Data
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="data"></param>
        void tcpClient_onSendData(NetTcpClient sender, CommandResult data)
        {
            Invoke((Action)delegate
            {
                listBox1.Items.Insert(0, sender.host + "- > Send data " + Encoding.UTF8.GetString(data.model as byte[]));
            });
        }
        /// <summary>
        /// Receive Data
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="data"></param>
        void tcpClient_onReceiveData(NetTcpClient sender, CommandResult data)
        {
            Invoke((Action)delegate
            {
                listBox1.Items.Insert(0, sender.host + "- > Recieve data " + Encoding.UTF8.GetString(data.model as byte[]));
            });
        }
        /// <summary>
        /// Error
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="data"></param>
        void tcpClient_onError(NetTcpClient sender, CommandResult data)
        {
            Invoke((Action)delegate
            {
                listBox1.Items.Insert(0, sender.host + "- > Error : " + data.message);
            });
        }
        /// <summary>
        /// DisConnect
        /// </summary>
        /// <param name="sender"></param>
        void tcpClient_onDisconnect(NetTcpClient sender)
        {
            Invoke((Action)delegate
            {
                listBox1.Items.Insert(0, sender.host + "- > DisConnect");
                SetStatusConnection(sender.host, 0);

            });
        }
        /// <summary>
        /// Connect
        /// </summary>
        /// <param name="sender"></param>
        void tcpClient_onConnect(NetTcpClient sender)
        {
            Invoke((Action)delegate
            {
                listBox1.Items.Insert(0, sender.host + "- > Connect");
                SetStatusConnection(sender.host, 1);

            });
        }

        private void button2_Click(object sender, EventArgs e)
        {
            try
            {
                stop();
                //stopClientListener();
            }
            catch (Exception ex)
            {
                Invoke((Action)delegate
                {
                    listBox1.Items.Insert(0, "button2 -> " + ex.Message);

                });
            }
        }

        /// <summary>
        /// Stop All Gates
        /// </summary>
        private void stop()
        {
            DataTable resultData = getListGate();

            Invoke((Action)delegate
            {
                for (int i = 0; i < resultData.Rows.Count; i++)
                {
                    string ip = resultData.Rows[i]["ip"].ToString();

                    gClient = new GateClient(ip, prt, 1024);
                    gClient.disconnect();
                    listBox1.Items.Insert(0, ip + "- > DisConnect");

                    DisconnectStatusGate();
                }
               
            });

            if (null != readGitOptionThread)
                readGitOptionThread.Abort();

            gServer.stop();

         	
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
        ///// <summary>
        ///// Start Client Listener
        ///// </summary>
        //private void startClientListener()
        //{
        //    int prtServer = Convert.ToInt32(ConfigurationManager.AppSettings["portServer"]);
        //    if (null == tcpServer)
        //    {
        //        tcpServer = new NetTcpServer(prtServer, C_BufferSize);
        //        tcpServer.onReceiveData += TcpServer_onReceiveData;
        //        //tcpServer.onAcceptClient += TcpServer_onAcceptClient;
        //        tcpServer.onSendData += TcpServer_onSendData;

        //        tcpServer.start();

        //        Invoke((Action)delegate
        //        {
        //            listBox1.Items.Insert(0, "INF: start tcpServer ");

        //        });

        //    }
        //}

        private void tcpServer_onSendData(NetTcpServer sender, NetTcpClient client, CommandResult data)
        {
            Invoke((Action)delegate
            {
                IPEndPoint remoteIpEndPoint = client.Client.Client.LocalEndPoint as IPEndPoint;
                listBox1.Items.Insert(0, "INF:" + remoteIpEndPoint + "-> Server Send to Client " + data.message);

            });
        }

        private void TcpServer_onAcceptClient(NetTcpServer sender, NetTcpClient client)
        {
            Invoke((Action)delegate

            {
                IPEndPoint remoteIpEndPoint = client.Client.Client.LocalEndPoint as IPEndPoint;
                listBox1.Items.Insert(0, "INF: " + remoteIpEndPoint.Address);
            });
        }

       
        /// <summary>
        /// Stop Client Listener
        /// </summary>
        //private void stopClientListener()
        //{
        //    if (null != tcpServer)
        //        tcpServer.stop();
        //    tcpServer = null;
        //}
        
        private void readGitOption()
        {
            readGitOptionThread = new Thread(new ThreadStart(() =>
            {
                try
                {
                    while (true)
                    {
                       /* Thread.Sleep(_readInterval);
                        mrs.WaitOne();
                        gitOption._infoOption = gitOption.GetLastStateOfDeviceOption();
                        //writeLog ("INF: Port: " + gitOption._infoOption.Port.ToString());
                        if (readInterval != TimeSpan.Parse(ConfigurationManager.AppSettings["Interval"]))
                            readInterval = TimeSpan.Parse(ConfigurationManager.AppSettings["Interval"]);*/

                    }

                }
                catch (Exception ex)
                {
                    Invoke((Action)delegate
                    {
                        listBox1.Items.Insert(0, "ERR: Thread read gitoption failed -> " + ex.Message);
                    });
                    //writeLog("ERR: Thread read gitoption failed -> " + ex.Message);
                }
            }));
            readGitOptionThread.Start();
        }
        private void button3_Click(object sender, EventArgs e)
        {
            
        }

        DateTime currentDate;
        Thread pingThread;
        bool reconnect;
        private void testButton_Click(object sender, EventArgs e)
        {
            currentDate = DateTime.Now;
            tryToCheckPing();
        }

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

                        Thread.Sleep(8000);

                        TimeSpan result = DateTime.Now.Subtract(currentDate);
                        if (int.Parse(result.Seconds.ToString()) > 8)
                        {
                            reconnect = true;
                            break;
                        }
                        else
                        {
                            reconnect = false;
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
                            reconnect = false;
                            MessageBox.Show("Ok Connect");
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

        private void clearButton_Click(object sender, EventArgs e)
        {
            listBox1.Items.Clear();

        }

    


        private void Unkown_Click(object sender, EventArgs e)
        {
            /*string cmd= "12EF45678";
			
			string kart		= Convert.ToString ((Int64.Parse (cmd.Substring (1, 8), System.Globalization.NumberStyles.HexNumber)));
					
			device	_host	= gitDevice.GetDevice("192.168.0.1");	 
			option	_option	= gitOption._infoOption;
			//if (null != gitUser.GetUser(kart))
			//{ 
				gitUser._lstUser.Add(gitUser.GetUser(kart, "1222"));

				int result		= gitLog.kartLicense("192.168.0.1", kart, _host, _option);
				ListInfo.removeKart("192.168.0.1");
				switch (result)
				{
					//case 2: write("[22011]"); break;
					//case 3:
					//case 4:
					//case 5:
					//case 6:
					//case 7:
					//case 8:
					//case 9:
					//case 10:
					//case 11:
					//	{
					//		write("[22010]");
					//		gitUser.removeUser(kart);
					//	} break;											
				}	
			//}
			//else
			//{
			//	_userinfo.studentId = "0";
			//	_userinfo.Pic = null;
			//	gitLog.saveLogUser (_userinfo, _host.Id, (int)_host.Direction, (int)EnumMessageType.unkownCard);
			//}*/
        }
    }
    #endregion
}
