using System;
using System.Collections.Generic;
using System.Linq;
using System.Text.Json.Serialization;
using System.Threading.Tasks;

namespace Swamid.Errorurl.Domain
{
    
    public class LoginErrors
    {
        [JsonPropertyName("error")]
        public LoginError[] Errors { get; set; }
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
