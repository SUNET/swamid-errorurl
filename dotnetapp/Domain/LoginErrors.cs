using System;
using System.Collections.Generic;
using System.Linq;
using System.Text.Json.Serialization;
using System.Threading.Tasks;

namespace Swamid.Errorurl.Domain
{
    
    public class LoginErrors
    {
        [JsonPropertyName("common")]
        public Common Common { get; set; }
        [JsonPropertyName("error")]
        public LoginError[] Errors { get; set; }
    }
    public class Common
    {
        [JsonPropertyName("logp")]
        public string Logo { get; set; }
        [JsonPropertyName("lang")]
        public string Lang { get; set; }
        [JsonPropertyName("langFlag")]
        public string LangFlag { get; set; }
        [JsonPropertyName("langSelect")]
        public string LangSelect { get; set; }
        [JsonPropertyName("contactInformation")]
        public string ContactInformation { get; set; }
        [JsonPropertyName("contactInformation")]
        public string TechnicalInformation { get; set; }
        [JsonPropertyName("footer")]
        public string Footer { get; set; }
    }
    public class LoginError
    {
        [JsonPropertyName("type")]
        public string Type { get; set; }
        [JsonPropertyName("header")]
        public string Header { get; set; }
        [JsonPropertyName("body")]
        public string[] Body { get; set; }
        [JsonPropertyName("context")]
        public LoginErrorContext[] context { get; set; }
    }

    public class LoginErrorContext
    {
        [JsonPropertyName("type")]
        public string Type { get; set; }
        [JsonPropertyName("identifiers")]
        public string[] Identifiers { get; set; }
        [JsonPropertyName("header")]
        public string Header { get; set; }
        [JsonPropertyName("body")]
        public string[] Body { get; set; }
    }

}
