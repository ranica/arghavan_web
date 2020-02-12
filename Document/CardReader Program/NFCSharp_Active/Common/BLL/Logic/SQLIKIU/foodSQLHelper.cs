using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Text;

namespace Common.BLL.Logic.SQLIKIU
{
	public class foodSQLHelper
	{
		#region Methods	
		
		/// <summary>
		/// Execute NonQuery
		/// </summary>
		/// <param name="cmdType"></param>
		/// <param name="cmdText"></param>
		/// <param name="commandParameters"></param>
		/// <returns></returns>
		public static int ExecuteNonQuery(CommandType cmdType, string cmdText, params SqlParameter[] commandParameters)
        {
            SqlConnection connection	= new SqlConnection(SSTCryptographer.Decrypt(ConfigurationManager.AppSettings["ConnectionString"].Trim(),"5212"));
            SqlCommand cmd				= new SqlCommand();

            PrepareCommand(cmd, connection, cmdType, cmdText, commandParameters);
            int val = cmd.ExecuteNonQuery();
            cmd.Parameters.Clear();
            return val;
        }

		/// <summary>
		/// Execute Reader
		/// </summary>
		/// <param name="cmdType"></param>
		/// <param name="cmdText"></param>
		/// <param name="commandParameters"></param>
		/// <returns></returns>
        public static SqlDataReader ExecuteReader(CommandType cmdType, string cmdText, params SqlParameter[] commandParameters)
        {
            SqlCommand  cmd		= new SqlCommand();
            SqlConnection conn	= new SqlConnection(SSTCryptographer.Decrypt(ConfigurationManager.AppSettings["ConnectionString"].Trim(),"5212"));
           
            try
            {
                PrepareCommand(cmd, conn, cmdType, cmdText, commandParameters);
                SqlDataReader rdr = cmd.ExecuteReader(CommandBehavior.CloseConnection);
                cmd.Parameters.Clear();
                return rdr;
            }
            catch
            {
                conn.Close();
                throw;
            }
        }

		/// <summary>
		/// Prepare Command
		/// </summary>
		/// <param name="cmd"></param>
		/// <param name="conn"></param>
		/// <param name="cmdType"></param>
		/// <param name="cmdText"></param>
		/// <param name="cmdParms"></param>
        private static void PrepareCommand(SqlCommand cmd, SqlConnection conn, CommandType cmdType, string cmdText, SqlParameter[] cmdParms)
        {
            if (conn.State != ConnectionState.Open)
                conn.Open();

            cmd.Connection = conn;
            cmd.CommandText = cmdText;
            cmd.CommandType = cmdType;

            if (cmdParms != null)
            {
                foreach (SqlParameter parm in cmdParms)
                    cmd.Parameters.Add(parm);
            }
        }
		#endregion
	}
}
