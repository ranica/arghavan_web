using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;


namespace System
{
	public class EventLogHandler
	{
		private static FileStream fileStream;
		private static string root = Path.GetPathRoot (AppDomain.CurrentDomain.BaseDirectory);

		public static void CreateEventLog (string messageLog)
		{
			 bool exists = System.IO.Directory.Exists(@root + @"\Event");

            if (!exists)
                System.IO.Directory.CreateDirectory(@root + @"\Event");

			fileStream = OpenOrCreateLogFile("log");
            fileStream.Position = fileStream.Length + 1;
            var streamWriter = new StreamWriter(fileStream);
            streamWriter.WriteLine(messageLog + "\n");
            streamWriter.Flush();
            streamWriter.Close();
		}

		private static FileStream OpenOrCreateLogFile (string name)
		{
			//-HH-mm-ss-tt
			 var fs = new FileStream(String.Format(@root + @"\Event\{0:yyyy-MM-dd-HH-mm-ss} __{1}", DateTime.Now, name + ".txt"), FileMode.OpenOrCreate, FileAccess.ReadWrite);
            return fs;
		}
	}
}
