using System;
using System.Collections.Generic;
using System.Dynamic;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Windows.Forms;
using Newtonsoft.Json;
using System.Linq;
using System.Data;

namespace Reader
{
    public partial class text : Form
    {
       
        HttpClient client = new HttpClient();
        //Model.LoginResponseModel res = null;
        public const string C_HEADER_ACCEPT = "Accept";
        public const string C_HEADER_BEARER = "Bearer";
        public const string C_HEADER_VALUE_APP_JSON = "application/json";
        private Model.LoginResponseModel loginResult;
        private Model.ComboDataModel cardTypeResult;

        public text()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            textBox1.Text = "calling Test()...\r\n";

            DownloadPageAsync();

            // need to get from DownloadPageAsync here: result, reasonPhrase, headers, code 

            textBox1.AppendText("done Test()\r\n");
        }

        private async void DownloadPageAsync()
        {

            using (var client = new HttpClient())
            {
                client.BaseAddress = new Uri("http://localhost:8000/");


                var content = new FormUrlEncodedContent(new[]
                {
                    new KeyValuePair<string, string>("code", "1000"),
                    new KeyValuePair<string, string>("password", "123456"),
                    //new KeyValuePair<string, string>("email", "reza@yahoo.com"),
                    //new KeyValuePair<string, string>("password_confirmation", "123456")
                });

                var result = await client.PostAsync("api/login", content);

                string resultContent = await result.Content.ReadAsStringAsync();

                //dynamic loginResultT = JsonConvert.DeserializeObject<dynamic>(resultContent);
                loginResult = JsonConvert.DeserializeObject<Model.LoginResponseModel>(resultContent);


                var t = loginResult.success.token;
                

                //MessageBox.Show(resultContent);
            }
        }

        private async void button2_Click(object sender, EventArgs e)
        {
            if (null == loginResult)
            {
                return;
            }

            using (var client = new HttpClient())
            {
                client.BaseAddress = new Uri("http://localhost:8000");

          
                client.DefaultRequestHeaders.Accept.Clear();
                client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue(C_HEADER_VALUE_APP_JSON));

                client.DefaultRequestHeaders.Add(C_HEADER_ACCEPT, C_HEADER_VALUE_APP_JSON);
                client.DefaultRequestHeaders.Authorization =
                                new AuthenticationHeaderValue(C_HEADER_BEARER, loginResult.success.token);


                var result = await client.PostAsync("/api/get-details", null);

                string resultContent = await result.Content.ReadAsStringAsync();

                //loginResult = JsonConvert.DeserializeObject<LoginResponseModel>(resultContent);

                MessageBox.Show(resultContent);
            }

        }

        private async void button3_Click(object sender, EventArgs e)
        {
            using (var client = new HttpClient())
            {
                client.BaseAddress = new Uri("http://localhost:8000");


                client.DefaultRequestHeaders.Accept.Clear();
                client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue(C_HEADER_VALUE_APP_JSON));

                client.DefaultRequestHeaders.Add(C_HEADER_ACCEPT, C_HEADER_VALUE_APP_JSON);
                client.DefaultRequestHeaders.Authorization =
                                new AuthenticationHeaderValue(C_HEADER_BEARER, loginResult.success.token);


                var result = await client.PostAsync("/api/get-cardtype", null);

                string resultContent = await result.Content.ReadAsStringAsync();

                cardTypeResult = JsonConvert.DeserializeObject<Model.ComboDataModel>(resultContent);

                //comboBox1.DisplayMember = "name";
                //comboBox1.ValueMember = "id";
                //comboBox1.DataSource = cardTypeResult.success;

                //MessageBox.Show(resultContent);
            }
        }
    }
}
