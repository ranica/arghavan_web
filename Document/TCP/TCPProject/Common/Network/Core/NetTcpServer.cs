using BaseDAL.Model;
using Common.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Sockets;
using System.Text;

namespace Common.Network.Core
{
	/// <summary>
	/// Tcp Server Wrapper
	/// </summary>
	public class NetTcpServer
	{
		#region Delegates
		public delegate void Start (NetTcpServer sender);
		public delegate void Stop (NetTcpServer sender);
		public delegate void AcceptClient (NetTcpServer sender, NetTcpClient client);
		public delegate void ReceiveData (NetTcpServer sender, NetTcpClient client, CommandResult data);
		public delegate void SendData (NetTcpServer sender, NetTcpClient client, CommandResult data);
		public delegate void Error (NetTcpServer sender, CommandResult data);
		public delegate void HintEvent (NetTcpServer sender, CommandResult data);
		#endregion

		#region Events
		public event Start			onStart;
		public event Stop			onStop;
		public event AcceptClient	onAcceptClient;
		public event ReceiveData	onReceiveData;
		public event SendData		onSendData;
		public event Error			onError;
		public event HintEvent		onHintEvent;
		#endregion		

		#region Constants
		#endregion

		#region Variables
		/// <summary>
		/// TcpServer
		/// </summary>
		private TcpListener server;

		/// <summary>
		/// Server Listen AR Result
		/// </summary>
		private object serverState;
		#endregion

		#region Properties
		/// <summary>
		/// Port
		/// </summary>
		public int port 
		{ 
			get; 
			private set;
		}

		/// <summary>
		/// Buffer Size
		/// </summary>
		public int bufferSize 
		{ 
			get; 
			private set;
		}

		/// <summary>
		/// Clients List
		/// </summary>
		public List<NetTcpClient> clients
		{
			get;
			private set;
		}
		#endregion

		#region Methods

		#region Constructors
		/// <summary>
		/// Constructor
		/// </summary>
		public NetTcpServer (int port, int bufferSize)
		{
			this.port		= port;
			this.bufferSize	= bufferSize;

			// Prepare
			this.clients	= new List<Core.NetTcpClient> ();
		}
		#endregion
		
		#region Start/Stop
		/// <summary>
		/// Start server
		/// </summary>
		/// <returns></returns>
		public void start ()
		{ 
			try 
			{
				// Disconnect
				stop ();
				
				// Try to connect
				server	= null;
				server	= new TcpListener (IPAddress.Any, port);

				server.Start ();

                onStart?.Invoke (this);

				beginListen ();
			}
			catch (Exception ex)
			{
 				raiseError (CommandResult.makeErrorResult (ex.Message, ex));
			}
		}

		/// <summary>
		/// stop server
		/// </summary>
		public bool stop ()
		{ 
			return doStop (true);
		}

		/// <summary>
		/// doStop
		/// </summary>
		private bool doStop (bool raiseEvent)
		{
			bool result	= false;

			if (null != server)
			{ 
				try
				{
					server.Stop ();
					server	= null;
					result	= true;

					if (raiseEvent)
						raiseStopped ();
				}
				catch (Exception ex)
				{
 					raiseError (CommandResult.makeErrorResult (ex.Message, ex));
				}
			}

			return result;
		}

		/// <summary>
		/// Begin Listen
		/// </summary>
		private void beginListen ()
		{
			if (null != server)
				server.BeginAcceptTcpClient (serverAcceptClient, serverState);
		}

		/// <summary>
		/// Listen completed
		/// </summary>
		/// <param name="ar"></param>
		private void serverAcceptClient (IAsyncResult ar)
		{
			try
			{
				if (null != server)
				{
					#region Get/Add new client
					TcpClient		client		= server.EndAcceptTcpClient (ar);
					NetTcpClient	netClient	= new NetTcpClient (client, bufferSize);

					// Add to clients
					clients.Add (netClient);
				
					// Add listener
					netClient.onConnect		+= NetClient_onConnect;
					netClient.onDisconnect  += NetClient_onDisconnect;
					netClient.onError       += NetClient_onError;
					netClient.onReceiveData += NetClient_onReceiveData;
					netClient.onSendData    += NetClient_onSendData;

					// Raise event
					raiseAcceptClient (netClient); 
					#endregion

					// Accept another client
					beginListen ();
				}
			}
			catch (Exception ex)
			{
				raiseError (CommandResult.makeErrorResult (ex.Message, ex));
			}
		}
		
