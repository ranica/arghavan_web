using Common.Enum;
using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Text;

namespace Common.BLL.Logic.SQLIKIU
{
    public class fodmember
    {
        // Code Student or Employee
        public const string PARAM_US = "@US";
        // National Code
        public const string PARAM_CM = "@CM";
        public const string PARAM_NAM = "@NAM";
        public const string PARAM_FAM = "@FAM";
        public const string PARAM_PN = "@PN";
        public const string PARAM_PS = "@PS";
        public const string PARAM_GRP = "@GRP";
        public const string PARAM_ORG = "@ORG";
        public const string PARAM_CONTRACT = "@CONTRACT";
        public const string PARAM_CDN = "@CDN";
        public const string PARAM_CARTNUMBER = "@CARTNUMBER";
        public const string PARAM_KINDCART = "@KINDCART";

        public const string GET_FODMEMBER_US = "SELECT * FROM fodmember WHERE us = " + PARAM_US;
        public const string GET_FODMEMBER_CM = "SELECT * FROM fodmember WHERE cm = " + PARAM_CM;
        public const string CHECK_CDN = "SELECT *  FROM fodmember WHERE cdn = " + PARAM_CDN + 
                                        " AND ( us != "+ PARAM_US + ")";       
                                        //" AND (cm != "+ PARAM_CM + " OR us != "+ PARAM_US + ")";       

        private const string UPDATE_MEMBER_CM = "UPDATE fodmember " +
                                                "SET  nam = " + PARAM_NAM +
                                                ", fam = " + PARAM_FAM +
                                                ", pn = " + PARAM_PN +
                                                ", us = " + PARAM_US +
                                                ", ps = " + PARAM_PS +
                                                ", grp = " + PARAM_GRP +
                                                ", org = " + PARAM_ORG +
                                                ", contract = " + PARAM_CONTRACT +
                                                ", cdn = " + PARAM_CDN +
                                                ", cartnumber = " + PARAM_CARTNUMBER +
                                                ", kindcart = " + PARAM_KINDCART +
                                                "  WHERE cm = " + PARAM_CM;

        private const string UPDATE_MEMBER_US = "UPDATE fodmember " +
                                                "SET  nam = " + PARAM_NAM +
                                                ", fam = " + PARAM_FAM +
                                                ", pn = " + PARAM_PN +
                                                ", cm = " + PARAM_CM +
                                                ", ps = " + PARAM_PS +
                                                ", grp = " + PARAM_GRP +
                                                ", org = " + PARAM_ORG +
                                                ", contract = " + PARAM_CONTRACT +
                                                ", cdn = " + PARAM_CDN +
                                                ", cartnumber = " + PARAM_CARTNUMBER +
                                                ", kindcart = " + PARAM_KINDCART +
                                                "  WHERE us = " + PARAM_US;


        /// <summary>
        /// Get Fodmember By Us
        /// </summary>
        /// <param name="data"></param>
        /// <returns></returns>
        public static Entity.SQLIKIU.fodmember GetFodMemberByUS(string data)
        {
            Entity.SQLIKIU.fodmember fodmembers = new Entity.SQLIKIU.fodmember();


            try
            {
                SqlParameter[] parameters =
                {
                        new SqlParameter( PARAM_US ,data)
                };

                SqlDataReader dataReader = foodSQLHelper.ExecuteReader(CommandType.Text, GET_FODMEMBER_US, parameters);

                if (!dataReader.HasRows)
                    return null;

                if (dataReader.Read())
                {
                    fodmembers.nam = dataReader["nam"].ToString();
                    fodmembers.fam = dataReader["fam"].ToString();
                    fodmembers.us = dataReader["us"].ToString().Trim();
                    fodmembers.cdn = dataReader["cdn"].ToString().Trim();
                    fodmembers.pn = dataReader["pn"].ToString().Trim();
                    fodmembers.cm = dataReader["cm"].ToString().Trim();
                    fodmembers.id = (int)dataReader["id"];
                    fodmembers.ps = dataReader["ps"].ToString().Trim();
                    fodmembers.contract = dataReader["contract"].ToString();
                    fodmembers.org = dataReader["org"].ToString();
                    fodmembers.kindcart = (int)dataReader["kindcart"];
                    fodmembers.cartnumber = dataReader["cartnumber"].ToString();
                    fodmembers.grp = (int)dataReader["grp"];

                }

                return fodmembers ?? null;
            }
            catch (Exception ex)
            {
                LoggerExtensions.log(ex);
                return null;

            }
        }

