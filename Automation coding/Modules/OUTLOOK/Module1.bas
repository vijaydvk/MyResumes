Attribute VB_Name = "Module1"
Sub Checklist()
 Dim cl As Range, rng As Range
 Dim addr As String
 Dim i, j, x1, i1, i2, i3, Val, pos, color, mailcount, count As Integer
 Dim chkdate, chktime
 Dim nmailcount, loops
 Dim arr(1000) As Integer
 Dim match, match1
 Dim WrdArray() As String
 loops = 0
 Val = 0
 color = 0
 count = 0
 Dim locmailsub, inboxmailsub
 Dim myItem As Outlook.MailItem
 Dim myitem1 As Outlook.MailItem
 Dim att As Object
 Dim att1 As Object
 Dim wdApp, wdapp1, wdapp2, wdapp3, wdapp4 As Object
 Dim att1s As String
 Dim wdDoc, wddoc1, wddoc2, wddoc3, wddoc4 As Object
 Dim mysheet, mysheet1, mysheet2, mysheet3, mysheet4 As Object
 Dim myFolder, myfolder1 As Folder
 Dim atts As Outlook.Attachments
 Dim myAttachment As Outlook.Attachment
 Dim daate As Outlook.AppointmentItem
 Dim x
 Set myNamespace = Application.GetNamespace("MAPI")
 Set myFolder = myNamespace.GetDefaultFolder(olFolderInbox).Parent.Folders.Item("Notes")

 Set myfolder1 = myFolder.Folders.Item(1)
 mailcount = myfolder1.Items.count
       myfolder1.Display

                 'Open a book to write mail names which we receive from 5.pm and above softcount subject
                 '--------------------------------------------------------------------------------------
                 Set wdapp1 = CreateObject("Excel.Application")
                 Set wddoc1 = wdapp1.Workbooks.Open("d:\Book1.xlsx")
                 wdapp1.Visible = True
                 Set mysheet1 = wdapp1.ActiveWorkbook.Worksheets("Sheet1")
                 Set mysheet2 = wdapp1.ActiveWorkbook.Worksheets("Sheet2")
                 'looping for mail
                 '----------------
                 For i1 = mailcount To 1 Step -1
                    Set myItem = myfolder1.Items(i1)

                      chkdate = Format(myItem.ReceivedTime, "DD/MM/YYYY")


                        If chkdate = "14/04/2017" Then

                             If InStr(1, myItem.Subject, "Opening Checklist", vbTextCompare) <> 0 Then

                                 count = count + 1

                                 mysheet1.Cells(count, 1).Value = myItem.Subject
 
                                WrdArray() = Split(mysheet1.Cells(count, 1).Value, "Opening", , vbTextCompare)
                                mysheet1.Cells(count, 3).Value = WrdArray(0)
                                 mysheet1.Cells(count, 2).Value = FindWord(mysheet1.Cells(count, 1).Value, 1)
                                 If mysheet1.Cells(count, 2).Value = "St" Then
                                    mysheet1.Cells(count, 2).Value = "St Cloud"
                                 End If
                                 mysheet1.Cells(count, 4).Value = Replace(SuperMid(Replace(myItem.Body, " ", ""), "Thankyou,", Replace(mysheet1.Cells(count, 3).Value, " ", "")), vbLf, "")

                                 mysheet1.Cells(count, 5).Value = myItem.Body
                                 mysheet1.Cells(count, 6).Value = chkdate


                             End If
                             If InStr(1, myItem.Subject, "Closing Checklist", vbTextCompare) <> 0 Then
   
                                 Val = Val + 1
                                 mysheet2.Cells(Val, 1).Value = myItem.Subject
                                 WrdArray() = Split(mysheet2.Cells(Val, 1).Value, "Closing", , vbTextCompare)
                                mysheet2.Cells(Val, 3).Value = WrdArray(0)
                                 mysheet2.Cells(Val, 2).Value = FindWord(mysheet2.Cells(Val, 1).Value, 1)
                                 If mysheet2.Cells(Val, 2).Value = "St" Then
                                    mysheet2.Cells(Val, 2).Value = "St Cloud"
                                 End If
                                 mysheet2.Cells(Val, 4).Value = Replace(SuperMid(Replace(myItem.Body, " ", ""), "Thankyou,", Replace(mysheet2.Cells(Val, 3).Value, " ", "")), vbLf, "")
                                 mysheet2.Cells(Val, 5).Value = myItem.Body
                                 mysheet2.Cells(Val, 6).Value = chkdate

                             End If
                        End If
                   
              Next i1
              
             For i1 = 1 To count
             For i3 = i1 + 1 To count
             If mysheet1.Cells(i1, 1).Value = mysheet1.Cells(i3, 1).Value Then
             mysheet1.Rows(i1).EntireRow.Delete
             count = count - 1
             End If
             Next i3
             Next i1
             For i1 = 1 To Val
             For i3 = i1 + 1 To Val
             If mysheet2.Cells(i1, 1).Value = mysheet2.Cells(i3, 1).Value Then
             mysheet2.Rows(i1).EntireRow.Delete
             Val = Val - 1
             End If
             Next i3
             Next i1
wddoc1.Save
wdapp1.Quit
End Sub

Public Function SuperMid(ByVal strMain As String, str1 As String, str2 As String, Optional reverse As Boolean) As String

Dim i As Integer, j As Integer, temp As Variant
On Error GoTo errhandler:
If reverse = True Then
    i = InStrRev(strMain, str1)
    j = InStrRev(strMain, str2)
    If i = j Then
        j = InStrRev(strMain, str2, i - 1)
    End If
Else
    i = InStr(1, strMain, str1)
    j = InStr(1, strMain, str2)
    If i = j Then
        j = InStr(i + 1, strMain, str2)
    End If
End If
If i = 0 And j = 0 Then GoTo errhandler:
If j = 0 Then j = Len(strMain) + Len(str2)
If i = 0 Then i = Len(strMain) + Len(str1)
If i > j And j <> 0 Then 'swap order
    temp = j
    j = i
    i = temp
    temp = str2
    str2 = str1
    str1 = temp
End If
i = i + Len(str1)
SuperMid = Mid(strMain, i, j - i)
Exit Function
errhandler:
MsgBox "Error extracting strings. Check your input" & vbNewLine & vbNewLine & "Aborting", , "Strings not found"
End
End Function
Function FindWord(Source As String, Position As Integer)

Dim arr() As String
arr = VBA.Split(Source, " ")
xCount = UBound(arr)
If xCount < 1 Or (Position - 1) > xCount Or Position < 0 Then
    FindWord = ""
Else
    FindWord = arr(Position - 1)
End If
End Function
