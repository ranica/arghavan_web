using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;


namespace Common.BLL.Entity.SQLIKIU
{
  public  class option
    {
        #region Constractors

        //public DeviceOption(DateTime? datstartsuit, DateTime? datendsuit, int zoonpart, int emergency, string genzoon)
        //{
        //    _datEndSuit = datendsuit;
        //    _datStartSuit = datstartsuit;
        //    _zoonpart = zoonpart;
        //    _emergency = emergency;
        //    _genzoon = genzoon;
        //}

        #endregion

        #region Fields

        private DateTime?	_datStartSuit;
        private DateTime?	_datEndSuit;       
        private int			_emergency;
        private int			_genzoonw;
        private int			_genzoonm;
		private bool		_firstInOut;
		private int			_port;	
		

        #endregion


        #region Properties

		public int Port
		{
			get { return _port; }
			set { _port = value; }
		}
       public bool FirstInOut
		{
			get { return _firstInOut; }
			set { _firstInOut = value; }
		}
        public int Genzoonm
        {
            get { return _genzoonm; }
            set { _genzoonm = value; }
        }        
        public int Genzoonw
        {
            get { return _genzoonw; }
            set { _genzoonw = value; }
        }        
        public DateTime? DatEndSuit
        {
            get { return _datEndSuit; }
            set { _datEndSuit = value; }
        }

        public DateTime? DatStartSuit
        {
            get { return _datStartSuit; }
            set { _datStartSuit = value; }
        }

        public int Emergency
        {
            get { return _emergency; }
            set { _emergency = value; }
        }
        
        #endregion
      
    }
}
