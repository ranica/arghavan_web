using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Windows.Forms;

namespace TcpProject
{
	static class Program
	{
		/// <summary>
		/// The main entry point for the application.
		/// </summary>
		[STAThread]
		static void Main ()
		{
			prepare ();
			Application.EnableVisualStyles ();
			Application.SetCompatibleTextRenderingDefault (false);
			Application.Run (new Form1 ());
		}
		/// <summary>
		/// Prepare
		/// </summary>
		private static void prepare ()
		{		
			// Initilization
			Common.Initializer.init (Path.Combine (Application.StartupPath, "log.txt"));				
		}
	}
}
