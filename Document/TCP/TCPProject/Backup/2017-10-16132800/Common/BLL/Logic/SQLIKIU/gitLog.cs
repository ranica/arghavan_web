using Common.BLL.Entity.SQLIKIU;
using Common.BLL.Logic.DB;
using Common.Enum;
using Common.Helper.Logger;
using Common.Model;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Linq;
using System.Text;


namespace Common.BLL.Logic.SQLIKIU
{
	public class gitLog
	{ 
		#region Variables 		
		public static ListInfo _info = new ListInfo ();
		public static int genzoon;
		public static user _userinfo;
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
			int result			= (int)EnumMessageType.unkownCard;
			_userinfo			= new user();
			_userinfo.studentId = "0";
			_userinfo.Name		="";
			_userinfo.Family	="";
			_userinfo.Pic		= null;
			gitLog.saveLogUser (_userinfo, _dev.Id, (int)_dev.Direction, result);
		}

		/// <summary>
		/// Check kart 
		/// </summary>
		/// <param name="ip"></param>
		/// <param name="kart"></param>
		/// <param name="_dev"></param>
		/// <param name="_opt"></param>
		/// <returns></returns>
		public static int kartLicense (string ip, string kart, device _dev, option _opt)
		{
			_userinfo = null; 
			int result = 0;
			
			dbIKIUDataContext db = new dbIKIUDataContext (ConfigurationManager.AppSettings["ConnectionString"].Trim ());
			if (ListInfo.notExistKart (kart))
			{
				_info.kart = kart;
				ListInfo.dicData.Add (ip, _info);

				_userinfo = gitUser._lstUser.Where (r => r.CodeCard == kart).FirstOrDefault ();			
				
				if (null != _userinfo)
				{
					//Check old pass
					var existPass = db.gitlogs.OrderByDescending (t => t.dat)
							.Where (r => r.stu_id == _userinfo.studentId)
									.Take (1).FirstOrDefault ();

					#region Valid Card
					_info.stu_id = _userinfo.studentId;

					if (_userinfo.Suitmem == (int)EnumSuitType.yes)
					{
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

									if (_dev != null)
									{
										//EventLogHandler.CreateEventLog ("Device have network");
										#region Device have network
										if (_dev.Gen == (int)EnumGenType.Both || _userinfo.Gen == _dev.Gen)
										{
											#region Gen Device is Ok
											if (_dev.Zoon == "0")
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
														} break;
													case (int)EnumTypeGenzoon.AllowByUser: // برنامه به تکرار تردد حساس است
														{
															if (_opt.Emergency == 0) //وضعیت اضطراری فعال نمی باشد
															{
																if (null != existPass)
																{
																	#region duplicate traffic
																																						
																			//قبلا تردد داشته است 
																			if (existPass.direction == _dev.Direction)
																			{
																				switch (existPass.commentId)
																				{
																					case 1  : 
																					case 13 :
																					case 14 :
																					case 15 : result = (int)EnumMessageType.allow; break ;
																					
																					case 2  : result = (int)EnumMessageType.duplicatPass; break ;
																					case 0  :
																					case 3	:
																					case 4	:
																					case 5	:
																					case 6	:
																					case 7	:
																					case 8	:
																					case 9	:
																					case 10	:
																					case 11	: result = (int)EnumMessageType.existPass;break ;
																
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

																if (_dev.Direction == (int)EnumDirection.input)
																	gitLog.saveLogUser (_userinfo, _dev.Id, (int)EnumDirection.output, result);

																else
																	gitLog.saveLogUser (_userinfo, _dev.Id, (int)EnumDirection.input, result);

																result = (int)EnumMessageType.allow;
															}

														} break;
													case (int)EnumTypeGenzoon.Auto:
														{
															result = (int)EnumMessageType.InsertByAuto;
															if (_dev.Direction == (int)EnumDirection.input)
																gitLog.saveLogUser (_userinfo, _dev.Id, (int)EnumDirection.output, result);
															else
																gitLog.saveLogUser (_userinfo, _dev.Id, (int)EnumDirection.input, result);

															result = (int)EnumMessageType.allow;

														} break;
													#endregion
												}

												#endregion											
											}
											else
												// ناحیه تردد مجاز نمی باشد
												result = (int)EnumMessageType.zoon;
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
								// تاریخ ورود مجاز نمی باشد
								result = (int)EnumMessageType.date;
							#endregion
						}
						else
							// تاریخ ورود به خوابگاه مجاز نمی باشد
							result = (int)EnumMessageType.dateSuit;
						#endregion
					}
					else
						// خوابگاهی نمی باشد
						result = (int)EnumMessageType.dontSuit;

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
				gitLog.saveLogUser (_userinfo, _dev.Id, (int)_dev.Direction, result);
			}
			else			
				gitLog.saveLogUser (_userinfo, _dev.Id, (int)_dev.Direction, result);			

			return result;
		}
		

		/// <summary>
		/// Save log user every reason
		/// </summary>
		/// <param name="_userinfo"></param>
		/// <param name="idDevice"></param>
		/// <param name="direct"></param>
		/// <param name="status"></param>
		public static void saveLogUser (user _userinfo, int idDevice, int direct, int status)
		{
			try
			{				
				dbIKIUDataContext db = new dbIKIUDataContext (ConfigurationManager.AppSettings["ConnectionString"].Trim ());
				
				DB.gitlog log = new DB.gitlog ();
				log.stu_id = _userinfo.studentId;
				log.nam = _userinfo.Name + " " + _userinfo.Family;
				log.pic = _userinfo.Pic;
				log.direction = direct;
				log.deviceId = idDevice;
				log.tim = Convert.ToDateTime (DateTime.Now.ToShortTimeString ());
				log.dat = DateTime.Now;
				log.commentId = status;
				//log.tim = DateTime.Now;

				db.gitlogs.InsertOnSubmit (log);
				db.SubmitChanges ();				
			}
			catch (Exception ex)
			{
				Logger.logger.log(CommandResult.makeErrorResult(ex.Message, ex));			
			}
		}

		/// <summary>
		/// Save Pass or dont pass user
		/// </summary>
		/// <param name="kart"></param>
		/// <param name="tagPass"></param>
		public static void saveLogUserPass (string kart, bool tagPass)
		{
			try
			{
				dbIKIUDataContext db = new dbIKIUDataContext (ConfigurationManager.AppSettings["ConnectionString"].Trim ());
				if (null != gitUser._lstUser)
				{
					var stuId = gitUser._lstUser.Where (r => r.CodeCard == kart).FirstOrDefault ();
					var _stu = (from n in db.gitlogs
								where n.stu_id == stuId.studentId
								&& n.commentId == (int)EnumMessageType.allow
								orderby n.dat descending
								select n).FirstOrDefault ();

					gitUser.removeUser (kart);

					if (_stu != null)
					{
						// ذخیره وضعیت تردد شخص
						if (tagPass)
						{
							// شخص عبور کرد
							_stu.commentId = (int)EnumMessageType.pass;
							db.SubmitChanges ();

						}
						else 
						{
							// شخص عبور نکرد
							_stu.commentId = (int)EnumMessageType.dontpass;
							db.SubmitChanges ();
						}
					}
				}
			}
			catch (Exception ex)
			{
				Logger.logger.log(CommandResult.makeErrorResult("saveLogUserPass" +ex.Message, ex));
			}
		}
		#endregion
	}
}