        /// <summary>
        /// Get Fodmember By CM
        /// </summary>
        /// <param name="data"></param>
        /// <returns></returns>
        public static Entity.SQLIKIU.fodmember GetFodMemberByCM(string data)
        {
            Entity.SQLIKIU.fodmember fodmembers = new Entity.SQLIKIU.fodmember();
            SqlDataReader dataReader;

            try
            {

                SqlParameter[] parameters =
                {
                        new SqlParameter( PARAM_CM ,data)
                };

                dataReader = foodSQLHelper.ExecuteReader(CommandType.Text, GET_FODMEMBER_CM, parameters);

                if (!dataReader.HasRows)
                    return null;

                if (dataReader.Read())
                {
                    fodmembers.nam = dataReader["nam"].ToString();
                    fodmembers.fam = dataReader["fam"].ToString();
                    fodmembers.us = dataReader["us"].ToString().Trim();
                    fodmembers.cdn = dataReader["cdn"].ToString().Trim();
                    fodmembers.pn = dataReader["pn"].ToString().Trim();
                    fodmembers.cm = dataReader["cm"].ToString().Trim();
                    fodmembers.id = (int)dataReader["id"];
                    fodmembers.ps = dataReader["ps"].ToString().Trim();
                    fodmembers.contract = dataReader["contract"].ToString();
                    fodmembers.org = dataReader["org"].ToString();
                    fodmembers.kindcart = (int)dataReader["kindcart"];
                    fodmembers.cartnumber = dataReader["cartnumber"].ToString();
                    fodmembers.grp = (int)dataReader["grp"];

                }

                return fodmembers ?? null;
            }
            catch (Exception ex)
            {
                LoggerExtensions.log(ex);
                return null;

            }
        }

        /// <summary>
        /// Update Info fodmember Tabel
        /// </summary>
        /// <param name="data"></param>
        /// <param name="typeUpdate"></param>
        /// <returns></returns>
        public static bool UpdateFodmember(Common.BLL.Entity.SQLIKIU.fodmember data, int typeUpdate)
        {
            //bool result = false;
            try
            {
                string date = String.Format("{0:yyyy-MM-dd}", DateTime.Now);
                //DateTime dat	=  DateTime.Now;

                SqlParameter[] parameters =
                {
                    new SqlParameter(PARAM_NAM ,data.nam),
                    new SqlParameter(PARAM_FAM, data.fam),
                    new SqlParameter(PARAM_PN , data.pn),
                    new SqlParameter(PARAM_US , data.us),
                    new SqlParameter(PARAM_PS , data.ps),
                    new SqlParameter(PARAM_GRP , data.grp),
                    new SqlParameter(PARAM_ORG , data.org),
                    new SqlParameter(PARAM_CONTRACT , data.contract),
                    new SqlParameter(PARAM_CDN , data.cdn),
                    new SqlParameter(PARAM_CARTNUMBER , data.cartnumber),
                    new SqlParameter(PARAM_CM, data.cm),
                    new SqlParameter(PARAM_KINDCART, data.kindcart)
            };
                if (typeUpdate == (int)EnumSearchType.number)
                    return foodSQLHelper.ExecuteNonQuery(CommandType.Text, UPDATE_MEMBER_US, parameters) != 0;
                else if (typeUpdate == (int)EnumSearchType.nationalcode)
                    return foodSQLHelper.ExecuteNonQuery(CommandType.Text, UPDATE_MEMBER_CM, parameters) != 0;

            }
            catch (Exception ex)
            {
                LoggerExtensions.log(ex);

            }
            return false;
        }

        public static bool DuplicateCDN(string cdn, string cm )
        {
            bool result = false;
            try
            {
                SqlParameter[] parameters =
                {
                        new SqlParameter( PARAM_CDN ,cdn),
                        new SqlParameter( PARAM_CM ,cm)
                };

                SqlDataReader dataReader = foodSQLHelper.ExecuteReader(CommandType.Text, CHECK_CDN, parameters);

                if (!dataReader.HasRows)
                    result =  false;

                if (dataReader.Read())
                    result = true;

            }
            catch (Exception ex)
            {
                LoggerExtensions.log(ex);
                result = true;
            }

            return result;
        }
    }
}
