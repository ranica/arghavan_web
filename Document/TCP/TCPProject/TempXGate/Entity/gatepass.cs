using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class gatepass : BaseBLL.Entity.BaseByViewId
	{
		
		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public System.Int32 id
		{
			get;
			set;
		}
//
	// Genereted Property of gatedevice
	//
	#region Relation - gatedevice (Has-Many relation)
		private System.Data.DataTable _get_gatedevice_gatepass_id;
		public System.Data.DataTable getgatedevice_gatepass_id
		{
			get
			{
				if ((_get_gatedevice_gatepass_id == null) && (AutoLoadForeignKeys))
					loadgatedevice_gatepass_id ();

				return _get_gatedevice_gatepass_id;
			}
			set
			{
				_get_gatedevice_gatepass_id	= value;
			}
		}

		public void loadgatedevice_gatepass_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatedevice	logic	= new BLL.Logic.XGate.gatedevice ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("gatepass_id = @gatepass_id", "", false, true, new KeyValuePair ("@gatepass_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "gatepass_id = @gatepass_id", "", false, true, new KeyValuePair ("@gatepass_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatedevice_gatepass_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of gatetraffic
	//
	#region Relation - gatetraffic (Has-Many relation)
		private System.Data.DataTable _get_gatetraffic_gatepass_id;
		public System.Data.DataTable getgatetraffic_gatepass_id
		{
			get
			{
				if ((_get_gatetraffic_gatepass_id == null) && (AutoLoadForeignKeys))
					loadgatetraffic_gatepass_id ();

				return _get_gatetraffic_gatepass_id;
			}
			set
			{
				_get_gatetraffic_gatepass_id	= value;
			}
		}

		public void loadgatetraffic_gatepass_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatetraffic	logic	= new BLL.Logic.XGate.gatetraffic ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("gatepass_id = @gatepass_id", "", false, true, new KeyValuePair ("@gatepass_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "gatepass_id = @gatepass_id", "", false, true, new KeyValuePair ("@gatepass_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatetraffic_gatepass_id	= opResult.model as System.Data.DataTable;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.UniqueIdentifier,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.Guid> viewId
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=191)]
		public System.String name
		{
			get;
			set;
		}
	}
}