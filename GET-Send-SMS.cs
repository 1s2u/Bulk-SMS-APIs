using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Web;
using System.Collections.Specialized;
using System.Diagnostics;
using System.Threading;

namespace Demo
{
    public class Program
    {
        public static void Main(string[] args)
        {
Stream update_objStream1 = Stream.Null, objStream1 = Stream.Null, objStream = Stream.Null;
            	string sURL;
            sURL = "http://1s2u.com/sms/sendsms/sendsms.asp?username=xxxxxx&password=xxxxxxxx&mno=6017xxxx&msg=Welcome toTest technologies&Sid=Test&fl=0&mt=0&ipcl=192.168.1.1";

                WebRequest wrGETURL;
                wrGETURL = WebRequest.Create(sURL);

                WebProxy myProxy = new WebProxy("myproxy", 80);
                myProxy.BypassProxyOnLocal = true;

                wrGETURL.Proxy = WebProxy.GetDefaultProxy();

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
