using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Web;
using System.Collections.Specialized;
using System.Diagnostics;
using System.Threading;
using System;

namespace Demo
{
    public class Program
    {
        public static void Main(string[] args)
        {
            Stream update_objStream1 = Stream.Null, objStream1 = Stream.Null, objStream = Stream.Null;
            string sURL;
            sURL = "https://api.1s2u.io/bulksms?username=xxxxxxx&password=xxxxxxxx&mt=0&fl=0&Sid=Test&mno=601xxxxxx&msg=Message will be written here";

            WebRequest wrGETURL;
            wrGETURL = WebRequest.Create(sURL);

            WebProxy myProxy = new WebProxy("myproxy", 80);
            myProxy.BypassProxyOnLocal = true;

            try { objStream = wrGETURL.GetResponse().GetResponseStream(); }
            catch (Exception ex)
            {
                // handle exception here

            }
            StreamReader objReader = new StreamReader(objStream);
            string messageId = objReader.ReadLine(); //final message id from stream object
            Console.WriteLine(messageId);

            //note: once done please all connctions.
            //objReader.Close();     
        }
    }
}
