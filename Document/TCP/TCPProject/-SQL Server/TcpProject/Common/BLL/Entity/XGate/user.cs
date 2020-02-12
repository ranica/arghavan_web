using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class user : BaseBLL.Entity.BaseByViewId
	{
		
//
	// Genereted Property of card
	//
	#region Relation - card (Has-Many relation)
		private System.Data.DataTable _get_card_user_id;
		public System.Data.DataTable getcard_user_id
		{
			get
			{
				if ((_get_card_user_id == null) && (AutoLoadForeignKeys))
					loadcard_user_id ();

				return _get_card_user_id;
			}
			set
			{
				_get_card_user_id	= value;
			}
		}

		public void loadcard_user_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.card	logic	= new BLL.Logic.XGate.card ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("user_id = @user_id", "", false, true, new KeyValuePair ("@user_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "user_id = @user_id", "", false, true, new KeyValuePair ("@user_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_card_user_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of gatetraffic
	//
	#region Relation - gatetraffic (Has-Many relation)
		private System.Data.DataTable _get_gatetraffic_user_id;
		public System.Data.DataTable getgatetraffic_user_id
		{
			get
			{
				if ((_get_gatetraffic_user_id == null) && (AutoLoadForeignKeys))
					loadgatetraffic_user_id ();

				return _get_gatetraffic_user_id;
			}
			set
			{
				_get_gatetraffic_user_id	= value;
			}
		}

		public void loadgatetraffic_user_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatetraffic	logic	= new BLL.Logic.XGate.gatetraffic ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("user_id = @user_id", "", false, true, new KeyValuePair ("@user_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "user_id = @user_id", "", false, true, new KeyValuePair ("@user_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatetraffic_user_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of staff
	//
	#region Relation - staff (Has-Many relation)
		private System.Data.DataTable _get_staff_user_id;
		public System.Data.DataTable getstaff_user_id
		{
			get
			{
				if ((_get_staff_user_id == null) && (AutoLoadForeignKeys))
					loadstaff_user_id ();

				return _get_staff_user_id;
			}
			set
			{
				_get_staff_user_id	= value;
			}
		}

		public void loadstaff_user_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.staff	logic	= new BLL.Logic.XGate.staff ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("user_id = @user_id", "", false, true, new KeyValuePair ("@user_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "user_id = @user_id", "", false, true, new KeyValuePair ("@user_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_staff_user_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of student
	//
	#region Relation - student (Has-Many relation)
		private System.Data.DataTable _get_student_id;
		public System.Data.DataTable getstudent_id
		{
			get
			{
				if ((_get_student_id == null) && (AutoLoadForeignKeys))
					loadstudent_id ();

				return _get_student_id;
			}
			set
			{
				_get_student_id	= value;
			}
		}

		public void loadstudent_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.student	logic	= new BLL.Logic.XGate.student ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("id = @id", "", false, true, new KeyValuePair ("@id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "id = @id", "", false, true, new KeyValuePair ("@id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_student_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of teacher
	//
	#region Relation - teacher (Has-Many relation)
		private System.Data.DataTable _get_teacher_user_id;
		public System.Data.DataTable getteacher_user_id
		{
			get
			{
				if ((_get_teacher_user_id == null) && (AutoLoadForeignKeys))
					loadteacher_user_id ();

				return _get_teacher_user_id;
			}
			set
			{
				_get_teacher_user_id	= value;
			}
		}

		public void loadteacher_user_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.teacher	logic	= new BLL.Logic.XGate.teacher ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("user_id = @user_id", "", false, true, new KeyValuePair ("@user_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "user_id = @user_id", "", false, true, new KeyValuePair ("@user_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_teacher_user_id	= opResult.model as System.Data.DataTable;
		}
	#endregion


		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=191)]
		public System.String name
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=191)]
		public System.String lastname
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=191)]
		public System.String code
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=191)]
		public System.String email
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=191)]
		public System.String username
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=191)]
		public System.String password
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.TinyInt,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public System.Byte state
		{
			get;
			set;
		}

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

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,foreignLogicType=typeof (BLL.Logic.XGate.person),foreignField="id")]
		public Nullable<System.Int32> people_id
		{
			get;
			set;
		}
//
	// Genereted Property of people_id
	//
	#region Referenced Property - person
		BLL.Entity.XGate.person _person_people_id;
		public BLL.Entity.XGate.person person_people_id
		{
			get
			{
				if ((null == _person_people_id) && (people_id.HasValue) && (AutoLoadForeignKeys))
					load_person_people_id ();
				return _person_people_id;
			}
			set
			{
				_person_people_id	= value;
			}
		}

		public void load_person_people_id ()
		{ 
			BLL.Entity.XGate.person	entity;
			BLL.Logic.XGate.person	logic;

			entity	= new BLL.Entity.XGate.person () { id = people_id.Value };
			logic	= new BLL.Logic.XGate.person ("XGate");
			logic.read (entity);

			_person_people_id	= entity;
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