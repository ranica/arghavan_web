using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;


namespace Common.BLL.Entity.IAU
{
    public class device
    {

        #region Fields

		private int _id;
        private string _ip;		
        private string _name;
        private bool?  _active;
        private int _zoon;
        private int? _dirction;
        private int? _gen;
        private bool _netstatus;
        private DateTime? _timresponse;	        
        
        #endregion

        #region Properties

		public int Id
		{
			get { return _id; }
			set { _id = value; }
		}
        public DateTime? TimeResponse
        {
            get { return _timresponse; }
            set { _timresponse = value; }
        }


        public bool NetStatus
        {
            get { return _netstatus; }
            set { _netstatus = value; }
        }
        public int? Gen
        {
            get { return _gen; }
            set { _gen = value; }
        }


        public int? Direction
        {
            get { return _dirction; }
            set { _dirction = value; }
        }


        public int Zoon
        {
            get { return _zoon; }
            set { _zoon = value; }
        }


        public bool? Active
        {
            get { return _active; }
            set { _active = value; }
        }
        public string Name
        {
            get { return _name; }
            set { _name = value; }
        }

        public string Ip
        {
            get { return _ip; }
            set { _ip = value; }
        }		

        #endregion
        

    }
}
