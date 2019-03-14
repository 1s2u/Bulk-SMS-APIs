Imports System
Imports System.Collections.Generic
Imports System.Linq
Imports System.Text.RegularExpressions

Namespace Demo
    Public Module Program
        Public Sub Main(args() As string)
            'Your code goes here
            
            
            Dim webClient As New System.Net.WebClient
Dim result As String = webClient.DownloadString("http://1s2u.com/sms/sendsms/sendsms.asp?username=xxxxxxx&password=xxxxxxx&mno=60176933511&msg=Welcome toTest technologies&Sid=Test&fl=0&mt=0&ipcl=192.168.1.1")
            Console.WriteLine(result)
        End Sub
    End Module
End Namespace
