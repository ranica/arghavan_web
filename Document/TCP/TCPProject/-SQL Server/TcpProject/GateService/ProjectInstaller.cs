using System;
using System.Collections;
using System.Collections.Generic;
using System.ComponentModel;
using System.Configuration.Install;
using System.Linq;

namespace GateService
{
	[RunInstaller (true)]
	public partial class ProjectInstaller : System.Configuration.Install.Installer
	{
		public ProjectInstaller ()
		{
			InitializeComponent ();
		}

        private void GateServiceProcessInstaller_AfterInstall(object sender, InstallEventArgs e)
        {

        }
    }
}
