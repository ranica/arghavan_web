using BaseDAL.Model;
using Common.BLL.Entity.IAU;
using Common.BLL.Logic.IAU;
using Common.Helper.Logger;
using Common.Model;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Diagnostics;
using System.Linq;
using System.Net;
using System.Text;


namespace Common.BLL.Logic.IAU
{
	public class gitDevice
	{

		#region Properties
		// Info IP , Direction : input or Output
		public static Dictionary<string, int> dicIpAddress = new Dictionary<string, int> ();
		// Public List Device
		public static List<device> lstDevice;
		public static List<device> _lstNull 
		{
			get; 
			set; 
		}
		public static device _deviceNull 
		{ 
			get; 
			set; 
		}

        private const string PARAM_STATE = "@STATE";
        private const string PARAM_IP = "@IP";
        private const string PARAM_NETSTATE = "@NETSTATE";

        private const string SELECT_DEVICE = "SELECT * FROM gate_devices WHERE state = 1";
        private const string SELECT_DEVICEByIP = "SELECT * FROM gate_devices WHERE ip = " + PARAM_IP ;
        private const string UPDATE_DEVICE = "UPDATE  gate_devices SET netState = " + PARAM_NETSTATE +
                                                "  WHERE ip = " + PARAM_IP;
        #endregion

        /// <summary>
        /// Get Direction Device
        /// </summary>
        /// <param name="ip"></param>
        /// <returns></returns>
        /// 
        public static string getdirection (string ip)
		{
			string result = "";

			if (null != dicIpAddress)
			{
				var item	= dicIpAddress.First (kvp => kvp.Key == ip).Value;
				result		= item.ToString ();
			}

			return result;
		}

        /// <summary>
        /// Get Device 
        /// </summary>
        /// <param name="ip"></param>
        /// <returns></returns>
        public static device GetDevice(string ip, int direct)
        {
            try
            {
                device _info = new device();               

                if (lstDevice.Count > 0)
                {
                    var _device = lstDevice.Where(r => r.Ip == ip).FirstOrDefault();

                    if (null != _device)
                    {
                        _info.Id = _device.Id;
                        _info.Name = _device.Name;
                        _info.Active = _device.Active;
                        _info.Gen = _device.Gen;                        
                        _info.Zoon = _device.Zoon;

                        _info.Direction = direct;

                        return _info;
                    }
                    else
                        return _deviceNull;
                }
                else
                    return _deviceNull;


            }
            catch (Exception ex)
            {
                LoggerExtension.log(ex);
                return _deviceNull;
            }
        }



        /// <summary>
        /// Get List Device
        /// </summary>
        /// <returns></returns>
        public static List<device> GetDevice ()
		{
			try
			{
                MySqlDataReader dataReader = MySQLHelper.ExecuteReader(CommandType.Text, SELECT_DEVICE, null);

                device _devinfo;

                List<device> _lstdevinfo = new List<device>();

                if (!dataReader.HasRows)
                    return null;
                else
                {
                    while (dataReader.Read())
                    {
                        _devinfo = new device();
                        _devinfo.Id = Convert.ToInt32(dataReader["id"]);
                        _devinfo.Name = dataReader["name"].ToString();
                        _devinfo.Active = Convert.ToBoolean(dataReader["state_id"]);
                        _devinfo.Gen = Convert.ToInt32(dataReader["gender_id"]);
                        _devinfo.Zoon = Convert.ToInt32(dataReader["zone_id"]);
                        _devinfo.Ip = dataReader["ip"].ToString();
                        _devinfo.Direction = Convert.ToInt32(dataReader["direct_id"]);

                        _lstdevinfo.Add(_devinfo);
                    }

                    return _lstdevinfo;
                }                
			}
			catch (Exception ex)
			{			
				Logger.logger.log(CommandResult.makeErrorResult(ex.Message, ex));

                return _lstNull;
			}
		}

		/// <summary>
		/// Set status network Gate
		/// </summary>
		/// <param name="ip"></param>
		/// <param name="status"></param>
		public static bool SetStatusConnection (string ip, bool status)
		{
            try
            {
                MySqlParameter[] parameters =
                {
                    new MySqlParameter(PARAM_IP  ,ip)
                };
                

                MySqlDataReader dataReader = MySQLHelper.ExecuteReader(CommandType.Text, SELECT_DEVICEByIP, parameters);

                if (!dataReader.HasRows)
                    return false;

                if (dataReader.Read())
                {
                    MySqlParameter[] parameter =
                    {
                        new MySqlParameter(PARAM_NETSTATE   , status),
                        new MySqlParameter(PARAM_IP         , ip)

                    };

                    return MySQLHelper.ExecuteNonQuery(CommandType.Text, UPDATE_DEVICE, parameter) != 0;

                }

                return false;

            }
            catch (Exception ex)
            {
                LoggerExtension.log(ex);
                return false;
            }            
		}       
    }
}
