using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class group : BaseBLL.Entity.BaseByViewId
	{
		
//
	// Genereted Property of card
	//
	#region Relation - card (Has-Many relation)
		private System.Data.DataTable _get_card_group_id;
		public System.Data.DataTable getcard_group_id
		{
			get
			{
				if ((_get_card_group_id == null) && (AutoLoadForeignKeys))
					loadcard_group_id ();

				return _get_card_group_id;
			}
			set
			{
				_get_card_group_id	= value;
			}
		}

		public void loadcard_group_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.card	logic	= new BLL.Logic.XGate.card ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("group_id = @group_id", "", false, true, new KeyValuePair ("@group_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "group_id = @group_id", "", false, true, new KeyValuePair ("@group_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_card_group_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of user
	//
	#region Relation - user (Has-Many relation)
		private System.Data.DataTable _get_user_group_id;
		public System.Data.DataTable getuser_group_id
		{
			get
			{
				if ((_get_user_group_id == null) && (AutoLoadForeignKeys))
					loaduser_group_id ();

				return _get_user_group_id;
			}
			set
			{
				_get_user_group_id	= value;
			}
		}

		public void loaduser_group_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.user	logic	= new BLL.Logic.XGate.user ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("group_id = @group_id", "", false, true, new KeyValuePair ("@group_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "group_id = @group_id", "", false, true, new KeyValuePair ("@group_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_user_group_id	= opResult.model as System.Data.DataTable;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=191)]
		public System.String name
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.DateTime,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.DateTime> created_at
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.DateTime,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.DateTime> updated_at
		{
			get;
			set;
		}
	}
}