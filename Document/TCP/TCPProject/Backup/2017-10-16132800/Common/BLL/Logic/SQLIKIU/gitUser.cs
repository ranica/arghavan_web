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
	public class gitUser
	{
		#region Variables
		public static List<user> _lstUser = new List<user>();
		#endregion

		#region Properties
		public static user _userinfoNull 
		{ 
			get; 
			set; 
		}
		#endregion

		#region Methods

		/// <summary>
		/// Get User by code kart
		/// </summary>
		/// <param name="codecard"></param>
		/// <returns></returns>
		public static user GetUser (string codecard)
		{
			try
			{				
				//string conn= SSTCryptographer.Decrypt( ConfigurationManager.AppSettings["ConnectionString"].Trim (),"61462");
				dbIKIUDataContext db = new dbIKIUDataContext (ConfigurationManager.AppSettings["ConnectionString"].Trim ());
				//string URL = ConfigurationManager.AppSettings["URL"].ToString();
				user _userinfo = new user ();
				var _exiUser = db.gitusers.Where (r => r.cdn == codecard).FirstOrDefault ();
				if (_exiUser != null)
				{
					_userinfo.CodeCard		=	!string.IsNullOrEmpty(_exiUser.cdn) ? _exiUser.cdn : "";
					_userinfo.studentId		=	!string.IsNullOrEmpty(_exiUser.stu_id) ? _exiUser.stu_id : "";
					_userinfo.Name			=	!string.IsNullOrEmpty(_exiUser.nam) ? _exiUser.nam : "";
					_userinfo.Family		=	!string.IsNullOrEmpty(_exiUser.fam) ? _exiUser.fam : "";
					_userinfo.Gen			=	(null != _exiUser.gen) ? (int)_exiUser.gen : -1;
					_userinfo.Pic			=	!string.IsNullOrEmpty(_exiUser.pic) ? _exiUser.pic : null;
					_userinfo.Suitmem		=	(null != _exiUser.suitmem) ? (int)_exiUser.suitmem : -1;
					_userinfo.Active		=	(null != _exiUser.active) ? _exiUser.active : false;
					_userinfo.StartDate		=	(null != _exiUser.startdat) ? _exiUser.startdat : Convert.ToDateTime("2000-01-01");
					_userinfo.EndDate		=	(null != _exiUser.enddat) ? _exiUser.enddat : Convert.ToDateTime("2000-01-01");					
					return _userinfo;
				}
				else
				{					
					return _userinfoNull;
				}
			}
			catch (Exception ex)
			{		
				Logger.logger.log(CommandResult.makeErrorResult(ex.Message, ex));
				return _userinfoNull;				
			}
		}

		public static void removeUser(string kart)
		{
			if (_lstUser.Count > 0)
			{
				var item = _lstUser.Where ( r=> r.CodeCard == kart ).FirstOrDefault();
				if (null != item )
					_lstUser .Remove (item);
			}
		}

		#endregion
	}
}
