namespace MySQLGateService
{
    partial class ProjectInstaller
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary> 
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Component Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.MySQLGateServiceProcessInstaller = new System.ServiceProcess.ServiceProcessInstaller();
            this.MySQLGateServiceInstaller = new System.ServiceProcess.ServiceInstaller();
            // 
            // MySQLGateServiceProcessInstaller
            // 
            this.MySQLGateServiceProcessInstaller.Account = System.ServiceProcess.ServiceAccount.LocalSystem;
            this.MySQLGateServiceProcessInstaller.Password = null;
            this.MySQLGateServiceProcessInstaller.Username = null;
            // 
            // MySQLGateServiceInstaller
            // 
            this.MySQLGateServiceInstaller.ServiceName = "MySQLGateService";
            this.MySQLGateServiceInstaller.StartType = System.ServiceProcess.ServiceStartMode.Automatic;
            // 
            // ProjectInstaller
            // 
            this.Installers.AddRange(new System.Configuration.Install.Installer[] {
            this.MySQLGateServiceProcessInstaller,
            this.MySQLGateServiceInstaller});

        }

        #endregion

        private System.ServiceProcess.ServiceProcessInstaller MySQLGateServiceProcessInstaller;
        private System.ServiceProcess.ServiceInstaller MySQLGateServiceInstaller;
    }
}