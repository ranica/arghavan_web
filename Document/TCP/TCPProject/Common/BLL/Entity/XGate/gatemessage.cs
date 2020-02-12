using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class gatemessage : BaseBLL.Entity.BaseByViewId
	{
		
//
	// Genereted Property of gatetraffic
	//
	#region Relation - gatetraffic (Has-Many relation)
		private System.Data.DataTable _get_gatetraffic_gatemessage_id;
		public System.Data.DataTable getgatetraffic_gatemessage_id
		{
			get
			{
				if ((_get_gatetraffic_gatemessage_id == null) && (AutoLoadForeignKeys))
					loadgatetraffic_gatemessage_id ();

				return _get_gatetraffic_gatemessage_id;
			}
			set
			{
				_get_gatetraffic_gatemessage_id	= value;
			}
		}

		public void loadgatetraffic_gatemessage_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatetraffic	logic	= new BLL.Logic.XGate.gatetraffic ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("gatemessage_id = @gatemessage_id", "", false, true, new KeyValuePair ("@gatemessage_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "gatemessage_id = @gatemessage_id", "", false, true, new KeyValuePair ("@gatemessage_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatetraffic_gatemessage_id	= opResult.model as System.Data.DataTable;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Text,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=2147483647)]
		public System.String message
		{
			get;
			set;
		}
	}
}