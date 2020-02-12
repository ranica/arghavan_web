using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Common.BLL.Entity.IAU
{
    public class studentInfo
    {
        #region Fields 
      
        private string _stu_id;
        private string _name;
        private string _family;
        private string _pic;
        private string _suit;
        private DateTime? enddat;
        #endregion

        #region Properties
        public DateTime? DataEnd
        {
            get { return enddat; }
            set { enddat = value; }
        }


        public string Suit
        {
            get { return _suit; }
            set { _suit = value; }
        }


        public string Picture
        {
            get { return _pic; }
            set { _pic = value; }
        }


        public string Family
        {
            get { return _family; }
            set { _family = value; }
        }


        public string Name
        {
            get { return _name; }
            set { _name = value; }
        }


        public string Stu_id
        {
            get { return _stu_id; }
            set { _stu_id = value; }
        }

        #endregion
	}
}
