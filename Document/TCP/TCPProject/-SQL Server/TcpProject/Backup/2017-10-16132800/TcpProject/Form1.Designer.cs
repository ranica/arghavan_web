namespace TcpProject
{
	partial class Form1
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

		#region Windows Form Designer generated code

		/// <summary>
		/// Required method for Designer support - do not modify
		/// the contents of this method with the code editor.
		/// </summary>
		private void InitializeComponent ()
		{
			this.button1 = new System.Windows.Forms.Button();
			this.portTextBox = new System.Windows.Forms.TextBox();
			this.ipTextBox = new System.Windows.Forms.TextBox();
			this.button2 = new System.Windows.Forms.Button();
			this.listBox1 = new System.Windows.Forms.ListBox();
			this.dataTextBox = new System.Windows.Forms.TextBox();
			this.button3 = new System.Windows.Forms.Button();
			this.clearButton = new System.Windows.Forms.Button();
			this.Unkown = new System.Windows.Forms.Button();
			this.SuspendLayout();
			// 
			// button1
			// 
			this.button1.Location = new System.Drawing.Point(46, 36);
			this.button1.Name = "button1";
			this.button1.Size = new System.Drawing.Size(75, 23);
			this.button1.TabIndex = 0;
			this.button1.Text = "Connect";
			this.button1.UseVisualStyleBackColor = true;
			this.button1.Click += new System.EventHandler(this.button1_Click);
			// 
			// portTextBox
			// 
			this.portTextBox.Location = new System.Drawing.Point(127, 66);
			this.portTextBox.Name = "portTextBox";
			this.portTextBox.Size = new System.Drawing.Size(100, 22);
			this.portTextBox.TabIndex = 1;
			this.portTextBox.Text = "1470";
			// 
			// ipTextBox
			// 
			this.ipTextBox.Location = new System.Drawing.Point(127, 36);
			this.ipTextBox.Name = "ipTextBox";
			this.ipTextBox.Size = new System.Drawing.Size(100, 22);
			this.ipTextBox.TabIndex = 2;
			this.ipTextBox.Text = "192.168.0.2";
			// 
			// button2
			// 
			this.button2.Location = new System.Drawing.Point(46, 65);
			this.button2.Name = "button2";
			this.button2.Size = new System.Drawing.Size(75, 23);
			this.button2.TabIndex = 0;
			this.button2.Text = "DC";
			this.button2.UseVisualStyleBackColor = true;
			this.button2.Click += new System.EventHandler(this.button2_Click);
			// 
			// listBox1
			// 
			this.listBox1.FormattingEnabled = true;
			this.listBox1.ItemHeight = 16;
			this.listBox1.Location = new System.Drawing.Point(46, 100);
			this.listBox1.Name = "listBox1";
			this.listBox1.Size = new System.Drawing.Size(561, 388);
			this.listBox1.TabIndex = 3;
			// 
			// dataTextBox
			// 
			this.dataTextBox.Location = new System.Drawing.Point(248, 36);
			this.dataTextBox.Name = "dataTextBox";
			this.dataTextBox.Size = new System.Drawing.Size(359, 22);
			this.dataTextBox.TabIndex = 4;
			// 
			// button3
			// 
			this.button3.Location = new System.Drawing.Point(248, 64);
			this.button3.Name = "button3";
			this.button3.Size = new System.Drawing.Size(75, 23);
			this.button3.TabIndex = 5;
			this.button3.Text = "Write";
			this.button3.UseVisualStyleBackColor = true;
			this.button3.Click += new System.EventHandler(this.button3_Click);
			// 
			// clearButton
			// 
			this.clearButton.Location = new System.Drawing.Point(611, 466);
			this.clearButton.Name = "clearButton";
			this.clearButton.Size = new System.Drawing.Size(33, 23);
			this.clearButton.TabIndex = 6;
			this.clearButton.Text = "C";
			this.clearButton.UseVisualStyleBackColor = true;
			this.clearButton.Click += new System.EventHandler(this.clearButton_Click);
			// 
			// Unkown
			// 
			this.Unkown.Location = new System.Drawing.Point(329, 64);
			this.Unkown.Name = "Unkown";
			this.Unkown.Size = new System.Drawing.Size(75, 23);
			this.Unkown.TabIndex = 5;
			this.Unkown.Text = "Unkown";
			this.Unkown.UseVisualStyleBackColor = true;
			this.Unkown.Click += new System.EventHandler(this.Unkown_Click);
			// 
			// Form1
			// 
			this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
			this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
			this.ClientSize = new System.Drawing.Size(649, 510);
			this.Controls.Add(this.clearButton);
			this.Controls.Add(this.Unkown);
			this.Controls.Add(this.button3);
			this.Controls.Add(this.dataTextBox);
			this.Controls.Add(this.listBox1);
			this.Controls.Add(this.ipTextBox);
			this.Controls.Add(this.portTextBox);
			this.Controls.Add(this.button2);
			this.Controls.Add(this.button1);
			this.Name = "Form1";
			this.Text = "Form1";
			this.Load += new System.EventHandler(this.Form1_Load);
			this.ResumeLayout(false);
			this.PerformLayout();

		}

		#endregion

		private System.Windows.Forms.Button button1;
		private System.Windows.Forms.TextBox portTextBox;
		private System.Windows.Forms.TextBox ipTextBox;
		private System.Windows.Forms.Button button2;
		private System.Windows.Forms.ListBox listBox1;
		private System.Windows.Forms.TextBox dataTextBox;
		private System.Windows.Forms.Button button3;
		private System.Windows.Forms.Button clearButton;
		private System.Windows.Forms.Button Unkown;
	}
}

