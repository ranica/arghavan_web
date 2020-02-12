using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Text;

namespace Common.BLL.Logic.SQLIKIU
{
    public class foduserfood
    {
        #region Varibales     
        private const string GET_USER_FOOD = "SELECT * FROM foduserfood";
        #endregion

        #region Methods      

        /// <summary>
        /// List Kind Card
        /// </summary>
        /// <returns></returns>
        public static List<Entity.SQLIKIU.foduserfood> GetFoodUserFood()
        {
            try
            {
                List<Entity.SQLIKIU.foduserfood> lstfoduserfoods = new List<Entity.SQLIKIU.foduserfood>();
                Entity.SQLIKIU.foduserfood foduserfoods;
                SqlDataReader dataReader = foodSQLHelper.ExecuteReader(CommandType.Text, GET_USER_FOOD);

                if (!dataReader.HasRows)
                    return null;
                else
                {
                    while (dataReader.Read())
                    {
                        foduserfoods = new Entity.SQLIKIU.foduserfood();
                        foduserfoods.id = (int)dataReader["id"];
                        foduserfoods.nam = dataReader["nam"].ToString();

                        lstfoduserfoods.Add(foduserfoods);
                    }
                }

                return lstfoduserfoods;
            }
            catch (Exception ex)
            {
                LoggerExtensions.log(ex);
                return null;
            }
        }

        #endregion
    }
}
