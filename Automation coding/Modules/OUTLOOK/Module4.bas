Attribute VB_Name = "Module4"
Sub SoftCount_status()
 Dim cl As Range, rng As Range
 Dim addr As String
 Dim i, j, x1, i1, i2, i3, Val, pos, color, mailcount, count As Integer
 Dim chkdate, chktime
 Dim nmailcount, loops
 Dim arr(1000) As Integer
 Dim match, match1
 loops = 0
 Val = 0
 color = 0
 count = 1
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
 
 'myfolder1.Display
 
 mailcount = myfolder1.Items.count
' MsgBox mailcount


                 Set wdapp1 = CreateObject("Excel.Application")
                 Set wddoc1 = wdapp1.Workbooks.Open("d:\Book3.xlsx")
                 wdapp1.Visible = True
                 Set mysheet1 = wdapp1.ActiveWorkbook.Worksheets("Sheet1")
                 For i1 = mailcount To 1 Step -1

                    Set myItem = myfolder1.Items(i1)

                      chkdate = Format(myItem.ReceivedTime, "DD/MM/YYYY")
                      chktime = Format(myItem.ReceivedTime, "HH:MM AM/PM")

                        If chkdate = "26/04/2017" Then

                             If InStr(1, myItem.Subject, "Soft Count", vbTextCompare) <> 0 Then
                               If myItem.Attachments.count > 0 Then
                                 count = count + 1
                                 arr(count) = i1
                                 mysheet1.Cells(count, 1).Value = myItem.Subject
                                 mysheet1.Cells(count, 2).Value = Format(myItem.ReceivedTime, "HH:MM AM/PM")
                                 mysheet1.Cells(count, 3).Value = i1
                                 mysheet1.Cells(count, 4).Value = myItem.ReceivedTime
                              End If

                             End If
                        End If
              
                   
              Next i1
             mysheet1.Range("A:G").Sort Key1:=mysheet1.Range("B1:B" & count), Order1:=xlAscending, Orientation:=xlTopToBottom, DataOption1:=xlSortNormal
            ' If count > 0 Then
              
             'For i1 = 1 To count
             'For i3 = i1 + 1 To count
             'If mysheet1.Cells(i1, 1).Value = mysheet1.Cells(i3, 1).Value Then
             'mysheet1.Rows(i3).EntireRow.Delete
             'count = count - 1
             'End If
             
             'Next i3
             'Next i1

         
          'For i1 = 1 To count
          'If mysheet1.Cells(i1, 2).Value < 0.7083 Then
          'mysheet1.Rows(i1).EntireRow.Delete
          'count = count - 1
          'i1 = i1 - 1
          'End If
          'If i1 = -1 Or 11 > count Then
          'Exit For
          'End If
          
         ' Next i1
          
          

             Set wdapp2 = CreateObject("Excel.Application")
             Set wddoc2 = wdapp2.Workbooks.Open("d:\Location names.xlsx")
             wdapp2.Visible = True
             Set mysheet2 = wdapp2.ActiveWorkbook.Worksheets("Sheet1")
             Row3 = mysheet2.UsedRange.Rows.count
             count = mysheet1.UsedRange.Rows.count
             For i1 = 1 To count + 1
             For i3 = 2 To Row3
             match = Replace(mysheet1.Cells(i1, 1).Value, " ", "")
             match1 = Replace(mysheet2.Cells(i3, 1).Value, " ", "")
             If match = match1 Then
             mysheet1.Cells(i1, 5).Value = mysheet2.Cells(i3, 2).Value
             End If
             Next i3
             Next i1
             wddoc2.Save
             wdapp2.Quit

             
           '  For i1 = 1 To count
           '  Set myItem = myfolder1.Items(mysheet1.Cells(i1, 3).Value)
           '  myItem.Display
           '  Set att = Application.ActiveInspector.CurrentItem.Attachments(1)
           '  Set att1 = Application.ActiveInspector.CurrentItem
           '  att1s = Replace(att1.Subject, "/", " ")
           '  If InStr(1, att.FileName, "ods", vbTextCompare) > 0 Then
           '  mysheet1.Cells(i1, 6).Value = "d:\temp\" & att1s & ".ods"
           '  att.SaveAsFile "d:\temp\" & att1s & ".ods"
           '  Else
           '  mysheet1.Cells(i1, 6).Value = "d:\temp\" & att1s & ".xlsx"
           '  att.SaveAsFile "d:\temp\" & att1s & ".xlsx"
           '  End If
           '  myItem.Close olDiscard
           '  Next i1
          ' End If
             
End Sub