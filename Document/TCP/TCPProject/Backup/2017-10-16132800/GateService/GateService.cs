using GateService.Helper;
using Common.BLL.Logic.SQLIKIU;
using Common.Network.Core;
using System;
using System.Configuration;
using System.Data.SqlClient;
using System.Diagnostics;
using System.ServiceProcess;
using System.Threading;
using System.Text;
using System.Windows.Forms;
using System.IO;
using Common.Helper.Logger;
using Common.Model;


namespace GateService
{
	public partial class GateService : ServiceBase
	{
		#region Constants
		/// <summary>
        /// Gate Event Source name 
        /// </summary>
		public const string C_GATE_EVENT_SOURCE	= "BioGateService";
		
		/// <summary>
        /// Gate Event Log name 
        /// </summary>
		public const string C_GATE_EVENT_LOG	= "BioGateServiceLog";

		public const string C_CONF_FILENAME			= "";
		//private const int		C_BufferSize	= 1024;
		#endregion

		#region	Variables
		/// <summary>
        /// Event Log 
        /// </summary>
		private EventLog eventLog;
		private ManualResetEvent	mrs			= null;	
		private TimeSpan _readInterval;
		private GateClient		gClient			= null;
		private Thread			connectThread	= null, readGitOptionThread= null;
		private int prt;		
		#endregion

		#region Properties
		//public int clientCount
		//{ 
		//	get; 
		//	private set;
		//}

		/// <summary>
		/// Raed Interval
		/// </summary>		 
		public TimeSpan readInterval
		{
			get
			{
				if (null == _readInterval)
					_readInterval = new TimeSpan (0, 1, 0);

				return _readInterval;
			}
			set
			{
				_readInterval = value;
			}
		}
		#endregion

		#region Methods

		public GateService ()
		{
			InitializeComponent ();			

			init ();
		}

		/// <summary>
		/// Initialize 
		/// </summary>
		private void init ()
		{
			 prepare ();
		}

		/// <summary>
		/// Prepare
		/// </summary>
		private void prepare ()
		{
			mrs	= new ManualResetEvent (true);
			makeEventLog ();
			Common.Initializer.init (Path.Combine (Application.StartupPath, "log.txt"));	

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
				System.Windows.Forms.MessageBox.Show (ex.Message);
			}			
		}
		/// <summary>
        /// Write log 
        /// </summary>
        /// <param name="log"></param>
		private void writeLog (string log)
		{			
			if (null != eventLog)
			{
				log	+= "\r\n" + DateTime.Now.ToString ("yyyy/MM/dd HH:mm:ss");
				eventLog.WriteEntry (log);
				//EventLogHandler.CreateEventLog(log);
			}
		}
		/// <summary>
		/// On Start
		/// </summary>
		/// <param name="args"></param>
		protected override void OnStart (string[] args)
		{
			try
			{
				writeLog ("Service Starting . . .");
				//LoggerConnect.logger.log(CommandResult.makeSuccessResult("Service Starting . . ."));

				readInterval = new TimeSpan (0, 1, 0);				

				tryToConnect ();	
			}
			catch (Exception ex )
			{				
				//LoggerError.logger.log(CommandResult.makeErrorResult(ex.Message, "ERR: INVALID On Start"));
				writeLog ("ERR: INVALID On Start" + ex.Message.ToString() );
			}
				
		}
		/// <summary>
		/// Try To Connect
		/// </summary>
		private void tryToConnect ()
		{
			connectThread	= new Thread (new ThreadStart (connectToGate));
			connectThread.Start ();
		}
		/// <summary>
		/// Connect To Gate
		/// </summary>
		private void connectToGate ()
		{
			gitDevice.lstDevice		=	gitDevice.GetDevice ();
			
			if (null != gitDevice.lstDevice)			 
				writeLog ("INF: gitDevice.lstDevice ok");
			//writeLog ("ERR: gitDevice.lstDevice" + gitDevice.lstDevice.Count.ToString());
			gitOption._infoOption	=	gitOption.GetLastStateOfDeviceOption();
			if (gitOption._infoOption != null )
				writeLog ("INF: gitOption._infoOption ok");
			prt				    	=	(null != gitOption._infoOption)? gitOption._infoOption.Port : 1470;
			writeLog (prt .ToString());
			
			if (null != gitDevice.lstDevice)
			{ 
				foreach (var item in gitDevice.lstDevice)
				{
					gClient = new GateClient (item.Ip, prt, 1024);
					gClient.onConnect			+= TcpClient_onConnect;
					gClient.onDisconnect		+= TcpClient_onDisconnect;
					gClient.onError				+= TcpClient_onError;
					gClient.onReceiveData		+= TcpClient_onReceiveData;
					gClient.onSendData			+= TcpClient_onSendData;				
				
					gClient.connect ();				
				}	
				//LoggerConnect.logger.log(CommandResult.makeSuccessResult("INF: Service Started Successfully"));
				writeLog ("INF: Service Started Successfully");
				readGitOption();					
			}
			else 
				//LoggerError.logger.log(CommandResult.makeErrorResult("ERR: Service failed"));
				writeLog ("ERR: Service failed" );
		}

