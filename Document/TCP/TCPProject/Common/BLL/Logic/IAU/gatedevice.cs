using BaseDAL.Model;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace Common.BLL.Logic.IAU
{
    public class gatedevice
    {
        #region Constrator
        private const string C_spUpdateStatusGateDevice = "spUpdateStatusGateDevice";
        private const string C_spDisconnectGateDevice = "spDisconnectGateDevice";
        private const string C_spLoadUser = "spLoadUser";
        private const string C_spLoadGateDevice = "spLoadGateDevice";
        private const string C_spLoadGateDeviceByID = "spLoadGateDeviceByID";

        private const string PARAM_ID = "@ID";
        private const string PARAM_STATE = "@STATE";
        private const string PARAM_NETSTATE = "@NETSTATE";
        private const string PARAM_IP = "@IP";
        private const string PARAM_CDN = "@CDN";
        private const string PARAM_GATE_DEVICE_ID = "@gatedevice_id";
        private const string SELECT_DEVICE = "SELECT * FROM gatedevices WHERE gatedevices.state = 1 AND gatedevices.type = 0";
        #endregion

        #region Properties

        #endregion

        #region Method

        /// <summary>
        /// Read All Gate Device
        /// </summary>
        /// <returns></returns>
        public DataTable readGateDevice()
        {

            DataTable t = new DataTable();
            MySqlDataReader dataReader = null;

            try
            {
              
                dataReader = MySQLHelper.ExecuteReader(CommandType.Text, SELECT_DEVICE);


                if (!dataReader.HasRows)
                {
                    return null;
                }
                else
                {
                    t.Load(dataReader);
                    dataReader.Close();

                    return t;
                }
            }
            catch (Exception)
            {
                dataReader?.Close();

                return null;
            }
        }

        /// <summary>
        /// Uodate status Gate
        /// </summary>
        /// <param name="state"></param>
        /// <returns></returns>
        public bool UpdateStatusGate(string ip, Byte state)
        {
            try
            {
                MySqlParameter[] parameters =
                {
                    new MySqlParameter(PARAM_IP  ,ip),
                    new MySqlParameter(PARAM_NETSTATE  ,state)
                };


               return  MySQLHelper.ExecuteNonQuery(CommandType.StoredProcedure, C_spUpdateStatusGateDevice, parameters) != 0;

            }
            catch (Exception ex )
            {
                LoggerExtensionMySQL.log(ex);
                return false;
            }
          
        }

        /// <summary>
        /// Disconnect Status Gate
        /// </summary>
        /// <returns></returns>
        public bool DisconnectStatusGate()
        {
            try
            {

                return MySQLHelper.ExecuteNonQuery(CommandType.StoredProcedure, C_spDisconnectGateDevice) != 0;

            }
            catch (Exception)
            {

                return false;
            }

        }

        /// <summary>
        /// Load  User
        /// </summary>
        /// <returns></returns>
        public DataTable loadUser(string cdn)
        {
            try
            {
                MySqlParameter[] parameters =
               {
                    new MySqlParameter(PARAM_CDN ,cdn)
               };

               return MySQLHelper.ExecuteNonQueryTable(CommandType.StoredProcedure, C_spLoadUser, parameters);

            }
            catch (Exception ex)
            {
                LoggerExtensionMySQL.log(ex);

                return null;
               
            }
        }

        /// <summary>
        /// Load  Gate Device By IP
        /// </summary>
        /// <returns></returns>
        public DataTable loadDevice(string ip)
        {
            DataTable dataTable = new DataTable();

            try
            {
                MySqlParameter[] parameters =
               {
                    new MySqlParameter(PARAM_IP ,ip)
               };

                dataTable = MySQLHelper.ExecuteNonQueryTable(CommandType.StoredProcedure, C_spLoadGateDevice, parameters);
                return dataTable;

            }
            catch (Exception ex)
            {
                LoggerExtensionMySQL.log(ex);

                return null;

            }
        }

        /// <summary>
        /// Load Gate device by id
        /// </summary>
        /// <param name="id"></param>
        /// <returns></returns>
        public DataTable loadDeviceById(int id)
        {
            DataTable dataTable = new DataTable();

            try
            {
                MySqlParameter[] parameters =
               {
                    new MySqlParameter(PARAM_ID ,id)
               };

                dataTable = MySQLHelper.ExecuteNonQueryTable(CommandType.StoredProcedure, C_spLoadGateDeviceByID, parameters);
                return dataTable;

            }
            catch (Exception ex)
            {
                LoggerExtensionMySQL.log(ex);

                return null;

            }
        }
      
        #endregion

    }
}
