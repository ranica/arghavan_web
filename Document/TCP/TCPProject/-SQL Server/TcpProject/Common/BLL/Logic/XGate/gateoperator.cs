using System;
using BaseDAL.Model;

namespace Common.BLL.Logic.XGate
{
	public class gateoperator : BaseBLL.Logic.Base<BLL.Entity.XGate.gateoperator>
	{
        #region Constants
        public const string C_SERVICE_USER = "ServiceUser";
        #endregion

        #region Method
    
        public gateoperator (object type) : base (type)
		{
		}
        #endregion


        #region Custom Method


        /// <summary>
        /// get service user
        /// </summary>
        /// <param name="user">User Model</param>
        /// <returns></returns>
        public CommandResult getServiceUser()
        {
            CommandResult result;

            Common.BLL.Entity.XGate.gateoperator user = new Entity.XGate.gateoperator()
            {
                username = C_SERVICE_USER
            };
            result = read(user, "username");

            if (user.id == 0)
                result = createServiceUser();
            else
                result.model = user;

            return result;
        }

        /// <summary>
        /// Create service user
        /// </summary>
        /// <param name="user">User Model</param>
        /// <returns></returns>
        public CommandResult createServiceUser()
        {
            CommandResult result;

            Common.BLL.Entity.XGate.gateoperator user = new Entity.XGate.gateoperator()
            {
                name = "Service",
                lastname = "",
                username = C_SERVICE_USER,
                password = @"$3r\/Ic3U53R",
                created_at = DateTime.Now,
               
            };
            result = create(user);
            result.model = user;

            return result;
        }

        #endregion
    }
}
