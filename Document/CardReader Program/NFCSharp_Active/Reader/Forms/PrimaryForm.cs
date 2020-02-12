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
using System.Windows.Forms;
using System.Net.Http;
using System.Net.Http.Headers;
using Reader.Model;
using Newtonsoft.Json;
using Reader.Helper;

namespace Reader.Forms
{
    public partial class PrimaryForm : Form
    {
        #region Variables
        private int time = 0;
        private string[] mzGroups = new string[2];
        public static string nameUser = null;
        public static string token;
        private ComboDataModel dataResult = null;
        private PersonModel personResult = null;
       
        #endregion

        #region Properties
        internal class CardData
        {
            public DateTime time;
            public string id;
        }

        CardData lastCardData = new CardData();
        #endregion

        #region Method

       
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
            cancelButton.Click          += CancelButton_Click;
            editButton.Click            += EditButton_Click;
            serachButton.Click          += SerachButton_Click;
            searchTextBox.KeyDown       += SearchTextBox_KeyDown;
            clearButton.Click           += ClearButton_Click;
        }

        /// <summary>
        /// Prepare
        /// </summary>
        private void prepare()
        {
            
            reloadCombo();
            dateToolStripLabel.Text = Weekdays.ConvertWeekDays() + "  " + Weekdays.toJalaliDate(DateTime.Now);
            parseArgs();
            //InitilizeReader();
            //ToggleReader();
        }

        /// <summary>
        /// Search Button
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void SerachButton_Click(object sender, EventArgs e)
        {
            // Validate checkboxes
            searchUser();
        }

        private async void searchUser()
        {
            RestfulHelper restfulHelper = new RestfulHelper(HttpClientData.baseUrl);
            personResult = await restfulHelper.requestSearch(searchTextBox.Text.Trim(), "/api/search-user");

            userIdTextBox.Text = personResult.success[0].user_id.ToString();
            nameTextBox.Text = personResult.success[0].people_name;
            lastnameTextBox.Text = personResult.success[0].people_lastname;
            natioalcodeTextBox.Text = personResult.success[0].people_nationalId;
            stateUserTextBox.Text = (personResult.success[0].user_state == 1) ? "کاربر فعال" : "کاربر غیرفعال";
            codeTextBox.Text = personResult.success[0].user_code;
            groupComboBox.SelectedValue = personResult.success[0].group_id;
            cardTypeComboBox.SelectedValue = personResult.success[0].card_type_id;
            cdnTextBox.Text = personResult.success[0].card_cdn;
            stateCheckBox.Checked = (personResult.success[0].card_state == 1) ? true : false;
            dateTextBox.Text = ExtensionsDateTime.toPersianDate(personResult.success[0].card_endDate);

        }

        /// <summary>
        /// Edit Button
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private async void EditButton_Click(object sender, EventArgs e)
        {
            CommandResult opResult = null;

            opResult = validateData();

            if (opResult.status == Common.Enum.EnumCommandStatus.success)
            {

                PersonModel personModel = new PersonModel();

                personModel.success[0].card_cdn = cdnTextBox.Text.Trim();
                personModel.success[0].card_state = (stateCheckBox.Checked) ? 1 : 0;
                personModel.success[0].card_endDate = DateTime.Parse(dateTextBox.Text.Trim());
                personModel.success[0].card_type_id = Convert.ToInt16(cardTypeComboBox.Text);
                personModel.success[0].people_name = nameTextBox.Text.Trim();
                personModel.success[0].people_lastname = lastnameTextBox.Text.Trim();
                personModel.success[0].people_nationalId = natioalcodeTextBox.Text.Trim();
                personModel.success[0].user_code = codeTextBox.Text.Trim();
                personModel.success[0].user_id = Convert.ToInt16(userIdTextBox.Text.Trim());

                RestfulHelper restfulHelper = new RestfulHelper(HttpClientData.baseUrl);
                SuccessModel resultContent = await restfulHelper.requestUpdate(personModel, "/api/update-user");

                if ( null != resultContent.success.code)
                {
                    messageLabel.Text = " اطلاعات" + resultContent.success.code + "  با موفقیت ثبت شد ";
                }

            }


        }

        /// <summary>
        /// Clear Button
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void ClearButton_Click(object sender, EventArgs e)
        {
            ClearPanels(dataGroupBox);
            ClearPanels(radioGroupBox);
            messageLabel.Text = "پیام";
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

        /// <summary>
        /// Reload ComboBox 
        /// </summary>
        private async void reloadCombo()
        {
            #region ComboBox CardType && GroupComboBox

            RestfulHelper restfulHelper = new RestfulHelper(HttpClientData.baseUrl);
            string resultContent = await restfulHelper.request("/api/get-data");


            dataResult = JsonConvert.DeserializeObject<Model.ComboDataModel>(resultContent);

            cardTypeComboBox.DisplayMember = "name";
            cardTypeComboBox.ValueMember = "id";
            cardTypeComboBox.DataSource = dataResult.successCardType;


            groupComboBox.DisplayMember = "name";
            groupComboBox.ValueMember = "id";
            groupComboBox.DataSource = dataResult.successGroup;

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
                //if (!searchTextBox.Text.isNullOrEmptyOrWhiteSpaceOrLen(50))
                //    loadData();

                //else
                //    MessageBox.Show("اطلاعات ورودی نامعتبر می باشد", "خطا", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
        }
       
        /// <summary>
		/// Validate data
		/// </summary>
		/// <returns></returns>
		private CommandResult validateData()
        {
            CommandResult result;

            List<string> err = new List<string>();
            string name = nameTextBox.Text.Trim();
            string lastName = lastnameTextBox.Text.Trim();
            string nationalCode = natioalcodeTextBox.Text.Trim();
            string code = codeTextBox.Text.Trim();
            string endDate = dateTextBox.Text;
            string cdn = cdnTextBox.Text.Trim();
            string cardType = cardTypeComboBox.Text.Trim();

            #region Validate
            if (name.isNullOrEmptyOrWhiteSpaceOrLen(50))
                err.Add("نام وارد شده نامعتبر می باشد");
            if (lastName.isNullOrEmptyOrWhiteSpaceOrLen(50))
                err.Add("نام خانوادگی وارد شده نامعتبر می باشد");
            if (nationalCode.isNullOrEmptyOrWhiteSpaceOrLen(10))
                err.Add("کد ملی وارد شده نامعتبر می باشد");
            if (code.isNullOrEmptyOrWhiteSpaceOrLen(50))
                err.Add("کد پرسنلی / دانشجویی وارد شده نامعتبر می باشد");
            if (cdn.isNullOrEmptyOrWhiteSpaceOrLen(50))
                err.Add("شماره سریال وارد شده نامعتبر می باشد");
            else if (cardType.isNullOrEmptyOrWhiteSpaceOrLen(50))
                err.Add("نوع کارت وارد شده نامعتبر می باشد");

            if (null != endDate)
            {
                if (!endDate.isBirthDate(10))
                    err.Add("تاریخ وارد شده نامعتبر است");
            }

            #endregion

            // Check for errors
            if (err.Count > 0)
                result = CommandResult.makeErrorResult("ERROR", String.Join("\r\n", err.ToArray()));
            else
                result = CommandResult.makeSuccessResult("OK");

            return result;
        }

        #endregion
    }
}
