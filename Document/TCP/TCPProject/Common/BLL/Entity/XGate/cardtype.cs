using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class cardtype : BaseBLL.Entity.BaseByViewId
	{
		
//
	// Genereted Property of card
	//
	#region Relation - card (Has-Many relation)
		private System.Data.DataTable _get_card_cardtype_id;
		public System.Data.DataTable getcard_cardtype_id
		{
			get
			{
				if ((_get_card_cardtype_id == null) && (AutoLoadForeignKeys))
					loadcard_cardtype_id ();

				return _get_card_cardtype_id;
			}
			set
			{
				_get_card_cardtype_id	= value;
			}
		}

		public void loadcard_cardtype_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.card	logic	= new BLL.Logic.XGate.card ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("cardtype_id = @cardtype_id", "", false, true, new KeyValuePair ("@cardtype_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "cardtype_id = @cardtype_id", "", false, true, new KeyValuePair ("@cardtype_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_card_cardtype_id	= opResult.model as System.Data.DataTable;
		}
	#endregion

		
		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=191)]
		public System.String name
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.gateoperator),foreignField="id")]
		public Nullable<System.Int32> created_id
		{
			get;
			set;
		}
//
	// Genereted Property of created_id
	//
	#region Referenced Property - gateoperator
		BLL.Entity.XGate.gateoperator _gateoperator_created_id;
		public BLL.Entity.XGate.gateoperator gateoperator_created_id
		{
			get
			{
				if ((null == _gateoperator_created_id) && (created_id.HasValue) && (AutoLoadForeignKeys))
					load_gateoperator_created_id ();
				return _gateoperator_created_id;
			}
			set
			{
				_gateoperator_created_id	= value;
			}
		}

		public void load_gateoperator_created_id ()
		{ 
			BLL.Entity.XGate.gateoperator	entity;
			BLL.Logic.XGate.gateoperator	logic;

			entity	= new BLL.Entity.XGate.gateoperator () { id = created_id.Value };
			logic	= new BLL.Logic.XGate.gateoperator ("XGate");
			logic.read (entity);

			_gateoperator_created_id	= entity;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.DateTime,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.DateTime> created_at
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.gateoperator),foreignField="id")]
		public Nullable<System.Int32> updated_id
		{
			get;
			set;
		}
//
	// Genereted Property of updated_id
	//
	#region Referenced Property - gateoperator
		BLL.Entity.XGate.gateoperator _gateoperator_updated_id;
		public BLL.Entity.XGate.gateoperator gateoperator_updated_id
		{
			get
			{
				if ((null == _gateoperator_updated_id) && (updated_id.HasValue) && (AutoLoadForeignKeys))
					load_gateoperator_updated_id ();
				return _gateoperator_updated_id;
			}
			set
			{
				_gateoperator_updated_id	= value;
			}
		}

		public void load_gateoperator_updated_id ()
		{ 
			BLL.Entity.XGate.gateoperator	entity;
			BLL.Logic.XGate.gateoperator	logic;

			entity	= new BLL.Entity.XGate.gateoperator () { id = updated_id.Value };
			logic	= new BLL.Logic.XGate.gateoperator ("XGate");
			logic.read (entity);

			_gateoperator_updated_id	= entity;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.DateTime,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.DateTime> updated_at
		{
			get;
			set;
		}
	}
}