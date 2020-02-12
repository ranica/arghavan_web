using Common.BLL.Entity.SQLIKIU;
using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Text;

namespace Common.BLL.Logic.SQLIKIU
{	
	public class foodReserve
	{
		private const string PARAM_CDN				= "@CDN";
		private const string PARAM_US				= "@US";		 
		private const string PARAM_DATE				= "@Date";
		private const string PARAM_VADE				= "@VADE";
		private const string PARAM_CODE_FORGET		= "@FORGET";
		private const string PARAM_FOODSTATUS		= "@FOODSTATUS";
		private const string PARAM_DEVICEID			= "@DEVICEID";
		private const string PARAM_DATRECIVE		= "@DATRECIVE";
		private const string PARAM_PROGRAM_ID		= "@PROGRAMID";


		private const string SELECT_PERSON			= "SELECT nam, fam, us FROM fodmember WHERE cdn ="+ PARAM_CDN;

		private const string SELECT_PERSON_BYUS		= "SELECT nam, fam  FROM fodmember WHERE us ="+ PARAM_US;
		
		private const string SELECT_PERSON_REZERV	= "SELECT dat, programid, foodstatus, kind, selfid, devicid, datrecive, vade, color  FROM fodrezerv WHERE us =" 
														+ PARAM_US + " and dat="+ PARAM_DATE + " and vade=" + PARAM_VADE; 

		private const string SELECT_FORGET_REZERV	= "SELECT us, dat, programid, foodstatus, kind, selfid, devicid, datrecive, vade, color  FROM fodrezerv WHERE codforget =" 
														+ PARAM_CODE_FORGET + " and dat="+ PARAM_DATE + " and vade=" + PARAM_VADE; 

		private const string SELECT_PORGRAM			= "SELECT drink  FROM fodprogram WHERE id=" + PARAM_PROGRAM_ID;
		
		private const string UPDATE_PERSON_REZERV	= "UPDATE fodrezerv SET foodstatus=" + PARAM_FOODSTATUS + " ,datrecive=" + 
													  PARAM_DATRECIVE + " ,devicid="+ PARAM_DEVICEID
													+ " WHERE us =" + PARAM_US + " and dat =" + PARAM_DATE;

		private const string INSERT_LOG				= "INSERT INTO fodlog  foodstatus=" + PARAM_FOODSTATUS + " datrecive=" + 
													  PARAM_DATRECIVE + " devicid="+ PARAM_DEVICEID
													+ " WHERE us =" + PARAM_US + " and dat =" + PARAM_DATE;



		/// <summary>
		/// Get Person By Code Kart
		/// </summary>
		/// <param name="cdn"></param>
		/// <returns></returns>
		public static infoPerson GetPerson(string cdn)
        {
			infoPerson	infoperson = new infoPerson();

            try
            {       
        		 SqlParameter[] parameters =
                {
                    new SqlParameter(PARAM_CDN	,SqlDbType.NVarChar,50)                    
                };

                parameters[0].Value = cdn;
               
                SqlDataReader dataReader = foodSQLHelper.ExecuteReader(CommandType.Text, SELECT_PERSON, parameters);
                if (!dataReader.HasRows)
                    return null;

                if (dataReader.Read())
				{					
					infoperson.name		= dataReader.GetString(0);
					infoperson.lastname	= dataReader.GetString(1);
					infoperson.us		= dataReader.GetString(2);
				}                                 

                return infoperson ?? null;
            }
            catch (Exception ex)
            {
                
            }
            return null;
        }

		public static infoPerson GetPersonbyUS(string us)
        {
			infoPerson	infoperson = new infoPerson();

            try
            {       
        		 SqlParameter[] parameters =
                {
                    new SqlParameter(PARAM_US	,SqlDbType.NVarChar,50)                    
                };

                parameters[0].Value = us;
               
                SqlDataReader dataReader = foodSQLHelper.ExecuteReader(CommandType.Text, SELECT_PERSON_BYUS, parameters);
                if (!dataReader.HasRows)
                    return null;

                if (dataReader.Read())
				{					
					infoperson.name		= dataReader.GetString(0);
					infoperson.lastname	= dataReader.GetString(1);
					infoperson.us		= us;
				}                                 

                return infoperson ?? null;
            }
            catch (Exception ex)
            {
                
            }
            return null;
        }

		/// <summary>
		/// Get Last Status Food by us
		/// </summary>
		/// <param name="us"></param>
		/// <param name="vade"></param>
		/// <returns></returns>
		public static food GetLastStatusFood(string us, int vade)
		{			
			var src = DateTime.Now;			
			var foodInfos  = new food();
			try
			{				
				 SqlParameter[] parameters =
                {
                    new SqlParameter(PARAM_US	,SqlDbType.NVarChar,50),                   
                   	new SqlParameter(PARAM_DATE	,SqlDbType.DateTime),
					new SqlParameter(PARAM_VADE	,SqlDbType.Int)
                };

				//string date2 = 	String.Format("{0}", src.ToString("u"));

                parameters[0].Value = us;
				string dateme		= String.Format("{0:yyyy-MM-dd}", src);
				parameters[1].Value = (dateme);
                parameters[2].Value = vade;
               

				SqlDataReader dataReader = foodSQLHelper.ExecuteReader(CommandType.Text, SELECT_PERSON_REZERV, parameters);
                if (!dataReader.HasRows)
                    return  foodInfos;

                if (dataReader.Read())
				{					
					foodInfos.dat			= Convert.ToDateTime(dataReader["dat"]);
					foodInfos.programId		= Convert.ToInt32(dataReader["programid"]);
					foodInfos.foodstatus	= Convert.ToInt32(dataReader["foodstatus"]);
					foodInfos.kind			= Convert.ToInt32(dataReader["kind"]);
					foodInfos.selfid		= Convert.ToInt32(dataReader["selfid"]);
					foodInfos.deviceid		= Convert.ToInt32(dataReader["devicid"]);
					string dd = dataReader["datrecive"].ToString();

					if("" != dataReader["datrecive"].ToString())
						foodInfos.datReceive = Convert.ToDateTime(dataReader["datrecive"]);	
				
					foodInfos.meal			= Convert.ToInt32(dataReader["vade"]);
					foodInfos.color			= Convert.ToInt32(dataReader["color"]);
				}	  
                     
				return foodInfos;
			}

			catch (Exception ex)
			{				
				return foodInfos;
			}
		}

