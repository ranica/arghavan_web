using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Windows.Forms;

namespace TcpProjectSQL
{
    static class Program
    {
        /// <summary>
        /// The main entry point for the application.
        /// </summary>
        [STAThread]
        static void Main()
        {
           // new Helper.Test2();

            prepare();
            Application.EnableVisualStyles();
            Application.SetCompatibleTextRenderingDefault(false);
            Application.Run(new Form1());
        }

        private static void prepare()
        {
            // Initilization
            string exePath = System.Reflection.Assembly.GetExecutingAssembly().Location;
            Common.Initializer.init(Path.Combine(Application.StartupPath, "log.txt"), exePath);
        }
    }
}
