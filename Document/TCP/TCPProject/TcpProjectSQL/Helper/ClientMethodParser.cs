using BaseDAL.Model;
using Common.Network.Core;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Linq;
using System.Text;

namespace TcpProjectSQL.Helper
{
	/// <summary>
	/// Client Method Parser
	/// </summary>
	public class ClientMethodParser
	{
        /*
			Commands (CLIENT):
					GET_LAST_DATA
			
			Commands (SERVER):
					NEW_DATA
		*/

        private NetTcpClient tcpClient;

        #region Methods
        /// <summary>
        /// Parse Command
        /// </summary>
        /// <param name="client"></param>
        /// <param name="data"></param>
        public void parseCmd (NetTcpClient client, CommandResult data, int port)
		{
            try
            {
                //data = "idDevice|command"  

                if ((null != client) && (null != data) && !data.message.isNullOrEmptyOrWhiteSpaceOrLen())
                {
                    DataTable res = data.model as DataTable;
                    string[] words = Encoding.UTF8.GetString(data.model as byte[]).Split('|');

                    int id = Convert.ToInt32(words[0]);

                    Common.BLL.Entity.XGate.gatedevice gateDeviceModel =
                        new Common.BLL.Entity.XGate.gatedevice()
                        {
                            id = id
                        };

                    Common.BLL.Logic.XGate.gatedevice lGateDevice =
                        new Common.BLL.Logic.XGate.gatedevice(Common.Enum.EDatabase.xGate);


                    CommandResult result = lGateDevice.read(gateDeviceModel, "id");

                    DataTable resultTable = result.model as DataTable;

                    if (resultTable.Rows.Count > 0)
                    {
                        string IpAddress = resultTable.Rows[0]["ip"].ToString();

                        SendClient(IpAddress, port, words[1].ToString());

                       
                    }
                }
            }
            catch (Exception ex)
            {

                LoggerExtensionSQL.logMain(ex);
            }
         
           
		}

        private static void SendClient(string ipAddress, int port, string command)
        {
            //tcpClient = new NetTcpClient(ipAddress, port, 1024);

            //tcpClient.connect();
            //tcpClient.write(command);
            //tcpClient.disconnect();
        }
              
       
        /// <summary>
        /// Write Cmd
        /// </summary>
        /// <param name="server"></param>
        /// <param name="data"></param>
        public static void writeData (NetTcpServer server, NetTcpClient client, string command)
		{
			if ((null != server) && !command.isNullOrEmptyOrWhiteSpaceOrLen ())
			{
				string cmd	=  command.Trim();

				server.write (cmd);
			}
		}
		#endregion
	}
}
