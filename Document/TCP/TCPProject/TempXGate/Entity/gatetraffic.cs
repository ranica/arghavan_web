using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class gatetraffic : BaseBLL.Entity.BaseByViewId
	{
		
		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public System.Int32 id
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.UniqueIdentifier,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.Guid> viewId
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.user),foreignField="id")]
		public System.Int32 user_id
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
				if ((null == _user_user_id) && (AutoLoadForeignKeys))
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

			entity	= new BLL.Entity.XGate.user () { id = user_id };
			logic	= new BLL.Logic.XGate.user ("XGate");
			logic.read (entity);

			_user_user_id	= entity;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.DateTime,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.DateTime> gatedate
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.gatedevice),foreignField="id")]
		public System.Int32 gatedevice_id
		{
			get;
			set;
		}
//
	// Genereted Property of gatedevice_id
	//
	#region Referenced Property - gatedevice
		BLL.Entity.XGate.gatedevice _gatedevice_gatedevice_id;
		public BLL.Entity.XGate.gatedevice gatedevice_gatedevice_id
		{
			get
			{
				if ((null == _gatedevice_gatedevice_id) && (AutoLoadForeignKeys))
					load_gatedevice_gatedevice_id ();
				return _gatedevice_gatedevice_id;
			}
			set
			{
				_gatedevice_gatedevice_id	= value;
			}
		}

		public void load_gatedevice_gatedevice_id ()
		{ 
			BLL.Entity.XGate.gatedevice	entity;
			BLL.Logic.XGate.gatedevice	logic;

			entity	= new BLL.Entity.XGate.gatedevice () { id = gatedevice_id };
			logic	= new BLL.Logic.XGate.gatedevice ("XGate");
			logic.read (entity);

			_gatedevice_gatedevice_id	= entity;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.gatepass),foreignField="id")]
		public System.Int32 gatepass_id
		{
			get;
			set;
		}
//
	// Genereted Property of gatepass_id
	//
	#region Referenced Property - gatepass
		BLL.Entity.XGate.gatepass _gatepass_gatepass_id;
		public BLL.Entity.XGate.gatepass gatepass_gatepass_id
		{
			get
			{
				if ((null == _gatepass_gatepass_id) && (AutoLoadForeignKeys))
					load_gatepass_gatepass_id ();
				return _gatepass_gatepass_id;
			}
			set
			{
				_gatepass_gatepass_id	= value;
			}
		}

		public void load_gatepass_gatepass_id ()
		{ 
			BLL.Entity.XGate.gatepass	entity;
			BLL.Logic.XGate.gatepass	logic;

			entity	= new BLL.Entity.XGate.gatepass () { id = gatepass_id };
			logic	= new BLL.Logic.XGate.gatepass ("XGate");
			logic.read (entity);

			_gatepass_gatepass_id	= entity;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.gatedirect),foreignField="id")]
		public System.Int32 gatedirect_id
		{
			get;
			set;
		}
//
	// Genereted Property of gatedirect_id
	//
	#region Referenced Property - gatedirect
		BLL.Entity.XGate.gatedirect _gatedirect_gatedirect_id;
		public BLL.Entity.XGate.gatedirect gatedirect_gatedirect_id
		{
			get
			{
				if ((null == _gatedirect_gatedirect_id) && (AutoLoadForeignKeys))
					load_gatedirect_gatedirect_id ();
				return _gatedirect_gatedirect_id;
			}
			set
			{
				_gatedirect_gatedirect_id	= value;
			}
		}

		public void load_gatedirect_gatedirect_id ()
		{ 
			BLL.Entity.XGate.gatedirect	entity;
			BLL.Logic.XGate.gatedirect	logic;

			entity	= new BLL.Entity.XGate.gatedirect () { id = gatedirect_id };
			logic	= new BLL.Logic.XGate.gatedirect ("XGate");
			logic.read (entity);

			_gatedirect_gatedirect_id	= entity;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.gatemessage),foreignField="id")]
		public System.Int32 gatemessage_id
		{
			get;
			set;
		}
//
	// Genereted Property of gatemessage_id
	//
	#region Referenced Property - gatemessage
		BLL.Entity.XGate.gatemessage _gatemessage_gatemessage_id;
		public BLL.Entity.XGate.gatemessage gatemessage_gatemessage_id
		{
			get
			{
				if ((null == _gatemessage_gatemessage_id) && (AutoLoadForeignKeys))
					load_gatemessage_gatemessage_id ();
				return _gatemessage_gatemessage_id;
			}
			set
			{
				_gatemessage_gatemessage_id	= value;
			}
		}

		public void load_gatemessage_gatemessage_id ()
		{ 
			BLL.Entity.XGate.gatemessage	entity;
			BLL.Logic.XGate.gatemessage	logic;

			entity	= new BLL.Entity.XGate.gatemessage () { id = gatemessage_id };
			logic	= new BLL.Logic.XGate.gatemessage ("XGate");
			logic.read (entity);

			_gatemessage_gatemessage_id	= entity;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.gateoperator),foreignField="id")]
		public Nullable<System.Int32> gateoperator_id
		{
			get;
			set;
		}
//
	// Genereted Property of gateoperator_id
	//
	#region Referenced Property - gateoperator
		BLL.Entity.XGate.gateoperator _gateoperator_gateoperator_id;
		public BLL.Entity.XGate.gateoperator gateoperator_gateoperator_id
		{
			get
			{
				if ((null == _gateoperator_gateoperator_id) && (gateoperator_id.HasValue) && (AutoLoadForeignKeys))
					load_gateoperator_gateoperator_id ();
				return _gateoperator_gateoperator_id;
			}
			set
			{
				_gateoperator_gateoperator_id	= value;
			}
		}

		public void load_gateoperator_gateoperator_id ()
		{ 
			BLL.Entity.XGate.gateoperator	entity;
			BLL.Logic.XGate.gateoperator	logic;

			entity	= new BLL.Entity.XGate.gateoperator () { id = gateoperator_id.Value };
			logic	= new BLL.Logic.XGate.gateoperator ("XGate");
			logic.read (entity);

			_gateoperator_gateoperator_id	= entity;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.DateTime,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.DateTime> created_at
		{
			get;
			set;
		}
	}
}