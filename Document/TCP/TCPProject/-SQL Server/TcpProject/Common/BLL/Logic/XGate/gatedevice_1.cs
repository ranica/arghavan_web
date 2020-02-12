using System;
using BaseDAL.Model;
using System.Collections.Generic;
using System.Linq;

namespace Common.BLL.Logic.XGate
{
	public class gatedevice_1 : BaseBLL.Logic.Base<BLL.Entity.XGate.gatedevice_1>
    {
        public gatedevice_1(object type) 
            : base (type)
		{
        }
        #region Constrator
        private const string C_spUpdateStatusGateDevice = "spUpdateStatusGateDevice";
        private const string C_spDisconnectGateDevice = "spDisconnectGateDevice";
        private const string C_getInfoUser = "getInfoUser";
        private const string C_getInfoDevice = "getInfoDevice";
        #endregion

        #region Properties
        // Info IP , Direction : input or Output
        public static Dictionary<string, int> dicIpAddress = new Dictionary<string, int>();
        // Public List Device
        public static List<Common.BLL.Entity.XGate.gatedevice> listDevice;
       
        private const string PARAM_STATE = "@STATE";
        private const string PARAM_IP = "@IP";
        private const string PARAM_NETSTATE = "@NETSTATE";

        private const string SELECT_DEVICE = "SELECT * FROM gate_devices WHERE state = 1";
        private const string SELECT_DEVICEByIP = "SELECT * FROM gate_devices WHERE ip = " + PARAM_IP;
        private const string UPDATE_DEVICE = "UPDATE  gate_devices SET netState = " + PARAM_NETSTATE +
                                                "  WHERE ip = " + PARAM_IP;
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
                connection, C_spUpdateStatusGateDevice, true);

            return result;
        }


        public CommandResult getListDevice()
        {
            CommandResult result = null;


            return result;

        }
        /// <summary>
        /// Get Direction Device
        /// </summary>
        /// <param name="ip"></param>
        /// <returns></returns>
        /// 
        //public static string gatedirection(string ip)
        //{
        //    string result = "";

        //    if (null != dicIpAddress)
        //    {
        //        var item = dicIpAddress.First(kvp => kvp.Key == ip).Value;
        //        result = item.ToString();
        //    }

        //    return result;
        //}

        /// <summary>
        /// Get Device 
        /// </summary>
        /// <param name="ip"></param>
        /// <returns></returns>
        //public static Common.BLL.Entity.XGate.gatedevice GetDevice(string ip, int direct)
        //{
        //    try
        //    {
        //        Common.BLL.Entity.XGate.gatedevice list_device =
        //                        new Common.BLL.Entity.XGate.gatedevice();

        //        if (listDevice.Count > 0)
        //        {
        //            var _device = listDevice.Where(r => r.Ip == ip).FirstOrDefault();

        //            if (null != _device)
        //            {
        //               // list_device..Id = _device.Id;
        //                list_device.Name = _device.Name;
        //                list_device.State = _device.State;
        //                list_device.GateGender_id = _device.GateGender_id;
        //                list_device.Zone_id = _device.Zone_id;

        //                list_device.GateDirect_id = direct;

        //                return list_device;
        //            }
        //            else
        //                return null;
        //        }
        //        else
        //            return null;


        //    }
        //    catch (Exception ex)
        //    {
        //        LoggerExtension.log(ex);
        //        return null;
        //    }
        //}
        

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

        #endregion
    }
}