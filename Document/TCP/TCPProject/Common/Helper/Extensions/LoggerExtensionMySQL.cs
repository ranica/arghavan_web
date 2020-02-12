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
    public static class LoggerExtensionMySQL
    {
        private static string root = Path.GetPathRoot(AppDomain.CurrentDomain.BaseDirectory);

        private const string C_spInsertLog = "spInsertLog";
        private const string PARAM_ERROR = "@P_ERROR";
        private const string PARAM_SOURCE = "@P_SOURCE";
        private const string PARAM_eInnerException = "@P_eINNEREXCEPTION";
        private const string PARAM_eStackTrace = "@P_eSTACKTRACE";
        private const string PARAM_eTargetSite = "@P_eTARGETSITE";
        private const string PARAM_eTargetSiteName = "@P_eTARGETSITENAME";
        private const string PARAM_eTargetSiteModule = "@P_eTARGETSITEMODULE";
       

      
        public static void log(this Exception e)
        {
            bool opResult = false;

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

            MySqlParameter[] parameters =
              {
                    new MySqlParameter(PARAM_ERROR                  , e.ToString()),
                    new MySqlParameter(PARAM_SOURCE                 , e.Source.ToString()),
                    new MySqlParameter(PARAM_eInnerException        , e.InnerException != null ? e.InnerException.ToString() : ""),
                    new MySqlParameter(PARAM_eStackTrace            , e.StackTrace),
                    new MySqlParameter(PARAM_eTargetSite            ,e.TargetSite),
                    new MySqlParameter(PARAM_eTargetSiteName        ,e.TargetSite.Name),
                    new MySqlParameter(PARAM_eTargetSiteModule      ,e.TargetSite.Module)
                   
                };

            opResult = MySQLHelper.ExecuteNonQuery(CommandType.StoredProcedure,C_spInsertLog, parameters) != 0;

            if (!opResult)
                File.WriteAllText(String.Format(@root + @"Logger\{0:yyyy-MM-dd-HH-mm-ss}_{1}", DateTime.Now, "output.txt"), s);
        }
    }
}
