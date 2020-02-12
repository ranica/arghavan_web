using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class gatezone : BaseBLL.Entity.BaseByViewId
	{
		
		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public System.Int32 id
		{
			get;
			set;
		}
//
	// Genereted Property of gateoption
	//
	#region Relation - gateoption (Has-Many relation)
		private System.Data.DataTable _get_gateoption_genzonem_id;
		public System.Data.DataTable getgateoption_genzonem_id
		{
			get
			{
				if ((_get_gateoption_genzonem_id == null) && (AutoLoadForeignKeys))
					loadgateoption_genzonem_id ();

				return _get_gateoption_genzonem_id;
			}
			set
			{
				_get_gateoption_genzonem_id	= value;
			}
		}

		public void loadgateoption_genzonem_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gateoption	logic	= new BLL.Logic.XGate.gateoption ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("genzonem_id = @genzonem_id", "", false, true, new KeyValuePair ("@genzonem_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "genzonem_id = @genzonem_id", "", false, true, new KeyValuePair ("@genzonem_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gateoption_genzonem_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of gateoption
	//
	#region Relation - gateoption (Has-Many relation)
		private System.Data.DataTable _get_gateoption_genzonew_id;
		public System.Data.DataTable getgateoption_genzonew_id
		{
			get
			{
				if ((_get_gateoption_genzonew_id == null) && (AutoLoadForeignKeys))
					loadgateoption_genzonew_id ();

				return _get_gateoption_genzonew_id;
			}
			set
			{
				_get_gateoption_genzonew_id	= value;
			}
		}

		public void loadgateoption_genzonew_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gateoption	logic	= new BLL.Logic.XGate.gateoption ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("genzonew_id = @genzonew_id", "", false, true, new KeyValuePair ("@genzonew_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "genzonew_id = @genzonew_id", "", false, true, new KeyValuePair ("@genzonew_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gateoption_genzonew_id	= opResult.model as System.Data.DataTable;
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