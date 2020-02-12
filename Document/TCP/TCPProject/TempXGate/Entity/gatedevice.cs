using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class gatedevice : BaseBLL.Entity.BaseByViewId
	{
		
		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public System.Int32 id
		{
			get;
			set;
		}
//
	// Genereted Property of gatepermit
	//
	#region Relation - gatepermit (Has-Many relation)
		private System.Data.DataTable _get_gatepermit_device_id;
		public System.Data.DataTable getgatepermit_device_id
		{
			get
			{
				if ((_get_gatepermit_device_id == null) && (AutoLoadForeignKeys))
					loadgatepermit_device_id ();

				return _get_gatepermit_device_id;
			}
			set
			{
				_get_gatepermit_device_id	= value;
			}
		}

		public void loadgatepermit_device_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatepermit	logic	= new BLL.Logic.XGate.gatepermit ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("device_id = @device_id", "", false, true, new KeyValuePair ("@device_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "device_id = @device_id", "", false, true, new KeyValuePair ("@device_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatepermit_device_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of gatetraffic
	//
	#region Relation - gatetraffic (Has-Many relation)
		private System.Data.DataTable _get_gatetraffic_gatedevice_id;
		public System.Data.DataTable getgatetraffic_gatedevice_id
		{
			get
			{
				if ((_get_gatetraffic_gatedevice_id == null) && (AutoLoadForeignKeys))
					loadgatetraffic_gatedevice_id ();

				return _get_gatetraffic_gatedevice_id;
			}
			set
			{
				_get_gatetraffic_gatedevice_id	= value;
			}
		}

		public void loadgatetraffic_gatedevice_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatetraffic	logic	= new BLL.Logic.XGate.gatetraffic ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("gatedevice_id = @gatedevice_id", "", false, true, new KeyValuePair ("@gatedevice_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "gatedevice_id = @gatedevice_id", "", false, true, new KeyValuePair ("@gatedevice_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatetraffic_gatedevice_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of gateoption_gatedevice
	//
	#region Relation - gateoption_gatedevice (Has-Many relation)
		private System.Data.DataTable _get_gateoption_gatedevice_gatedevice_id;
		public System.Data.DataTable getgateoption_gatedevice_gatedevice_id
		{
			get
			{
				if ((_get_gateoption_gatedevice_gatedevice_id == null) && (AutoLoadForeignKeys))
					loadgateoption_gatedevice_gatedevice_id ();

				return _get_gateoption_gatedevice_gatedevice_id;
			}
			set
			{
				_get_gateoption_gatedevice_gatedevice_id	= value;
			}
		}

		public void loadgateoption_gatedevice_gatedevice_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gateoption_gatedevice	logic	= new BLL.Logic.XGate.gateoption_gatedevice ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("gatedevice_id = @gatedevice_id", "", false, true, new KeyValuePair ("@gatedevice_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "gatedevice_id = @gatedevice_id", "", false, true, new KeyValuePair ("@gatedevice_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gateoption_gatedevice_gatedevice_id	= opResult.model as System.Data.DataTable;
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

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=191)]
		public System.String ip
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

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.TinyInt,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.Byte> state
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.gategender),foreignField="id")]
		public System.Int32 gategender_id
		{
			get;
			set;
		}
//
	// Genereted Property of gategender_id
	//
	#region Referenced Property - gategender
		BLL.Entity.XGate.gategender _gategender_gategender_id;
		public BLL.Entity.XGate.gategender gategender_gategender_id
		{
			get
			{
				if ((null == _gategender_gategender_id) && (AutoLoadForeignKeys))
					load_gategender_gategender_id ();
				return _gategender_gategender_id;
			}
			set
			{
				_gategender_gategender_id	= value;
			}
		}

		public void load_gategender_gategender_id ()
		{ 
			BLL.Entity.XGate.gategender	entity;
			BLL.Logic.XGate.gategender	logic;

			entity	= new BLL.Entity.XGate.gategender () { id = gategender_id };
			logic	= new BLL.Logic.XGate.gategender ("XGate");
			logic.read (entity);

			_gategender_gategender_id	= entity;
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

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.zone),foreignField="id")]
		public System.Int32 zone_id
		{
			get;
			set;
		}
//
	// Genereted Property of zone_id
	//
	#region Referenced Property - zone
		BLL.Entity.XGate.zone _zone_zone_id;
		public BLL.Entity.XGate.zone zone_zone_id
		{
			get
			{
				if ((null == _zone_zone_id) && (AutoLoadForeignKeys))
					load_zone_zone_id ();
				return _zone_zone_id;
			}
			set
			{
				_zone_zone_id	= value;
			}
		}

		public void load_zone_zone_id ()
		{ 
			BLL.Entity.XGate.zone	entity;
			BLL.Logic.XGate.zone	logic;

			entity	= new BLL.Entity.XGate.zone () { id = zone_id };
			logic	= new BLL.Logic.XGate.zone ("XGate");
			logic.read (entity);

			_zone_zone_id	= entity;
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

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.TinyInt,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.Byte> netState
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.Int32> timepass
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.Int32> timeserver
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