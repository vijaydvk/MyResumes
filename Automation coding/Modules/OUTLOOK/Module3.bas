Attribute VB_Name = "Module3"
Sub sales()
Dim ns As NameSpace
Set ns = Application.Session
Dim mcount, count As Integer
Dim acc As account
Dim f As Folder
Dim myItem As Outlook.MailItem
Dim wdapp1, wddoc1, mysheet1 As Object
Dim chkdate
'For Each acc In ns.Accounts

 '   MsgBox acc.DisplayName

'Next


Set acc = ns.Accounts.Item(2)
'MsgBox acc.DisplayName
Set f = acc.DeliveryStore.GetDefaultFolder(olFolderSentMail)
f.Display
MsgBox f.Name
mcount = f.Items.count
                 Set wdapp1 = CreateObject("Excel.Application")
                 Set wddoc1 = wdapp1.Workbooks.Open("d:\Sales automation\Sales.xlsx")
                 wdapp1.Visible = True
                 Set mysheet1 = wdapp1.ActiveWorkbook.Worksheets("Sheet1")
                 For i1 = 2 To 2
                    Set myItem = f.Items(i1)
                    MsgBox myItem.Subject
                    chkdate = Format(myItem.ReceivedTime, "DD/MM/YYYY")
                    MsgBox chkdate
                    If chkdate = "18/04/2017" Then
                            For i = 1 To 15
                             If InStr(1, myItem.Subject, sheet1.Cells(i, 1).Value, vbTextCompare) <> 0 Then
                               If Split(myItem.Subject, " ")(0) = Split(sheet1.Cells(i, 1).Value, " ")(0) Then
                                 mysheet1.Cells(i, 2).Value = myItem.Subject
                                 mysheet1.Cells(i, 3).Value = Format(myItem.ReceivedTime, "HH:MM AM/PM")
                                 mysheet1.Cells(i, 4).Value = i1
                                 mysheet1.Cells(i, 5).Value = myItem.ReceivedTime
                                 mysheet1.Cells(i, 6).Value = myItem.Body
                                End If
                              End If
                            Next i
                            
                        End If

                   
              Next i1

End Sub
