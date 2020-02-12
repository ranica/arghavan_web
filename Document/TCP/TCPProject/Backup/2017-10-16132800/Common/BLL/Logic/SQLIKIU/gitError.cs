using Common.BLL.Logic.DB;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Linq;
using System.Text;

namespace Common.BLL.Logic.SQLIKIU
{
	public class gitError
	{
		public static void saveErrorDevice(string ip, string error)
		{
			try
			{
				dbTestDataContext	 db = new dbTestDataContext (ConfigurationManager.AppSettings["ConnectionStringError"].Trim ());
				DB.giterror		err	= new DB.giterror ();
				err.ip		= ip;
				err.error	= error;
				err.date	= DateTime.Now;

				db.giterrors.InsertOnSubmit(err);
				db.SubmitChanges();
			}
			catch (Exception)
			{
				
				throw;
			}
		}
	}
}
