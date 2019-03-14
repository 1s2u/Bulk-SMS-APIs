using System;
using System.Collections.Generic;
using System.Linq;
using System.Text.RegularExpressions;
using System.Collections.Specialized;
using System.Text;

namespace Demo
{
    public class Program
    {
        public static void Main(string[] args)
        {
             string messageID = string.Empty;
            using (var wb = new System.Net.WebClient())
            {
                var data = new NameValueCollection();
                data["username"] = "xxxxxxx";
                data["password"] = "xxxxxx";
                data["mno"] = "6017xxxxxx";
                data["msg"] = "Hello Teting";
                data["Sid"] = "Sender";
                data["mt"] = "0";

                data["fl"] = "0";
                data["ipcl"]= "192.168.1.1";



                var results = wb.UploadValues("http://1s2u.com/sms/sendsms/sendsms.asp", "POST", data);
               messageID = Encoding.UTF8.GetString(results);
             
              
            }
            Console.WriteLine(messageID);
        }
    }
}
