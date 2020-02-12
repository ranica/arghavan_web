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
	public  class gitOption
	{
		 #region Variables
		 public static option _infoOption;
        private const string SELECT_OPTION = "SELECT * FROM gate_options LIMIT 1 ";
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
                option deviceInfos = new option();
                
                MySqlDataReader dataReader = MySQLHelper.ExecuteReader(CommandType.Text, SELECT_OPTION, null);			

                if (!dataReader.HasRows)
                    return null;

                if (dataReader.Read())
                {
                    deviceInfos.DatEndSuit =(DateTime)(dataReader["endDate"]);
                    deviceInfos.DatStartSuit = (DateTime)(dataReader["startDate"]);
                    deviceInfos.Emergency = (int)(dataReader["emergency"]);
                    deviceInfos.Genzoonw = Convert.ToInt16(dataReader["genzonew_id"]);
                    deviceInfos.Genzoonm = Convert.ToInt16(dataReader["genzonem_id"]);
                    deviceInfos.Port = Convert.ToInt16(dataReader["port"]);

                    return deviceInfos ?? null;
                } 
                              
				else 
					return null;
			}
			catch (Exception ex)
			{
                LoggerExtension.log(ex);
				return null;
			}
		}	
		#endregion
	
	}
}
