using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Configuration;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Net.Http;
using System.Reflection;
using System.Text;
using System.Windows.Forms;
using Newtonsoft.Json;
using Reader.Model;
using Reader.Helper;
using System.Threading.Tasks;

namespace Reader.Forms
{
    public partial class LoginForm : Form
    {
        #region Varaibles

        HttpClient client = new HttpClient();
        private Model.LoginResponseModel loginResult;

        #endregion

        #region Methods
        public LoginForm()
        {
            InitializeComponent();

            Init();
        }
        /// <summary>
        /// Initilizer
        /// </summary>
        private void Init()
        {
            bindEvents();

            prepare();
        }
        /// <summary>
        /// Prepare
        /// </summary>
        private void prepare()
        {
            versionLabel.Text = Assembly.GetExecutingAssembly().GetName().Version.ToString();
        }
        /// <summary>
        /// Bind Events
        /// </summary>
        private void bindEvents()
        {
            loginButton.Click += LoginButton_Click;
            exitButton.Click += ExitButton_Click;
            passwordTextBox.KeyDown += PasswordTextBox_KeyDown;
        }

        private void PasswordTextBox_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Enter)
            {
                if (!passwordTextBox.Text.isNullOrEmptyOrWhiteSpaceOrLen(50))
                    checkLogin();
                else
                    MessageBox.Show("گذر واژه نامعتبر است", "خطا", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
        }

        /// <summary>
        /// Login Button
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void LoginButton_Click(object sender, EventArgs e)
        {
            checkLogin();
        }
        /// <summary>
        /// Check Login
        /// </summary>
        private async void checkLogin()
        {
            try
            {
                string user = usernameTextBox.Text.Trim();
                string pass = passwordTextBox.Text.Trim();

                if (!user.isNullOrEmptyOrWhiteSpaceOrLen(50) && !pass.isNullOrEmptyOrWhiteSpaceOrLen(50) && user.Length > 0 && pass.Length > 0)
                {
                    RestfulHelper resfulhelper = new RestfulHelper(HttpClientData.baseUrl);
                    string url = "api/login";


                    HttpClientData.token = await resfulhelper.connect(user, pass, url);
                     

                    if (null != HttpClientData.token)
                    {
                        PrimaryForm form = new PrimaryForm();
                        this.Hide();
                        form.ShowDialog();

                    }
                    else
                    {
                        MessageBox.Show("اتصال بانک اطلاعاتی برقرار نمی باشد", "خطا", MessageBoxButtons.OK, MessageBoxIcon.Error);

                    }

                }
                else
                    MessageBox.Show("لطفا مشخصات را کامل نمایید", "خطا", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            catch (Exception ex)
            {
                MessageBox.Show("خطای ناشناخته ", "خطا", MessageBoxButtons.OK, MessageBoxIcon.Error);
                LoggerExtensions.log(ex);
                Environment.Exit(0);

            }
        }

      
        /// <summary>
        /// Exit Button
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void ExitButton_Click(object sender, EventArgs e)
        {
            Close();
        }
        #endregion
    }
}
