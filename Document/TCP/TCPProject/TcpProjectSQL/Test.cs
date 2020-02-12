using BaseDAL.Model;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using TcpProjectSQL.Helper;

namespace TcpProjectSQL
{
    public partial class Test : Form
    {
        public Test()
        {
            InitializeComponent();

            init();
        }

        private void init()
        {
            prepare();
        }

        private void prepare()
        {
            Dictionary<String, string> dicSerialCard = new Dictionary<string, string>();
            string cdn = "52525252";
            string ip = "192.168.1.1";
            int result = -1;

            if (dicSerialCard.Count > 0)
            {
                var item = dicSerialCard.First(kvp => kvp.Value == cdn);
                if (item.Value != null)
                    result = (int)Common.Enum.EMessage.useOtherDevice;
                else
                {
                    dicSerialCard.Add(ip, cdn);
                    result =  ValidateData();
                }

            }

            if (-1 != result)
            {
                switch (result)
                {
                    case 0:
                        {
                            //if (cardDirect == (int)Common.Enum.EDirection.input)
                            //   // write(sendDataInput);
                            //else if (cardDirect == (int)Common.Enum.EDirection.output)
                            //    write(sendDataOutput);

                        }
                        break;

                    case 4:
                    case 5:
                    case 6:
                    case 7:
                    case 8:
                    case 9:
                    case 10:
                    case 11:
                    case 15:
                    case 16:
                        {
                            //if (cardDirect == (int)Common.Enum.EDirection.input)
                            //    write(sendDataDonotInput);
                            //else if (cardDirect == (int)Common.Enum.EDirection.output)
                            //    write(sendDataDonotOutput);

                            //gitUser.removeUser(kart);
                        }
                        break;
                    case 17:
                        {
                            // در حال عبور از دستگاه دیگر
                        }break;
                    default:
                        break;
                }

                var item = dicSerialCard.First(r => r.Value == cdn);
                if (null != item.Value)
                    dicSerialCard.Remove(item.Key);
            }

           
        }

        private int ValidateData()
        {
           
            Dictionary<String, object> dic = new Dictionary<string, object>();


            Validator validator = makeChain();

            DataTable resultBase = loadBaseData();
            DataTable resultData = loadUserData();

            int cardDirect = 1; //input or output

            dic.Add("direct", cardDirect);
            if (resultData.Rows.Count == 1)
            {
                return validator.validate(resultBase.Rows[0], resultData.Rows[0], dic);

            }
            else
                return (int)Common.Enum.EMessage.unkownCard;

        }

        /// <summary>
        /// Make Chain
        /// </summary>
        /// <returns></returns>
        Validator makeChain()
        {
            DateOptionValidator dateOptionChecker = new DateOptionValidator();
            UserStateValidator userStateChecker = new UserStateValidator();
            CardValidator cardChecker  = new CardValidator();
            GenderValidate genderChecker = new GenderValidate();
            ZoneValidate zoneChecker = new ZoneValidate();
            TrafficStateValidate trafficStateChecker = new TrafficStateValidate();
            TrafficValidate trafficChecker = new TrafficValidate();

            dateOptionChecker.setValidator(userStateChecker);
            userStateChecker.setValidator(cardChecker);
            cardChecker.setValidator(genderChecker);
            genderChecker.setValidator(trafficStateChecker);
            trafficStateChecker.setValidator(trafficChecker);

            return dateOptionChecker; 
        }
        /// <summary>
        /// Load Base Data by Ip device
        /// </summary>
        /// <returns></returns>
        private DataTable loadBaseData()
        {
            Common.BLL.Logic.XGate.gatedevice lGateDevice =
                 new Common.BLL.Logic.XGate.gatedevice(Common.Enum.EDatabase.xGate);

            CommandResult opResult = lGateDevice.loadDevice(textBox2.Text);
            return opResult.model as DataTable;
        }
        /// <summary>
        /// Load User Data by cdn 
        /// </summary>
        /// <returns></returns>

        private DataTable loadUserData()
        {
            Common.BLL.Logic.XGate.gatedevice lGateDevice =
                 new Common.BLL.Logic.XGate.gatedevice(Common.Enum.EDatabase.xGate);

            CommandResult opResult = lGateDevice.loadUser(textBox1.Text);
             return opResult.model as DataTable;
        }

      

        private void button1_Click(object sender, EventArgs e)
        {
            Common.BLL.Logic.XGate.gatedevice lGateDevice =
                  new Common.BLL.Logic.XGate.gatedevice(Common.Enum.EDatabase.xGate);

            CommandResult opResult = lGateDevice.loadUser(textBox1.Text);
            dataGridViewUser.DataSource = opResult.model;
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Common.BLL.Logic.XGate.gatedevice lGateDevice =
                  new Common.BLL.Logic.XGate.gatedevice(Common.Enum.EDatabase.xGate);

            CommandResult opResult = lGateDevice.loadDevice(textBox2.Text);
            dataGridViewTraffic.DataSource = opResult.model;
        }
    }
}
