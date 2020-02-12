using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;

namespace System
{
    public static class LoggerExtensions
    {
        private static string root = Path.GetPathRoot(AppDomain.CurrentDomain.BaseDirectory);

        public static void log(this Exception e)
        {
            //bool opResult = false;

            bool existFolder = System.IO.Directory.Exists(@root + @"\Logger");
            if (!existFolder)
                System.IO.Directory.CreateDirectory(@root + @"\Logger");

            string s = e.ToString() +
                        e.Source.ToString() + "\n\n" +
                        (e.InnerException != null ? e.InnerException.ToString() : "") + "\n\n" +
                        e.StackTrace + "\n\n" +
                        e.TargetSite.Name + "\n\n" +
                        e.TargetSite.Module + "\n\n" +
                        e.TargetSite.ToString() + "\n\n" +
                        e.Data;

            File.WriteAllText(String.Format(@root + @"Logger\{0:yyyy-MM-dd-HH-mm-ss}_{1}", DateTime.Now, "output.txt"), s);
          
        }
    }
}
