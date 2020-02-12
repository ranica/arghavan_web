using Common.BLL.Entity.IAU;
using Common.BLL.Logic.IAU;
using Common.Enum;
using Common.Helper.Logger;
using Common.Model;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Linq;
using System.Text;


namespace Common.BLL.Logic.IAU
{
    public class gitLog
    {
        #region Variables 		
        public static ListInfo _info = new ListInfo();
        public static int genzoon;
        public static user _userinfo;

        private const string PARAM_US = "@US";
        private const string PARAM_CDN = "@CDN";
        private const string PARAM_DAT = "@DATE";
        private const string PARAM_DEVICE_ID = "@DEVICEID";
        private const string PARAM_PASSTYPE_ID = "@PASSTYPE";
        private const string PARAM_DIRECT_ID = "@DIRECTID";
        private const string PARAM_MSG_ID = "@MSGID";
        private const string PARAM_CREATED_AT = "@CREATED_AT";
        private const string PARAM_UPDATED_AT = "@UPADTED_AT";
        private const string PARAM_ALLOW = "@ALLOW";

        private const string SELECT_TOP_TRAFFIC = "SELECT * FROM gate_traffics  WHERE us = " + PARAM_US + " AND msg_id = " + PARAM_ALLOW +
                    " ORDER BY dat DESC LIMIT 1";

        private const string UPDATE_TOP_TRAFFIC = "UPDATE  gate_traffics  Set msg_id   = " + PARAM_MSG_ID +
                                    " WHERE us = " + PARAM_US + " AND  msg_id = " + PARAM_ALLOW +
                                   "  ORDER BY dat DESC LIMIT 1";

        private const string CHECK_EXIST_TRAFFIC = "SELECT * FROM gate_traffics  WHERE us = " + PARAM_US + " ORDER BY dat DESC LIMIT 1";


        private const string INSERT_TRAFFIC = "INSERT INTO gate_traffics  (us, cdn, dat, device_id, passtype_id" +
                                                                          ",direct_id, msg_id, created_at, updated_at)  VALUES ("
                                                                           + PARAM_US + ", "
                                                                           + PARAM_CDN + ", "
                                                                           + PARAM_DAT + ", "
                                                                           + PARAM_DEVICE_ID + ", "
                                                                           + PARAM_PASSTYPE_ID + ", "
                                                                           + PARAM_DIRECT_ID + ", "
                                                                           + PARAM_MSG_ID + ", "
                                                                           + PARAM_CREATED_AT + ", "
                                                                           + PARAM_UPDATED_AT + ")";

        public class existPass
        {
            public int direct_id;
            public int msg_id;
        }

        #endregion

        #region Methods
        /// <summary>
        /// Kart Unkown 
        /// </summary>
        /// <param name="ip"></param>
        /// <param name="_dev"></param>
        /// <param name="_opt"></param>
        public static void kartUnkown(string ip, device _dev, option _opt)
        {
            try
            {
                int result = (int)EnumMessageType.unkownCard;
                _userinfo = new user();
                _userinfo.studentId = "0";
                _userinfo.Name = "";
                _userinfo.Family = "";
                _userinfo.Pic = null;
                _userinfo.CodeCard = "000";
                gitLog.saveLogUser(_userinfo, _dev.Id, (int)_dev.Direction, result);
            }
            catch (Exception ex)
            {
                LoggerExtension.log(ex);
            }
            
        }

