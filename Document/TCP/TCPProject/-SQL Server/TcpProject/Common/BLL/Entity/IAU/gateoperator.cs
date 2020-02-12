using System;
using System.Data;


namespace Common.BLL.Entity.IAU
{
	
	public class gateoperator : BaseBLL.Entity.BaseByViewId
	{
		public System.String username
		{
			get;
			set;
		}

		public System.String password
		{
			get;
			set;
		}

		public System.String name
		{
			get;
			set;
		}

		public System.String lastname
		{
			get;
			set;
		}

		
		public Nullable<System.Int32> timepic
		{
			get;
			set;
		}

		public Nullable<System.Int32> reccount
		{
			get;
			set;
		}

		
		public Nullable<System.DateTime> created_at
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