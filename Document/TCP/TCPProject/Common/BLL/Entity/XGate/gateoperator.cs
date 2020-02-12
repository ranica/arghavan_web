using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class gateoperator : BaseBLL.Entity.BaseByViewId
	{
		
	
//
	// Genereted Property of person
	//
	#region Relation - person (Has-Many relation)
		private System.Data.DataTable _get_person_updated_id;
		public System.Data.DataTable getperson_updated_id
		{
			get
			{
				if ((_get_person_updated_id == null) && (AutoLoadForeignKeys))
					loadperson_updated_id ();

				return _get_person_updated_id;
			}
			set
			{
				_get_person_updated_id	= value;
			}
		}

		public void loadperson_updated_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.person	logic	= new BLL.Logic.XGate.person ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_person_updated_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of person
	//
	#region Relation - person (Has-Many relation)
		private System.Data.DataTable _get_person_created_id;
		public System.Data.DataTable getperson_created_id
		{
			get
			{
				if ((_get_person_created_id == null) && (AutoLoadForeignKeys))
					loadperson_created_id ();

				return _get_person_created_id;
			}
			set
			{
				_get_person_created_id	= value;
			}
		}

		public void loadperson_created_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.person	logic	= new BLL.Logic.XGate.person ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_person_created_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of zone
	//
	#region Relation - zone (Has-Many relation)
		private System.Data.DataTable _get_zone_created_id;
		public System.Data.DataTable getzone_created_id
		{
			get
			{
				if ((_get_zone_created_id == null) && (AutoLoadForeignKeys))
					loadzone_created_id ();

				return _get_zone_created_id;
			}
			set
			{
				_get_zone_created_id	= value;
			}
		}

		public void loadzone_created_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.zone	logic	= new BLL.Logic.XGate.zone ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_zone_created_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of zone
	//
	#region Relation - zone (Has-Many relation)
		private System.Data.DataTable _get_zone_updated_id;
		public System.Data.DataTable getzone_updated_id
		{
			get
			{
				if ((_get_zone_updated_id == null) && (AutoLoadForeignKeys))
					loadzone_updated_id ();

				return _get_zone_updated_id;
			}
			set
			{
				_get_zone_updated_id	= value;
			}
		}

		public void loadzone_updated_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.zone	logic	= new BLL.Logic.XGate.zone ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_zone_updated_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of user
	//
	#region Relation - user (Has-Many relation)
		private System.Data.DataTable _get_user_created_id;
		public System.Data.DataTable getuser_created_id
		{
			get
			{
				if ((_get_user_created_id == null) && (AutoLoadForeignKeys))
					loaduser_created_id ();

				return _get_user_created_id;
			}
			set
			{
				_get_user_created_id	= value;
			}
		}

		public void loaduser_created_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.user	logic	= new BLL.Logic.XGate.user ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_user_created_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of user
	//
	#region Relation - user (Has-Many relation)
		private System.Data.DataTable _get_user_updated_id;
		public System.Data.DataTable getuser_updated_id
		{
			get
			{
				if ((_get_user_updated_id == null) && (AutoLoadForeignKeys))
					loaduser_updated_id ();

				return _get_user_updated_id;
			}
			set
			{
				_get_user_updated_id	= value;
			}
		}

		public void loaduser_updated_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.user	logic	= new BLL.Logic.XGate.user ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_user_updated_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of teacher
	//
	#region Relation - teacher (Has-Many relation)
		private System.Data.DataTable _get_teacher_created_id;
		public System.Data.DataTable getteacher_created_id
		{
			get
			{
				if ((_get_teacher_created_id == null) && (AutoLoadForeignKeys))
					loadteacher_created_id ();

				return _get_teacher_created_id;
			}
			set
			{
				_get_teacher_created_id	= value;
			}
		}

		public void loadteacher_created_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.teacher	logic	= new BLL.Logic.XGate.teacher ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_teacher_created_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of teacher
	//
	#region Relation - teacher (Has-Many relation)
		private System.Data.DataTable _get_teacher_updated_id;
		public System.Data.DataTable getteacher_updated_id
		{
			get
			{
				if ((_get_teacher_updated_id == null) && (AutoLoadForeignKeys))
					loadteacher_updated_id ();

				return _get_teacher_updated_id;
			}
			set
			{
				_get_teacher_updated_id	= value;
			}
		}

		public void loadteacher_updated_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.teacher	logic	= new BLL.Logic.XGate.teacher ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_teacher_updated_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of student
	//
	#region Relation - student (Has-Many relation)
		private System.Data.DataTable _get_student_updated_id;
		public System.Data.DataTable getstudent_updated_id
		{
			get
			{
				if ((_get_student_updated_id == null) && (AutoLoadForeignKeys))
					loadstudent_updated_id ();

				return _get_student_updated_id;
			}
			set
			{
				_get_student_updated_id	= value;
			}
		}

		public void loadstudent_updated_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.student	logic	= new BLL.Logic.XGate.student ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_student_updated_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of student
	//
	#region Relation - student (Has-Many relation)
		private System.Data.DataTable _get_student_created_id;
		public System.Data.DataTable getstudent_created_id
		{
			get
			{
				if ((_get_student_created_id == null) && (AutoLoadForeignKeys))
					loadstudent_created_id ();

				return _get_student_created_id;
			}
			set
			{
				_get_student_created_id	= value;
			}
		}

		public void loadstudent_created_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.student	logic	= new BLL.Logic.XGate.student ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_student_created_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of staff
	//
	#region Relation - staff (Has-Many relation)
		private System.Data.DataTable _get_staff_created_id;
		public System.Data.DataTable getstaff_created_id
		{
			get
			{
				if ((_get_staff_created_id == null) && (AutoLoadForeignKeys))
					loadstaff_created_id ();

				return _get_staff_created_id;
			}
			set
			{
				_get_staff_created_id	= value;
			}
		}

		public void loadstaff_created_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.staff	logic	= new BLL.Logic.XGate.staff ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_staff_created_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of staff
	//
	#region Relation - staff (Has-Many relation)
		private System.Data.DataTable _get_staff_updated_id;
		public System.Data.DataTable getstaff_updated_id
		{
			get
			{
				if ((_get_staff_updated_id == null) && (AutoLoadForeignKeys))
					loadstaff_updated_id ();

				return _get_staff_updated_id;
			}
			set
			{
				_get_staff_updated_id	= value;
			}
		}

		public void loadstaff_updated_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.staff	logic	= new BLL.Logic.XGate.staff ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_staff_updated_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of province
	//
	#region Relation - province (Has-Many relation)
		private System.Data.DataTable _get_province_created_id;
		public System.Data.DataTable getprovince_created_id
		{
			get
			{
				if ((_get_province_created_id == null) && (AutoLoadForeignKeys))
					loadprovince_created_id ();

				return _get_province_created_id;
			}
			set
			{
				_get_province_created_id	= value;
			}
		}

		public void loadprovince_created_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.province	logic	= new BLL.Logic.XGate.province ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_province_created_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of province
	//
	#region Relation - province (Has-Many relation)
		private System.Data.DataTable _get_province_updated_id;
		public System.Data.DataTable getprovince_updated_id
		{
			get
			{
				if ((_get_province_updated_id == null) && (AutoLoadForeignKeys))
					loadprovince_updated_id ();

				return _get_province_updated_id;
			}
			set
			{
				_get_province_updated_id	= value;
			}
		}

		public void loadprovince_updated_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.province	logic	= new BLL.Logic.XGate.province ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_province_updated_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of gatepermit
	//
	#region Relation - gatepermit (Has-Many relation)
		private System.Data.DataTable _get_gatepermit_created_id;
		public System.Data.DataTable getgatepermit_created_id
		{
			get
			{
				if ((_get_gatepermit_created_id == null) && (AutoLoadForeignKeys))
					loadgatepermit_created_id ();

				return _get_gatepermit_created_id;
			}
			set
			{
				_get_gatepermit_created_id	= value;
			}
		}

		public void loadgatepermit_created_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatepermit	logic	= new BLL.Logic.XGate.gatepermit ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatepermit_created_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of gatepermit
	//
	#region Relation - gatepermit (Has-Many relation)
		private System.Data.DataTable _get_gatepermit_updated_id;
		public System.Data.DataTable getgatepermit_updated_id
		{
			get
			{
				if ((_get_gatepermit_updated_id == null) && (AutoLoadForeignKeys))
					loadgatepermit_updated_id ();

				return _get_gatepermit_updated_id;
			}
			set
			{
				_get_gatepermit_updated_id	= value;
			}
		}

		public void loadgatepermit_updated_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatepermit	logic	= new BLL.Logic.XGate.gatepermit ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatepermit_updated_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of gatepermit
	//
	#region Relation - gatepermit (Has-Many relation)
		private System.Data.DataTable _get_gatepermit_operator_id;
		public System.Data.DataTable getgatepermit_operator_id
		{
			get
			{
				if ((_get_gatepermit_operator_id == null) && (AutoLoadForeignKeys))
					loadgatepermit_operator_id ();

				return _get_gatepermit_operator_id;
			}
			set
			{
				_get_gatepermit_operator_id	= value;
			}
		}

		public void loadgatepermit_operator_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatepermit	logic	= new BLL.Logic.XGate.gatepermit ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("operator_id = @operator_id", "", false, true, new KeyValuePair ("@operator_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "operator_id = @operator_id", "", false, true, new KeyValuePair ("@operator_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatepermit_operator_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of gateoption
	//
	#region Relation - gateoption (Has-Many relation)
		private System.Data.DataTable _get_gateoption_created_id;
		public System.Data.DataTable getgateoption_created_id
		{
			get
			{
				if ((_get_gateoption_created_id == null) && (AutoLoadForeignKeys))
					loadgateoption_created_id ();

				return _get_gateoption_created_id;
			}
			set
			{
				_get_gateoption_created_id	= value;
			}
		}

		public void loadgateoption_created_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gateoption	logic	= new BLL.Logic.XGate.gateoption ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gateoption_created_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of gateoption
	//
	#region Relation - gateoption (Has-Many relation)
		private System.Data.DataTable _get_gateoption_updated_id;
		public System.Data.DataTable getgateoption_updated_id
		{
			get
			{
				if ((_get_gateoption_updated_id == null) && (AutoLoadForeignKeys))
					loadgateoption_updated_id ();

				return _get_gateoption_updated_id;
			}
			set
			{
				_get_gateoption_updated_id	= value;
			}
		}

		public void loadgateoption_updated_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gateoption	logic	= new BLL.Logic.XGate.gateoption ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gateoption_updated_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of gatedevice
	//
	#region Relation - gatedevice (Has-Many relation)
		private System.Data.DataTable _get_gatedevice_created_id;
		public System.Data.DataTable getgatedevice_created_id
		{
			get
			{
				if ((_get_gatedevice_created_id == null) && (AutoLoadForeignKeys))
					loadgatedevice_created_id ();

				return _get_gatedevice_created_id;
			}
			set
			{
				_get_gatedevice_created_id	= value;
			}
		}

		public void loadgatedevice_created_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatedevice	logic	= new BLL.Logic.XGate.gatedevice ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatedevice_created_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of gatedevice
	//
	#region Relation - gatedevice (Has-Many relation)
		private System.Data.DataTable _get_gatedevice_updated_id;
		public System.Data.DataTable getgatedevice_updated_id
		{
			get
			{
				if ((_get_gatedevice_updated_id == null) && (AutoLoadForeignKeys))
					loadgatedevice_updated_id ();

				return _get_gatedevice_updated_id;
			}
			set
			{
				_get_gatedevice_updated_id	= value;
			}
		}

		public void loadgatedevice_updated_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatedevice	logic	= new BLL.Logic.XGate.gatedevice ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatedevice_updated_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of city
	//
	#region Relation - city (Has-Many relation)
		private System.Data.DataTable _get_city_created_id;
		public System.Data.DataTable getcity_created_id
		{
			get
			{
				if ((_get_city_created_id == null) && (AutoLoadForeignKeys))
					loadcity_created_id ();

				return _get_city_created_id;
			}
			set
			{
				_get_city_created_id	= value;
			}
		}

		public void loadcity_created_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.city	logic	= new BLL.Logic.XGate.city ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_city_created_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of city
	//
	#region Relation - city (Has-Many relation)
		private System.Data.DataTable _get_city_updated_id;
		public System.Data.DataTable getcity_updated_id
		{
			get
			{
				if ((_get_city_updated_id == null) && (AutoLoadForeignKeys))
					loadcity_updated_id ();

				return _get_city_updated_id;
			}
			set
			{
				_get_city_updated_id	= value;
			}
		}

		public void loadcity_updated_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.city	logic	= new BLL.Logic.XGate.city ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_city_updated_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of cardtype
	//
	#region Relation - cardtype (Has-Many relation)
		private System.Data.DataTable _get_cardtype_created_id;
		public System.Data.DataTable getcardtype_created_id
		{
			get
			{
				if ((_get_cardtype_created_id == null) && (AutoLoadForeignKeys))
					loadcardtype_created_id ();

				return _get_cardtype_created_id;
			}
			set
			{
				_get_cardtype_created_id	= value;
			}
		}

		public void loadcardtype_created_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.cardtype	logic	= new BLL.Logic.XGate.cardtype ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_cardtype_created_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of cardtype
	//
	#region Relation - cardtype (Has-Many relation)
		private System.Data.DataTable _get_cardtype_updated_id;
		public System.Data.DataTable getcardtype_updated_id
		{
			get
			{
				if ((_get_cardtype_updated_id == null) && (AutoLoadForeignKeys))
					loadcardtype_updated_id ();

				return _get_cardtype_updated_id;
			}
			set
			{
				_get_cardtype_updated_id	= value;
			}
		}

		public void loadcardtype_updated_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.cardtype	logic	= new BLL.Logic.XGate.cardtype ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_cardtype_updated_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of card
	//
	#region Relation - card (Has-Many relation)
		private System.Data.DataTable _get_card_created_id;
		public System.Data.DataTable getcard_created_id
		{
			get
			{
				if ((_get_card_created_id == null) && (AutoLoadForeignKeys))
					loadcard_created_id ();

				return _get_card_created_id;
			}
			set
			{
				_get_card_created_id	= value;
			}
		}

		public void loadcard_created_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.card	logic	= new BLL.Logic.XGate.card ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "created_id = @created_id", "", false, true, new KeyValuePair ("@created_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_card_created_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of card
	//
	#region Relation - card (Has-Many relation)
		private System.Data.DataTable _get_card_updated_id;
		public System.Data.DataTable getcard_updated_id
		{
			get
			{
				if ((_get_card_updated_id == null) && (AutoLoadForeignKeys))
					loadcard_updated_id ();

				return _get_card_updated_id;
			}
			set
			{
				_get_card_updated_id	= value;
			}
		}

		public void loadcard_updated_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.card	logic	= new BLL.Logic.XGate.card ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "updated_id = @updated_id", "", false, true, new KeyValuePair ("@updated_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_card_updated_id	= opResult.model as System.Data.DataTable;
		}
	#endregion
//
	// Genereted Property of gatetraffic
	//
	#region Relation - gatetraffic (Has-Many relation)
		private System.Data.DataTable _get_gatetraffic_id;
		public System.Data.DataTable getgatetraffic_id
		{
			get
			{
				if ((_get_gatetraffic_id == null) && (AutoLoadForeignKeys))
					loadgatetraffic_id ();

				return _get_gatetraffic_id;
			}
			set
			{
				_get_gatetraffic_id	= value;
			}
		}

		public void loadgatetraffic_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.gatetraffic	logic	= new BLL.Logic.XGate.gatetraffic ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("id = @id", "", false, true, new KeyValuePair ("@id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "id = @id", "", false, true, new KeyValuePair ("@id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_gatetraffic_id	= opResult.model as System.Data.DataTable;
		}
	#endregion

		

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=191)]
		public System.String username
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.VarChar,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create,size=191)]
		public System.String password
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
		public System.String lastname
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.Int32> timepic
		{
			get;
			set;
		}

		[BaseBLL.Base.Field(nullable=true,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public Nullable<System.Int32> reccount
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