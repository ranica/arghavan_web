using Common.Model;
using Microsoft.Win32;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Common.Helper.Windows
{
	/// <summary>
	/// Registry Helper
	/// </summary>
	public class RegistryHelper
	{
		#region Methods
		/// <summary>
        /// Get a key value 
        /// </summary>
		public static void readValue (string key, string valueName, string defaultValue = "")
		{
			try
			{
				Registry.GetValue (key, valueName, defaultValue);
			}
			catch (Exception ex)
			{
				Common.Helper.Logger.Logger.logger.log (CommandResult.makeErrorResult (ex.Message, ex));
			}
		}

		/// <summary>
        /// Set a key value 
        /// </summary>
		public static void writeValue (string key, string valueName, string value)
		{
			try
			{
				Registry.SetValue (key, value, value);
			}
			catch (Exception ex)
			{
				Common.Helper.Logger.Logger.logger.log (CommandResult.makeErrorResult (ex.Message, ex));
			}
		}
		#endregion
	}
}
