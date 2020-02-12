using BaseDAL.Model;
using Common.Network.Core;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace TcpProject.Helper
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
		public static void parseCmd (NetTcpClient client, CommandResult data)
		{
			if ((null != client) && (null != data) && !data.message.isNullOrEmptyOrWhiteSpaceOrLen ())
			{
				string cmd = data.message.ToLower ();

				if (cmd == "get_last_data")
				{
					// Get last data
				}
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
