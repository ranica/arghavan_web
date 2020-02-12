using System;
using BaseDAL.Model;

namespace Common.BLL.Logic.XGate
{
	public class gateerror : BaseBLL.Logic.Base<BLL.Entity.XGate.gateerror>
	{
        #region Constants
        private const string C_spInsertLog = "spInsertLog";
        #endregion

        #region Method
        public gateerror(object type) : base(type)
        {
        }

        #endregion

        #region Custom Method
        /// <summary>
        /// Insert Log in Gate Error Table
        /// </summary>
        /// <param name="error"></param>
        /// <returns></returns>
        public CommandResult InsertLog(Common.BLL.Entity.XGate.gateerror error)
        {
            CommandResult result = null;
            // Ineset new Error
            result = BaseDAL.DBaseHelper.executeCommand(BaseDAL.Base.EnumExecuteType.procedureNonQuery,
                connection, C_spInsertLog, true,

                new KeyValuePair("@error", error.error),
                new KeyValuePair("@eSource",error.eSource),
                new KeyValuePair("@eStackTrace", error.eStackTrace),
                new KeyValuePair("@InnerException", error.eInnerException),
                new KeyValuePair("@eTargetSite", error.eTargetSite),
                new KeyValuePair("@eTargetSiteName", error.eTargetSiteName),
                new KeyValuePair("@eTargetSiteModule", error.eTargetSiteModule),
                new KeyValuePair("@created_at", DateTime.Now)

                );

            return result;
        }
        #endregion
    }
}