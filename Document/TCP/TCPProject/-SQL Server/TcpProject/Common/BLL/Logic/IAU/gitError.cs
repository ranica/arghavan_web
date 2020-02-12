using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace Common.BLL.Logic.IAU
{
    public class gitError
    {
        private const string PARAM_ERROR = "@ERROR";
        private const string PARAM_IP = "@IP";
        private const string PARAM_CREATED_AT = "@CREATED_AT";
        private const string PARAM_UPDATED_AT = "@UPDATED_AT";

        private const string INSERT_ERROR = "INSERT INTO gate_errors  (error, ip, created_at, updated_at)  VALUES ("
                                                                           + PARAM_ERROR + ", "
                                                                           + PARAM_IP + ", "                                                                           
                                                                           + PARAM_CREATED_AT + ", "
                                                                           + PARAM_UPDATED_AT + ")";
        public static void saveErrorDevice(string ip, string error)
        {
            try
            {
                MySqlParameter[] parameters =
                 {
                    new MySqlParameter(PARAM_ERROR                  , error),
                    new MySqlParameter(PARAM_IP                     , ip),
                    new MySqlParameter(PARAM_CREATED_AT             ,DateTime.Now),
                    new MySqlParameter(PARAM_UPDATED_AT             ,DateTime.Now)
                };

                MySQLHelper.ExecuteNonQuery(CommandType.Text, INSERT_ERROR, parameters);
            }
            catch (Exception ex)
            {
                LoggerExtension.log(ex);
            }
            
        }
    }
}
