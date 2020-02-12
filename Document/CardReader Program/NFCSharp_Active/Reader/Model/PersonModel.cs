using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Reader.Model
{

    public class PersonModel
    {
        public PersonResponseData[] success
        {
            get;
            set;
        }
    }

    public class PersonResponseData
    {
        public string people_name
        {
            get;
            set;
        }

        public string people_lastname
        {
            get;
            set;
        }
        public string people_nationalId
        {
            get;
            set;
        }
        public string user_code
        {
            get;
            set;
        }

        public int user_id
        {
            get;
            set;
        }

        public int user_state
        {
            get;
            set;
        }

       
        public string card_cdn
        {
            get;
            set;
        }

        public int card_type_id
        {
            get;
            set;
        }

        public int card_state
        {
            get;
            set;
        }
        public DateTime card_endDate
        {
            get;
            set;
        }

        public int group_id
        {
            get;
            set;
        }

    }
}