        /// <summary>
        /// Check kart 
        /// </summary>
        /// <param name="ip"></param>
        /// <param name="kart"></param>
        /// <param name="_host"></param>
        /// <param name="_opt"></param>
        /// <returns></returns>
        public static int kartLicense(string ip, string kart, device _host, option _opt)
        {
            try
            {
                _userinfo = null;
                int result = 0;
                existPass edata = new existPass();

                if (ListInfo.notExistKart(kart))
                {
                    _info.kart = kart;
                    ListInfo.dicData.Add(ip, _info);

                    _userinfo = gitUser._lstUser.Where(r => r.CodeCard == kart).FirstOrDefault();

                    if (null != _userinfo)
                    {
                        MySqlParameter[] parameters =
                        {
                        new MySqlParameter(PARAM_US   , _userinfo.studentId)
                    };

                        MySqlDataReader dataReader = MySQLHelper.ExecuteReader(CommandType.Text, CHECK_EXIST_TRAFFIC, parameters);
                        if (!dataReader.HasRows)
                            edata = null;
                        if (dataReader.Read())
                        {
                            edata.direct_id = Convert.ToInt32(dataReader["direct_id"]);
                            edata.msg_id = Convert.ToInt32(dataReader["msg_id"]);
                        }

                        #region Valid Card
                        _info.stu_id = _userinfo.studentId;

                        //if (_userinfo.Suitmem == (int)EnumSuitType.yes)
                        //{
                        // دانشجو خوابگاهی می باشد
                        #region User is Suit
                        if (_opt.DatEndSuit >= DateTime.Now)
                        {
                            //EventLogHandler.CreateEventLog ("User is Suit");
                            #region Date traffic

                            if (_userinfo.EndDate >= DateTime.Now)
                            {
                                //EventLogHandler.CreateEventLog ("Date traffic");
                                #region Date End  is Valid

                                if ((bool)_userinfo.Active)
                                {
                                    //EventLogHandler.CreateEventLog ("User is Active");
                                    #region User is Active

                                    if (_host != null)
                                    {
                                        //EventLogHandler.CreateEventLog ("Device have network");
                                        #region Device have network
                                        if (_host.Gen == (int)EnumGenType.Both || _userinfo.Gen == _host.Gen)
                                        {
                                            #region Gen Device is Ok
                                            if (_host.Zoon == 1)
                                            {
                                                #region Zoon is Ok											
                                                // برنامه به تکرار تردد حساس است ی نه؟
                                                if (_userinfo.Gen == (int)EnumGenType.Woman)
                                                    genzoon = _opt.Genzoonw;

                                                else if (_userinfo.Gen == (int)EnumGenType.Man)
                                                    genzoon = _opt.Genzoonm;

                                                switch (genzoon)
                                                {
                                                    #region Switch

                                                    case (int)EnumTypeGenzoon.Allow:
                                                        {
                                                            result = (int)EnumMessageType.allow;
                                                            //EventLogHandler.CreateEventLog ("EnumTypeGenzoon.Allow");
                                                        }
                                                        break;
                                                    case (int)EnumTypeGenzoon.AllowByUser: // برنامه به تکرار تردد حساس است
                                                        {
                                                            if (_opt.Emergency == 0) //وضعیت اضطراری فعال نمی باشد
                                                            {
                                                                if (null != edata)
                                                                {
                                                                    #region duplicate traffic

                                                                    //قبلا تردد داشته است 
                                                                    if (edata.direct_id == _host.Direction)
                                                                    {
                                                                        switch (edata.msg_id)
                                                                        {
                                                                            case 1:
                                                                            case 13:
                                                                            case 14:
                                                                            case 15: result = (int)EnumMessageType.allow; break;

                                                                            case 2: result = (int)EnumMessageType.duplicatPass; break;
                                                                            case 0:
                                                                            case 3:
                                                                            case 4:
                                                                            case 5:
                                                                            case 6:
                                                                            case 7:
                                                                            case 8:
                                                                            case 9:
                                                                            case 10:
                                                                            case 11: result = (int)EnumMessageType.existPass; break;

                                                                        }
                                                                    }
                                                                    else
                                                                        result = (int)EnumMessageType.allow;
                                                                    #endregion
                                                                }
                                                                else
                                                                    result = (int)EnumMessageType.allow;
                                                            }

                                                            else if (_opt.Emergency == 1)
                                                            {
                                                                result = (int)EnumMessageType.emergency;

                                                                if (_host.Direction == (int)EnumDirection.input)
                                                                    gitLog.saveLogUser(_userinfo, _host.Id, (int)EnumDirection.output, result);

                                                                else
                                                                    gitLog.saveLogUser(_userinfo, _host.Id, (int)EnumDirection.input, result);

                                                                result = (int)EnumMessageType.allow;
                                                            }

                                                        }
                                                        break;
                                                    case (int)EnumTypeGenzoon.Auto:
                                                        {
                                                            result = (int)EnumMessageType.InsertByAuto;
                                                            if (_host.Direction == (int)EnumDirection.input)
                                                                gitLog.saveLogUser(_userinfo, _host.Id, (int)EnumDirection.output, result);
                                                            else
                                                                gitLog.saveLogUser(_userinfo, _host.Id, (int)EnumDirection.input, result);

                                                            result = (int)EnumMessageType.allow;

                                                        }
                                                        break;
                                                        #endregion
                                                }

                                                #endregion
                                            }
                                            else
                                                // ناحیه تردد مجاز نمی باشد
                                                result = (int)EnumMessageType.zone;
                                            #endregion
                                        }

                                        else
                                            // جنسیت مطابقت ندارد
                                            result = (int)EnumMessageType.gen;
                                        #endregion
                                    }
                                    else
                                        // دستگاه معتبر نمی باشد
                                        result = (int)EnumMessageType.deaciveDevice;
                                    #endregion
                                }
                                else
                                    // شخص فعال نمی باشد
                                    result = (int)EnumMessageType.deactivePerson;
                                #endregion
                            }
                            else
                                // تاریخ کارت مجاز نمی باشد
                                result = (int)EnumMessageType.expairedCard;
                            #endregion
                        }
                        else
                            // تاریخ ورود به خوابگاه مجاز نمی باشد
                            result = (int)EnumMessageType.expairedDepartment;
                        #endregion
                        //}
                        //else
                        //	// خوابگاهی نمی باشد
                        //	result = (int)EnumMessageType.dontSuit;

                        #endregion
                    }
                    else
                        result = (int)EnumMessageType.unkownCard;
                }
                else
                    result = (int)EnumMessageType.duplicatPass;



                if (result == (int)EnumMessageType.unkownCard)
                {
                    _userinfo.studentId = "0";
                    _userinfo.Pic = null;
                    gitLog.saveLogUser(_userinfo, _host.Id, (int)_host.Direction, result);
                }
                else
                    gitLog.saveLogUser(_userinfo, _host.Id, (int)_host.Direction, result);

                return result;
            }
            catch (Exception ex)
            {
                LoggerExtension.log(ex);
                return -1;
            }
           
        }


