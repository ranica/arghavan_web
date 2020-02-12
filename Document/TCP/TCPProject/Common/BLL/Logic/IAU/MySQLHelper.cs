using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using MySql.Data.MySqlClient;
using System.Configuration;

namespace Common.BLL.Logic.IAU
{
    public class MySQLHelper
    {
        #region Methods	

        /// <summary>
        /// Execute NonQuery
        /// </summary>
        /// <param name="cmdType"></param>
        /// <param name="cmdText"></param>
        /// <param name="commandParameters"></param>
        /// <returns></returns>
        public static DataTable ExecuteNonQueryTable(CommandType cmdType, string cmdText, params MySqlParameter[] commandParameters)
        {
            string valueConnctionString = ConfigurationManager.AppSettings["Bo+EjoPcYlV6skzulIWQ3eVo6OkxRly5"].Trim();
            string pathConnectionString = SSTCryptographer.Decrypt(valueConnctionString, "@rira?2018");

            MySqlConnection connection = new MySqlConnection(pathConnectionString);
            MySqlCommand cmd = new MySqlCommand();
            MySqlDataAdapter dataAdaptor = new MySqlDataAdapter(cmd);
            DataSet dataSet = new DataSet();
            DataTable dataTable = new DataTable();

            PrepareCommand(cmd, connection, cmdType, cmdText, commandParameters);
            dataAdaptor.SelectCommand = cmd;
         
            int val = cmd.ExecuteNonQuery();
           
            dataAdaptor.Fill(dataTable);
            //dataTable = dataSet.Tables[0];
            cmd.Parameters.Clear();
            return dataTable;
            
           //return val;
        }

        /// <summary>
        /// Execute NonQuery
        /// </summary>
        /// <param name="cmdType"></param>
        /// <param name="cmdText"></param>
        /// <param name="commandParameters"></param>
        /// <returns></returns>
        public static int ExecuteNonQuery(CommandType cmdType, string cmdText, params MySqlParameter[] commandParameters)
        {
            string valueConnctionString = ConfigurationManager.AppSettings["Bo+EjoPcYlV6skzulIWQ3eVo6OkxRly5"].Trim();
            string pathConnectionString = SSTCryptographer.Decrypt(valueConnctionString, "@rira?2018");
            MySqlConnection connection = new MySqlConnection(pathConnectionString);

            MySqlCommand cmd = new MySqlCommand();
            

            PrepareCommand(cmd, connection, cmdType, cmdText, commandParameters);
           
            int val = cmd.ExecuteNonQuery();
          

            return val;
        }

        /// <summary>
        /// Execute Reader
        /// </summary>
        /// <param name="cmdType"></param>
        /// <param name="cmdText"></param>
        /// <param name="commandParameters"></param>
        /// <returns></returns>
        public static MySqlDataReader ExecuteReader(CommandType cmdType, string cmdText, params MySqlParameter[] commandParameters)
        {
            MySqlCommand cmd = new MySqlCommand();

            string valueConnctionString = ConfigurationManager.AppSettings["Bo+EjoPcYlV6skzulIWQ3eVo6OkxRly5"].Trim();
            string pathConnectionString = SSTCryptographer.Decrypt(valueConnctionString, "@rira?2018");
            MySqlConnection connection = new MySqlConnection(pathConnectionString);

            try
            {
                PrepareCommand(cmd, connection, cmdType, cmdText, commandParameters);
                MySqlDataReader rdr = cmd.ExecuteReader(CommandBehavior.CloseConnection);
                cmd.Parameters.Clear();
                return rdr;
            }
            catch
            {
                connection.Close();
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
        private static void PrepareCommand(MySqlCommand cmd, MySqlConnection conn, CommandType cmdType, string cmdText, MySqlParameter[] cmdParms)
        {
            if (conn.State != ConnectionState.Open)
                conn.Open();

            cmd.Connection = conn;
            cmd.CommandText = cmdText;
            cmd.CommandType = cmdType;

            if (cmdParms != null)
            {
                foreach (MySqlParameter parm in cmdParms)
                    cmd.Parameters.Add(parm);
            }
        }
        #endregion
    }
}
