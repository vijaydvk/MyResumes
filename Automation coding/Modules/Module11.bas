Attribute VB_Name = "Module11"
Sub Working_hours_split()
Attribute Working_hours_split.VB_ProcData.VB_Invoke_Func = " \n14"
'
' Working_hours_split Macro
'

'
Dim dispbody As String
Dim FilePath As String
Dim OutApp As Object
Dim OutMail As Object
Dim splitword
Dim x, chk, k, lp As Integer
Dim temp As String
Dim chkcount As Integer
chkcount = 0
x = 1
chk = 1
dispbody = ""
Dim leng As Integer
Dim start, endd As Integer
endd = 1
Dim sheet2, sheet1 As Object
Dim rng As Range
Dim cellvalue
Set rng = Selection
FilePath = Application.DefaultFilePath & "\auth.txt"
Set sheet2 = ActiveWorkbook.Worksheets(1)
             For lp = 2 To ActiveWorkbook.Worksheets.count
             Set sheet1 = ActiveWorkbook.Worksheets(lp)
             With sheet1
                      lastrow1 = .Cells(.Rows.count, "A").End(xlUp).Row
   
             'MsgBox lastrow1
             
             For i = 1 To 1 'lastrow1 - 18
             If InStr(1, .Cells(i, 1).value, "Total", vbTextCompare) = 0 And InStr(1, .Cells(i, 1).value, "Note :", vbTextCompare) = 0 Then
             If .Cells(i, 1).value = "WeekOff" Then
             i = i + 3
             sheet2.Cells(x, 1).value = "---------------------------------------------------------------------------------------------------------------------------------"
             sheet2.Cells(x + 1, 1).value = " "
             x = x + 2
             'MsgBox x
             endd = i
             'MsgBox start
             'MsgBox endd
              For k = start To endd
                 sheet2.Cells(x, 1).value = .Cells(k, 1).value
                 'MsgBox sheet2.Cells(x, 1).value
                 x = x + 1
             Next k
             
             endd = endd + 2
             Else
             start = endd
             '.Cells(i, 1).value = Replace(.Cells(i, 1).value, "Schedule", "Updates")
             If InStr(1, .Cells(i, 1).value, "AM", vbTextCompare) > 0 Then
             
             splitword = Split(.Cells(i, 1).value, ",", -1, vbTextCompare)
             
                'MsgBox splitword(0)
                For j = 0 To UBound(splitword)
                'MsgBox Split(splitword(0), "Hours Worked", -1, vbTextCompare)(0)
                leng = Len(splitword(j))
                'MsgBox leng
                'temp = splitword(j)
                temp = Left(splitword(j), leng - 10)
                'MsgBox temp
                 If (InStr(1, temp, "09:", vbTextCompare) > 0 Or InStr(1, temp, "10:", vbTextCompare) > 0 Or InStr(1, temp, "08:", vbTextCompare) > 0) Then
                    If InStr(splitword(j), "AM") > 0 Then
                         chk = 0
                         'MsgBox splitword(j)
                         If sheet2.Cells(x, 1).value = "" Then
                         chkcount = chkcount + 1
                         sheet2.Cells(x, 1).value = Split(splitword(j), "Hours Worked", -1, vbTextCompare)(0) & ") , "
                         'MsgBox sheet2.Cells(i, 1).value
                         Else
                         sheet2.Cells(x, 1).value = sheet2.Cells(x, 1).value + Split(splitword(j), "Hours Worked", -1, vbTextCompare)(0) & ") , "
                         chkcount = chkcount + 1
                         'MsgBox sheet2.Cells(i, 1).value
                         End If
                    End If
                 End If
                Next j
                'MsgBox sheet2.Cells(i, 1).value
                If chk = 0 Then
                sheet2.Cells(x, 1).value = Left(sheet2.Cells(x, 1).value, Len(sheet2.Cells(x, 1).value) - 2)
                If chkcount <= 1 Then
                sheet2.Cells(x, 1).value = sheet2.Cells(x, 1).value + "is there."
                Else
                sheet2.Cells(x, 1).value = sheet2.Cells(x, 1).value + "are there."
                End If
                End If
                'MsgBox sheet2.Cells(i, 1).value
             
             Else
             
             sheet2.Cells(x, 1).value = .Cells(i, 1).value
             sheet2.Cells(x, 1).value = Replace(sheet2.Cells(x, 1).value, "Schedule", "Updates")
             End If
             x = x + 1
             
             End If
             chk = 1
             Else
                        sheet2.Cells(x, 1).value = .Cells(i, 1).value
            x = x + 1
             End If
             chkcount = 0
             
             Next i

          End With
      '  Open FilePath For Output As #1
                   With sheet2
                      x = .Cells(.Rows.count, "A").End(xlUp).Row
                   End With
                   sheet2.Columns("A").AutoFit
                   'MsgBox x
       ' For i = 1 To x
       ' Print #1, sheet2.Cells(i, 1).value
       'dispbody = dispbody + sheet2.Cells(i, 1).value
       ' Next i
       Set rng = sheet2.Range("A1:A" & x).SpecialCells(xlCellTypeVisible)
      '  Close #1
        'MsgBox x
       ' Dim MyTxtFile
       ' MyTxtFile = Shell("C:\WINDOWS\notepad.exe C:\Users\Morning Shift\Documents\auth.txt", 1)
        
        Set OutApp = CreateObject("Outlook.Application")
        Set OutMail = OutApp.CreateItem(0)
        'MsgBox OutMail.Session.Accounts.Item(2)
    On Error Resume Next
    With OutMail
        '.From = OutMa    e = "jchandra@suncommobile.com"
        '.SendUsingAccount = OutMail.Session.Accounts.Item(2)
        '.SentOnBehalfOfName = OutMail.Session.Accounts.Item(2)
        .SendUsingAccount = OutApp.Session.Accounts.Item(2)
        .Display
        '.Save
        '.Close olPromtForSave
        '.Send   'or use .Display
    End With
    On Error GoTo 0

    With Application
        .EnableEvents = True
        .ScreenUpdating = True
    End With

    Set OutMail = Nothing
    Set OutApp = Nothing
        
        sheet2.Columns("A").Delete
        
        Next lp
