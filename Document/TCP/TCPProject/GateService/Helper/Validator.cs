using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace GateService.Helper
{
    public abstract class Validator
    {
        protected Validator nextValidator;

        public void setValidator(Validator validator)
        {
            this.nextValidator = validator;
        }
        
        public abstract int validate (DataRow baseRecord, DataRow dataRecord, Dictionary<String, object> criterial);
    }
}
