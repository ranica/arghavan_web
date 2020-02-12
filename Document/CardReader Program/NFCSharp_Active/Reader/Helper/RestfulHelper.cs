using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Text;
using System.Threading.Tasks;
using Newtonsoft.Json;
using Reader.Model;

namespace Reader.Helper
{
    public class RestfulHelper
    {
        public const string C_HEADER_ACCEPT = "Accept";
        public const string C_HEADER_BEARER = "Bearer";
        public const string C_HEADER_VALUE_APP_JSON = "application/json";

        public string token = "";
        public string baseUrl { get; private set; }

        public HttpClient client = new HttpClient();


        public RestfulHelper(string baseUrl)
        {
            this.baseUrl = baseUrl;

            client = new HttpClient();

            client.BaseAddress = new Uri(baseUrl);
        }

        /// <summary>
        /// Connect to Server
        /// </summary>
        /// <param name="username"></param>
        /// <param name="password"></param>
        /// <param name="url"></param>
        /// <returns></returns>
        public async Task<string> connect(string username,
                                  string password,
                                  string url)
        {
            var content = new FormUrlEncodedContent(new[]
            {
                new KeyValuePair<string, string>("code", username),
                new KeyValuePair<string, string>("password", password),
            });

            var result = await client.PostAsync(url, content);

            string resultContent = await result.Content.ReadAsStringAsync();

            LoginResponseModel loginResult = JsonConvert.DeserializeObject<Model.LoginResponseModel>(resultContent);

            this.token = loginResult.success.token;

            return token;
        }

        /// <summary>
        /// is Connect
        /// </summary>
        public bool isConnected
        {
            get
            {
                /// todo: get
                
                return false;
            }
        }

        /// <summary>
        /// Disconnect
        /// </summary>
        public void disconnect()
        {
            //client.
        }

        /// <summary>
        /// Request 
        /// </summary>
        /// <param name="url"></param>
        /// <returns></returns>
        public async Task<string> request(string url)
        {
            client.DefaultRequestHeaders.Accept.Clear();
            client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue(C_HEADER_VALUE_APP_JSON));

            client.DefaultRequestHeaders.Add(C_HEADER_ACCEPT, C_HEADER_VALUE_APP_JSON);
            client.DefaultRequestHeaders.Authorization =
                            new AuthenticationHeaderValue(C_HEADER_BEARER, HttpClientData.token);


            var result = await client.PostAsync(url, null);
            string resultContent = await result.Content.ReadAsStringAsync();

            return resultContent;
        }

        /// <summary>
        /// Request Search Data
        /// </summary>
        /// <param name="code"></param>
        /// <param name="url"></param>
        /// <returns></returns>
        public async Task<PersonModel> requestSearch(string code,
                                                string url)
        {
            client.DefaultRequestHeaders.Accept.Clear();
            client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue(C_HEADER_VALUE_APP_JSON));

            client.DefaultRequestHeaders.Add(C_HEADER_ACCEPT, C_HEADER_VALUE_APP_JSON);
            client.DefaultRequestHeaders.Authorization =
                            new AuthenticationHeaderValue(C_HEADER_BEARER, HttpClientData.token);

            var content = new FormUrlEncodedContent(new[]
            {
                new KeyValuePair<string, string>("code", code),
            });

            var result = await client.PostAsync(url, content);

            string resultContent = await result.Content.ReadAsStringAsync();

            PersonModel responseResult = JsonConvert.DeserializeObject<Model.PersonModel>(resultContent);
            return responseResult;
        }

        public async Task<SuccessModel> requestUpdate(PersonModel data,
                                              string url)
        {
            client.DefaultRequestHeaders.Accept.Clear();
            client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue(C_HEADER_VALUE_APP_JSON));

            client.DefaultRequestHeaders.Add(C_HEADER_ACCEPT, C_HEADER_VALUE_APP_JSON);
            client.DefaultRequestHeaders.Authorization =
                            new AuthenticationHeaderValue(C_HEADER_BEARER, HttpClientData.token);

            var content = new FormUrlEncodedContent(new[]
            {
                new KeyValuePair<string, string>("user_code", data.success[0].user_code),
                new KeyValuePair<string, string>("user_id", data.success[0].user_id.ToString()),
                new KeyValuePair<string, string>("people_name", data.success[0].people_name),
                new KeyValuePair<string, string>("people_lastname", data.success[0].people_lastname),
                new KeyValuePair<string, string>("people_nationalId", data.success[0].people_nationalId),
                new KeyValuePair<string, string>("people_nationalId", data.success[0].people_nationalId),
                new KeyValuePair<string, string>("card_cdn", data.success[0].card_cdn),
                new KeyValuePair<string, string>("card_type_id", data.success[0].card_type_id.ToString()),
                new KeyValuePair<string, string>("card_endDate", data.success[0].card_endDate.ToShortDateString()),
                new KeyValuePair<string, string>("card_state", data.success[0].card_state.ToString()),
            });

            var result = await client.PostAsync(url, content);

            string resultContent = await result.Content.ReadAsStringAsync();

            SuccessModel responseResult = JsonConvert.DeserializeObject<Model.SuccessModel>(resultContent);
            return responseResult;
        }
    }
}
