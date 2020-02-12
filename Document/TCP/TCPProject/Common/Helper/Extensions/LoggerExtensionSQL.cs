using BaseDAL.Model;
using Common.BLL.Logic.IAU;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.IO;
using System.Linq;
using System.Text;

namespace System
{
    public static class LoggerExtensionSQL
    {
        private static string root = Path.GetPathRoot(AppDomain.CurrentDomain.BaseDirectory);

     

        /// <summary>
        /// Insert Log in DB
        /// </summary>
        /// <param name="e"></param>
        public static void logMain(this Exception e)
        {
           
            bool existFolder = System.IO.Directory.Exists(@root + @"\Logger");
            if (!existFolder)
                System.IO.Directory.CreateDirectory(@root + @"\Logger");

            string s = e.ToString() +
                       e.Source.ToString() + " \n\n " +
                      (e.InnerException != null ? e.InnerException.ToString() : "") + "  \n\n " +
                       e.StackTrace + " \n\n " +
                       e.TargetSite.Name + "\n\n " +
                       e.TargetSite.Module + "\n\n " +
                       e.TargetSite.ToString() + "\n\n" +
                       e.Data;

            Common.BLL.Entity.XGate.gateerror errorModel = new Common.BLL.Entity.XGate.gateerror()
            {
                error = e.ToString(),
                eSource = e.Source.ToString(),
                eInnerException = e.InnerException != null ? e.InnerException.ToString() : "",
                eStackTrace = e.StackTrace,
                eTargetSite = e.TargetSite.Name,
                eTargetSiteModule = e.TargetSite.Module.ToString(),
                eTargetSiteName = e.TargetSite.Name
            };

            Common.BLL.Logic.XGate.gateerror lGateError = 
                    new Common.BLL.Logic.XGate.gateerror(Common.Enum.EDatabase.xGate);
            CommandResult result =  lGateError.InsertLog(errorModel);

            
            if (result.status != BaseDAL.Base.EnumCommandStatus.success)
            {
                File.WriteAllText(String.Format(@root + @"Logger\{0:yyyy-MM-dd-HH-mm-ss}_{1}", DateTime.Now, "output.txt"), s);
            }
        }
    }
}
