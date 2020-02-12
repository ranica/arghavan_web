using Common.BLL.Entity.SQLIKIU;
using Common.BLL.Logic.DB;
using Common.Enum;
using Common.Helper.Logger;
using Common.Model;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Linq;
using System.Text;

namespace Common.BLL.Logic.SQLIKIU
{
	public class tbGuest
	{
		#region Variable
		

		#endregion
		#region Properties
		

		#endregion
		#region Methods

		/// <summary>
		/// Get Info Guest
		/// </summary>
		/// <param name="stuid"></param>
		/// <returns></returns>
		public static guest infoGuest(string stuid)
		{
			guest result = null;
			try
			{
				dbIKIUDataContext db = new dbIKIUDataContext (ConfigurationManager.AppSettings["ConnectionString"].Trim ());
				var info = db.tbreqguests.Where (r=> r.stu_id == stuid && Convert.ToDateTime(r.dats) <= DateTime.Now  &&  Convert.ToDateTime(r.datf) >= DateTime.Now ).FirstOrDefault();
				//
				guest gt = new guest ();

				if (null != info )
				{
					if (info.kind == (int)EnumKindGuest.Student)
						gt.cdnguest = info.stuguest;
					else 
						gt.cdnguest = info.cdnguest;
					gt.name		= info.namguest.isNullOrEmptyOrWhiteSpaceOrLen() ? "" : info.namguest;
					gt.relation = info.nesbat.isNullOrEmptyOrWhiteSpaceOrLen() ? "" : info.nesbat;
					gt.datend	= ((null != info.datf) ? Convert.ToDateTime( info.datf).ToString("yyyy/MM/dd"): "")  + " __  "+ ((null != info.dats) ? Convert.ToDateTime( info.dats).ToString("yyyy/MM/dd"): "");
					gt.message  = (null != info.kind) ? getMessage(info.kind) : "";

					result = gt;
				}
				else 
					result = null ;

				return result;

			}
			catch (Exception ex)
			{
				Logger.logger.log ( CommandResult.makeErrorResult(ex.Message, ex));
				return result;
			}
		}

		//TODO : Create Enum for Kind Guest
		/// <summary>
		/// Get kind guest Message 
		/// </summary>
		/// <param name="request"></param>
		/// <returns></returns>
		private static string getMessage (int request)
		{
			string result = "";
			switch (request)
			{
				case 0 : 
					result = "درخواست در حال بررسی می باشد";
					break;
				case 1 :
					result = "حضور میهمان بلا مانع است";
					break;
				case 2 :
					result = "حضور میهمان مجاز نمی باشد";
					break;
					
				default:
				break;
			}
			return result;
		}

		#endregion
	}
}
