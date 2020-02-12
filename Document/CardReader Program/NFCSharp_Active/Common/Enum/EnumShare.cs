using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Common.Enum
{
	/// <summary>
	/// SHARE mode enumeration
	/// </summary>
	public	enum EnumShare
	{
		/// <summary>
		/// This application is not willing to share this card with other applications.
		/// </summary>
		Exclusive = 1,	

		/// <summary>
		/// This application is willing to share this card with other applications.
		/// </summary>
		Shared,			

		/// <summary>
		/// This application demands direct control of the reader, so it is not available to other applications.
		/// </summary>
		Direct			
	}
}
