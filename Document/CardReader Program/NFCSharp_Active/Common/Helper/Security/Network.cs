using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.NetworkInformation;
using System.Net.Sockets;
using System.Text;

namespace Common.Helper.Security
{
	public class Network
	{
		public static string GetLocalIPAddress()
        {
            var host = Dns.GetHostEntry(Dns.GetHostName());
            foreach (var ip in host.AddressList)
            {
                if (ip.AddressFamily == AddressFamily.InterNetwork)
                {
                    return ip.ToString();
                }
            }
            throw new Exception("Local IP Address Not Found!");
        }

		public static bool PingHost(string nameOrAddress)
		{
			bool pingable = false;
			Ping pinger = new Ping();
			try
			{
				PingReply reply = pinger.Send(nameOrAddress);
				if( reply.Status == IPStatus.Success)
					pingable = true;
			}
			catch (PingException ex)
			{
				EventLogHandler.CreateEventLog("PingHost: " + ex.Message);
			}
			return pingable;
		}

	}
}
