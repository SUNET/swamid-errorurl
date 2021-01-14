using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.IO;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration.UserSecrets;
using Microsoft.Extensions.Localization;
using Microsoft.Extensions.Logging;
using Swamid.Errorurl.Helpers;
using Swamid.Errorurl.Models;
using Swamid.Errorurl.Domain;
using Newtonsoft.Json;
using Microsoft.AspNetCore.Localization;
using Microsoft.AspNetCore.Http;
using Microsoft.Extensions.Options;
using Microsoft.AspNetCore.Builder;
using System.Globalization;
using System.Web;
using Microsoft.EntityFrameworkCore.Internal;
using System.Threading;

namespace Swamid.Errorurl.Controllers
{
    public class HomeController : Controller
    {
        private readonly ILogger<HomeController> _logger;
        private IStringLocalizer<HomeController> _localizer;
        private IOptions<RequestLocalizationOptions> _locOptions;
        [ViewData]
        public string  Title { get; set; }
        [ViewData]
        public string Footer { get; set; }
        public HomeController(ILogger<HomeController> logger, 
            IStringLocalizer<HomeController> localizer,
            IOptions<RequestLocalizationOptions> LocOptions
)
        {
            _logger = logger;
            _localizer = localizer;
            _locOptions = LocOptions;
        }
       
        public IActionResult Index([FromQuery] QueryParams query)
        {
            //string returnUrl = "";
            //var q = System.Web.HttpUtility.ParseQueryString(HttpContext.Request.QueryString.Value);
            //q.Remove("lang");
            //returnUrl = "~/" + (q.Keys.Count == 0 ? "" : "?" + q).ToString();
            SetLanguage(query);
            

            var le = GetErrorTexts();
            var model = new ErrorViewModel() { Parameters = query };
            model.Culture = _localizer.GetString("culture").Value;
            model.CultureText = _localizer.GetString("culture_text").Value; ;
            model.CultureLogo = _localizer.GetString("logo").Value; ;
            model.TechnicalInfo = _localizer.GetString("technical_information").Value;
            model.ContactInfo = _localizer.GetString("contact_information").Value;
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
            Footer = _localizer.GetString("FooterText").Value;
            Title = model.LoginError.First().Header;
            return View(model);
            
        }

        private void SetLanguage(QueryParams query)
        {
            
            if (query.lang != null)
            {
                if (_locOptions.Value.SupportedUICultures.Contains(new CultureInfo(query.lang))){
                    var cultureInfo = new CultureInfo(query.lang);
                    CultureInfo.DefaultThreadCurrentCulture = cultureInfo;
                    CultureInfo.DefaultThreadCurrentUICulture = cultureInfo;
                    Thread.CurrentThread.CurrentCulture = cultureInfo;
                    Thread.CurrentThread.CurrentUICulture = cultureInfo;
                }
                query.lang = null;
            }
        }
        

        [ResponseCache(Duration = 0, Location = ResponseCacheLocation.None, NoStore = true)]
        public IActionResult Error()
        {
            return View(new ErrorViewModel { RequestId = Activity.Current?.Id ?? HttpContext.TraceIdentifier });
        }
        private LoginErrors GetErrorTexts()
        {
            var path = FilePathHelper.ToApplicationPath(_localizer.GetString("Text").Value);
            var json =System.IO.File.ReadAllText(path, Encoding.GetEncoding("ISO-8859-1"));
            var errors = JsonConvert.DeserializeObject<LoginErrors>(json);
            return errors;
        }
    }
}
