using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Swamid.Errorurl.Domain
{
    public class QueryParams
    {
        public string errorurl_code { get; set; }
        
        public string errorurl_ts { get; set; }
        public string errorurl_rp { get; set; }
        public string errorurl_tid { get; set; }
        public string errorurl_ctx { get; set; }
        public bool HaveDetails()
        {
            var ret =  (errorurl_ts + "" != "" && (errorurl_ts + "").ToUpper() != "ERRORURL_TS") |
                (errorurl_rp + "" != "" && (errorurl_rp + "").ToUpper() != "ERRORURL_RP") |
                (errorurl_tid + "" != "" && (errorurl_tid + "").ToUpper() != "ERRORURL_TID") |
                (errorurl_ctx + "" != "" && (errorurl_ctx + "").ToUpper() != "ERRORURL_CTX");
            //var ret = (errorurl_ts+ "ERRORURL_TS").ToUpper() != "ERRORURL_TS" | 
            //    (errorurl_rp+ "ERRORURL_RP").ToUpper() != "ERRORURL_RP" |
            //    (errorurl_tid+ "ERRORURL_TID").ToUpper() != "ERRORURL_TID" |
            //    (errorurl_ctx+ "ERRORURL_CTX").ToUpper() != "ERRORURL_CTX";
            return ret;
        }
        public string GetDetails()
        {
            var sb = new StringBuilder();
            sb.Append( errorurl_ts ==null  ? "" : "ERRORURL_TS: " + errorurl_ts  + "</br>");
            sb.Append(errorurl_rp == null ? "": "ERRORURL_RP: " + errorurl_rp + "</br>");
            sb.Append(errorurl_tid == null ? "" : "ERRORURL_TID: " + errorurl_tid + "</br>");
            sb.Append(errorurl_ctx == null ? "" : "ERRORURL_CTX: " + errorurl_ctx + "");
            return sb.ToString();
        }
    }
}
