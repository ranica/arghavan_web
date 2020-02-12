using Common.Enum;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace GateService.Helper
{
    class UserStateValidator : Validator
    {
        public override int validate(DataRow baseRecord, DataRow dataRecord, Dictionary<string, object> criterial)
        {
           
            int result = -1;

            // Check criteria  User State

            if (Convert.ToByte((dataRecord["userState"])) == 1)
                result = 0;
            else
                result = (int)Common.Enum.EnumMessageType.deactivePerson;

            if (0 == result)
            {
                return (this.nextValidator.validate(baseRecord, dataRecord, criterial));
            }

            return result;
        }

    }
}
