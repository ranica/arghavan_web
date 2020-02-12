using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace GateService.Helper
{
    class ZoneValidate : Validator
    {
        public override int validate(DataRow baseRecord, DataRow dataRecord, Dictionary<string, object> criterial)
        {
            int result = -1;

           //TODO: Zone?

            return result;
        }
    }
}
