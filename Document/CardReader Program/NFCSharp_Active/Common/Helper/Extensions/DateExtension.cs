using System;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Text;

namespace System
{
	/// <summary>
	/// Date Extension
	/// </summary>
	public static class DateExtension
	{
		#region Methods

		/// <summary>
		/// Check Birth Date
		/// </summary>
		/// <param name="data"></param>
		/// <param name="len"></param>
		/// <returns></returns>
		public static bool isBirthDate (this string data, int len = 0)
		{
			bool result = false;
			char[] delimiterChars = { '/' };          

            string[] myString = data.Split(delimiterChars);

			int year	= int.Parse(myString[0]);
			int month	= int.Parse(myString[1]);
			int day		= int.Parse(myString[2]);
			
			if (month > 0 && month < 13)
			{
				if (month > 0 && month < 7)
				{
					if (day > 0 && day < 32)
						result = true;						
				}
				else if (month > 6 && month < 13)
				{
					if (day > 0 && day < 31)
						result = true;						
				}
			}

			return result;
		}


		#endregion
	}
}
