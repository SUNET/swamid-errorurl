using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using Swamid.Errorurl.Models;
using Swamid.Errorurl.Domain;
using Microsoft.AspNetCore.Http;

namespace Swamid.Errorurl.Controllers
{
    public class HomeController : Controller
    {
        private readonly ILogger<HomeController> _logger;
        private LanguageSettings _languageSettings;
        private string _culture;

        [ViewData]
        public string  Title { get; set; }
        [ViewData]
        public string Footer { get; set; }
        public HomeController(ILogger<HomeController> logger, 
            LanguageSettings languageSettings
)
        {
            _logger = logger;
            _languageSettings = languageSettings;
        }
       
        public IActionResult Index([FromQuery] QueryParams query)
        {

            SetLanguage(query);
            var le = GetErrors();
            var model = new ErrorViewModel() { Parameters = query };
            SetNavigation(le,model);
            
            if (query.errorurl_code + "" == "" | (query.errorurl_code + "" == "ERRORURL_CODE"))
            {
                //Get all errors
                model.LoginError = le.Errors.ToList();
            }
            else
            {
                //Get specific error
                LoginError e = le.Errors.Where(e => e.Type == query.errorurl_code).SingleOrDefault();
                if ((query.errorurl_ctx + "" != "" && (query.errorurl_ctx + "").ToUpper() != "errorurl_ctx"))
                {
                    if (e.context != null)
                    {
                        var ctx = e.context.Where(i => i.Identifiers.Contains(query.errorurl_ctx)).SingleOrDefault();
                        if (ctx != null)
                        {
                            e.Header = ctx.Header;
                            e.Body = ctx.Body;
                        }
                    }
                }
                //ToDo handle if e is null
                model.LoginError = new List<LoginError>() { e };
            }
            Footer = le.Common.Footer;
            Title = model.LoginError.First().Header;
            return View(model);
            
        }
        private void SetNavigation(LoginErrors errors, ErrorViewModel model)
        {
            if (errors != null)
            {
                model.Navigations = GetLangNavigation();
                model.TechnicalInfo = errors.Common.TechnicalInformation;
                model.ContactInfo = errors.Common.ContactInformation;
            }
        }

        private List<Navigation> GetLangNavigation()
        {
            var navigations = new List<Navigation>(3);
            foreach(var l in _languageSettings.LoginErrors)
            {
                if (l.Common.Lang.ToLower() != _culture)
                {
                    navigations.Add(new Navigation()
                    {
                        Culture = l.Common.Lang,
                        CultureLogo = GetLogoPath(l.Common.LangFlag),
                        CultureText = l.Common.LangSelect
                    });
                }
            }
            return navigations;
        }

        private string GetLogoPath(string path)
        {
            var imgPath = "/images/" + path;
            if (!string.IsNullOrEmpty(_languageSettings.SubsiteName))
            {
                imgPath = "/" + _languageSettings.SubsiteName + imgPath;
            }
            return imgPath;
        }

        private void SetLanguage(QueryParams query)
        {
            _culture = _languageSettings.DefaultCulture.ToLower();
            if (query.lang != null)
            {
                if (_languageSettings.SupportedCultures.Contains(query.lang.ToLower()))
                {
                    _culture = query.lang.ToLower();
                }    
            }
            query.lang = null;
        }


        [ResponseCache(Duration = 0, Location = ResponseCacheLocation.None, NoStore = true)]
        public IActionResult Error()
        {
            return View(new ErrorViewModel { RequestId = Activity.Current?.Id ?? HttpContext.TraceIdentifier });
        }
        private LoginErrors GetErrors()
        {
            var e = (from l in _languageSettings.LoginErrors.Where(e => e.Common.Lang == _culture) select l).FirstOrDefault();
            return e;
        }
    }
}
