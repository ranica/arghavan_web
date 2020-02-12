using Common.BLL.Entity.SQLIKIU;
using Common.BLL.Logic.SQLIKIU;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Configuration;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Reflection;
using System.Text;
using System.Windows.Forms;

namespace Activate.Forms
{
	public partial class LoginForm : Form
	{
		#region Varaibles
		
		#endregion

		#region Methods
		public LoginForm ()
		{
			InitializeComponent ();

			Init();
		}
		/// <summary>
		/// Initilizer
		/// </summary>
		private void Init ()
		{
			bindEvents();
			prepare();
		}
		/// <summary>
		/// Prepare
		/// </summary>
		private void prepare ()
		{
			versionLabel.Text = Assembly.GetExecutingAssembly().GetName().Version.ToString();
        }
		/// <summary>
		/// Bind Events
		/// </summary>
		private void bindEvents ()
		{
			loginButton.Click					+= LoginButton_Click;
			exitButton.Click					+= ExitButton_Click;
            passwordTextBox.KeyDown             += PasswordTextBox_KeyDown;
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
        private void LoginButton_Click (object sender, EventArgs e)
		{
			checkLogin ();
		}
		/// <summary>
		/// Check Login
		/// </summary>
		private void checkLogin ()
		{
			try
			{
				string user = usernameTextBox.Text.Trim();
				string pass = passwordTextBox.Text.Trim();

				if (!user.isNullOrEmptyOrWhiteSpaceOrLen(50) && !pass.isNullOrEmptyOrWhiteSpaceOrLen(50) && user.Length > 0 && pass.Length > 0 )
				{
                    string username = ConfigurationManager.AppSettings["username"].ToString();
                    string password = ConfigurationManager.AppSettings["password"].ToString();

                    if (user == username && pass == password)
                   
                    {
                        //EventLogHandler.CreateEventLog("Login Successfull");
                        //MainForm.nameUser = op.Name + " " + op.Family;
                        PrimaryForm.nameUser = username;
                        PrimaryForm form = new PrimaryForm();

                        this.Hide();
                        form.ShowDialog();
                        Environment.Exit(0);
                    }
                    else
                        MessageBox.Show("اطلاعات کاربری را بررسی نمایید", "خطا", MessageBoxButtons.OK, MessageBoxIcon.Error);
                }
				else 
					MessageBox.Show("لطفا مشخصات را کامل نمایید","خطا" ,MessageBoxButtons.OK, MessageBoxIcon.Error);
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
		private void ExitButton_Click (object sender, EventArgs e)
		{
			Close();
		}		
		#endregion

	}
}