End Sub


Function RangetoHTML(rng As Range)
' Changed by Ron de Bruin 28-Oct-2006
' Working in Office 2000-2016
    Dim fso As Object
    Dim ts As Object
    Dim TempFile As String
    Dim TempWB As Workbook

    TempFile = Environ$("temp") & "\" & Format(Now, "dd-mm-yy h-mm-ss") & ".htm"

    'Copy the range and create a new workbook to past the data in
    rng.Copy
    Set TempWB = Workbooks.add(1)
    With TempWB.Sheets(1)
        .Cells(1).PasteSpecial Paste:=8
        .Cells(1).PasteSpecial xlPasteValues, , False, False
        .Cells(1).PasteSpecial xlPasteFormats, , False, False
        .Cells(1).Select
        Application.CutCopyMode = False
        On Error Resume Next
        .DrawingObjects.Visible = True
        .DrawingObjects.Delete
        On Error GoTo 0
    End With

    'Publish the sheet to a htm file
    With TempWB.PublishObjects.add( _
         SourceType:=xlSourceRange, _
         Filename:=TempFile, _
         sheet:=TempWB.Sheets(1).Name, _
         Source:=TempWB.Sheets(1).UsedRange.Address, _
         HtmlType:=xlHtmlStatic)
        .Publish (True)
    End With

    'Read all data from the htm file into RangetoHTML
    Set fso = CreateObject("Scripting.FileSystemObject")
    Set ts = fso.GetFile(TempFile).OpenAsTextStream(1, -2)
    RangetoHTML = ts.readall
    ts.Close
    RangetoHTML = Replace(RangetoHTML, "align=center x:publishsource=", _
                          "align=left x:publishsource=")

    'Close TempWB
    TempWB.Close savechanges:=False

    'Delete the htm file we used in this function
    Kill TempFile

    Set ts = Nothing
    Set fso = Nothing
    Set TempWB = Nothing
End Function

