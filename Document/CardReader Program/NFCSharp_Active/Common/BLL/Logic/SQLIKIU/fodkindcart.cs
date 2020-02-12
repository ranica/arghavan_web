using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Text;

namespace Common.BLL.Logic.SQLIKIU
{
    public class fodkindcart
    {
        #region Varibales     
        private const string  GET_KIND_CART= "SELECT * FROM fodkindcart";
        #endregion

        #region Methods      

        /// <summary>
        /// List Kind Card
        /// </summary>
        /// <returns></returns>
        public static List <Entity.SQLIKIU.fodkindcart> GetFoodKindCard()
        {
            try
            {               
                List<Entity.SQLIKIU.fodkindcart> lstfodkindcart = new List<Entity.SQLIKIU.fodkindcart>();
                Entity.SQLIKIU.fodkindcart fodkindkart;            
                SqlDataReader dataReader = foodSQLHelper.ExecuteReader(CommandType.Text, GET_KIND_CART);

                if (!dataReader.HasRows)
                    return null;
                else
                {
                    while (dataReader.Read())
                    {
                        fodkindkart = new Entity.SQLIKIU.fodkindcart();
                        fodkindkart.id = (int)dataReader["id"];
                        fodkindkart.nam = dataReader["nam"].ToString();
                      
                        lstfodkindcart.Add(fodkindkart);
                    }
                }

                return lstfodkindcart;


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