		/// <summary>
		/// Update Status Food
		/// </summary>
		/// <param name="foodStatus"></param>
		/// <param name="deviceId"></param>
		/// <returns></returns>
		public static bool UpdateStatusFood(int foodStatus, int deviceId, string us)
        {
            try
            {
				var src = DateTime.Now;	
				string date		= String.Format("{0:yyyy-MM-dd}", src);

                SqlParameter[] parameters =
                {
                    new SqlParameter(PARAM_FOODSTATUS	,SqlDbType.Int),
                    new SqlParameter(PARAM_DATRECIVE	,SqlDbType.DateTime),
                    new SqlParameter(PARAM_DEVICEID		,SqlDbType.Int),
                    new SqlParameter(PARAM_US		    ,SqlDbType.NVarChar,50),
					new SqlParameter(PARAM_DATE			,SqlDbType.DateTime),

                };

                parameters[0].Value = foodStatus;
                parameters[1].Value = DateTime.Now;
                parameters[2].Value = deviceId;
				parameters[3].Value = us;
				parameters[4].Value = date;

                return foodSQLHelper.ExecuteNonQuery(CommandType.Text, UPDATE_PERSON_REZERV, parameters) != 0;
            }
            catch (Exception e)
            {
				//EventLogHandler.CreateEventLog(e.Message);
            }
            return false;
        }

		public static string GetFoodName(int programId)
		{
			string nameFood = null;
            try
            {       
        		 SqlParameter[] parameters =
                {
                    new SqlParameter(PARAM_PROGRAM_ID	,SqlDbType.Int)                    
                };

                parameters[0].Value = programId;
               
                SqlDataReader dataReader = foodSQLHelper.ExecuteReader(CommandType.Text, SELECT_PORGRAM, parameters);
                if (!dataReader.HasRows)
                    return null;
                if (dataReader.Read())
                    nameFood = dataReader.GetString(0);                

                return nameFood ?? null;
            }
            catch (Exception ex)
            {
                
            }
            return null;
		}	

		public static bool InsertLogFood(int foodStatus, int deviceId)
        {
            try
            {
                SqlParameter[] parameters =
                {
                    new SqlParameter(PARAM_FOODSTATUS	,SqlDbType.Int),
                    new SqlParameter(PARAM_DATRECIVE	,SqlDbType.DateTime),
                    new SqlParameter(PARAM_DEVICEID		,SqlDbType.Int)
                };

                parameters[0].Value = foodStatus;
                parameters[1].Value = DateTime.Now;
                parameters[2].Value = deviceId;

                return foodSQLHelper.ExecuteNonQuery(CommandType.Text, UPDATE_PERSON_REZERV, parameters) != 0;
            }
            catch (Exception e)
            {
				//EventLogHandler.CreateEventLog(e.Message);
            }
            return false;
        }


		public static food GetLastStatusFoodByCodeForget(string codeforget, int vade)
		{			
			var src = DateTime.Now;			
			var foodInfos  = new food();
			try
			{				
				 SqlParameter[] parameters =
				{
					new SqlParameter(PARAM_CODE_FORGET	,SqlDbType.NVarChar,50),                   
					new SqlParameter(PARAM_DATE	,SqlDbType.DateTime),
					new SqlParameter(PARAM_VADE	,SqlDbType.Int)
				};

				//string date2 = 	String.Format("{0}", src.ToString("u"));

				parameters[0].Value = codeforget;
				string dateme		= String.Format("{0:yyyy-MM-dd}", src);
				parameters[1].Value = (dateme);
				parameters[2].Value = vade;
               

				SqlDataReader dataReader = foodSQLHelper.ExecuteReader(CommandType.Text, SELECT_FORGET_REZERV, parameters);
				if (!dataReader.HasRows)
					return  foodInfos;

				if (dataReader.Read())
				{					
					foodInfos.dat			= Convert.ToDateTime(dataReader["dat"]);
					foodInfos.programId		= Convert.ToInt32(dataReader["programid"]);
					foodInfos.foodstatus	= Convert.ToInt32(dataReader["foodstatus"]);
					foodInfos.kind			= Convert.ToInt32(dataReader["kind"]);
					foodInfos.selfid		= Convert.ToInt32(dataReader["selfid"]);
					foodInfos.deviceid		= Convert.ToInt32(dataReader["devicid"]);
					foodInfos.us			= dataReader["us"].ToString();
					string dd = dataReader["datrecive"].ToString();

					if("" != dataReader["datrecive"].ToString())
						foodInfos.datReceive = Convert.ToDateTime(dataReader["datrecive"]);	
				
					foodInfos.meal			= Convert.ToInt32(dataReader["vade"]);
					foodInfos.color			= Convert.ToInt32(dataReader["color"]);
				}	  
                     
				return foodInfos;
			}

			catch (Exception ex)
			{				
				return foodInfos;
			}
		}
		 
	}
}
