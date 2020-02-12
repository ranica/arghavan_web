using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;


namespace Common.BLL.Entity.SQLIKIU
{
    public class logOperator
    {

        private string host;
        private string _username;
        private string _password;
        private DateTime _time;
        private DateTime _date;
        private string _success;
        private string _typeevent;
        private int _descript;

        public int Descript
        {
            get { return _descript; }
            set { _descript = value; }
        }        

        public string TypeEvent
        {
            get { return _typeevent; }
            set { _typeevent = value; }
        }        

        public string Success
        {
            get { return _success; }
            set { _success = value; }
        }
        
        public DateTime Date
        {
            get { return _date; }
            set { _date = value; }
        }
        
        public DateTime Time
        {
            get { return _time; }
            set { _time = value; }
        }
        

        public string Password
        {
            get { return _password; }
            set { _password = value; }
        }
        

        public string Username
        {
            get { return _username; }
            set { _username = value; }
        }
        

        public string Ip
        {
            get { return host; }
            set { host = value; }
        }
        



        /*[Id] [int] IDENTITY(1,1) NOT NULL,
     [ip] [nvarchar](50) NULL,
     [username] [nvarchar](50) NULL,
     [password] [nvarchar](50) NULL,
     [time] [smalldatetime] NULL,
     [date] [datetime] NULL,
     [success] [nvarchar](50) NULL,
     [typeevent] [nvarchar](1000) NULL,
     [descript] [nvarchar](1000) NULL,
     }*/
    }
}
