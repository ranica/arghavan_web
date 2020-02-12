using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace TcpProject.Helper
{
    class CardValidator : Validator
    {
        public override int validate(DataRow baseRecord, 
                                     DataRow dataRecord, 
                                     Dictionary<string, object> criterial)
                                     
        {
            int result = -1;

            if ( ((DateTime)dataRecord["cardEnd"]) >= DateTime.Now &&
               ( (DateTime)dataRecord["cardBegin"]) <= DateTime.Now)
                result = 0;
            else
                result = (int)Common.Enum.EnumMessageType.expairedCard; 

            if (0 == result)
            {
                return (this.nextValidator.validate(baseRecord, dataRecord, criterial));
            }
           
            return result;
        }
    }
}