		/// <summary>
		/// On Connect
		/// </summary>
		/// <param name="sender"></param>
		private void TcpClient_onConnect (NetTcpClient sender)
		{
			//LoggerConnect.logger.log(CommandResult.makeSuccessResult("INF: "+ sender.host + "- > Connect"));
			writeLog("INF: "+ sender.host + "- > Connect");
			gitDevice.SetStatusConnection(sender.host,true);
		}

		/// <summary>
		/// On Receive Data
		/// </summary>
		/// <param name="sender"></param>
		/// <param name="data"></param>
		private void TcpClient_onReceiveData (NetTcpClient sender, Common.Model.CommandResult data)
		{
			//LoggerReceive.logger.log(CommandResult.makeSuccessResult("INF: " + sender.host+  "- > Receive: " + Encoding.UTF8.GetString(data.model as byte[])));
			writeLog("INF: " + sender.host+  "- > Receive: " + Encoding.UTF8.GetString(data.model as byte[]));
		}

		/// <summary>
		/// On Send Data
		/// </summary>
		/// <param name="sender"></param>
		/// <param name="data"></param>
		private void TcpClient_onSendData (NetTcpClient sender, Common.Model.CommandResult data)
		{
			writeLog("INF: " + sender.host+  "- > Send: " + Encoding.UTF8.GetString(data.model as byte[]));			
		}

		/// <summary>
		/// On Disconnect 
		/// </summary>
		/// <param name="sender"></param>
		private void TcpClient_onDisconnect (NetTcpClient sender)
		{	
			//LoggerConnect.logger.log(CommandResult.makeSuccessResult("INF: " + sender.host+  "- > DisConnect"));		
			writeLog("INF: " + sender.host+  "- > DisConnect");
			gitDevice.SetStatusConnection(sender.host,false);			
		}

		/// <summary>
		/// On Error
		/// </summary>
		/// <param name="sender"></param>
		/// <param name="data"></param>
		private void TcpClient_onError (NetTcpClient sender, Common.Model.CommandResult data)
		{
			//LoggerError.logger.log(CommandResult.makeErrorResult("ERR: " + sender.host+  "- > On Error: " + data.message));
			writeLog("ERR: " + sender.host+  "- > On Error: " + data.message);
			gitError.saveErrorDevice(sender.host,data.message);
		}

		/// <summary>
		/// On Stop
		/// </summary>
		protected override void OnStop ()
		{
			stop ();
		}
		/// <summary>
		/// Stop
		/// </summary>
		private void stop ()
		{
			foreach (var item in gitDevice.lstDevice)
			{					
				gClient = new GateClient (item.Ip, prt, 1024);				
				gClient.disconnect();	
				gitDevice.SetStatusConnection(item.Ip,false);					
			}	

			if (null != readGitOptionThread)
					readGitOptionThread.Abort();		
			//LoggerConnect.logger.log(CommandResult.makeSuccessResult("INF: Service Stopped successfully"));
			writeLog ("INF: Service Stopped successfully");				
		}

		/// <summary>
		/// Read gitOption
		/// </summary>
		private void readGitOption ()
		{
			readGitOptionThread = new Thread (new ThreadStart (() =>
			{
				try
				{
					while (true)
					{
						Thread.Sleep (_readInterval);						
						mrs.WaitOne ();
						gitOption._infoOption	=	gitOption.GetLastStateOfDeviceOption();
						//writeLog ("INF: Port: " + gitOption._infoOption.Port.ToString());
						if (readInterval != TimeSpan.Parse (ConfigurationManager.AppSettings["Interval"]))
							readInterval = TimeSpan.Parse (ConfigurationManager.AppSettings["Interval"]);						
					}
				}
				catch (Exception ex)
				{
					//LoggerError.logger.log(CommandResult.makeErrorResult("ERR: Thread read gitoption failed -> " , ex.Message));
					writeLog("ERR: Thread read gitoption failed -> " + ex.Message);
				}
			}));
			readGitOptionThread.Start ();
		}

		#endregion
	}
}
