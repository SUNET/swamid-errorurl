using System;
using System.Collections.Generic;
using System.Linq;
using System.Text.RegularExpressions;
using System.Threading.Tasks;
using System.Web;

namespace Swamid.Errorurl.Helpers
{
    public class StringFunctions
    {
        public static string StripString(string input)
        {
            if (input != null)
            {
                input = HttpUtility.UrlDecode(input);
                input = input.Replace("&", "&amp;").Replace("<", "&lt;").Replace(">", "&gt;").Replace("\"", "&quot;").Replace("'", "&apos;");
            }
            return input;
        }
    }
}
