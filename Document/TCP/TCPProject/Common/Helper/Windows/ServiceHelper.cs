using System;
using System.Collections.Generic;
using System.Linq;
using System.ServiceProcess;
using System.Text;


namespace Common.Helper.Windows
{
	/// <summary>
	/// Windows Service Helper
	/// </summary>
	public class ServiceHelper
	{
		#region Properties
		#endregion

		#region Methods
		/// <summary>
		/// Get Service status
		/// </summary>
		/// <param name="serviceName"></param>
		/// <param name="machineName"></param>
		/// <returns></returns>
		public static ServiceControllerStatus serviceStatus (string serviceName, string machineName)
		{
			ServiceControllerStatus result;
			ServiceController sc;

			try
			{
				sc = new ServiceController (serviceName, machineName);
				result = sc.Status;
			}
			catch (Exception)
			{
				result = ServiceControllerStatus.Stopped;
			}

			return result;
		}

		/// <summary>
		/// Start service
		/// </summary>
		/// <param name="serviceName"></param>
		/// <param name="machineName"></param>
		/// <returns></returns>
		public static bool startService (string serviceName, string machineName)
		{
			bool result = false;
			ServiceController sc;


			try
			{
				sc = new ServiceController (serviceName, machineName);

				if ((sc.Status == ServiceControllerStatus.Running) || (sc.Status == ServiceControllerStatus.StartPending))
					result = true;
				else
					#region Try to start service
					try
					{
						sc.Start ();
						sc.WaitForStatus (ServiceControllerStatus.Running, new TimeSpan (0, 0, 10));

						result = (sc.Status == ServiceControllerStatus.Running);
					}
					catch (Exception)
					{
						result = false;
					}
					#endregion
			}
			catch (Exception)
			{
			}

			return result;
		}

		/// <summary>
		/// Stop service
		/// </summary>
		/// <param name="serviceName"></param>
		/// <param name="machineName"></param>
		/// <returns></returns>
		public static bool stopService (string serviceName, string machineName)
		{
			bool result = false;
			ServiceController sc;

			try
			{

				sc = new System.ServiceProcess.ServiceController (serviceName);
				try
				{
					sc.Stop ();
					sc.WaitForStatus (ServiceControllerStatus.Stopped);


					if (sc.Status.Equals (ServiceControllerStatus.Stopped))
					{

					}
				}
				catch (Exception)
				{

				}
				finally
				{
					sc.Close ();
				}


				sc = new ServiceController (serviceName, machineName);

				if ((sc.Status != ServiceControllerStatus.Running) && (sc.Status != ServiceControllerStatus.StartPending))
					result = true;
				else
					#region Try to stop service
					try
					{
						sc.Stop ();

						result = (sc.Status == ServiceControllerStatus.Stopped) || (sc.Status == ServiceControllerStatus.StopPending);
					}
					catch (Exception)
					{
						result = false;
					}
					#endregion
			}
			catch (Exception)
			{
				/// TODO : Log Error
			}

			return result;
		}
		#endregion
	}
}
