using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Linq;
using System.Text;
using BaseDAL.Model;
using Common.Network.Core;

namespace TcpProject.Helper
{
    public class GateServer
    {
        #region Events
        public event Common.Network.Core.NetTcpServer.Start onStart;
        public event Common.Network.Core.NetTcpServer.Stop onStop;
        public event Common.Network.Core.NetTcpServer.ReceiveData onReceiveData;
        public event Common.Network.Core.NetTcpServer.SendData onSendData;
        public event Common.Network.Core.NetTcpServer.Error onError;

        #endregion

        #region Variables

        private int prt;
        private NetTcpServer tcpServer;
        private NetTcpClient tcpClient;

        #endregion

        #region Properties
             
        #endregion

        #region Methods
        public GateServer(int port, int bufferSize)
        {
            prepare();
            tcpServer = new NetTcpServer(port, bufferSize);

            tcpServer.onReceiveData += TcpServer_onReceiveData;
            tcpServer.onSendData += TcpServer_onSendData;
            tcpServer.onStop += TcpServer_onStop;
            tcpServer.onStart += TcpServer_onStart;
        }

        private void prepare()
        {
            prt = Convert.ToInt32(ConfigurationManager.AppSettings["port"]);

        }

        /// <summary>
        /// Tcp Server On Start
        /// </summary>
        /// <param name="sender"></param>
        private void TcpServer_onStart(NetTcpServer sender)
        {
            if (null != onStart)
            {
                onStart(sender);
            }
        }

        /// <summary>
        /// Tcp Server On Stop
        /// </summary>
        /// <param name="sender"></param>
        private void TcpServer_onStop(NetTcpServer sender)
        {
            if (null != onStop)
            {
                onStop(sender);
            }
        }

        /// <summary>
        /// Tcp Server On Send Data
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="client"></param>
        /// <param name="data"></param>
        private void TcpServer_onSendData(NetTcpServer sender, NetTcpClient client, BaseDAL.Model.CommandResult data)
        {
            if (null != onSendData)
                onSendData(sender, client, data);
        }

        /// <summary>
        /// Tcp Servre On Receive Data
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="client"></param>
        /// <param name="data"></param>
        private void TcpServer_onReceiveData(NetTcpServer sender, NetTcpClient client, BaseDAL.Model.CommandResult data)
        {
            if (null != onReceiveData)
            {
                onReceiveData(sender, client, data);

                parseData(client, data);

            }
        }

        /// <summary>
        /// Parse Data
        /// </summary>
        /// <param name="client"></param>
        /// <param name="data"></param>
        public void parseData(NetTcpClient client, CommandResult data)
        {
            try
            {
                //data = "idDevice|command"  

                if ((null != client) && (null != data) && !data.message.isNullOrEmptyOrWhiteSpaceOrLen())
                {
                    DataTable res = data.model as DataTable;
                    string[] words = Encoding.UTF8.GetString(data.model as byte[]).Split('|');

                    int id = Convert.ToInt32(words[0]);

                    Common.BLL.Logic.IAU.gatedevice lGateDevice =
                        new Common.BLL.Logic.IAU.gatedevice();


                    DataTable resultTable = lGateDevice.loadDeviceById(id);


                    if (resultTable.Rows.Count > 0)
                    {
                        string IpAddress = resultTable.Rows[0]["ip"].ToString();


                        tcpClient = new NetTcpClient(IpAddress, prt, 1024);

                        tcpClient.connect();

                        try
                        {
                            tcpClient.write(words[1]);
                            tcpClient.flush();
                        }
                        catch (Exception ex)
                        {
                            string s = ex.Message;
                        }
                        tcpClient.disconnect();

                    }
                }
            }
            catch (Exception ex)
            {

                LoggerExtensionSQL.logMain(ex);
            }
        }

        /// <summary>
        /// Start Tcp Server
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        public void start()
        {
            tcpServer.start();
        }

        /// <summary>
        /// Stop Tcp Server
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        public void stop()
        {
            tcpServer.stop();
        }
        
        #endregion
    }
}
