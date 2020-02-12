using BaseDAL.Model;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace TcpProject.Helper
{
    class TrafficValidate : Validator
    {
        public override int validate(DataRow baseRecord, 
                                     DataRow dataRecord, 
                                     Dictionary<string, object> criterial)
        {
            int result = -1;
            int messageId = Convert.ToInt32(dataRecord["message_id"]);
            switch (messageId)
            {
                case 2:
                //case 3:
                case 14:
               // case 16:
                case 15: result = 0; break;

                case 1: 
                case 4: result = (int)Common.Enum.EnumMessageType.existPass; break;
                case 3: result = (int)Common.Enum.EnumMessageType.duplicatPass; break;
                //case 5: result = (int)Common.Enum.EnumMessageType.zone; break;
                // case 6: result = (int)Common.Enum.EnumMessageType.gen; break;
                //case 7: result = (int)Common.Enum.EnumMessageType.deaciveDevice; break;
                //case 8: result = (int)Common.Enum.EnumMessageType.deactivePerson; break;
                //case 9: result = (int)Common.Enum.EnumMessageType.expairedCard; break;
                //case 10:result = (int)Common.Enum.EnumMessageType.expairedDepartment; break;
               // case 11: 

            }
            if (0 == result)
            {
                messageId = 3;


                Common.BLL.Logic.IAU.gatetraffic lGateTraffic =
                    new Common.BLL.Logic.IAU.gatetraffic();

                int opResult = lGateTraffic.RegisterTraffic(baseRecord, dataRecord, criterial, messageId);

            }

            return result;
        }

        
        /// <summary>
        /// Register Data in DB
        /// </summary>
        /// <param name="baseRecord"></param>
        /// <param name="dataRecord"></param>
        /// <param name="criterial"></param>
        /// <param name="message_id"></param>
        /// <returns></returns>

        public bool RegisterTraffic(DataRow baseRecord,
                                     DataRow dataRecord,
                                     Dictionary<string, object> criterial,
                                     int message_id)
        {
            bool result = false;

            Common.BLL.Logic.IAU.gatetraffic lGateTraffic =
                    new Common.BLL.Logic.IAU.gatetraffic();

            int opResult = lGateTraffic.RegisterTraffic(baseRecord, dataRecord, criterial, message_id);

            if (0 == opResult)
            {
                result = true;
            }

            return result;
        }


    }
}
