using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Reader.Model
{
    public class SuccessModel
    {
        public SuccessModelData success
        {
            get;
            set;
        }
    }
    

    public class SuccessModelData
    {
        public string code
        {
            get;
            set;
        }

       
    }
}
