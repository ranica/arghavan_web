using System;
using BaseDAL.Model;

namespace Common.BLL.Logic.XGate
{
	public class gatedevice : BaseBLL.Logic.Base<BLL.Entity.XGate.gatedevice>
	{
		public gatedevice (object type) : base (type)
		{
		}

        #region Constrator
        private const string C_spUpdateStatusGateDevice = "spUpdateStatusGateDevice";
        private const string C_spDisconnectGateDevice = "spDisconnectGateDevice";
        private const string C_getInfoUser = "spGetInfoUser";
        private const string C_getInfoDevice = "spGetInfoDevice";
        private const string C_spLoadGateDeviceById = "spLoadGateDeviceById";
        #endregion

        #region Properties
       
        #endregion

        #region Methods


        /// <summary>
        /// Uodate status Gate
        /// </summary>
        /// <param name="state"></param>
        /// <returns></returns>
        public CommandResult UpdateStatusGate(string ip, Byte state)
        {
            CommandResult result = null;


            // Update Gate
            result = BaseDAL.DBaseHelper.executeCommand(BaseDAL.Base.EnumExecuteType.procedureNonQuery,
                connection, C_spUpdateStatusGateDevice, true,
                new KeyValuePair("@ip", ip),
                new KeyValuePair("@netState", state)
                );

            return result;
        }

        /// <summary>
        /// Disconnect Status Gate
        /// </summary>
        /// <returns></returns>
        public CommandResult DisconnectStatusGate()
        {
            CommandResult result = null;


            // Update Gate
            result = BaseDAL.DBaseHelper.executeCommand(BaseDAL.Base.EnumExecuteType.procedureNonQuery,
                connection, C_spDisconnectGateDevice, true);

            return result;
        }


  
        /// <summary>
        /// Load  User
        /// </summary>
        /// <returns></returns>
        public CommandResult loadUser(string cdn)
        {
            CommandResult result;
            result = BaseDAL.DBaseHelper.executeCommand(BaseDAL.Base.EnumExecuteType.procedureReader,
                                                            connection, C_getInfoUser, true,
                new KeyValuePair("@cdn", cdn)
                );

            return result;
        }

        /// <summary>
        /// Load  User
        /// </summary>
        /// <returns></returns>
        public CommandResult loadDevice(string ip)
        {
            CommandResult result;
            result = BaseDAL.DBaseHelper.executeCommand(BaseDAL.Base.EnumExecuteType.procedureReader,
                                                            connection, C_getInfoDevice, true,
                new KeyValuePair("@ip", ip)
                );

            return result;
        }

        /// <summary>
        /// Load  Gate Device By Id
        /// </summary>
        /// <returns></returns>
        public CommandResult loadDeviceById(int id)
        {
            CommandResult result;
            result = BaseDAL.DBaseHelper.executeCommand(BaseDAL.Base.EnumExecuteType.procedureReader,
                                                            connection, C_spLoadGateDeviceById, true,
                new KeyValuePair("@id", id)
                );

            return result;
        }
        #endregion
    }
}