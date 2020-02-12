namespace Common.Enum
{
	public enum EnumMessageType
	{
		pass			= 1, // تردد انجام شد
		dontpass		= 2, // تردد انجام نشد
		allow			= 3, //   مجوز  تردد صادر شد	
		existPass		= 4,// قبلا تردد ثبت شده است
		zone			= 5, // عدم مجوز برای این ناحیه
		gen				= 6, // جنسیت مطابقت ندارد 
		deaciveDevice	= 7, // دستگاه غیر فعال است
		deactivePerson	= 8,//شما غیر فعال می باشید
		expairedCard    = 9, // کارت شما منقضی شده است
		expairedDepartment =  10, // تاریخ تردد مجاز نمی باشد
		dontSuit		= 11, // شما خوابگاهی نمی باشید.
		unkownCard		= 12, // کارت ناشناخته است
		emergency		= 13, // وضعیت اضطراری فعال است
		licensedByUser	= 14, // مجوز توسط نگهبان صادر شده است
		InsertByAuto	= 15, // مجوز اتوماتیک صادر شده است
		duplicatPass	= 16 //تردد همزمان از دو مسیر با یک کارت

	}
}
