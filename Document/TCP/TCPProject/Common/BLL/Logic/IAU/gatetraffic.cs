using System;
using BaseDAL.Model;
using System.Data;
using System.Collections.Generic;
using Common.Model;
using Common.Enum;
using MySql.Data.MySqlClient;

namespace Common.BLL.Logic.IAU
{
	public class gatetraffic 
	{
        #region Constants
        private const string C_spRegisterTraffic = "spRegisterTraffic";
        private const string C_spUpdateResponseTraffic = "spUpdateResponseTraffic";

        private const string PARAM_USER_ID = "@USER_ID";
        private const string PARAM_GATE_DATE = "@GATEDATE";
        private const string PARAM_GATE_DEVICE_ID = "@GATEDEVICE_ID";
        private const string PARAM_GATE_PASS_ID = "@GATEPASS_ID";
        private const string PARAM_GATE_DIRECT_ID = "@GATEDIRECT_ID";
        private const string PARAM_GATE_MESSAGE_ID = "@GATEMESSAGE_ID";
        private const string PARAM_GATE_OPERATOR_ID = "@GATEOPERATOR_ID";
        
        #endregion


        /// <summary>
        /// Registre Data to DB
        /// </summary>
        /// <param name="baseRecord"></param>
        /// <param name="dataRecord"></param>
        /// <param name="criterial"></param>
        /// <param name="message_id"></param>
        /// <returns></returns>
        public int RegisterTraffic(DataRow baseRecord, 
                                   int user_id, 
                                   Dictionary<string, object> criterial, 
                                   int message_id)
        {
            int result = -1;


            MySqlParameter[] parameters =
              {
                    new MySqlParameter(PARAM_USER_ID, user_id),
                    //new MySqlParameter(PARAM_GATE_DATE, DateTime.Now),
                    new MySqlParameter(PARAM_GATE_DEVICE_ID, baseRecord["gatedevice_id"]),
                    new MySqlParameter(PARAM_GATE_PASS_ID, baseRecord["gatepass_id"]),
                    new MySqlParameter(PARAM_GATE_DIRECT_ID, Convert.ToInt32(criterial["direct"])),
                    new MySqlParameter(PARAM_GATE_MESSAGE_ID, message_id),
                    new MySqlParameter(PARAM_GATE_OPERATOR_ID, Convert.ToInt32(criterial["serviceId"]))
                   
               };

            result = MySQLHelper.ExecuteNonQuery(CommandType.StoredProcedure, C_spRegisterTraffic, parameters);

            return result;
        }

             /// <summary>
            ///  Register Response 
            /// </summary>
            /// <param name="host">Ip Address </param>
            /// <param name="dicUser"> Data User </param>
            /// <param name="pass"> Pass done or don't done</param>
            /// <returns></returns>
            public bool UpdateResponseTraffic(string host, 
                                              Dictionary<string, UserFeature> dicUser, 
                                              bool pass)
            {
                      
                int message_id = 0;

                // ذخیره وضعیت تردد شخص
                if (pass)
                {
                    // شخص عبور کرد
                    message_id = (int)EnumMessageType.pass;
                }
                else
                {
                    // شخص عبور نکرد
                    message_id = (int)EnumMessageType.dontpass;
                }

                MySqlParameter[] parameters =
                    {
                        new MySqlParameter(PARAM_GATE_MESSAGE_ID ,message_id),
                        new MySqlParameter(PARAM_USER_ID  ,Convert.ToInt32(dicUser[host].user_id))
                    };

                 // UPDATE traffic
                 return MySQLHelper.ExecuteNonQuery(CommandType.StoredProcedure, 
                                                    C_spUpdateResponseTraffic, 
                                                    parameters) != 0;
                      
            }
        }
}