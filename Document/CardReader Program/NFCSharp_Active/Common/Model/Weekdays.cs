using System;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Text;

namespace Common.Model
{   
     public class Weekdays
    {
        public static string ConvertWeekDays()
        {
            string result = string.Empty;

            DayOfWeek days = DateTime.Now.DayOfWeek;

            switch (days)
            {
                case DayOfWeek.Sunday:
                    result = "یکشنبه";
                    break;
                case DayOfWeek.Monday:
                    result = "دوشنبه";
                    break;
                case DayOfWeek.Tuesday:
                    result = "سه شنبه";
                    break;
                case DayOfWeek.Wednesday:
                    result = "چهارشنبه";
                    break;
                case DayOfWeek.Thursday:
                    result = "پنج شنبه";
                    break;
                case DayOfWeek.Friday:
                    result = "جمعه";
                    break;
                case DayOfWeek.Saturday:
                    result = "شنبه";
                    break;
                default:
                    break;
            }

            return result;
        }

        /// <summary>
        /// Convert Date To Jalali Date
        /// </summary>
        /// <param name="n"></param>
        /// <returns></returns>
        public static string toJalaliDate(DateTime n)
        {
            PersianCalendar pc = new PersianCalendar();
            string d = (pc.GetDayOfMonth(n) > 9 ? pc.GetDayOfMonth(n).ToString() : "0" + pc.GetDayOfMonth(n).ToString());
            string m = (pc.GetMonth(n) > 9 ? pc.GetMonth(n).ToString() : "0" + pc.GetMonth(n).ToString());
            string y = pc.GetYear(n).ToString();
            return (y + "/" + m + "/" + d);
        }
    }
}
