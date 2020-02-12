using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Common.Enum
{
	public enum EnumProtocol
	{		
		/// <summary>
		/// There is no active protocol.
		/// </summary>
		Undefined	= 0x00000000,	

		/// <summary>
		/// T=0 is the active protocol.
		/// </summary>
		T0			= 0x00000001,	

		/// <summary>
		/// T=1 is the active protocol.
		/// </summary>
		T1			= 0x00000002,	

		/// <summary>
		/// Raw is the active protocol.
		/// </summary>
		Raw			= 0x00010000, 
		Default		= unchecked ((int) 0x80000000),  // Use implicit PTS.

		/// <summary>
		/// T=1 or T=0 can be the active protocol
		/// </summary>
		T0orT1		= T0 | T1
	
	
	}
}
