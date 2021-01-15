using Newtonsoft.Json;
using Swamid.Errorurl.Domain;
using System.IO;
using System.Linq;
using System.Text;

namespace Swamid.Errorurl.Helpers
{
    public static class FilePathHelper
    {
        public static string ToApplicationPath(this string fileName)
        {
            var exePath = Path.GetDirectoryName(System.Reflection
                                .Assembly.GetExecutingAssembly().CodeBase).Replace("file:\\","");
            //Regex appPathMatcher = new Regex(@"(?<!fil)[A-Za-z]:\\+[\S\s]*?(?=\\+bin)");
            //var appRoot = appPathMatcher.Match(exePath).Value;

            return Path.Combine(exePath, fileName);
        }
        public static LoginErrors GetErrorTexts(string fileName)
        {
            var path = ToApplicationPath(fileName);
            var json = System.IO.File.ReadAllText(path, Encoding.UTF8);
            var errors = JsonConvert.DeserializeObject<LoginErrors>(json);
            return errors;
        }
    }
}
