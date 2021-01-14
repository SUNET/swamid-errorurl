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
        private string _errorurl_code;
        private string _errorurl_ts;
        private string _errorurl_rp;
        private string _errorurl_tid;
        private string _errorurl_ctx;
        private string _lang;
        public string errorurl_code
        {
            get
            {
                return _errorurl_code;
            }
            set { _errorurl_code = StringFunctions.StripString(value); }
        }
        [DisplayName("ERRORURL_TS")]
        public string errorurl_ts
        {
            get
            {
                return _errorurl_ts;
            }
            set { _errorurl_ts = StringFunctions.StripString(value); }

        }
        [DisplayName("ERRORURL_RP")]
        public string errorurl_rp
        {
            get
            {
                return _errorurl_rp;
            }
            set { _errorurl_rp = StringFunctions.StripString(value); }
        }
        [DisplayName("ERRORURL_TID")]
        public string errorurl_tid
        {
            get
            {
                return _errorurl_tid;
            }
            set { _errorurl_tid = StringFunctions.StripString(value); }
        }
        [DisplayName("ERRORURL_CTX")]
        public string errorurl_ctx
        {
            get
            {
                return _errorurl_ctx;
            }
            set { _errorurl_ctx =StringFunctions.StripString( value); }
        }
        public string lang
        {
            get { return _lang; }
            set { _lang = value; }
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
