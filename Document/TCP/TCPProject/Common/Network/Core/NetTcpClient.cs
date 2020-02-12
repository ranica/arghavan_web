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
	/// Tcp Client Wrapper
	/// </summary>
	public class NetTcpClient
	{
		#region Delegates
		public delegate void Connect (NetTcpClient sender);
		public delegate void Disconnect (NetTcpClient sender);
		public delegate void ReceiveData (NetTcpClient sender, CommandResult data);
		public delegate void SendData (NetTcpClient sender, CommandResult data);
		public delegate void Error (NetTcpClient sender, CommandResult data);
		#endregion

		#region Events
		public event Connect		onConnect;
		public event Disconnect		onDisconnect;
		public event ReceiveData	onReceiveData;
		public event SendData		onSendData;
		public event Error			onError;
		#endregion		

		#region Constants
		/// <summary>
		/// Write/Read timeout in milisecond
		/// </summary>
		public const int C_TIMEOUT	= 5000;
		#endregion

		#region Variables
		public byte[] receiveBuffer;
		public object readSyncObj;
		/// <summary>
		/// Object State
		/// </summary>
		public object connectSyncObj
		{ 
			get; 
			set; 
		}
	

		/// <summary>
		/// TcpClient
		/// </summary>
		private TcpClient client;
        public TcpClient Client
        {
            get
            {
                return client;
            }
        }
		#endregion

		#region Properties		
		
		/// <summary>
		/// Buffer Size
		/// </summary>
		public int bufferSize
		{ 
			get; 
			private set;
		}
		
		/// <summary>
		/// Port
		/// </summary>
		public int port 
		{ 
			get; 
			private set;
		}

		/// <summary>
		/// IP
		/// </summary>
		public string host 
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
		public NetTcpClient (TcpClient client, int bufferSize)
		{
			this.client		= client;
 			this.bufferSize	= bufferSize;

			receiveBuffer	= new byte[bufferSize];
			readSyncObj		= new object ();

			beginRead();
		}

		/// <summary>
		/// Constructor
		/// </summary>
		public NetTcpClient (string host, int port, int bufferSize)
		{
 			this.host		= host;
			this.port		= port;
			this.bufferSize	= bufferSize;

			receiveBuffer	= new byte[bufferSize];
			readSyncObj		= new object ();
			connectSyncObj	= new object ();
		} 
		#endregion
		
		#region Connect/Disconnect
		/// <summary>
		/// Try to connect
		/// </summary>
		/// <returns></returns>
		public void connect ()
		{ 
			try 
			{
				// Disconnect
				disconnect ();
				
				// Try to connect
				client	= null;
				client	= new TcpClient ();
				client.ReceiveTimeout	= C_TIMEOUT;
				client.SendTimeout		= C_TIMEOUT;

				client.BeginConnect (IPAddress.Parse (host), port, connectCallback, connectSyncObj);
			}
			catch (Exception ex)
			{
 				raiseError (CommandResult.makeErrorResult (ex.Message, ex));
			}
		}

		/// <summary>
		/// Try to connect
		/// </summary>
		/// <param name="ar"></param>
		private void connectCallback (IAsyncResult ar)
		{
			try
			{ 
				//TcpClient tcpclient = ar.AsyncState as TcpClient;

				//if (tcpclient.Client != null)
				if ((client != null) && (client.Client != null) && (client.Client.Connected))
				{
					client.EndConnect(ar);
			
					// Begin read
					beginRead ();

					// Emit signal
					raiseConnected ();
				}
				else
					raiseError (CommandResult.makeErrorResult ("NOT CONNECT", 999));
			}
			catch (Exception ex)
			{ 
				raiseError (CommandResult.makeErrorResult (ex.Message, ex));
			}
		}
		/// <summary>
		/// Disconnect client
		/// </summary>
		public bool disconnect ()
		{ 
			return doDisconnect (true);
		}

		/// <summary>
		/// Disconnect
		/// </summary>
		private bool doDisconnect (bool raiseEvent)
		{
			bool result	= false;

			if (null != client)
			{ 
				try
				{					
					client.Close ();		
					client	= null;
					result	= true;

					if (raiseEvent)
						raiseDisconnected ();
				}
				catch (Exception ex)
				{
 					raiseError (CommandResult.makeErrorResult (ex.Message, ex));
				}
			}

			return result;
		}
		#endregion

		#region Write
        public void flush ()
        {
            try
            {
                client?.GetStream().Flush();
            }
            catch (Exception)
            {
            }
        }

		/// <summary>
		/// Write string with encoding
		/// </summary>
		/// <param name="data"></param>
		/// <param name="encoding">Default encoding is UTF8</param>
		public void write (string data, Encoding encoding = null)
		{
			if ((null != data) && (0 < data.Length))
			{
				if (null == encoding)
					encoding = Encoding.UTF8;

				byte[] bData = encoding.GetBytes (data);

				if (bData.Length > 0)
					write (bData);
			}
		}

		/// <summary>
		/// Write bytes
		/// </summary>
		/// <param name="data"></param>
		public void write (byte[] data)
		{
			if ((null != data) && (0 < data.Length))
			{
				try
				{
					if (null != client)
					{
						client.GetStream ().Write (data, 0, data.Length);
						raiseSent (CommandResult.makeSuccessResult ("Send", data));
					}
						
				}
				catch (Exception)
				{
					raiseError (CommandResult.makeErrorResult ("WRITE ERROR", 990));
				}
			}
		}
		#endregion
		
		#region Read
		/// <summary>
		/// Begin Read
		/// </summary>
		private void beginRead ()
		{
			if ((null != client) && (null != client.GetStream ()))
				client.GetStream ().BeginRead (receiveBuffer, 0, receiveBuffer.Length, endRead, readSyncObj);
		}

		/// <summary>
		/// On Client Read finished
		/// </summary>
		/// <param name="ar"></param>
		private void endRead (IAsyncResult ar)
		{
			NetworkStream	ns	= null;

			try
			{ 
				if (null != client)
					ns	= client.GetStream ();
			}
			catch (Exception ex)
			{ 
				raiseError (CommandResult.makeErrorResult (ex.Message, ex));
			}

			if ((ns != null) && ar.IsCompleted)
			{
				try
				{ 
					int size = client.GetStream ().EndRead (ar);

					if (size > 0)
					{
						byte[] data = new byte[size];

						// Trim buffer
						Array.Copy (receiveBuffer, data, size);
						

						// Emit Signal
						raiseReceive (CommandResult.makeSuccessResult ("Receive", data));
					}

					beginRead ();
				}
				catch (Exception ex)
				{
					raiseError (CommandResult.makeErrorResult (ex.Message, ex));
				}
			}
		} 
		#endregion

		#region Event Emitter
		/// <summary>
		/// Rrais onConnect event
		/// </summary>
		private void raiseConnected ()
		{
			if (null != onConnect)
				onConnect (this);
		}

		/// <summary>
		/// Rrais onDisconnect event
		/// </summary>
		private void raiseDisconnected ()
		{
			if (null != onDisconnect)
				onDisconnect (this);
		}

		/// <summary>
		/// Raise OnReceive
		/// </summary>
		private void raiseReceive (CommandResult data)
		{
			if (null != onReceiveData)
				onReceiveData (this, data);
		}

		/// <summary>
		/// Raise onSent
		/// </summary>
		private void raiseSent (CommandResult data)
		{
			if (null != onSendData)
				onSendData (this, data);
		}

		/// <summary>
		/// Raise OnError
		/// </summary>
		private void raiseError (CommandResult data)
		{
			if (null != onError)
				onError (this, data);
		}

        #endregion
        #endregion

    }
}
