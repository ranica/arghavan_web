using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace GateService.Helper
{
    class DuplicateValidate : Validator
    {
        public override int validate(DataRow baseRecord, DataRow dataRecord, Dictionary<string, object> criterial)
        {
            throw new NotImplementedException();
        }
    }
}
