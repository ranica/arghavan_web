using System;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace NFCSharp
{
    public static class Extensions
    {
        public static string BytesToHex(this byte[] bytes)
        {
            string hex = String.Empty;
			string date = null;
		
			if (null != bytes)
			{
				for (int idx = 0; idx < bytes.Length; idx++)
				{
					if (idx == 5)
					{
						date =	checkLength(string.Format("{0:X2}", bytes[5])) + 
								checkLength(string.Format("{0:X2}", bytes[6])) +
								checkLength(string.Format("{0:X2}", bytes[7])) + 
								checkLength(string.Format("{0:X2}", bytes[8]));
						
					}
					
					hex = hex + string.Format("{0:X2}", bytes[idx]);               
				}
			}			
            return  date;
        }

		

		private static	string checkLength(string hex)
		{			
			string result ="";
			result = hex;
			if (hex != "")
			{
				if (hex.Length < 2)
				{
					hex = "0" + hex;
					result = hex;
				}
			}

			return result;
		}
		 public static string BytesToDec(this byte[] bytes)
        {
            string hex = String.Empty;
            
			 for (int idx = 5; idx < 9; idx++)
            {
                hex = hex + string.Format("{0:X2}", bytes[idx]);               
            }

			 //hex = hex + string.Format("{0:X2}", bytes[5]) + 
			 //			string.Format("{0:X2}", bytes[6]) + 
			 //			string.Format("{0:X2}", bytes[7]) +
			 //			string.Format("{0:X2}", bytes[8]) ;
            
            return hex.Trim();

			//hex =  string.Format("{0:X2}", bytes[5]).Length < 2 ? "0" + string.Format("{0:X2}", bytes[5]): string.Format("{0:X2}" + 
			//	   string.Format("{0:X2}", bytes[6]).Length < 2 ? "0" + string.Format("{0:X2}", bytes[6]): string.Format("{0:X2}" + 
			//	   string.Format("{0:X2}", bytes[7]).Length < 2 ? "0" + string.Format("{0:X2}", bytes[7]): string.Format("{0:X2}" + 
			//	   string.Format("{0:X2}", bytes[8]).Length < 2 ? "0" + string.Format("{0:X2}", bytes[8]): string.Format("{0:X2}" ;

            
        }

        public static byte[] HexToBytes(this string payload)
        {
            payload = payload.Trim().Replace(" ", "");
            if (payload.Length % 2 > 0) return null;

            byte[] HexAsBytes = new byte[payload.Length / 2];
            for (int index = 0; index < HexAsBytes.Length; index++)
            {
                string byteValue = payload.Substring(index * 2, 2);
                HexAsBytes[index] = byte.Parse(byteValue, NumberStyles.HexNumber, CultureInfo.InvariantCulture);
            }
            return HexAsBytes;
        }
    }
}
