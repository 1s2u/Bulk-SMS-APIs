Imports System
Imports System.Collections.Generic
Imports System.Linq
Imports System.Text.RegularExpressions

Namespace Demo
    Public Module Program
        Public Sub Main(args() As String)
            'Your code goes here


            Dim webClient As New System.Net.WebClient
            Dim result As String = webClient.DownloadString("https://api.1s2u.io/bulksms?username=xxxxxxx&password=xxxxxxxx&mt=0&fl=0&Sid=Test&mno=601xxxxxxxx&msg=Message will be written here")
            Console.WriteLine(result)

        End Sub
    End Module
End Namespace