		#region Clients Events
		/// <summary>
		/// Send Data Client Event
		/// </summary>
		/// <param name="sender"></param>
		/// <param name="data"></param>
		private void NetClient_onSendData (NetTcpClient sender, CommandResult data)
		{
			if (null != onHintEvent)
				onHintEvent.Invoke (this, new CommandResult ()
				{
					id      = 2002,
					message = "Client Send data",
					model   = sender
				});
		}

		/// <summary>
		/// Client Receive-data Event
		/// </summary>
		/// <param name="sender"></param>
		/// <param name="data"></param>
		private void NetClient_onReceiveData (NetTcpClient sender, CommandResult data)
		{
			if (null != onHintEvent)
				onHintEvent.Invoke (this, new CommandResult ()
				{
					id      = 2002,
					message = "Client Receive data",
					model   = sender,
					extra	= data
				});

			// Raise Recive data
			raiseReceive (sender, data);
		}

		/// <summary>
		/// Client Error Event
		/// </summary>
		/// <param name="sender"></param>
		/// <param name="data"></param>
		private void NetClient_onError (NetTcpClient sender, CommandResult data)
		{
			if (null != onHintEvent)
				onHintEvent.Invoke (this, new CommandResult ()
				{
					id      = 2009,
					message = "Client Error",
					model   = sender
				});
		}

		/// <summary>
		/// Disconnect Client Event
		/// </summary>
		/// <param name="sender"></param>
		private void NetClient_onDisconnect (NetTcpClient sender)
		{
			if (null != onHintEvent)
				onHintEvent.Invoke (this, new CommandResult ()
				{
					id      = 2001,
					message = "Client Disconnect",
					model   = sender
				});
		}

		/// <summary>
		/// Connect Client Event
		/// </summary>
		/// <param name="sender"></param>
		private void NetClient_onConnect (NetTcpClient sender)
		{
			if (null != onHintEvent)
				onHintEvent.Invoke (this, new CommandResult ()
				{
					id      = 2000,
					message = "Client Connect",
					model   = sender
				});
		} 
		#endregion
		#endregion

		#region Write
		/// <summary>
		/// Write string with encoding
		/// </summary>
		/// <param name="data"></param>
		/// <param name="encoding">Default encoding is UTF8</param>
		public void write (string data, Encoding encoding = null)
		{
			foreach (NetTcpClient client in clients)
				client.write (data, encoding);
		}

		/// <summary>
		/// Write bytes
		/// </summary>
		/// <param name="data"></param>
		public void write (byte[] data)
		{
			foreach (NetTcpClient client in clients)
				client.write (data);
		}
		#endregion

		#region Event Emitter
		/// <summary>
		/// Rrais onStart event
		/// </summary>
		private void raiseStarted ()
		{
			if (null != onStart)
				onStart (this);
		}

		/// <summary>
		/// Rrais onStop event
		/// </summary>
		private void raiseStopped ()
		{
			if (null != onStop)
				onStop (this);
		}

		/// <summary>
		/// Raise OnReceive
		/// </summary>
		private void raiseReceive (NetTcpClient netClient, CommandResult data)
		{
			if (null != onReceiveData)
				onReceiveData (this, netClient, data);
		}

		/// <summary>
		/// Raise onSent
		/// </summary>
		private void raiseSent (NetTcpClient netClient, CommandResult data)
		{
			if (null != onSendData)
				onSendData (this, netClient, data);
		}

		/// <summary>
		/// Raise OnError
		/// </summary>
		private void raiseError (CommandResult data)
		{
			if (null != onError)
				onError (this, data);
		} 

		/// <summary>
		/// Raise OnClient Accepted
		/// </summary>
		private void raiseAcceptClient (NetTcpClient netClient)
		{
			if (null != onAcceptClient)
				onAcceptClient (this, netClient);
		} 
		#endregion

		#endregion
	}
}
