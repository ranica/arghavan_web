using BaseDAL.Model;
using Common.Network.Core;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace MySQLGateService.Helper
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

        #region Methods
        /// <summary>
        /// Parse Command
        /// </summary>
        /// <param name="client"></param>
        /// <param name="data"></param>
        public static void parseCmd(NetTcpClient client, CommandResult data, int port)
        {
            try
            {
                //data = "idDevice|command"  

                if ((null != client) && (null != data) && !data.message.isNullOrEmptyOrWhiteSpaceOrLen())
                {
                    DataTable res = data.model as DataTable;
                    string[] words = Encoding.UTF8.GetString(data.model as byte[]).Split('|');

                    int id = Convert.ToInt32(words[0]);

                    Common.BLL.Entity.IAU.gatedevice gateDeviceModel =
                       new Common.BLL.Entity.IAU.gatedevice()
                       {
                           ip = "1222"
                           //id = id
                       };



                    Common.BLL.Logic.IAU.gatedevice lGateDevice =
                        new Common.BLL.Logic.IAU.gatedevice();






                    //CommandResult result = lGateDevice.read(gateDeviceModel, "id");

                    // DataTable resultTable = result.model as DataTable;
                    DataTable resultTable = null;

                    if (resultTable.Rows.Count > 0)
                    {
                        string IpAddress = resultTable.Rows[0]["ip"].ToString();

                        NetTcpClient tcpClient = new NetTcpClient(IpAddress, port, 1024);

                        tcpClient.connect();
                        tcpClient.write(words[1].ToLower());
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
        /// Write Cmd
        /// </summary>
        /// <param name="server"></param>
        /// <param name="data"></param>
        public static void writeData (NetTcpServer server, string command)
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
