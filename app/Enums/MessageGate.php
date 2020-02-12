<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class MessageGate extends Enum
{
	const pass					= 1; // تردد انجام شد
	const dontPass				= 2; // تردد انجام نشد
	const allow					= 3; //   مجوز  تردد صادر شد
	const exists_pass			= 4;// قبلا تردد ثبت شده است
	const mismatch_zone			= 5; // عدم مجوز برای این ناحیه
	const mismatch_gender 		= 6; // جنسیت مطابقت ندارد
	const disable_gate_device	= 7; // دستگاه غیر فعال است
	const disable_user			= 8;//شما غیر فعال می باشید
	const expaired_card    		= 9; // کارت شما منقضی شده است
	const expaired_department 	= 10; // تاریخ تردد مجاز نمی باشد
	const dontSuit				= 11; // شما خوابگاهی نمی باشید.
	const unknown_card			= 12; // کارت ناشناخته است
	const emergency				= 13; // وضعیت اضطراری فعال است
	const licensed_by_user		= 14; // مجوز توسط نگهبان صادر شده است
	const store_by_auto			= 15; // مجوز اتوماتیک صادر شده است
	const duplicat_pass			= 16; //تردد همزمان از دو مسیر با یک کارت
	const unknown_device		= 17; //تردد همزمان از دو مسیر با یک کارت
    const stepSuccessfull 		= 18;
}
