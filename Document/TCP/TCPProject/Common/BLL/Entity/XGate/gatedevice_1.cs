using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{

	public class gatedevice_1 
	{

        #region Fields

        private System.String name;
        private System.String ip;
        private System.Int32 type;
        private Nullable<System.Byte> state;
        private System.Int32 gategender_id;
        private System.Int32 gatepass_id;
        private System.Int32 zone_id;
        private System.Int32 gatedirect_id;
        private Nullable<System.Byte> netSate;
        #endregion

        #region Properties
        public Nullable<System.Byte> NetState
        {
            get { return netSate; }
            set { netSate = value; }
        }


        public System.Int32 GateDirect_id
        {
            get { return gatedirect_id; }
            set { gatedirect_id = value; }
        }

        public System.Int32 Zone_id
        {
            get { return zone_id; }
            set { zone_id = value; }
        }


        public System.Int32 GatePass_id
        {
            get { return gatepass_id; }
            set { gatepass_id = value; }
        }

        public System.Int32 GateGender_id
        {
            get { return gategender_id; }
            set { gategender_id = value; }
        }

        public Nullable<System.Byte> State
        {
            get { return state; }
            set { state = value; }
        }

        public System.Int32 Type
        {
            get { return type; }
            set { type = value; }
        }

        public System.String Ip
        {
            get { return ip; }
            set { ip = value; }
        }

        public System.String Name
        {
            get { return name; }
            set { name = value; }
        }
        #endregion
    }
}