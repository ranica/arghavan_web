using MySql.Data.MySqlClient;
using System;
using System.Data;


namespace Common.BLL.Logic.IAU
{
	public class gateoperator 
	{
        #region Constants
        
        private const string C_spGetUserGate = "spGetUserGate";
        private const string C_spInsertSevice = "spInsertService";
        private const string C_SERVICE_USER = "ServiceUser";
        private const string PARAM_USERNAME = "@P_USERNAME";
        private const string PARAM_PASSWORD = "@P_PASSWORD";
        private const string PARAM_NAME = "@P_NAME";
        private const string PARAM_LASTNAME = "@P_LASTNAME";
        
        #endregion

        #region Method

        /// <summary>
        /// get service user
        /// </summary>
        /// <param name="user">User Model</param>
        /// <returns></returns>
        public DataTable getServiceUser()
        {
            DataTable result = new DataTable();
          
            try
            {
                result = readGateOpearator();

                if (result.Rows.Count == 0)
                    result = createServiceUser();

                return result;
            }
            catch (Exception ex)
            {
                LoggerExtensionMySQL.log(ex);

                return null;

            }
        }

        /// <summary>
        /// Read User Gate 
        /// </summary>
        /// <returns></returns>
        private DataTable readGateOpearator()
        {
           //  MySqlDataReader dataReader = null;
            try
            {
                DataTable result = new DataTable();
               

                MySqlParameter[] parameters =
                {
                    new MySqlParameter(PARAM_USERNAME ,C_SERVICE_USER)
                };

                return MySQLHelper.ExecuteNonQueryTable(CommandType.StoredProcedure, C_spGetUserGate, parameters);

                
            }
            catch (Exception ex)
            {
                LoggerExtensionMySQL.log(ex);

                return null;
            }
           
        }

        /// <summary>
        /// Create service user
        /// </summary>
        /// <param name="user">User Model</param>
        /// <returns></returns>
        public DataTable createServiceUser()
        {
            DataTable result = new DataTable();

            try
            {
                MySqlParameter[] parameters =
                  {
                    new MySqlParameter(PARAM_USERNAME ,C_SERVICE_USER),
                    new MySqlParameter(PARAM_PASSWORD ,@"$3r\/Ic3U53R"),
                    new MySqlParameter(PARAM_NAME ,"Service"),
                    new MySqlParameter(PARAM_LASTNAME ,"")

               };


                int opResult = MySQLHelper.ExecuteNonQuery(CommandType.StoredProcedure, C_spInsertSevice, parameters);
                if (0 != opResult)
                {
                    result = readGateOpearator();
                }

                return result;
            }
            catch (Exception ex)
            {
                LoggerExtensionMySQL.log(ex);

                return null;
            }
            
        }

        #endregion
    }
}