        /// <summary>
        /// Save log user every reason
        /// </summary>
        /// <param name="_userinfo"></param>
        /// <param name="idDevice"></param>
        /// <param name="direct"></param>
        /// <param name="status"></param
        public static void saveLogUser(user _userinfo, int idDevice, int direct, int status)
        {
            try
            {

                MySqlParameter[] parameters =
                {
                    //TODO:: Save pic
                    new MySqlParameter(PARAM_CDN          , _userinfo.CodeCard ?? (object)DBNull.Value),
                    new MySqlParameter(PARAM_US           , _userinfo.studentId ?? (object)DBNull.Value),
                    new MySqlParameter(PARAM_DAT          , DateTime.Now),
                    new MySqlParameter(PARAM_DEVICE_ID    ,idDevice),
                    new MySqlParameter(PARAM_PASSTYPE_ID  ,_userinfo.Typepass),
                    new MySqlParameter(PARAM_DIRECT_ID    ,direct),
                    new MySqlParameter(PARAM_MSG_ID       ,status),
                    new MySqlParameter(PARAM_CREATED_AT   ,DateTime.Now),
                    new MySqlParameter(PARAM_UPDATED_AT   ,DateTime.Now)
                };

                MySQLHelper.ExecuteNonQuery(CommandType.Text, INSERT_TRAFFIC, parameters);
            }
            catch (Exception ex)
            {
                LoggerExtension.log(ex);
            }
        }

        /// <summary>
        /// Save Pass or dont pass user
        /// </summary>
        /// <param name="kart"></param>
        /// <param name="tagPass"></param>
        public static void saveLogUserPass(string host, bool tagPass)
        {
            try
            {
                int msg;

                if (null != gitUser._lstUser)
                {
                    var stuId = gitUser._lstUser.Where(r => r.Ip == host).FirstOrDefault();

                    MySqlParameter[] parameters =
                    {
                        new MySqlParameter(PARAM_US     ,stuId.studentId),
                        new MySqlParameter(PARAM_ALLOW  ,(int)EnumMessageType.allow)
                    };


                    MySqlDataReader dataReader = MySQLHelper.ExecuteReader(CommandType.Text, SELECT_TOP_TRAFFIC, parameters);
                    if (!dataReader.HasRows)
                        return;
                    if (dataReader.Read())
                    {
                        // ذخیره وضعیت تردد شخص
                        if (tagPass)
                        {
                            // شخص عبور کرد
                            msg = (int)EnumMessageType.pass;
                        }
                        else
                        {
                            // شخص عبور نکرد
                            msg = (int)EnumMessageType.dontpass;
                        }

                        MySqlParameter[] parameter =
                        {
                            new MySqlParameter(PARAM_US   , stuId.studentId),
                            new MySqlParameter(PARAM_ALLOW  ,(int)EnumMessageType.allow),
                            new MySqlParameter(PARAM_MSG_ID    , msg)
                        };

                        MySQLHelper.ExecuteNonQuery(CommandType.Text, UPDATE_TOP_TRAFFIC, parameter);
                    }
                }
            }
            catch (Exception ex)
            {
                LoggerExtension.log(ex);
            }
        }
        #endregion
    }
}
