using BaseDAL.Model;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace TcpProjectSQL.Helper
{
    class TrafficStateValidate : Validator
    {
        public override int validate(DataRow baseRecord, 
                                     DataRow dataRecord, 
                                     Dictionary<string, object> criterial)
                                    
        {
            int result = -1, gender = -1, messageId = 0;


            switch ((int)dataRecord["gender_id"])
            {
                case 1:
                    {
                        gender = (int)baseRecord["genZoneMan"];
                    }
                    break;

                case 2:
                    {
                        gender = (int)baseRecord["genZoneWoman"];
                    }
                    break;

                default:
                    break;
            }

            switch (gender)
            {
                // به تکرار تردد حساس نیست
                case 1:
                    {
                        result = 0;
                    }break;
                    // به تکرار تردد حساس است
                case 2:
                    {
                        int state = (((dataRecord["direct_id"] as DBNull) != null) ? 0 : (int)(dataRecord["direct_id"]));
                        if ( 0 != state)
                        {
                            if ((int)dataRecord["direct_id"] == (int)criterial["direct"]) //input or output
                            {
                                return this.nextValidator.validate(baseRecord, dataRecord, criterial);
                            }
                            else
                            {
                                result = 0;
                            }
                        }
                        else
                            result = 0;
                       
                    }break;
                    // تردد دوم اتوماتیک ثبت گردد
                case 3:
                    {
                        int state = (((dataRecord["direct_id"] as DBNull) != null) ? 0 : (int)(dataRecord["direct_id"]));
                        if (0 != state)
                        {
                            if ((int)dataRecord["direct_id"] == (int)criterial["direct"]) //اگر دو تردد یکی است تردد ورود یا خروج را ثبت کن
                            {
                                messageId = 15;

                                int temp = (int)criterial["direct"];

                                if (temp == (int)Common.Enum.EDirection.input)
                                {
                                    criterial["direct"] = (int)Common.Enum.EDirection.output;
                                }
                                else
                                {
                                    criterial["direct"] = (int)Common.Enum.EDirection.input;
                                }

                                Common.BLL.Logic.XGate.gatetraffic lGateTraffic =
                                     new Common.BLL.Logic.XGate.gatetraffic(Common.Enum.EDatabase.xGate);

                                CommandResult opResult = lGateTraffic.RegisterTraffic(baseRecord, Convert.ToInt16(dataRecord["user_id"]), criterial, messageId);

                                criterial["direct"] = temp;

                                result = 0;
                            }
                            else
                                result = 0;

                        }
                        else
                            result = 0;
                       

                    }break;
                default:
                    break;
            }

            if ( 0 == result)
            {
                messageId = 3; // شخص مجوز تردد دارد
                
                Common.BLL.Logic.XGate.gatetraffic lGateTraffic =
                    new Common.BLL.Logic.XGate.gatetraffic(Common.Enum.EDatabase.xGate);

                CommandResult opResult = lGateTraffic.RegisterTraffic(baseRecord, Convert.ToInt16(dataRecord["user_id"]), criterial, messageId);

            }

            return result;
        }

    }
}
