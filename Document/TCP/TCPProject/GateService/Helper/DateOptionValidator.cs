using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace GateService.Helper
{
    class DateOptionValidator : Validator
    {
        public override int validate(DataRow baseRecord, 
                                     DataRow dataRecord, 
                                     Dictionary<string, object> criterial)
                                    
        {
            int result = 0;

            // Check criteria  DateStart Option

            if (Convert.ToDateTime(baseRecord["optionEnd"]) >= DateTime.Now &&
                Convert.ToDateTime(baseRecord["optionStart"]) <= DateTime.Now)
                    result = 0;
            else
                result = Convert.ToInt16(Common.Enum.EnumMessageType.expairedDepartment); ;

            if (0 == result)
            {
                return (this.nextValidator.validate(baseRecord, dataRecord, criterial));
            }

            return result;
        }
    }
}

