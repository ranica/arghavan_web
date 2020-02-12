using System;
using System.Data;
using BaseDAL.Model;

namespace Common.BLL.Entity.XGate
{
	[Serializable]
	public class gender : BaseBLL.Entity.BaseByViewId
	{
		
		[BaseBLL.Base.Field(nullable=false,sqlDBType=System.Data.SqlDbType.Int,primary=false,usage=BaseBLL.Base.EnumUsage.read | BaseBLL.Base.EnumUsage.update | BaseBLL.Base.EnumUsage.create)]
		public System.Int32 id
		{
			get;
			set;
		}
//
	// Genereted Property of person
	//
	#region Relation - person (Has-Many relation)
		private System.Data.DataTable _get_person_gender_id;
		public System.Data.DataTable getperson_gender_id
		{
			get
			{
				if ((_get_person_gender_id == null) && (AutoLoadForeignKeys))
					loadperson_gender_id ();

				return _get_person_gender_id;
			}
			set
			{
				_get_person_gender_id	= value;
			}
		}

		public void loadperson_gender_id (int pageIndex = -1, int pageSize = 100)
		{
			CommandResult	opResult;

			BLL.Logic.XGate.person	logic	= new BLL.Logic.XGate.person ("XGate");
			if (pageIndex == -1)
				opResult	= logic.allData ("gender_id = @gender_id", "", false, true, new KeyValuePair ("@gender_id", id));
			else
				opResult	= logic.allByPaging ( pageIndex, pageSize, "gender_id = @gender_id", "", false, true, new KeyValuePair ("@gender_id", id));

			if (opResult.status == BaseDAL.Base.EnumCommandStatus.success)
				_get_person_gender_id	= opResult.model as System.Data.DataTable;
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