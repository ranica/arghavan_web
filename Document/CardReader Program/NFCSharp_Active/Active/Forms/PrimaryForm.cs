using Common.BLL.Logic.SQLIKIU;
using Common.Enum;
using Common.Model;
using NFCSharp;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Configuration;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Activate.Forms
{
    public partial class PrimaryForm : Form
    {
        #region Variables
        private int time = 0;
        private string[] mzGroups = new string[2];
        public static string nameUser = null;
        #endregion

        #region Properties
        internal class CardData
        {
            public DateTime time;
            public string id;
        }

        CardData lastCardData = new CardData();
        #endregion

        #region Methods      
        public PrimaryForm()
        {
            InitializeComponent();

            init();

        }
        /// <summary>
        /// Initilizer
        /// </summary>
        private void init()
        {
            bindEvents();

            prepare();
        }
        /// <summary>
        /// Bind Events
        /// </summary>
        private void bindEvents()
        {
            cancelButton.Click += CancelButton_Click;
            editButton.Click += EditButton_Click;
            saveButton.Click += SaveButton_Click;
            serachButton.Click += SerachButton_Click;
            searchTextBox.KeyDown += SearchTextBox_KeyDown;
            clearButton.Click += ClearButton_Click;
        }

        private void ClearButton_Click(object sender, EventArgs e)
        {
            ClearPanels(dataGroupBox);
            ClearPanels(radioGroupBox);
            messageLabel.Text = "پیام";
        }


        /// <summary>
        /// Prepare
        /// </summary>
        private void prepare()
        {
            reloadCombo();
            dateToolStripLabel.Text = Weekdays.ConvertWeekDays() + "  " + Weekdays.toJalaliDate(DateTime.Now);
            parseArgs();
            InitilizeReader();
            ToggleReader();
        }
        /// <summary>
        /// Reload ComboBox 
        /// </summary>
        private void reloadCombo()
        {
            #region CardType

            var lstKindCard = fodkindcart.GetFoodKindCard();

            kindCardComboBox.DataSource = lstKindCard;
            kindCardComboBox.DisplayMember = "nam";
            kindCardComboBox.ValueMember = "id";
            #endregion

            #region GroupType
            var lstUserFood = foduserfood.GetFoodUserFood();

            userFoodComboBox.DataSource = lstUserFood;
            userFoodComboBox.DisplayMember = "nam";
            userFoodComboBox.ValueMember = "id";
            #endregion
        }

        /// <summary>
        /// Parse Args
        /// </summary>
        private void parseArgs()
        {
            try
            {
                time = Convert.ToInt32(ConfigurationManager.AppSettings["Milliseconds"]);
            }
            catch (Exception ex)
            {
                LoggerExtensions.log(ex);
            }
        }
        /// <summary>
        /// Initilizer Reader
        /// </summary>
        private void InitilizeReader()
        {
            NFCHandler.Init();

            int i = 0;
            foreach (NFCReader rdr in NFCHandler.Readers)
            {
                mzGroups[i] = rdr.Name;
                i++;
            }
        }
        /// <summary>
        /// Toggle Reader
        /// </summary>
        private void ToggleReader()
        {
            try
            {
                if (!NFCHandler.IsInitialized) return;

                if (null == mzGroups[0]) return;

                string Tempval = mzGroups[0];
                if (Tempval.Contains("NFC"))
                {
                    int index = Array.IndexOf(mzGroups, Tempval);
                    NFCHandler.Readers[index].TagFound += PrimaryForm_TagFound;
                    NFCHandler.Readers[index].StartPolling();
                    deviceToolStripTextBox.BackColor = Color.GreenYellow;
                }
                else
                {
                    deviceToolStripTextBox.BackColor = Color.Red;
                    MessageBox.Show("دستگاه شناسایی نشد. لطفا مجدد تلاش نمایید");
                    //TODO: Check restart
                    Application.Restart();
                    Environment.Exit(0);
                }
            }
            catch (Exception ex)
            {
                deviceToolStripTextBox.BackColor = Color.Red;
                LoggerExtensions.log(ex);
                MessageBox.Show("خطا در اتصال به دستگاه");
            }
        }
        /// <summary>
        /// Tag Found
        /// </summary>
        /// <param name="Tag"></param>
        private void PrimaryForm_TagFound(NFCTag Tag)
        {
            try
            {
                string strID = Convert.ToString(Int64.Parse(Tag.ATR, System.Globalization.NumberStyles.HexNumber));

                if ((lastCardData.id != strID) || (DateTime.Now.Subtract(lastCardData.time).Milliseconds > time))
                {
                    //EventLogHandler.CreateEventLog("strID : " + strID);
                    serialTextBox.Text = strID;
                    cdnTextBox.Text = strID;
                }

                lastCardData.id = strID;
                lastCardData.time = DateTime.Now;
            }
            catch (Exception ex)
            {
                LoggerExtensions.log(ex);
            }            
        }
      
        /// <summary>
        /// SearchTextBox KeyDown
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void SearchTextBox_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Enter)
            {
                if (!searchTextBox.Text.isNullOrEmptyOrWhiteSpaceOrLen(50))               
                    loadData();
                
                else
                    MessageBox.Show("اطلاعات ورودی نامعتبر می باشد", "خطا", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
        }       
        /// <summary>
        /// Save Button
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void SaveButton_Click(object sender, EventArgs e)
        {
            //TODO: Insert User New
        }
        /// <summary>
        /// Edit Button
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void EditButton_Click(object sender, EventArgs e)
        {
            try
            {
                CommandResult opResult = null;
                opResult = validateData();
                if (opResult.status == EnumCommandStatus.success)
                {
                    if (!Common.BLL.Logic.SQLIKIU.fodmember.DuplicateCDN(cdnTextBox.Text.Trim()
                                                                         ,natioalcodeTextBox.Text.Trim()))
                        RegisterData();
                    else
                        messageLabel.Text = "کد کارت وارد شده نامعتبراست";
                }
                else
                    MessageBox.Show(opResult.model.ToString(), "اخطار", MessageBoxButtons.OK, MessageBoxIcon.Warning);

            }
            catch (Exception ex)
            {
                LoggerExtensions.log(ex);
            }           
        }

        /// <summary>
        /// Register Data 
        /// </summary>
        private void RegisterData()
        {
            int typeData = 0;
            try
            {
                Common.BLL.Entity.SQLIKIU.fodmember fodmembers = new Common.BLL.Entity.SQLIKIU.fodmember();
                fodmembers.cdn = cdnTextBox.Text.Trim();
                fodmembers.nam = nameTextBox.Text.Trim();
                fodmembers.fam = lastnameTextBox.Text.Trim();
                fodmembers.cm = natioalcodeTextBox.Text.Trim();
                fodmembers.pn = pnTextBox.Text.Trim();
               
                fodmembers.contract = contractTextBox.Text.Trim();
                fodmembers.cdn = cdnTextBox.Text.Trim();
                fodmembers.grp = (int)userFoodComboBox.SelectedValue;
                fodmembers.kindcart = (int)kindCardComboBox.SelectedValue;
                fodmembers.org = orgTextBox.Text.Trim();

                RadioButton radio = GetCheckedRadio(radioGroupBox);
                if (radio.Checked)
                {
                    switch (Convert.ToInt16(radio.Tag))
                    {
                        case (int)EnumSearchType.newUser:
                            break;
                        case (int)EnumSearchType.number: typeData = (int)EnumSearchType.number; break;

                        case (int)EnumSearchType.nationalcode: typeData = (int)EnumSearchType.nationalcode; break;
                    }

                    bool result = Common.BLL.Logic.SQLIKIU.fodmember.UpdateFodmember(fodmembers, typeData);
                    if (result)
                    {
                        messageLabel.Text = "اطلاعات با موفقیت ثبت و ویرایش شد";
                        ClearPanels(dataGroupBox);
                    }
                    else
                        messageLabel.Text = " خطا در ثبت و ویرایش !!";
                    //TODO: Clear messageLabel

                }
            }
            catch (Exception ex)
            {
                LoggerExtensions.log(ex);
            }
        }

        /// <summary>
        /// Cancel Button
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void CancelButton_Click(object sender, EventArgs e)
        {
            Close();
        }

        /// <summary>
        /// Serach Button
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void SerachButton_Click(object sender, EventArgs e)
        {
            if (!searchTextBox.Text.isNullOrEmptyOrWhiteSpaceOrLen(50))         
                loadData();
            
            else
                MessageBox.Show("اطلاعات ورودی نامعتبر می باشد", "خطا", MessageBoxButtons.OK, MessageBoxIcon.Error);
        }
        /// <summary>
        /// Load Data
        /// </summary>
        private void loadData()
        {
            try
            {
                ClearPanelsData();
                messageLabel.Text = "پیام";
                Common.BLL.Entity.SQLIKIU.fodmember fodmemberData = new Common.BLL.Entity.SQLIKIU.fodmember();
                RadioButton radio = GetCheckedRadio(radioGroupBox);
                if (radio.Checked)
                {
                    switch (Convert.ToInt16(radio.Tag))
                    {
                        case (int)EnumSearchType.newUser:
                            break;
                        case (int)EnumSearchType.number:
                            // Code 
                            fodmemberData = Common.BLL.Logic.SQLIKIU.fodmember.GetFodMemberByUS(searchTextBox.Text.Trim());
                            break;

                        case (int)EnumSearchType.nationalcode:
                            fodmemberData = Common.BLL.Logic.SQLIKIU.fodmember.GetFodMemberByCM(searchTextBox.Text.Trim());
                            break;
                    }

                    if (null != fodmemberData)
                    {
                        nameTextBox.Text = fodmemberData.nam;
                        lastnameTextBox.Text = fodmemberData.fam;
                        natioalcodeTextBox.Text = fodmemberData.cm;
                        pnTextBox.Text = fodmemberData.pn;
                        idTextBox.Text = fodmemberData.id.ToString();
                    
                        userFoodComboBox.SelectedValue = fodmemberData.grp;
                        contractTextBox.Text = fodmemberData.contract;
                        cdnTextBox.Text = fodmemberData.cdn;
                        kindCardComboBox.SelectedValue = fodmemberData.kindcart;
                       
                        orgTextBox.Text = fodmemberData.org;
                    }
                    else
                        messageLabel.Text = "اطلاعاتی موجود نمی باشد";
                }
            }
            catch (Exception ex)
            {
                LoggerExtensions.log(ex);
            }           
        }

        private void ClearPanelsData()
        {
            nameTextBox.Text = 
            lastnameTextBox.Text = 
            natioalcodeTextBox.Text = 
            pnTextBox.Text =
            idTextBox.Text =
          
            contractTextBox.Text =
            cdnTextBox.Text =

          
            orgTextBox.Text = "";
        }

        // <summary>
        /// Get Checked Radio Button
        /// </summary>
        /// <param name="container"></param>
        /// <returns></returns>
        RadioButton GetCheckedRadio(Control container)
        {
            foreach (var control in container.Controls)
            {
                RadioButton radio = control as RadioButton;

                if (radio != null && radio.Checked)
                {
                    return radio;
                }
            }

            return null;
        }
        /// <summary>
        /// Validate  data
        /// </summary>
        /// <returns></returns>
        private CommandResult validateData()
        {
            CommandResult result;

            List<string> err = new List<string>();

            string nam = nameTextBox.Text.Trim();
            string fam = lastnameTextBox.Text.Trim();
            string pn = pnTextBox.Text.Trim();
            string cm = natioalcodeTextBox.Text.Trim();
          
            string cdn = cdnTextBox.Text.Trim();
            string kindcart = kindCardComboBox.Text;
            string groupUser = userFoodComboBox.Text;

            #region Validate
            if (nam.isNullOrEmptyOrWhiteSpaceOrLen(50))
                err.Add("نام شخص وارد شده نامعتبر می باشد");
            if (fam.isNullOrEmptyOrWhiteSpaceOrLen(50))
                err.Add("نام خانوادگی وارد شده نامعتبر می باشد");
            if (pn.isNullOrEmptyOrWhiteSpaceOrLen(50))
                err.Add("شماره پرسنلی وارد شده نامعتبر است");
            if (cm.isNullOrEmptyOrWhiteSpaceOrLen(50))
                err.Add("کد ملی وارد شده نامعتبر می باشد");
            if (cdn.isNullOrEmptyOrWhiteSpaceOrLen(50))
                err.Add("سریال کارت وارد شده نامعتبر می باشد");
            if (kindcart.isNullOrEmptyOrWhiteSpaceOrLen(50))
                err.Add("نوع کارت وارد شده نامعتبر است");
            if (groupUser.isNullOrEmptyOrWhiteSpaceOrLen(50))
                err.Add("گروه وارد شده نامعتبر است");

            #endregion

            // Check for errors
            if (err.Count > 0)
                result = CommandResult.makeErrorResult("ERROR", String.Join("\r\n", err.ToArray()));
            else
                result = CommandResult.makeSuccessResult("OK");

            return result;
        }

        /// <summary>
        /// Clear Panel
        /// </summary>
        /// <param name="control"></param>
        public void ClearPanels(GroupBox control)
        {
            foreach (Control ctr in control.Controls)
            {
                if (ctr is TextBox)
                {
                    ctr.Text = "";
                }
                else if (ctr is ComboBox)
                {
                    ((ComboBox)ctr).SelectedIndex = 0;
                }
            }
        }
        #endregion
    }
}
