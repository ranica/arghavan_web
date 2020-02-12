using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class city : BaseBLL.Entity.BaseByViewId
	{
		
		
//
	// Genereted Property of person
	//
	#region Relation - person (Has-Many relation)
		private System.Data.DataTable _get_person_city_id;
		public System.Data.DataTable getperson_city_id
		{
			get
			{
				if ((_get_person_city_id == null) && (AutoLoadForeignKeys))
					loadperson_city_id ();

				return _get_person_city_id;
			}
			set
			{
				_get_person_city_id	= value;
			}
		}

		public void loadperson_city_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.person	logic	= new BLL.Logic.XGate.person ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("city_id = @city_id", "", false, true, new KeyValuePair ("@city_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "city_id = @city_id", "", false, true, new KeyValuePair ("@city_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_person_city_id	= opResult.model as System.Data.DataTable;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=191)]
		public System.String name
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.province),foreignField="id")]
		public System.Int32 province_id
		{
			get;
			set;
		}
//
	// Genereted Property of province_id
	//
	#region Referenced Property - province
		BLL.Entity.XGate.province _province_province_id;
		public BLL.Entity.XGate.province province_province_id
		{
			get
			{
				if ((null == _province_province_id) && (AutoLoadForeignKeys))
					load_province_province_id ();
				return _province_province_id;
			}
			set
			{
				_province_province_id	= value;
			}
		}

		public void load_province_province_id ()
		{ 
			BLL.Entity.XGate.province	entity;
			BLL.Logic.XGate.province	logic;

			entity	= new BLL.Entity.XGate.province () { id = province_id };
			logic	= new BLL.Logic.XGate.province ("XGate");
			logic.read (entity);

			_province_province_id	= entity;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.DateTime,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.DateTime> created_at
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
		public Nullable<System.DateTime> updated_at
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
	}
}