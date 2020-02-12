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
                // key Decrypt =@rira?2018

                cmResult.dataSource = config.AppSettings.Settings["54/b2xMEGtMDf4n6EENX6w=="].Value;
                cmResult.initCatalog = config.AppSettings.Settings["HV9qAxO0kfe5uUCsQvHJxA=="].Value;
                cmResult.userId = config.AppSettings.Settings["5B2JwtIHoug="].Value;
                cmResult.password = config.AppSettings.Settings["P4oIByzEdVs="].Value;

                return cmResult;
            }

            catch (Exception ex)
            {
                LoggerExtensionSQL.logMain(ex);
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
                LoggerExtensionSQL.logMain(ex);
                result = false;
            }
            ConfigurationManager.RefreshSection("appSettings");
            return result;
        }
		#endregion
	}
}
