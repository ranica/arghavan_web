using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Reader.Model
{
    public class LoginResponseModel
    {
        public LoginResponseData success
        {
            get;
            set;
        }
    }

    public class LoginResponseData
    {
        public string token
        {
            get;
            set;
        }
    }

}

