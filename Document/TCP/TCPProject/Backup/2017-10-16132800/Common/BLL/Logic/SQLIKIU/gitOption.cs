using Common.BLL.Entity.SQLIKIU;
using Common.BLL.Logic.DB;
using Common.Helper.Logger;
using Common.Model;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Linq;
using System.Text;


namespace Common.BLL.Logic.SQLIKIU
{
	public  class gitOption
	{
		 #region Variables
		 public static option _infoOption;
		 #endregion

		#region Properties
		
		#endregion

		 #region Methods		 
		
		 /// <summary>
		/// Get last status device option
		/// </summary>
		/// <returns></returns>
		public  static option GetLastStateOfDeviceOption ()
		{
			try
			{				
				dbIKIUDataContext db = new dbIKIUDataContext (ConfigurationManager.AppSettings["ConnectionString"].Trim ());

				option deviceInfos = new option ();
				var lastdata = db.gitoptions.FirstOrDefault ();
				if (lastdata != null)
				{
					deviceInfos.DatEndSuit		= lastdata.datendsuit;
					deviceInfos.DatStartSuit	= lastdata.datstartsuit;
					deviceInfos.Emergency		= (int)lastdata.emergency;
					deviceInfos.Genzoonw		= (int)lastdata.genzoonw;
					deviceInfos.Genzoonm		= lastdata.genzoonm;
					//deviceInfos.FirstInOut		= (bool)lastdata.firstInOut;
					deviceInfos.Port			= (int)lastdata.port;

					return deviceInfos ?? null;
				}
				else 
					return null;
			}
			catch (Exception ex)
			{
				Logger.logger.log(CommandResult.makeErrorResult(ex.Message, ex));
				return null;
			}
		}	
		#endregion
	
	}
}
