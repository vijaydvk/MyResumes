Attribute VB_Name = "Module1"
Sub webdriver()
Attribute webdriver.VB_ProcData.VB_Invoke_Func = " \n14"

 ' run this macro from book1
 ' ---------------------------
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
 count = 0
 Dim locmailsub, inboxmailsub
 Dim myItem As Outlook.MailItem
 Dim myitem1 As Outlook.MailItem
 Dim att As Object
 Dim att1 As Object
 Dim wdapp, wdapp1, wdapp2, wdapp3, wdapp4 As Object
 Dim att1s As String
 Dim wddoc, wddoc1, wddoc2, wddoc3, wddoc4 As Object
 Dim mysheet, mysheet1, mysheet2, mysheet3, mysheet4 As Object
 Dim myFolder As Folder
 Dim atts As Outlook.Attachments
 Dim myAttachment As Outlook.Attachment
 Dim daate As Outlook.AppointmentItem
 Dim x
' Set myNamespace = Application.GetNamespace("MAPI")
 
 'Set myFolder = myNamespace.GetDefaultFolder(olFolderInbox).Parent.Folders.Item("Checklist")
 

' mailcount = myFolder.Items.count
 'MsgBox mailcount
                 'Open a book to write all location details
                 '-----------------------------------------
             Set wdapp3 = CreateObject("Excel.Application")
             Set wddoc3 = wdapp3.Workbooks.Open("d:\Inventory.xls")
             wdapp3.Visible = True
             Set mysheet3 = wdapp3.ActiveWorkbook.Worksheets("Sheet1")
             inventryrow = mysheet3.UsedRange.Rows.count
             With ActiveSheet
                      lastrow1 = .Cells(.Rows.count, "A").End(xlUp).Row
             End With
             For i = 1 To lastrow1
                'mysheet3.AutoFilterMode = True
                mysheet3.Range("C3").AutoFilter Field:=3, Criteria1:=ActiveSheet.Cells(i, 2)
                mysheet3.Range("A3").AutoFilter Field:=1, Criteria1:=ActiveSheet.Cells(i, 1)
                Set rng = mysheet3.Range("A4:A" & inventryrow)
                    For Each cl In rng.SpecialCells(xlCellTypeVisible)
                    addr = Replace(cl.Address, "$A$", "")
                    If InStr(1, mysheet3.Cells(addr, 3).value, ActiveSheet.Cells(i, 2).value, vbTextCompare) <> 0 Then
                    color = 1
                    Val = Val + mysheet3.Cells(addr, 4)
                    End If
                    Next cl
                    ActiveSheet.Cells(i, 4).value = Val
                    Val = 0
                    If color = 0 Then
                    ActiveSheet.Cells(i, 4).Interior.ColorIndex = 35
                    ActiveSheet.Cells(i, 4).Borders.LineStyle = xlContinuous
                    End If
                    color = 0
             Next i
             wddoc3.Save
             wdapp3.Quit
            ' wddoc4.Save
             'wdapp4.Quit
             
End Sub
