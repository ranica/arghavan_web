using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class gatedirect : BaseBLL.Entity.BaseByViewId
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
		private System.Data.DataTable _get_gatedevice_gatedirect_id;
		public System.Data.DataTable getgatedevice_gatedirect_id
		{
			get
			{
				if ((_get_gatedevice_gatedirect_id == null) && (AutoLoadForeignKeys))
					loadgatedevice_gatedirect_id ();

				return _get_gatedevice_gatedirect_id;
			}
			set
			{
				_get_gatedevice_gatedirect_id	= value;
			}
		}

		public void loadgatedevice_gatedirect_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatedevice	logic	= new BLL.Logic.XGate.gatedevice ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("gatedirect_id = @gatedirect_id", "", false, true, new KeyValuePair ("@gatedirect_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "gatedirect_id = @gatedirect_id", "", false, true, new KeyValuePair ("@gatedirect_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatedevice_gatedirect_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of gatetraffic
	//
	#region Relation - gatetraffic (Has-Many relation)
		private System.Data.DataTable _get_gatetraffic_gatedirect_id;
		public System.Data.DataTable getgatetraffic_gatedirect_id
		{
			get
			{
				if ((_get_gatetraffic_gatedirect_id == null) && (AutoLoadForeignKeys))
					loadgatetraffic_gatedirect_id ();

				return _get_gatetraffic_gatedirect_id;
			}
			set
			{
				_get_gatetraffic_gatedirect_id	= value;
			}
		}

		public void loadgatetraffic_gatedirect_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatetraffic	logic	= new BLL.Logic.XGate.gatetraffic ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("gatedirect_id = @gatedirect_id", "", false, true, new KeyValuePair ("@gatedirect_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "gatedirect_id = @gatedirect_id", "", false, true, new KeyValuePair ("@gatedirect_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatetraffic_gatedirect_id	= opResult.model as System.Data.DataTable;
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

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public System.Int32 type
		{
			get;
			set;
		}
	}
}