using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class card : BaseBLL.Entity.BaseByViewId
	{
		
		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=50)]
		public System.String cdn
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.Date,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.DateTime> startDate
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.Date,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.DateTime> endDate
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.TinyInt,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.Byte> state
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.cardtype),foreignField="id")]
		public Nullable<System.Int32> cardtype_id
		{
			get;
			set;
		}
//
	// Genereted Property of cardtype_id
	//
	#region Referenced Property - cardtype
		BLL.Entity.XGate.cardtype _cardtype_cardtype_id;
		public BLL.Entity.XGate.cardtype cardtype_cardtype_id
		{
			get
			{
				if ((null == _cardtype_cardtype_id) && (cardtype_id.HasValue) && (AutoLoadForeignKeys))
					load_cardtype_cardtype_id ();
				return _cardtype_cardtype_id;
			}
			set
			{
				_cardtype_cardtype_id	= value;
			}
		}

		public void load_cardtype_cardtype_id ()
		{ 
			BLL.Entity.XGate.cardtype	entity;
			BLL.Logic.XGate.cardtype	logic;

			entity	= new BLL.Entity.XGate.cardtype () { id = cardtype_id.Value };
			logic	= new BLL.Logic.XGate.cardtype ("XGate");
			logic.read (entity);

			_cardtype_cardtype_id	= entity;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.group),foreignField="id")]
		public System.Int32 group_id
		{
			get;
			set;
		}
//
	// Genereted Property of group_id
	//
	#region Referenced Property - group
		BLL.Entity.XGate.group _group_group_id;
		public BLL.Entity.XGate.group group_group_id
		{
			get
			{
				if ((null == _group_group_id) && (AutoLoadForeignKeys))
					load_group_group_id ();
				return _group_group_id;
			}
			set
			{
				_group_group_id	= value;
			}
		}

		public void load_group_group_id ()
		{ 
			BLL.Entity.XGate.group	entity;
			BLL.Logic.XGate.group	logic;

			entity	= new BLL.Entity.XGate.group () { id = group_id };
			logic	= new BLL.Logic.XGate.group ("XGate");
			logic.read (entity);

			_group_group_id	= entity;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.user),foreignField="id")]
		public Nullable<System.Int32> user_id
		{
			get;
			set;
		}
//
	// Genereted Property of user_id
	//
	#region Referenced Property - user
		BLL.Entity.XGate.user _user_user_id;
		public BLL.Entity.XGate.user user_user_id
		{
			get
			{
				if ((null == _user_user_id) && (user_id.HasValue) && (AutoLoadForeignKeys))
					load_user_user_id ();
				return _user_user_id;
			}
			set
			{
				_user_user_id	= value;
			}
		}

		public void load_user_user_id ()
		{ 
			BLL.Entity.XGate.user	entity;
			BLL.Logic.XGate.user	logic;

			entity	= new BLL.Entity.XGate.user () { id = user_id.Value };
			logic	= new BLL.Logic.XGate.user ("XGate");
			logic.read (entity);

			_user_user_id	= entity;
		}
	#endregion

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