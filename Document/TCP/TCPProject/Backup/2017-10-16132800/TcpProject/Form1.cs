using Common.Network.Core;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading;
using System.Windows.Forms;
using TcpProject.Helper;
using Common.BLL.Logic.SQLIKIU;

using Common.BLL.Entity.SQLIKIU;
using Common.Model;
using Common.Enum;
using System.Diagnostics;
using System.Configuration;



namespace TcpProject
{
	public partial class Form1 : Form
	{
		public Form1 ()
		{
			InitializeComponent ();
			//makeEventLog ();

			//NetTcpClient t	= new NetTcpClient ("192.168.0.2", 1470, 1024);
			//t.onReceiveData += t_onReceiveData;
			//t.connect ();
		}

		void t_onReceiveData (NetTcpClient sender, Common.Model.CommandResult data)
		{
			string s = Encoding.UTF8.GetString (data.model as byte[]);

			Invoke ((Action)delegate
			{
				listBox1.Items.Insert (0, s);
			});
		}

		public const string C_GATE_EVENT_SOURCE	= "BioGateService";
		
		/// <summary>
        /// Gate Event Log name 
        /// </summary>
		public const string C_GATE_EVENT_LOG	= "BioGateServiceLog";

		#region Variables
		private EventLog eventLog;
		private ManualResetEvent	mrs			= null;	
		private TimeSpan _readInterval, _writeInterval;
		private GateClient		gClient			= null;
		private Thread			connectThread	= null, readGitOptionThread= null;
		private int prt;		
		#endregion

	

		#region Properties

		public int clientCount
		{ 
			get; 
			private set;
		}

		/// <summary>
		/// Write Interval
		/// </summary>		 
		public TimeSpan writeInterval
		{
			get
			{
				if (null == _writeInterval)
					_writeInterval = new TimeSpan (0, 0, 10);

				return _writeInterval;
			}
			set
			{
				_writeInterval = value;
			}
		}

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

		//TODO: Get Info gitOpetion
		//TODO: Get Info gitDevice
		//TODO: Disconnect Device
		//TODO: Save status device in DB
		//TODO: Remove device disconnected from dicgClient
		 
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
		private void button1_Click (object sender, EventArgs e)
		{

			try
			{
				writeLog ("Service Starting . . .");

				readInterval = new TimeSpan (0, 1, 0);				

				tryToConnect ();
			}
			catch (Exception)
			{				
				writeLog ("ERR: INVALID CONFIG DATA");
			}



			//writeInterval = new TimeSpan (0, 0, 10);
			////gitDevice.lstDevice		=	gitDevice.GetDevice ();
			////gitOption._infoOption	=	gitOption.GetLastStateOfDeviceOption();
			////clientCount				=	gitDevice.lstDevice.Count;

			////gClient					=	new GateClient[clientCount];
			// prt					=	(null != gitOption._infoOption)? gitOption._infoOption.Port : 1470;
			
			//int i =	0;
			////foreach (var item in gitDevice.lstDevice)
			////{				
			////	//DeviceInfo.dicIpAddress.Add(item.Ip,(int)item.Direction);
			////	gClient[i] = new GateClient (item.Ip, prt, 1024);
			////	gClient[i].onConnect		+= tcpClient_onConnect;
			////	gClient[i].onDisconnect		+= tcpClient_onDisconnect;
			////	gClient[i].onError			+= tcpClient_onError;
			////	gClient[i].onReceiveData	+= tcpClient_onReceiveData;
			////	gClient[i].onSendData		+= tcpClient_onSendData;				

			////	gClient[i].connect ();				
			////	dicgClient.Add (i, item.Ip);
			////	i++;
			////}	
	
			
			
		}

		private void tryToConnect ()
		{
			connectThread	= new Thread (new ThreadStart (connectToGate));
			connectThread.Start ();
		}

		private void connectToGate ()
		{
			
			gitDevice.lstDevice		=	gitDevice.GetDevice ();
			//writeLog ("ERR: gitDevice.lstDevice" + gitDevice.lstDevice.Count.ToString());
			gitOption._infoOption	=	gitOption.GetLastStateOfDeviceOption();
			prt				    	=	(null != gitOption._infoOption)? gitOption._infoOption.Port : 1470;
			
			if (null != gitDevice.lstDevice)
			{ 
				foreach (var item in gitDevice.lstDevice)
				{
					gClient = new GateClient (item.Ip, prt, 1024);
					gClient.onConnect			+= tcpClient_onConnect;
					gClient.onDisconnect		+= tcpClient_onDisconnect;
					gClient.onError				+= tcpClient_onError;
					gClient.onReceiveData		+= tcpClient_onReceiveData;
					gClient.onSendData			+= tcpClient_onSendData;				
				
					gClient.connect ();				
				}	
				//writeLog ("INF: Service Started Successfully");
				readGitOption();					
			}
			//else 
			//	writeLog ("INF: Service failed");
			
		}

		void tcpClient_onSendData (NetTcpClient sender, Common.Model.CommandResult data)
		{
			Invoke ((Action)delegate
			{
				listBox1.Items.Insert (0, sender.host + "- > Send data "+ Encoding.UTF8.GetString (data.model as byte[]));
			});
		}

