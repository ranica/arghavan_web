using Common.BLL.Entity.SQLIKIU;
using Common.BLL.Logic.DB;
using Common.Helper.Logger;
using Common.Model;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Diagnostics;
using System.Linq;
using System.Net;
using System.Text;


namespace Common.BLL.Logic.SQLIKIU
{
	public class gitDevice
	{

		#region Properties
		// Info IP , Direction : input or Output
		public static Dictionary<string, int> dicIpAddress = new Dictionary<string, int> ();
		// Public List Device
		public static List<device> lstDevice;
		public static List<device> _lstNull 
		{
			get; 
			set; 
		}
		public static device _deviceNull 
		{ 
			get; 
			set; 
		}
		#endregion

		/// <summary>
		/// Get Direction Device
		/// </summary>
		/// <param name="ip"></param>
		/// <returns></returns>
		/// 
		public static string getdirection (string ip)
		{
			string result = "";

			if (null != dicIpAddress)
			{
				var item	= dicIpAddress.First (kvp => kvp.Key == ip).Value;
				result		= item.ToString ();
			}

			return result;
		}

		/// <summary>
		/// Get Device 
		/// </summary>
		/// <param name="ip"></param>
		/// <returns></returns>
		public static device GetDevice (string ip)
		{
			try
			{
				device _info = new device ();
				if (lstDevice.Count > 0)
				{
					var _device = lstDevice.Where (r => r.Ip == ip).FirstOrDefault ();

					if (null != _device)
					{
						_info.Id		= _device.Id;
						_info.Name		= _device.Name;
						_info.Active	= _device.Active;
						_info.Gen		= _device.Gen;
						_info.Direction = _device.Direction;
						_info.Zoon		= _device.Zoon;

						return _info;
					}
					else
						return _deviceNull;
				}
				else
					return _deviceNull;


			}
			catch (Exception ex)
			{
				Logger.logger.log(CommandResult.makeErrorResult(ex.Message, ex));
				return _deviceNull;
			}
		}

		/// <summary>
		/// Get List Device
		/// </summary>
		/// <returns></returns>
		public static List<device> GetDevice ()
		{
			try
			{
				//var tcs = new TaskCompletionSource<DeviceInfo> ();
				
				dbIKIUDataContext db = new dbIKIUDataContext (ConfigurationManager.AppSettings["ConnectionString"].Trim ());				
				device _devinfo;
				List<device> _lstdevinfo = new List<device> ();
				var _lstdev = db.gitdevices.Where (r => r.active == true).ToList ();
				if (_lstdev.Count > 0)
				{
					foreach (var item in _lstdev)
					{
						_devinfo			= new device ();
						_devinfo.Id			= item.id;
						_devinfo.Name		= item.namedevice;
						_devinfo.Active		= item.active;
						_devinfo.Gen		= item.gen;
						_devinfo.Zoon		= item.zoon;
						_devinfo.Ip			= item.ipmain;
						_devinfo.Direction	= item.direction;

						_lstdevinfo.Add (_devinfo);
					}
					
					return _lstdevinfo;
				}
				else
				{					
					return _lstNull;
				}
			}
			catch (Exception ex)
			{				
				Logger.logger.log(CommandResult.makeErrorResult(ex.Message, ex));
				return _lstNull;
			}
		}

		/// <summary>
		/// Set status network Gate
		/// </summary>
		/// <param name="ip"></param>
		/// <param name="status"></param>
		public static void SetStatusConnection (string ip, bool status)
		{
			dbIKIUDataContext db = new dbIKIUDataContext (ConfigurationManager.AppSettings["ConnectionString"].Trim ());
			var device = db.gitdevices.Where (r => r.ipmain == ip).FirstOrDefault ();
				if (device != null)
			{				
				device.netStatus = status;
				db.SubmitChanges ();
			}
		}		
	}
}
