using Microsoft.EntityFrameworkCore.Metadata.Conventions;
using Swamid.Errorurl.Helpers;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Swamid.Errorurl.Domain
{
    public class QueryParams
    {
        public string errorurl_code { get; set; }

        private string _errorurl_ts;
        private string _errorurl_rp;
        private string _errorurl_tid;
        private string _errorurl_ctx;
        [DisplayName("ERRORURL_TS")]
        public string errorurl_ts
        {
            get
            {
                return StringFunctions.StripString(_errorurl_ts);
            }
            set { _errorurl_ts = value; }

        }
        [DisplayName("ERRORURL_RP")]
        public string errorurl_rp
        {
            get
            {
                return StringFunctions.StripString(_errorurl_rp);
            }
            set { _errorurl_rp = value; }
        }
        [DisplayName("ERRORURL_TID")]
        public string errorurl_tid
        {
            get
            {
                return StringFunctions.StripString(_errorurl_tid);
            }
            set { _errorurl_tid = value; }
        }
        [DisplayName("ERRORURL_CTX")]
        public string errorurl_ctx
        {
            get
            {
                return StringFunctions.StripString(_errorurl_ctx);
            }
            set { _errorurl_ctx = value; }
        }

        public bool HaveDetails()
        {
            var ret = (errorurl_ts + "" != "" && (errorurl_ts + "").ToUpper() != "ERRORURL_TS") |
                (errorurl_rp + "" != "" && (errorurl_rp + "").ToUpper() != "ERRORURL_RP") |
                (errorurl_tid + "" != "" && (errorurl_tid + "").ToUpper() != "ERRORURL_TID") |
                (errorurl_ctx + "" != "" && (errorurl_ctx + "").ToUpper() != "ERRORURL_CTX");
            return ret;
        }
        public string GetDetails()
        {
            var sb = new StringBuilder();
            sb.Append(errorurl_ts == null ? "" : "ERRORURL_TS: " + errorurl_ts + "</br>");
            sb.Append(errorurl_rp == null ? "" : "ERRORURL_RP: " + errorurl_rp + "</br>");
            sb.Append(errorurl_tid == null ? "" : "ERRORURL_TID: " + errorurl_tid + "</br>");
            sb.Append(errorurl_ctx == null ? "" : "ERRORURL_CTX: " + errorurl_ctx + "");
            return sb.ToString();
        }
    }
}
