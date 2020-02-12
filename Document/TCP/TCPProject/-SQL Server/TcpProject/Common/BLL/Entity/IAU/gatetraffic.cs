using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.IAU
{
	
	public class gatetraffic 
	{
		
		public System.Int32 user_id
		{
			get;
			set;
		}

		public Nullable<System.DateTime> gatedate
		{
			get;
			set;
		}

		public System.Int32 gatedevice_id
		{
			get;
			set;
		}

		public System.Int32 gatepass_id
		{
			get;
			set;
		}

		public System.Int32 gatedirect_id
		{
			get;
			set;
		}
		public System.Int32 gatemessage_id
		{
			get;
			set;
		}
		public Nullable<System.Int32> gateoperator_id
		{
			get;
			set;
		}
		public Nullable<System.DateTime> created_at
		{
			get;
			set;
		}
	}
}