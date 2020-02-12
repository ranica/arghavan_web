using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Common.Model
{
	public class ListInfo
	{
		//dicData = ip, kart
		public static Dictionary<string, ListInfo> dicData = new Dictionary<string, ListInfo> ();
		public string kart { get; set; } // کد کارت		
		public string stu_id { get; set; } // شماره دانشجویی 

		public static bool notExistKart (string code)
		{
			bool result = false;

			if (dicData.Count > 0)
			{
				var item = dicData.First (kvp => kvp.Value.kart  == code);
				if (item.Value != null)
					result	=  false;
				else
					result	=	true;
			}
			else
				result =  true;

			return result;
		}

		public static void removeKart (string ip)
		{
			if (null != dicData)
			{ 
				var item = dicData.First (kvp => kvp.Key == ip);
				dicData.Remove (item.Key);
			}
			//EventLogHandler.CreateEventLog("Remove IP : " + IpEndpoint.Address.ToString());
		}
	}
}
