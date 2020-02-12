using BaseDAL.Model;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Linq;
using System.Text;

namespace Common.Helper.Setting
{
	public class SettingHelper
	{
		#region Properties

		#endregion

		#region Methods
		/// <summary>
        /// Read Config data 
        /// </summary>
        /// <returns></returns>         
        public static ConnectionModel  readConfigData(string path)
        {
            Configuration config = ConfigurationManager.OpenExeConfiguration(path);
			ConnectionModel cmResult = new ConnectionModel ();
            string result = string.Empty;

            try
            {
                // key Decrypt = @90447B@Petrol

                cmResult.dataSource = ".";
                cmResult.initCatalog = "XGate";
                cmResult.userId = "admin";
                cmResult.password = "*54321*";
						 
                return cmResult;
            }

            catch (Exception ex)
            {
                LoggerExtension.log(ex);
                cmResult = null;
            }
            return cmResult;
        }

        /// <summary>
        /// Write Config Data
        /// </summary>
        /// <param name="value"></param>
        /// <returns></returns>
        public static bool writeConfigData (string path, string value)
        {
            bool result = false;
            Configuration config = ConfigurationManager.OpenExeConfiguration (path);
            try
            {
                config.AppSettings.Settings["ConnectionString"].Value = value;                
                config.Save(ConfigurationSaveMode.Full);
                result = true;
            }
            catch (Exception ex)
            {
                LoggerExtension.log(ex);
                result = false;
            }
            ConfigurationManager.RefreshSection("appSettings");
            return result;
        }
		#endregion
	}
}
