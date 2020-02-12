using System;
using BaseDAL.Model;
using System.Data;
using System.Collections.Generic;
using Common.Model;
using Common.Enum;

namespace Common.BLL.Logic.XGate
{
	public class gatetraffic : BaseBLL.Logic.Base<BLL.Entity.XGate.gatetraffic>
	{
        #region Constants
        private const string C_spRegisterTraffic = "spRegisterTraffic";
        private const string C_spUpdateResponseTarffic = "spUpdateResponseTarffic";
        #endregion

        #region Method
        public gatetraffic(object type) : base(type)
        {
        }
        #endregion

        #region Custom Method
        /// <summary>
        /// Registre Data to DB
        /// </summary>
        /// <param name="baseRecord"></param>
        /// <param name="dataRecord"></param>
        /// <param name="criterial"></param>
        /// <param name="message_id"></param>
        /// <returns></returns>
        public CommandResult RegisterTraffic(DataRow baseRecord,
                                   int user_id,
                                   Dictionary<string, object> criterial,
                                   int message_id)
        { 
            CommandResult result = null;


            // Register new traffic
            result = BaseDAL.DBaseHelper.executeCommand(BaseDAL.Base.EnumExecuteType.procedureNonQuery,
                connection, C_spRegisterTraffic, true,

                new KeyValuePair("@user_id", user_id),
                new KeyValuePair("@gatedate", DateTime.Now),
                new KeyValuePair("@gatedevice_id", baseRecord["gatedevice_id"]),
                new KeyValuePair("@gatepass_id", baseRecord["gatepass_id"]),
                new KeyValuePair("@gatedirect_id", Convert.ToInt32(criterial["direct"])),
                new KeyValuePair("@gatemessage_id", message_id),
                //new KeyValuePair("@gateoperator_id", Convert.ToInt32("3")),
                new KeyValuePair("@gateoperator_id", Convert.ToInt32(criterial["serviceId"])),
                new KeyValuePair("@created_at", DateTime.Now)

                );
           

            return result;

        }

        /// <summary>
        ///  Register Response 
        /// </summary>
        /// <param name="host">Ip Address </param>
        /// <param name="dicUser"> Data User </param>
        /// <param name="pass"> Pass done or don't done</param>
        /// <returns></returns>
        public CommandResult UpdateResponseTraffic(string host, Dictionary<string, UserFeature> dicUser, bool pass)
        {
            CommandResult result = null;
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
            // Register new traffic
            result = BaseDAL.DBaseHelper.executeCommand(BaseDAL.Base.EnumExecuteType.procedureNonQuery,
                connection, C_spUpdateResponseTarffic, true,
                new KeyValuePair("@message_id", message_id),
                new KeyValuePair("@user_id", Convert.ToInt32(dicUser[host].user_id))
                );


            return result;
        }
        #endregion


    }
}