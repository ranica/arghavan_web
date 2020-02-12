namespace TcpProjectSQL
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
            this.clearButton = new System.Windows.Forms.Button();
            this.Unkown = new System.Windows.Forms.Button();
            this.writeButton = new System.Windows.Forms.Button();
            this.dataTextBox = new System.Windows.Forms.TextBox();
            this.listBox1 = new System.Windows.Forms.ListBox();
            this.ipTextBox = new System.Windows.Forms.TextBox();
            this.portTextBox = new System.Windows.Forms.TextBox();
            this.disconnectButton = new System.Windows.Forms.Button();
            this.connectButton = new System.Windows.Forms.Button();
            this.testButton = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // clearButton
            // 
            this.clearButton.Location = new System.Drawing.Point(435, 361);
            this.clearButton.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.clearButton.Name = "clearButton";
            this.clearButton.Size = new System.Drawing.Size(25, 19);
            this.clearButton.TabIndex = 15;
            this.clearButton.Text = "C";
            this.clearButton.UseVisualStyleBackColor = true;
            // 
            // Unkown
            // 
            this.Unkown.Location = new System.Drawing.Point(224, 34);
            this.Unkown.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.Unkown.Name = "Unkown";
            this.Unkown.Size = new System.Drawing.Size(56, 19);
            this.Unkown.TabIndex = 13;
            this.Unkown.Text = "Unkown";
            this.Unkown.UseVisualStyleBackColor = true;
            this.Unkown.Click += new System.EventHandler(this.Unkown_Click);
            // 
            // writeButton
            // 
            this.writeButton.Location = new System.Drawing.Point(163, 34);
            this.writeButton.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.writeButton.Name = "writeButton";
            this.writeButton.Size = new System.Drawing.Size(56, 19);
            this.writeButton.TabIndex = 14;
            this.writeButton.Text = "Write";
            this.writeButton.UseVisualStyleBackColor = true;
            this.writeButton.Click += new System.EventHandler(this.button3_Click);
            // 
            // dataTextBox
            // 
            this.dataTextBox.Location = new System.Drawing.Point(163, 11);
            this.dataTextBox.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.dataTextBox.Name = "dataTextBox";
            this.dataTextBox.Size = new System.Drawing.Size(270, 20);
            this.dataTextBox.TabIndex = 12;
            // 
            // listBox1
            // 
            this.listBox1.FormattingEnabled = true;
            this.listBox1.Location = new System.Drawing.Point(11, 63);
            this.listBox1.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.listBox1.Name = "listBox1";
            this.listBox1.Size = new System.Drawing.Size(422, 316);
            this.listBox1.TabIndex = 11;
            // 
            // ipTextBox
            // 
            this.ipTextBox.Location = new System.Drawing.Point(72, 11);
            this.ipTextBox.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.ipTextBox.Name = "ipTextBox";
            this.ipTextBox.Size = new System.Drawing.Size(76, 20);
            this.ipTextBox.TabIndex = 10;
            this.ipTextBox.Text = "127.0.0.1";
            // 
            // portTextBox
            // 
            this.portTextBox.Location = new System.Drawing.Point(72, 36);
            this.portTextBox.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.portTextBox.Name = "portTextBox";
            this.portTextBox.Size = new System.Drawing.Size(76, 20);
            this.portTextBox.TabIndex = 9;
            this.portTextBox.Text = "8000";
            // 
            // disconnectButton
            // 
            this.disconnectButton.Location = new System.Drawing.Point(11, 35);
            this.disconnectButton.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.disconnectButton.Name = "disconnectButton";
            this.disconnectButton.Size = new System.Drawing.Size(56, 19);
            this.disconnectButton.TabIndex = 7;
            this.disconnectButton.Text = "DC";
            this.disconnectButton.UseVisualStyleBackColor = true;
            this.disconnectButton.Click += new System.EventHandler(this.button2_Click);
            // 
            // connectButton
            // 
            this.connectButton.Location = new System.Drawing.Point(11, 11);
            this.connectButton.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.connectButton.Name = "connectButton";
            this.connectButton.Size = new System.Drawing.Size(56, 19);
            this.connectButton.TabIndex = 8;
            this.connectButton.Text = "Connect";
            this.connectButton.UseVisualStyleBackColor = true;
            this.connectButton.Click += new System.EventHandler(this.button1_Click);
            // 
            // testButton
            // 
            this.testButton.Location = new System.Drawing.Point(310, 35);
            this.testButton.Name = "testButton";
            this.testButton.Size = new System.Drawing.Size(75, 23);
            this.testButton.TabIndex = 16;
            this.testButton.Text = "Test";
            this.testButton.UseVisualStyleBackColor = true;
            this.testButton.Click += new System.EventHandler(this.testButton_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(464, 390);
            this.Controls.Add(this.testButton);
            this.Controls.Add(this.clearButton);
            this.Controls.Add(this.Unkown);
            this.Controls.Add(this.writeButton);
            this.Controls.Add(this.dataTextBox);
            this.Controls.Add(this.listBox1);
            this.Controls.Add(this.ipTextBox);
            this.Controls.Add(this.portTextBox);
            this.Controls.Add(this.disconnectButton);
            this.Controls.Add(this.connectButton);
            this.Name = "Form1";
            this.Text = "Test TCP SQL SERVER";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button clearButton;
        private System.Windows.Forms.Button Unkown;
        private System.Windows.Forms.Button writeButton;
        private System.Windows.Forms.TextBox dataTextBox;
        private System.Windows.Forms.ListBox listBox1;
        private System.Windows.Forms.TextBox ipTextBox;
        private System.Windows.Forms.TextBox portTextBox;
        private System.Windows.Forms.Button disconnectButton;
        private System.Windows.Forms.Button connectButton;
        private System.Windows.Forms.Button testButton;
    }
}

