using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Common.BLL.Entity.IAU
{
    public class gatedevice
    {
       
        public System.String name
        {
            get;
            set;
        }

        
        public System.String ip
        {
            get;
            set;
        }

        
        public System.Int32 type
        {
            get;
            set;
        }

        
        public Nullable<System.Byte> state
        {
            get;
            set;
        }

        
        public System.Int32 gategender_id
        {
            get;
            set;
        }
        public System.Int32 gatepass_id
        {
            get;
            set;
        }
        public System.Int32 zone_id
        {
            get;
            set;
        }
        
        public System.Int32 gatedirect_id
        {
            get;
            set;
        }
        
        public Nullable<System.Byte> netState
        {
            get;
            set;
        }

        
        public Nullable<System.Int32> timepass
        {
            get;
            set;
        }

        
        public Nullable<System.Int32> timeserver
        {
            get;
            set;
        }

        
        public Nullable<System.Int32> created_id
        {
            get;
            set;
        }
        public Nullable<System.DateTime> created_at
        {
            get;
            set;
        }

        
        public Nullable<System.Int32> updated_id
        {
            get;
            set;
        }
        public Nullable<System.DateTime> updated_at
        {
            get;
            set;
        }
    }
}
