using Common.BLL.Entity.IAU;
using Common.BLL.Logic.IAU;
using Common.Helper.Logger;
using Common.Model;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Linq;
using System.Text;

namespace Common.BLL.Logic.IAU
{
	public class gitUser
	{
		#region Variables
		public static List<user> _lstUser = new List<user>();
        private const string PARAM_CDN = "@CDN";

        private const string SELECT_USER = "SELECT * FROM gate_users WHERE cdn = " + PARAM_CDN;
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
		public static user GetUser (string codecard, string ip)
		{
			try
			{				
				user _userinfo = new user ();

                MySqlParameter[] parameters =
                {
                    new MySqlParameter(PARAM_CDN  ,codecard)
                };


                MySqlDataReader dataReader = MySQLHelper.ExecuteReader(CommandType.Text, SELECT_USER, parameters);

                if (!dataReader.HasRows)
                    return null;

                if (dataReader.Read())
                {
                    _userinfo.CodeCard = (string)(dataReader["cdn"]);
                    _userinfo.studentId = (string)(dataReader["us"]);
                    //_userinfo.Name = !string.IsNullOrEmpty(_exiUser.nam) ? _exiUser.nam : "";
                    //_userinfo.Family = !string.IsNullOrEmpty(_exiUser.fam) ? _exiUser.fam : "";
                    _userinfo.Gen = Convert.ToInt16(dataReader["gender_id"]);
                    _userinfo.Pic = (DBNull.Value != dataReader["pic"]) ? Convert.ToString(dataReader["pic"]) : null;
                    _userinfo.Suitmem = Convert.ToInt16(dataReader["suitmem"]);
                    _userinfo.Active = Convert.ToBoolean(dataReader["active"]);
                    _userinfo.StartDate = (DateTime)(dataReader["startDate"]);
                    _userinfo.EndDate = (DateTime)(dataReader["endDate"]);
                    _userinfo.Ip = ip;
                    return _userinfo;
                }
               
				else
				{					
					return _userinfoNull;
				}
			}
			catch (Exception ex)
			{
                LoggerExtension.log(ex);	
				return _userinfoNull;				
			}
		}

		public static void removeUser(string kart)
		{
            try
            {
                if (_lstUser.Count > 0)
                {
                    var item = _lstUser.Where(r => r.CodeCard == kart).FirstOrDefault();
                    if (null != item)
                        _lstUser.Remove(item);
                }
            }
            catch (Exception ex)
            {
                LoggerExtension.log(ex);
            }
			
		}

		#endregion
	}
}
