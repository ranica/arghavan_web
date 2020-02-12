using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.ServiceProcess;
using System.Text;
using System.Threading;
using System.Windows.Forms;

namespace GateService
{
	static class __Program
	{
		/// <summary>
		/// The main entry point for the application.
		/// </summary>
		static void Main ()
		{
            prepare();

			ServiceBase[] ServicesToRun;
			ServicesToRun = new ServiceBase[] 
            { 
                new GateService() 
            };
			ServiceBase.Run (ServicesToRun);
		}

        /// <summary>
		/// Prepare
		/// </summary>
		private static void prepare()
        {
            // Initilization
            string path = System.Reflection.Assembly.GetExecutingAssembly().Location;
            Common.Initializer.init(Path.Combine(Application.StartupPath, "log.txt"), path);

            // Add the event handler for handling UI thread exceptions to the event.
            Application.ThreadException += Application_ThreadException;

            // Set the unhandled exception mode to force all Windows Forms errors
            // to go through our handler.
            Application.SetUnhandledExceptionMode(UnhandledExceptionMode.CatchException);

            // Add the event handler for handling non-UI thread exceptions to the event. 
            AppDomain.CurrentDomain.UnhandledException += CurrentDomain_UnhandledException;
        }

        private static void CurrentDomain_UnhandledException(object sender, UnhandledExceptionEventArgs e)
        {
            (e.ExceptionObject as Exception).logMain();
        }

        private static void Application_ThreadException(object sender, ThreadExceptionEventArgs e)
        {
            e.Exception.logMain();
        }
    }

}
