using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class gateoption_gatedevice : BaseBLL.Entity.BaseByViewId
	{
		
		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.gateoption),foreignField="id")]
		public Nullable<System.Int32> gateoption_id
		{
			get;
			set;
		}
//
	// Genereted Property of gateoption_id
	//
	#region Referenced Property - gateoption
		BLL.Entity.XGate.gateoption _gateoption_gateoption_id;
		public BLL.Entity.XGate.gateoption gateoption_gateoption_id
		{
			get
			{
				if ((null == _gateoption_gateoption_id) && (gateoption_id.HasValue) && (AutoLoadForeignKeys))
					load_gateoption_gateoption_id ();
				return _gateoption_gateoption_id;
			}
			set
			{
				_gateoption_gateoption_id	= value;
			}
		}

		public void load_gateoption_gateoption_id ()
		{ 
			BLL.Entity.XGate.gateoption	entity;
			BLL.Logic.XGate.gateoption	logic;

			entity	= new BLL.Entity.XGate.gateoption () { id = gateoption_id.Value };
			logic	= new BLL.Logic.XGate.gateoption ("XGate");
			logic.read (entity);

			_gateoption_gateoption_id	= entity;
		}
	#endregion

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.gatedevice),foreignField="id")]
		public Nullable<System.Int32> gatedevice_id
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
				if ((null == _gatedevice_gatedevice_id) && (gatedevice_id.HasValue) && (AutoLoadForeignKeys))
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

			entity	= new BLL.Entity.XGate.gatedevice () { id = gatedevice_id.Value };
			logic	= new BLL.Logic.XGate.gatedevice ("XGate");
			logic.read (entity);

			_gatedevice_gatedevice_id	= entity;
		}
	#endregion
	}
}