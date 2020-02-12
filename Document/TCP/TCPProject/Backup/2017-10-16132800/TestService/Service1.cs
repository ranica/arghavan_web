using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Diagnostics;
using System.Linq;
using System.ServiceProcess;
using System.Text;

namespace TestService
{
	public partial class Service1 : ServiceBase
	{

		/// Gate Event Source name 
        /// </summary>
		public const string C_GATE_EVENT_SOURCE	= "BioGateService";
		
		/// <summary>
        /// Gate Event Log name 
        /// </summary>
		public const string C_GATE_EVENT_LOG	= "BioGateServiceLog";
		private EventLog eventLog;
		public Service1 ()
		{
			InitializeComponent ();
			makeEventLog();
		}

		/// <summary>
		/// Make event log
		/// </summary>
		private void makeEventLog ()
		{
			try
			{
				eventLog		=	 new EventLog ();
				eventLog.Source =	C_GATE_EVENT_SOURCE;
				eventLog.Log    =	C_GATE_EVENT_LOG;

				if (!EventLog.Exists (C_GATE_EVENT_LOG))
					EventLog.CreateEventSource (C_GATE_EVENT_SOURCE, C_GATE_EVENT_LOG);
			}
			catch (Exception ex)
			{
				//MessageBox.Show (ex.Message);
			}
			
		}
		protected override void OnStart (string[] args)
		{
		}

		protected override void OnStop ()
		{
		}
	}
}
