using BaseDAL.Model;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace TcpProject.Helper
{
    class TrafficStateValidate : Validator
    {
        public override int validate(DataRow baseRecord, 
                                     DataRow dataRecord, 
                                     Dictionary<string, object> criterial)
                                    
        {
            int result = -1, gender = -1, messageId = 0;

            int gender_id = Convert.ToInt32(dataRecord["gender_id"]);
            switch (gender_id)
            {
                case 1:
                    {
                        gender = Convert.ToInt32(baseRecord["genZoneMan"]);
                    }
                    break;

                case 2:
                    {
                        gender = Convert.ToInt32(baseRecord["genZoneWoman"]);
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
                        int state = (((dataRecord["direct_id"] as DBNull) != null) ? 0 : Convert.ToInt32((dataRecord["direct_id"])));
                        if ( 0 != state)
                        {
                            if (Convert.ToInt32(dataRecord["direct_id"]) == Convert.ToInt32(criterial["direct"])) //input or output
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
                        int state = (((dataRecord["direct_id"] as DBNull) != null) ? 0 : Convert.ToInt32((dataRecord["direct_id"])));
                        if (0 != state)
                        {
                            if (Convert.ToInt32(dataRecord["direct_id"]) == Convert.ToInt32(criterial["direct"])) //اگر دو تردد یکی است تردد ورود یا خروج را ثبت کن
                            {
                                messageId = 15;

                                int temp = Convert.ToInt32(criterial["direct"]);

                                if (temp == (int)Common.Enum.EDirection.input)
                                {
                                    criterial["direct"] = (int)Common.Enum.EDirection.output;
                                }
                                else
                                {
                                    criterial["direct"] = (int)Common.Enum.EDirection.input;
                                }

                                Common.BLL.Logic.IAU.gatetraffic lGateTraffic =
                                     new Common.BLL.Logic.IAU.gatetraffic();
                              
                                int opResult = lGateTraffic.RegisterTraffic(baseRecord, dataRecord, criterial, messageId);

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
                
                Common.BLL.Logic.IAU.gatetraffic lGateTraffic =
                    new Common.BLL.Logic.IAU.gatetraffic();

               
                int opResult = lGateTraffic.RegisterTraffic(baseRecord, dataRecord, criterial, messageId);

            }

            return result;
        }

    }
}
