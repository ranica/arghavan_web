namespace GateService
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
		protected override void Dispose (bool disposing)
		{
			if (disposing && (components != null))
			{
				components.Dispose ();
			}
			base.Dispose (disposing);
		}

		#region Component Designer generated code

		/// <summary>
		/// Required method for Designer support - do not modify
		/// the contents of this method with the code editor.
		/// </summary>
		private void InitializeComponent ()
		{
            this.GateServiceProcessInstaller = new System.ServiceProcess.ServiceProcessInstaller();
            this.GateServiceInstaller = new System.ServiceProcess.ServiceInstaller();
            // 
            // GateServiceProcessInstaller
            // 
            this.GateServiceProcessInstaller.Account = System.ServiceProcess.ServiceAccount.LocalSystem;
            this.GateServiceProcessInstaller.Password = null;
            this.GateServiceProcessInstaller.Username = null;
            this.GateServiceProcessInstaller.AfterInstall += new System.Configuration.Install.InstallEventHandler(this.GateServiceProcessInstaller_AfterInstall);
            // 
            // GateServiceInstaller
            // 
            this.GateServiceInstaller.ServiceName = "GateService";
            this.GateServiceInstaller.StartType = System.ServiceProcess.ServiceStartMode.Automatic;
            // 
            // ProjectInstaller
            // 
            this.Installers.AddRange(new System.Configuration.Install.Installer[] {
            this.GateServiceInstaller,
            this.GateServiceProcessInstaller});

		}

		#endregion

		private System.ServiceProcess.ServiceProcessInstaller GateServiceProcessInstaller;
		private System.ServiceProcess.ServiceInstaller GateServiceInstaller;
	}
}