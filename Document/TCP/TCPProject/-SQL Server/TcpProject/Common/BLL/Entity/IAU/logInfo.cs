using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;


namespace Common.BLL.Entity.IAU
{
	public class logInfo
	{
		#region Fields


		private string _stu_id;
		private int _direction;
		private int _deviceid;
		private int _commentId;
		private string _pic;
		private string _name;
		#endregion

		#region Perporties


		public string Name
		{
			get { return _name; }
			set { _name = value; }
		}


		public string Picture
		{
			get { return _pic; }
			set { _pic = value; }
		}


		public int CommentId
		{
			get { return _commentId; }
			set { _commentId = value; }
		}


		public int DeviceId
		{
			get { return _deviceid; }
			set { _deviceid = value; }
		}


		public int Direction
		{
			get { return _direction; }
			set { _direction = value; }
		}


		public string Stu_id
		{
			get { return _stu_id; }
			set { _stu_id = value; }
		}
		#endregion		

	}
}
