using Swamid.Errorurl.Domain;
using System;
using System.Collections.Generic;

namespace Swamid.Errorurl.Models
{
    public class ErrorViewModel
    {
        public string Title { get; set; }
        public string ContactInfo { get; set; }
        public string TechnicalInfo { get; set; }
        public List<LoginError> LoginError { get; set; }
        public QueryParams Parameters { get; set; }
        public string RequestId { get; set; }
        public bool ShowRequestId => !string.IsNullOrEmpty(RequestId);
        public string Culture { get; set; }
        public string CultureText { get; set; }
        public string CultureLogo { get; set; }
        public string ReturnUrl { get; set; }
    }
}
