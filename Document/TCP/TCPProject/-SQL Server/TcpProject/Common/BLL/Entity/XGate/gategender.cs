using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class gategender : BaseBLL.Entity.BaseByViewId
	{
		
//
	// Genereted Property of gatedevice
	//
	#region Relation - gatedevice (Has-Many relation)
		private System.Data.DataTable _get_gatedevice_gategender_id;
		public System.Data.DataTable getgatedevice_gategender_id
		{
			get
			{
				if ((_get_gatedevice_gategender_id == null) && (AutoLoadForeignKeys))
					loadgatedevice_gategender_id ();

				return _get_gatedevice_gategender_id;
			}
			set
			{
				_get_gatedevice_gategender_id	= value;
			}
		}

		public void loadgatedevice_gategender_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatedevice	logic	= new BLL.Logic.XGate.gatedevice ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("gategender_id = @gategender_id", "", false, true, new KeyValuePair ("@gategender_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "gategender_id = @gategender_id", "", false, true, new KeyValuePair ("@gategender_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatedevice_gategender_id	= opResult.model as System.Data.DataTable;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=191)]
		public System.String gender
		{
			get;
			set;
		}
	}
}