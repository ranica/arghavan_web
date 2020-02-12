using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;


namespace Common.BLL.Entity.IAU
{
  public   class operatorInfo
    {
        #region Fields

        private int _id;
        private string _username;
        private string _password;
        private string _name;
        private string _family;
        private int? _timPic;
        private int? _countRecord;

        #endregion

        #region Properties
        public int Id
        {
            get { return _id; }
            set { _id = value; }
        }
        public int? CountRecord
        {
            get { return _countRecord; }
            set { _countRecord = value; }
        }

        public int? TimePic
        {
            get { return _timPic; }
            set { _timPic = value; }
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


        public string Password
        {
            get { return _password; }
            set { _password = value; }
        }


        public string Username
        {
            get { return _username; }
            set { _username = value; }
        }

        #endregion
       
        
    }
}
