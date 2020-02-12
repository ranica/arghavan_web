using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Reader.Helper
{
    public class DownloadAsyncResult
    {
        public string result { get; set; }
        public string code { get; set; }
        public string cdn { get; set; }
        public string name { get; set; }
        //public HttpResponseHeaders headers { get; set; }
        //public HttpStatusCode code { get; set; }
        public string errorMessage { get; set; }
    }
}
