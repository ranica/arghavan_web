using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.InteropServices;
using System.Text;

namespace Common.Helper.Reader
{
	public class NFC_PSPC
	{
		public const int SCARD_SCOPE_USER = 0;
		public const int SCARD_SCOPE_TERMINAL = 1;
		public const int SCARD_SCOPE_SYSTEM = 2;

		/// <summary>
		/// Establish Context
		/// </summary>
		/// <param name="dwScope"></param>
		/// <param name="pvReserved1"></param>
		/// <param name="pvReserved2"></param>
		/// <param name="phContext"></param>
		/// <returns></returns>
		[DllImport ("winscard.dll")]		
		public static extern int SCardEstablishContext (uint dwScope, IntPtr pvReserved1, IntPtr pvReserved2, out IntPtr phContext);

		/// <summary>
		/// Release Context
		/// </summary>
		/// <param name="phContext"></param>
		/// <returns></returns>
		[DllImport ("WinScard.dll")]
		public static extern int SCardReleaseContext (IntPtr phContext);

		/// <summary>
		/// List Readers
		/// </summary>
		/// <param name="hContext"></param>
		/// <param name="mszGroups"></param>
		/// <param name="mszReaders"></param>
		/// <param name="pcchReaders"></param>
		/// <returns></returns>

		[DllImport ("WinScard.dll", EntryPoint = "SCardListReadersA", CharSet = CharSet.Ansi)]
		public static extern int SCardListReaders (
													  IntPtr hContext,
													  byte[] mszGroups,
													  byte[] mszReaders,
													  ref UInt32 pcchReaders
												  );
		/// <summary>
		/// Connect
		/// </summary>
		/// <param name="hContext"></param>
		/// <param name="cReaderName"></param>
		/// <param name="dwShareMode"></param>
		/// <param name="dwPrefProtocol"></param>
		/// <param name="phCard"></param>
		/// <param name="ActiveProtocol"></param>
		/// <returns></returns>

		[DllImport ("WinScard.dll")]
		public static extern int SCardConnect (IntPtr hContext,
												string cReaderName,
												uint dwShareMode,
												uint dwPrefProtocol,
												ref IntPtr phCard,
												ref IntPtr ActiveProtocol);

		/// <summary>
		/// Disconnect
		/// </summary>
		/// <param name="hCard"></param>
		/// <param name="Disposition"></param>
		/// <returns></returns>
		[DllImport ("WinScard.dll")]
		public static extern int SCardDisconnect (IntPtr hCard, int Disposition);

		/// <summary>
		/// Begin Transaction
		/// </summary>
		/// <param name="hCard"></param>
		/// <returns></returns>

		[DllImport ("WinScard.dll")]
		public static extern int SCardBeginTransaction (IntPtr hCard);
		/// <summary>
		/// Status
		/// </summary>
		/// <param name="hCard"></param>
		/// <param name="szReaderName"></param>
		/// <param name="pcchReaderLen"></param>
		/// <param name="pdwState"></param>
		/// <param name="ActiveProtocol"></param>
		/// <param name="pbAtr"></param>
		/// <param name="pcbAtrLen"></param>
		/// <returns></returns>
		[DllImport ("WinScard.dll")]
		public static extern int SCardStatus (
											   IntPtr hCard,
											   string szReaderName,
											   ref UInt32 pcchReaderLen,
											   ref int pdwState,
											   ref IntPtr ActiveProtocol,
											   byte[] pbAtr,
											   ref int pcbAtrLen);

		/// <summary>
		/// Reconnect
		/// </summary>
		/// <param name="hCard"></param>
		/// <param name="dwShareMode"></param>
		/// <param name="dwPreferredProtocols"></param>
		/// <param name="dwInitialization"></param>
		/// <param name="pdwActiveProtocol"></param>
		/// <returns></returns>
		[DllImport ("WinScard.dll")]
		public static extern long SCardReconnect (IntPtr hCard,
													uint dwShareMode,
													uint dwPreferredProtocols,
													uint dwInitialization,
													ref IntPtr pdwActiveProtocol
												 );
		/// <summary>
		/// End Transaction
		/// </summary>
		/// <param name="hCard"></param>
		/// <param name="dwDisposition"></param>
		/// <returns></returns>

		[DllImport ("WinScard.dll")]
		public static extern long SCardEndTransaction (IntPtr hCard,
														 uint dwDisposition
													  );
		[StructLayout (LayoutKind.Sequential)]
		public struct SCARD_IO_REQUEST
		{
			public int dwProtocol;
			public int cbPciLength;
		}
		/// <summary>
		/// Transmit
		/// </summary>
		/// <param name="hCard"></param>
		/// <param name="pioSendRequest"></param>
		/// <param name="SendBuff"></param>
		/// <param name="SendBuffLen"></param>
		/// <param name="pioRecvRequest"></param>
		/// <param name="RecvBuff"></param>
		/// <param name="RecvBuffLen"></param>
		/// <returns></returns>
		[DllImport ("winscard.dll")]
		public static extern int SCardTransmit (
												 IntPtr hCard,
												 ref SCARD_IO_REQUEST pioSendRequest,
												 byte[] SendBuff,
												 int SendBuffLen,
												 ref SCARD_IO_REQUEST pioRecvRequest,
												 byte[] RecvBuff,
												 ref int RecvBuffLen
											   );
	

	}
}
