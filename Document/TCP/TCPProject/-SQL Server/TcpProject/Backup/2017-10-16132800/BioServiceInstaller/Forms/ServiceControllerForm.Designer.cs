namespace BioServiceInstaller.Forms
{
    partial class ServiceControllerForm
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

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
			this.loadingLabel = new System.Windows.Forms.Label();
			this.groupBox1 = new System.Windows.Forms.GroupBox();
			this.startServiceButton = new System.Windows.Forms.Button();
			this.stopServiceButton = new System.Windows.Forms.Button();
			this.pauseServiceButton = new System.Windows.Forms.Button();
			this.serviceStatusLabel = new System.Windows.Forms.Label();
			this.label3 = new System.Windows.Forms.Label();
			this.groupBox1.SuspendLayout();
			this.SuspendLayout();
			// 
			// loadingLabel
			// 
			this.loadingLabel.BackColor = System.Drawing.Color.Black;
			this.loadingLabel.Font = new System.Drawing.Font("Tahoma", 10F);
			this.loadingLabel.ForeColor = System.Drawing.Color.White;
			this.loadingLabel.Location = new System.Drawing.Point(0, 17);
			this.loadingLabel.Margin = new System.Windows.Forms.Padding(5, 0, 5, 0);
			this.loadingLabel.Name = "loadingLabel";
			this.loadingLabel.Size = new System.Drawing.Size(258, 45);
			this.loadingLabel.TabIndex = 3;
			this.loadingLabel.Text = "کمی صبر کنید";
			this.loadingLabel.TextAlign = System.Drawing.ContentAlignment.MiddleLeft;
			// 
			// groupBox1
			// 
			this.groupBox1.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Right)));
			this.groupBox1.BackColor = System.Drawing.Color.Transparent;
			this.groupBox1.Controls.Add(this.loadingLabel);
			this.groupBox1.Controls.Add(this.startServiceButton);
			this.groupBox1.Controls.Add(this.stopServiceButton);
			this.groupBox1.Controls.Add(this.pauseServiceButton);
			this.groupBox1.Controls.Add(this.serviceStatusLabel);
			this.groupBox1.Controls.Add(this.label3);
			this.groupBox1.Location = new System.Drawing.Point(8, 4);
			this.groupBox1.Margin = new System.Windows.Forms.Padding(5, 6, 5, 6);
			this.groupBox1.Name = "groupBox1";
			this.groupBox1.Padding = new System.Windows.Forms.Padding(5, 6, 5, 6);
			this.groupBox1.Size = new System.Drawing.Size(611, 127);
			this.groupBox1.TabIndex = 2;
			this.groupBox1.TabStop = false;
			// 
			// startServiceButton
			// 
			this.startServiceButton.Anchor = System.Windows.Forms.AnchorStyles.Bottom;
			this.startServiceButton.Location = new System.Drawing.Point(362, 73);
			this.startServiceButton.Margin = new System.Windows.Forms.Padding(5, 6, 5, 6);
			this.startServiceButton.Name = "startServiceButton";
			this.startServiceButton.Size = new System.Drawing.Size(147, 42);
			this.startServiceButton.TabIndex = 0;
			this.startServiceButton.Text = "اجرا";
			this.startServiceButton.UseVisualStyleBackColor = true;
			// 
			// stopServiceButton
			// 
			this.stopServiceButton.Anchor = System.Windows.Forms.AnchorStyles.Bottom;
			this.stopServiceButton.Location = new System.Drawing.Point(132, 73);
			this.stopServiceButton.Margin = new System.Windows.Forms.Padding(5, 6, 5, 6);
			this.stopServiceButton.Name = "stopServiceButton";
			this.stopServiceButton.Size = new System.Drawing.Size(147, 42);
			this.stopServiceButton.TabIndex = 2;
			this.stopServiceButton.Text = "پایان";
			this.stopServiceButton.UseVisualStyleBackColor = true;
			// 
			// pauseServiceButton
			// 
			this.pauseServiceButton.Anchor = System.Windows.Forms.AnchorStyles.Bottom;
			this.pauseServiceButton.Location = new System.Drawing.Point(132, 73);
			this.pauseServiceButton.Margin = new System.Windows.Forms.Padding(5, 6, 5, 6);
			this.pauseServiceButton.Name = "pauseServiceButton";
			this.pauseServiceButton.Size = new System.Drawing.Size(147, 42);
			this.pauseServiceButton.TabIndex = 1;
			this.pauseServiceButton.Text = "توقف";
			this.pauseServiceButton.UseVisualStyleBackColor = true;
			// 
			// serviceStatusLabel
			// 
			this.serviceStatusLabel.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Right)));
			this.serviceStatusLabel.Font = new System.Drawing.Font("Tahoma", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
			this.serviceStatusLabel.Location = new System.Drawing.Point(261, 25);
			this.serviceStatusLabel.Margin = new System.Windows.Forms.Padding(5, 0, 5, 0);
			this.serviceStatusLabel.Name = "serviceStatusLabel";
			this.serviceStatusLabel.Size = new System.Drawing.Size(218, 33);
			this.serviceStatusLabel.TabIndex = 1;
			this.serviceStatusLabel.Text = "Status";
			this.serviceStatusLabel.TextAlign = System.Drawing.ContentAlignment.MiddleLeft;
			// 
			// label3
			// 
			this.label3.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Right)));
			this.label3.AutoSize = true;
			this.label3.Location = new System.Drawing.Point(482, 31);
			this.label3.Margin = new System.Windows.Forms.Padding(5, 0, 5, 0);
			this.label3.Name = "label3";
			this.label3.Size = new System.Drawing.Size(151, 30);
			this.label3.TabIndex = 1;
			this.label3.Text = "وضعیت سرویس : ";
			// 
			// ServiceControllerForm
			// 
			this.AutoScaleDimensions = new System.Drawing.SizeF(12F, 30F);
			this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
			this.ClientSize = new System.Drawing.Size(629, 137);
			this.Controls.Add(this.groupBox1);
			this.Font = new System.Drawing.Font("B Yekan", 12F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(178)));
			this.Margin = new System.Windows.Forms.Padding(5, 6, 5, 6);
			this.Name = "ServiceControllerForm";
			this.RightToLeft = System.Windows.Forms.RightToLeft.Yes;
			this.Text = "کنترل گر سرویس گیت";
			this.groupBox1.ResumeLayout(false);
			this.groupBox1.PerformLayout();
			this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Label loadingLabel;
        private System.Windows.Forms.GroupBox groupBox1;
        private System.Windows.Forms.Button startServiceButton;
        private System.Windows.Forms.Button stopServiceButton;
        private System.Windows.Forms.Button pauseServiceButton;
        private System.Windows.Forms.Label serviceStatusLabel;
        private System.Windows.Forms.Label label3;
    }
}

