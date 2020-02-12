using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using Common.Helper.Logger;

namespace Common
{
	public class Initializer
	{
		/// <summary>
		/// Init
		/// </summary>
		public static void init (string loggerFilename)
		{
			Logger.logger	= new Helper.Logger.Logger(loggerFilename);				
		}
		
	}
}
