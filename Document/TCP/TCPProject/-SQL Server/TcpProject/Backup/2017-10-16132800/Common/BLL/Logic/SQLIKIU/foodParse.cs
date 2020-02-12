using Common.BLL.Entity.SQLIKIU;
using Common.Enum;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Linq;
using System.Text;

namespace Common.BLL.Logic.SQLIKIU
{
	public class foodParse
	{
		#region Properties

		public static infoPerson infoDic = null;

		#endregion		
	
		#region Methods	
		/// <summary>
		/// Parse Code Kart
		/// </summary>
		/// <param name="strID"></param>
		public static int ParseCode (string strID)
		{
			infoDic = null;
			var src = DateTime.Now;		
			string date		= String.Format("{0:yyyy-MM-dd}", src);
			int result = -1;
			try
			{
				int meal	= Convert.ToInt32(ConfigurationManager.AppSettings["meal"]);
				int self	= Convert.ToInt32(ConfigurationManager.AppSettings["selfNumber"]);
				int device	= Convert.ToInt32(ConfigurationManager.AppSettings["deviceNumber"]);
				
				infoDic = foodReserve.GetPerson(strID);				
							
				if (null != infoDic)
				{	
					#region Found Kart	
					infoDic.cdn = strID;
					if ( infoDic.us.ToLower() != "000" || infoDic.us.ToLower() != "0")
					{
						#region Define Kart
						food  foodInfos = foodReserve.GetLastStatusFood(infoDic.us,meal);						
						
							if ( foodInfos.dat == Convert.ToDateTime(date))
							{
								#region Date is ok							
							
								//if (foodInfos.meal == meal)
								//{
								//	#region Meal is Ok								
								
									if (foodInfos.kind == 1 || foodInfos.kind == 2)
									{
										#region Kind is Byeday and Reserve	
										infoDic.kind = foodInfos.kind;

										if (foodInfos.foodstatus == 0)
										{
											#region Food is not eat										
										
											if (foodInfos.selfid == self)
											{
												#region Self is Ok		
												if (foodInfos.deviceid == device)
												{
													#region Device is Ok
													
													infoDic.food		= foodReserve.GetFoodName(foodInfos.programId);
													infoDic.deviceId	= foodInfos.deviceid;
													infoDic.dateReceive	= foodInfos.datReceive;
													infoDic.color		= foodInfos.color;

													result = (int)EnumMessageFood.successfull;
													#endregion
												}
												else 
													result = (int)EnumMessageFood.forbiddenDevice;
											
												#endregion
											}
											else 
												result = (int)EnumMessageFood.forbiddenSelf;
											#endregion
										}
										else
										{
											infoDic.food		= foodReserve.GetFoodName(foodInfos.programId);
											infoDic.dateReceive	= foodInfos.datReceive;
											infoDic.deviceId	= foodInfos.deviceid;	
											infoDic.selfId		= foodInfos.selfid;
											infoDic.color		= foodInfos.color;
											

											result = (int)EnumMessageFood.eatFood;
										}
										#endregion									
									}
									else 
										result = (int)EnumMessageFood.dontKind;	
									#endregion		
								//}
								//else 
								//	result = (int)EnumMessageFood.dontReserveMeal;
								//#endregion
							}
							else 
								result = (int)EnumMessageFood.forbiddenDate;							
					
						#endregion
					}
					//else 
					//	result = (int)EnumMessageFood.notDefineKart;
				 #endregion
				}
				else 
					result = (int)EnumMessageFood.unkownKart;			

				return result;		
			}
			catch (Exception ex)
			{
				
				return result;
			}
		}


		public static int ParseForgetCode (string code)
		{
			infoDic = null;
			var src = DateTime.Now;		
			string date		= String.Format("{0:yyyy-MM-dd}", src);
			int result = -1;
			try
			{
				int meal	= Convert.ToInt32(ConfigurationManager.AppSettings["meal"]);
				int self	= Convert.ToInt32(ConfigurationManager.AppSettings["selfNumber"]);
				int device	= Convert.ToInt32(ConfigurationManager.AppSettings["deviceNumber"]);
				
				//infoDic = foodReserve..GetPerson(strID);		
				food  foodInfos = foodReserve.GetLastStatusFoodByCodeForget(code,meal);
				if (null != foodInfos)
				{
					infoDic = foodReserve.GetPersonbyUS(foodInfos.us);
					if (null != infoDic)
					{
						#region Code Found
						
						if ( foodInfos.dat == Convert.ToDateTime(date))
						{
						#region Date is ok						
							
						
						if (foodInfos.kind == 1 || foodInfos.kind == 2)
						{
							#region Kind is Byeday and Reserve	
										infoDic.kind = foodInfos.kind;

										if (foodInfos.foodstatus == 0)
										{
											#region Food is not eat										
										
											if (foodInfos.selfid == self)
											{
												#region Self is Ok		
												if (foodInfos.deviceid == device)
												{
													#region Device is Ok
													
													infoDic.food		= foodReserve.GetFoodName(foodInfos.programId);
													infoDic.deviceId	= foodInfos.deviceid;
													infoDic.dateReceive	= foodInfos.datReceive;
													infoDic.color		= foodInfos.color;

													result = (int)EnumMessageFood.successfull;
													#endregion
												}
												else 
													result = (int)EnumMessageFood.forbiddenDevice;
											
												#endregion
											}
											else 
												result = (int)EnumMessageFood.forbiddenSelf;
											#endregion
										}
										else
										{
											infoDic.food		= foodReserve.GetFoodName(foodInfos.programId);
											infoDic.dateReceive	= foodInfos.datReceive;
											infoDic.deviceId	= foodInfos.deviceid;	
											infoDic.selfId		= foodInfos.selfid;
											infoDic.color		= foodInfos.color;
											

											result = (int)EnumMessageFood.eatFood;
										}
										#endregion									
						}
						else 
								result = (int)EnumMessageFood.dontKind;	
									#endregion										
						}
						else 
							result = (int)EnumMessageFood.forbiddenDate;	

							#endregion
						}
						else 
							result = (int)EnumMessageFood.unkownCode;						
				}
				else 
					result = (int)EnumMessageFood.unkownCode;	
					

				return result;		
			}
			catch (Exception ex)
			{
				
				return result;
			}
		}

		#endregion

	}
}
