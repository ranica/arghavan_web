using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;


namespace Common.BLL.Entity.IAU
{
    public class user
    {
        #region Fields

        private string stu_id;
        private string cdn;
        private string name;
        private string family;
        private int? gen;
        private int suitmem;
        private string suitname;     
        private string pic;
        private DateTime? startdat;
        private DateTime? enddat;
        private bool? active;
        private int type;
        private int typepass;
        private string ip;

        #endregion

        #region Properties

        public int Typepass
        {
            get { return typepass; }
            set { typepass = value; }
        }
        public int Type
        {
            get { return type; }
            set { type = value; }
        }
        public string Suitname
        {
            get { return suitname; }
            set { suitname = value; }
        }
        public bool? Active
        {
            get { return active; }
            set { active = value; }
        }


        public DateTime? EndDate
        {
            get { return enddat; }
            set { enddat = value; }
        }


        public DateTime? StartDate
        {
            get { return startdat; }
            set { startdat = value; }
        }


        public string Pic
        {
            get { return pic; }
            set { pic = value; }
        }


        public int Suitmem
        {
            get { return suitmem; }
            set { suitmem = value; }
        }


        public int? Gen
        {
            get { return gen; }
            set { gen = value; }
        }


        public string Family
        {
            get { return family; }
            set { family = value; }
        }


        public string Name
        {
            get { return name; }
            set { name = value; }
        }


        public string CodeCard
        {
            get { return cdn; }
            set { cdn = value; }
        }


        public string studentId
        {
            get { return stu_id; }
            set { stu_id = value; }
        }

        public string Ip
        {
            get { return ip; }
            set { ip = value; }
        }


        #endregion       

    }
}