		void tcpClient_onReceiveData (NetTcpClient sender, Common.Model.CommandResult data)
		{
			Invoke ((Action)delegate
			{
				listBox1.Items.Insert (0, sender.host + "- > Recieve data " + Encoding.UTF8.GetString (data.model as byte[]));
			});
		}

		void tcpClient_onError (NetTcpClient sender, Common.Model.CommandResult data)
		{
			Invoke ((Action)delegate
			{
				listBox1.Items.Insert (0, sender.host + "- > Error : " + data.message);				
			});
		}

		void tcpClient_onDisconnect (NetTcpClient sender)
		{
			Invoke ((Action)delegate
			{
				listBox1.Items.Insert (0, sender.host+  "- > DisConnect");
				gitDevice.SetStatusConnection(sender.host,false);

			});
		}

		void tcpClient_onConnect (NetTcpClient sender)
		{			
			Invoke ((Action)delegate
			{				
				listBox1.Items.Insert (0, sender.host + "- > Connect");
				gitDevice.SetStatusConnection(sender.host,true);
				
			});
		}

		private void button2_Click (object sender, EventArgs e)
		{
			try
			{
				stop();
				//string Ip = ipTextBox.Text;
				//int index = -1;
				//if (dicgClient.Count > 0)
				//{
				//	index =  dicgClient.First(r=>r.Value == Ip).Key;
				//	if (index > -1)
				//		gClient[index].disconnect ();
				//}		
			}
			catch (Exception ex)
			{				
				Invoke ((Action)delegate
				{				
					listBox1.Items.Insert (0, "button2 -> "+ ex.Message);
				
				});
			}					 
		}

		private void stop ()
		{			
			Invoke((Action) delegate
			{
				foreach (var item in gitDevice.lstDevice)
				{				
					gClient = new GateClient (item.Ip, prt, 1024);				
					gClient.disconnect();			
					listBox1.Items.Insert (0, item.Ip +  "- > DisConnect");				
					gitDevice.SetStatusConnection(item.Ip,false);					
				}	
			});			

			if (null != readGitOptionThread)
					readGitOptionThread.Abort();

			//if (dicgClient.Count > 0)
			//{ 
			//	foreach (var item in dicgClient)
			//	{		
			//		gitDevice.SetStatusConnection(item.Value,false);
			//		gClient[item.Key].disconnect();				
			//	}
			//}
			//else 
			//	listBox1.Items.Insert (0,"ERR: DICTIONARTY IS EMPTY");			

			//dicgClient.Clear();
			////writeLog ("INF: Service Stopped successfully");				
		}

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
					Invoke ((Action)delegate
					{
						listBox1.Items.Insert (0, "ERR: Thread read gitoption failed -> " + ex.Message);
					});
					//writeLog("ERR: Thread read gitoption failed -> " + ex.Message);
				}
			}));
			readGitOptionThread.Start ();
		}
		private void button3_Click (object sender, EventArgs e)
		{
		//	try
		//	{
		//		string Ip = ipTextBox.Text;
		//		int index = -1;
		//		if (dicgClient.Count > 0)
		//		{
		//			index =  dicgClient.First(r=>r.Value == Ip).Key;
		//			if (index > -1)
		//				gClient[index].write(dataTextBox.Text);
		//		}		
		//	}
		//	catch (Exception ex)
		//	{
				
		//		Invoke ((Action)delegate
		//		{				
		//			listBox1.Items.Insert (0, "button3 -> "+ ex.Message);
				
		//		});
		//	}		
		}

		private void clearButton_Click (object sender, EventArgs e)
		{
			listBox1.Items.Clear();
			
		}

		private void Form1_Load (object sender, EventArgs e)
		{

		}
		public static user _userinfo;

		private void Unkown_Click (object sender, EventArgs e)
		{
			string cmd= "12EF45678";
			
			string kart		= Convert.ToString ((Int64.Parse (cmd.Substring (1, 8), System.Globalization.NumberStyles.HexNumber)));
					
			device	_host	= gitDevice.GetDevice("192.168.0.1");	 
			option	_option	= gitOption._infoOption;
			//if (null != gitUser.GetUser(kart))
			//{ 
				gitUser._lstUser.Add(gitUser.GetUser(kart));

				int result		= gitLog.kartLicense("192.168.0.1", kart, _host, _option);
				ListInfo.removeKart("192.168.0.1");
				switch (result)
				{
					//case 2: write("[22011]"); break;
					//case 3:
					//case 4:
					//case 5:
					//case 6:
					//case 7:
					//case 8:
					//case 9:
					//case 10:
					//case 11:
					//	{
					//		write("[22010]");
					//		gitUser.removeUser(kart);
					//	} break;											
				}	
			//}
			//else
			//{
			//	_userinfo.studentId = "0";
			//	_userinfo.Pic = null;
			//	gitLog.saveLogUser (_userinfo, _host.Id, (int)_host.Direction, (int)EnumMessageType.unkownCard);
			//}
		}		
	}		
		#endregion	
	
}
