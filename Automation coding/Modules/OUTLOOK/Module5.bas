Attribute VB_Name = "Module5"
Sub Shedule_draft()
   ' Dim OutApp As Object
   ' Dim OutMail As Object
'Dim acc As account
'Set acc = ns.Accounts.Item(2)
 'Set OutApp = CreateObject("Outlook.Application")
 '   Set OutMail = OutApp.CreateItem(0)
 '   On Error Resume Next
 '   With OutMail
        '.From = "jchandra@suncommobile.com"
        '.To = "vijayakumard01@gmail.com;vijay1988@yahoo.co.in"
        '.CC = "vijayakumar_d@in.com"
        '.BCC = ""
 '       .Subject = "This is the Subject line"
 '       .HTMLBody = "testing"
 '       .SentOnBehalfOfName = OutApp.Session.Accounts.Item(2)
        '.SendUsingAccount = OutApp.Session.Accounts.Item(2)
 '       .Display
        ''.Save
        ''.Close olPromtForSave
        ''.Send   'or use .Display
 '   End With
    'MsgBox OutApp.Session.Accounts.Item(2)
 '   Set OutMail = Nothing
 '   Set OutApp = Nothing
 Dim FilePath As String
 Dim ns As NameSpace
Set ns = Application.Session
Dim mcount, count As Integer
Dim acc As account
Dim f As Folder
Dim myItem As Outlook.MailItem
Dim wddoc1, wdapp1, mysheet1 As Object
Dim chkdate
Dim sbody() As String
Dim linecnt As Integer
'For Each acc In ns.Accounts

 '   MsgBox acc.DisplayName

'Next
    Dim MSForms_DataObject As Object

 

Set acc = ns.Accounts.Item(2)
'MsgBox acc.DiSsplayName
Set f = acc.DeliveryStore.GetDefaultFolder(olFolderSentMail)
'f.Display
'MsgBox f.Name
mcount = f.Items.count
'MsgBox mcount
                 Set wdapp1 = CreateObject("Excel.Application")
                 Set wddoc1 = wdapp1.Workbooks.Open("D:\Automation coding\Working hours split\temp.xlsx")
                 wdapp1.Visible = True
                 Set mysheet1 = wdapp1.ActiveWorkbook.Worksheets("Sheet1")
                 wdapp1.Visible = True
                 For i1 = mcount To 14000 Step -1
                 'mysheet1.Columns("A").Delete
                    Set myItem = f.Items(i1)
                   ' MsgBox myItem.Subject
                    chkdate = Format(myItem.ReceivedTime, "DD/MM/YYYY")
                   ' MsgBox chkdate
                    If chkdate = "27/04/2017" Then
                            'For i = 1 To 15
                             'If InStr(1, myItem.Subject, sheet1.Cells(i, 1).Value, vbTextCompare) <> 0 Then
                              ' If Split(myItem.Subject, " ")(0) = Split(sheet1.Cells(i, 1).Value, " ")(0) Then
                               '  mysheet1.Cells(i, 2).Value = myItem.Subject
                                ' mysheet1.Cells(i, 3).Value = Format(myItem.ReceivedTime, "HH:MM AM/PM")
                                ' mysheet1.Cells(i, 4).Value = i1
                                ' mysheet1.Cells(i, 5).Value = myItem.ReceivedTime
                                ' mysheet1.Cells(i, 6).Value = myItem.Body
                                'End If
                              'End If
                           ' Next i
                           
                           If InStr(1, myItem.Subject, "FYI", vbTextCompare) <> 0 Then
                           
                           sbody = Split(myItem.Body, Chr(13) & Chr(10))
                           linecnt = UBound(sbody)
                           MsgBox linecnt
                                   For j = 0 To UBound(sbody)
                                   'For each item in the array (i.e. each line) add the line to the first empty cell in column A of sheet1
                                     mysheet1.Cells(65000, 1).End(xlUp).Offset(1, 0).Value = sbody(j)
                                     If sbody(j) = "" Then
                                     mysheet1.Cells(65000, 1).End(xlUp).Offset(1, 0).Value = "  "
                                     End If
                                     'If InStr(1, sbody(j), "AM", vbTextCompare) > 0 And InStr(1, sbody(j), "AM", vbTextCompare) > 0 Then
                                     'mysheet1.Cells(65000, 1).End(xlUp).Offset(1, 0).Value = ""
                                     'End If
                                   Next
                                    Set mysheet1 = wdapp1.ActiveWorkbook.Worksheets.Add
                          ' mysheet1.Range("A1").Copy
                             ' Set MSForms_DataObject = CreateObject("new:{1C3B4210-F441-11CE-B9EA-00AA006B1A69}")
                             ' MSForms_DataObject.SetText myItem.Body
                             ' MSForms_DataObject.PutInClipboard
                             ' mysheet1.Columns("B").Paste
                             'Set MSForms_DataObject = Nothing
                             mysheet1.Rows("40:42").EntireRow.Delete
                           End If
                           'mysheet1.Columns("A" & linecnt - 17 & ":A" & linecnt).Delete
                           
                        End If

                  
              Next
 
         'MsgBox wdapp1.ActiveWorkbook.Worksheets.count
         
       
         'wdapp1.ActiveWorkbook.Worksheets(1).Delete
         
         
 
End Sub
