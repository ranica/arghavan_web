using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace TcpProject.Helper
{
    class GenderValidate : Validator
    {
        public override int validate(DataRow baseRecord,
                                     DataRow dataRecord, 
                                     Dictionary<string, object> criterial)
                                     
        {
            int result = -1;

            int genderBase = Convert.ToInt32(baseRecord["gender_id"]);
            int genderId = Convert.ToInt32(dataRecord["gender_id"]);

            if ((genderBase == (int)Common.Enum.EGender.Both)
                || (genderBase == genderId ))
                result = 0;
            else
                result = (int)Common.Enum.EnumMessageType.gen;

            if (0 == result)
            {
                return this.nextValidator.validate(baseRecord, dataRecord, criterial);
            }


            return result;
        }
    }
}
