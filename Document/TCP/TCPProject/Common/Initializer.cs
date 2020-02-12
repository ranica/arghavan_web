using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using Common.Helper.Logger;
using BaseDAL.Model;

namespace Common
{
	public class Initializer
	{
	
        /// <summary>
		/// Init
		/// </summary>
		public static void init(string loggerFilename, string exePath)
        {
            ConnectionModel res = Common.Helper.Setting.SettingHelper.readConfigData(exePath);
            ConnectionModel cm = new ConnectionModel()
            {
                dataSource = SSTCryptographer.Decrypt(res.dataSource.Trim(), "@rira?2018"),
                initCatalog = SSTCryptographer.Decrypt(res.initCatalog.Trim(), "@rira?2018"),
                userId = SSTCryptographer.Decrypt(res.userId.Trim(), "@rira?2018"),
                password = SSTCryptographer.Decrypt(res.password.Trim(), "@rira?2018"),


                //dataSource = res.dataSource,
                //initCatalog = res.initCatalog,
                //userId = res.userId,
                //password = res.password
            };

            Logger.logger = new Helper.Logger.Logger(loggerFilename);
            BaseDAL.Base.Connection.dataSources.Add(Common.Enum.EDatabase.xGate.ToString(), cm);
        }

    }
}
