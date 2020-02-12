using BaseDAL.Model;
using Common.Model;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace Common.Helper.Logger
{/// <summary>
	/// Logger
	/// </summary>
	public class Logger
	{
		#region Properties
		/// <summary>
		/// Static logger
		/// </summary>
		public static Logger logger
		{
			get;
			set;
		}
		
		/// <summary>
		/// FileStream
		/// </summary>
		private FileStream	fileStream
		{
			get;
			set;
		}
		#endregion

		#region Variables
		private object writerObject;
		#endregion

		#region Methods
		/// <summary>
		/// Constructor
		/// </summary>
		/// <param name="filename"></param>
		/// 
		
		public Logger (string filename)
		{
			try
			{
				fileStream	= File.Open (filename, FileMode.OpenOrCreate, FileAccess.Write, FileShare.ReadWrite);
			}
			catch (Exception ex)
			{
				MessageBox.Show ("FATAL ERROR : \r\n" + ex.Message, "ERROR!", MessageBoxButtons.OK, MessageBoxIcon.Error);
			}
		}
		~Logger ()
		{
			if (null != fileStream)
				try
				{
					fileStream.Close ();
				}
				catch
				{
				}
		}

		/// <summary>
		/// Log data
		/// </summary>
		/// <param name="data"></param>
		public void log (CommandResult data)
		{
			try
			{
				byte[] bytes;

				data.message		= string.Format ("\r\n{0}\r\n{1}", DateTime.Now, data.message??"");
				bytes			= data.message.getBytes ();
				fileStream.BeginWrite (bytes, 0, bytes.Length, writerCallBack, writerObject);
			}
			catch (Exception ex)
			{
			}
		}

		/// <summary>
		/// Writer Callback
		/// </summary>
		/// <param name="ar"></param>
		private void writerCallBack (IAsyncResult ar)
		{
			try
			{
				fileStream.EndWrite (ar);
			}
			catch (Exception ex)
			{
			}
		}
		#endregion
	}
}
