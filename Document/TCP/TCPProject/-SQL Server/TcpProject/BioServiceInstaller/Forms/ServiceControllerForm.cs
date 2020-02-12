using Common.Helper.Windows;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Configuration;
using System.Data;
using System.Drawing;
using System.Linq;
using System.ServiceProcess;
using System.Text;
using System.Threading;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace BioServiceInstaller.Forms
{
    public partial class ServiceControllerForm : Form
    {
        #region Constants
        private string serviceName;
        private string hostName;
        #endregion

        #region Methods
        /// <summary>
        /// Constructor
        /// </summary>
        public ServiceControllerForm()
        {
            InitializeComponent();

            init();
        }

        /// <summary>
        /// Init
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
            startServiceButton.Click += StartServiceButton_Click;
            stopServiceButton.Click += StopServiceButton_Click;
            pauseServiceButton.Click += PauseServiceButton_Click;
        }

        /// <summary>
        /// Puase Service
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void PauseServiceButton_Click(object sender, EventArgs e)
        {
        }

        /// <summary>
        /// Stop Service
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void StopServiceButton_Click(object sender, EventArgs e)
        {
            loadingLabel.Visible = true;
            new Thread(new ThreadStart(() =>
            {
                Common.Helper.Windows.ServiceHelper.stopService(serviceName, hostName);
                Invoke((Action)delegate
                {
                    loadingLabel.Visible = true;

                    updateStatus();
                });
            })).Start();
        }

        /// <summary>
        /// Start Service
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void StartServiceButton_Click(object sender, EventArgs e)
        {
            loadingLabel.Visible = true;
            new Thread(new ThreadStart(() =>
            {
                Common.Helper.Windows.ServiceHelper.startService(serviceName, hostName);
                Invoke((Action)delegate
                {
                    loadingLabel.Visible = true;

                    updateStatus();
                });
            })).Start();
        }

        /// <summary>
        /// Prepare
        /// </summary>
        private void prepare()
        {
            serviceName =	ConfigurationManager.AppSettings["serviceName"];
            hostName =		ConfigurationManager.AppSettings["hostName"];

            loadingLabel.Visible = false;
			//pauseServiceButton.Enabled = false; // NOT WORK IT THIS VERSION
            updateStatus();
        }

        /// <summary>
        /// Get Service status
        /// </summary>
        private void updateStatus()
        {
            ServiceControllerStatus opResult = ServiceHelper.serviceStatus(serviceName, hostName);
            string status;

            loadingLabel.Visible = true;
            if ((opResult == ServiceControllerStatus.Running) || (opResult == ServiceControllerStatus.StartPending))
                status = "در حال اجرا";
            else if ((opResult == ServiceControllerStatus.Stopped) || (opResult == ServiceControllerStatus.StopPending))
                status = "پایان یافته";
            else if ((opResult == ServiceControllerStatus.Paused) || (opResult == ServiceControllerStatus.PausePending))
                status = "متوقف شده";
            else
                status = "نامشخص";

            loadingLabel.Visible = false;
            serviceStatusLabel.Text = status;
        }
        #endregion
    }
}
