using System;
using System.Collections.Generic;
using System.Linq;
using System.Text.Json.Serialization;
using System.Threading.Tasks;

namespace Swamid.Errorurl.Domain
{
    public class LanguageSettings
    {
        public LanguageSettings()
        {
            LoginErrors = new List<LoginErrors>(3);
        }
        public string SubsiteName { get; set; }
        public string DefaultCulture { get; set; }

        public List<string> SupportedCultures { get; set; }

        public List<string> CultureFiles { get; set; }
        public List<LoginErrors> LoginErrors { get; set; }
    }
}
