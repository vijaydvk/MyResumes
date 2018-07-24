Attribute VB_Name = "Module14"
Sub hard_count()
Attribute hard_count.VB_ProcData.VB_Invoke_Func = " \n14"
'
' hard_count Macro
'

'
Dim rng As Range
Dim list(200) As String
Dim exapp, exdoc, exsheet As Object
Dim exsheet1 As Object
Dim countsheet(500) As String
    Dim OutApp As Object
    Dim OutMail As Object
    Set rng = Nothing
cnt = 0
'Set exsheet = ActiveSheet
Set exapp = CreateObject("Excel.Application")
Set exdoc = exapp.Workbooks.Open("D:/Automation coding/hard count/05.05/045358.xls")
Set exsheet = exapp.ActiveWorkbook.ActiveSheet

exapp.Visible = True

With exsheet
rowc = .Cells(.Rows.count, "A").End(xlUp).Row
End With
 For i = 5 To rowc
    j = i + 1
    Do While j <= rowc
    If exsheet.Cells(i, "B").value = exsheet.Cells(j, "B").value Then
    'MsgBox .Cells(i, "J").Value & "-" & i & j
       If exsheet.Cells(i, "C").value > exsheet.Cells(j, "C").value Then
        'list(cnt) = i
        'cnt = cnt + 1
        'Exit For
        'Else
        'list(cnt) = i
        'cnt = cnt + 1
        'Exit For
        exsheet.Rows(j).EntireRow.Delete
        'j = j + 1
        Else
        exsheet.Cells(i, "A").value = exsheet.Cells(j, "A").value
        exsheet.Cells(i, "B").value = exsheet.Cells(j, "B").value
        exsheet.Cells(i, "C").value = exsheet.Cells(j, "C").value
        exsheet.Cells(i, "D").value = exsheet.Cells(j, "D").value
        MsgBox exsheet.Cells(j, "B").value
        exsheet.Rows(j).EntireRow.Delete
        End If
    End If
    j = j + 1
   ' MsgBox j
    Loop
  '  list(cnt) = i
   ' cnt = cnt + 1
    
 Next i
 
 'filter using count sheet reference
 'asheet.Range("$A$4:$F$16556").AutoFilter Field:=1, Criteria1:=asheet.Cells(i, "K").value
With exsheet
rowc = .Cells(.Rows.count, "A").End(xlUp).Row
End With

For i = 5 To rowc
countsheet(cnt) = exsheet.Cells(i, "A").value
cnt = cnt + 1
Next i

exdoc.Save
exapp.Quit

Set exdoc = Nothing
Set exapp = Nothing
 
Set exsheet1 = ActiveSheet

For i = 5 To 5  'rowc


exsheet1.Range("$A$3:$I$16556").AutoFilter Field:=1, Criteria1:=countsheet(i)

  Set rng = exsheet1.Range("$C$3:$I" & exsheet1.Range("I65536").End(xlUp).Row).SpecialCells(xlCellTypeVisible)
  
  'Set rng = Sheets(i).Range("A1:E41").SpecialCells(xlCellTypeVisible)

    On Error GoTo 0

    If rng Is Nothing Then
        MsgBox "The selection is not a range or the sheet is protected" & _
               vbNewLine & "please correct and try again.", vbOKOnly
        Exit Sub
    End If

    With Application
        .EnableEvents = False
        .ScreenUpdating = False
    End With

    Set OutApp = CreateObject("Outlook.Application")
    Set OutMail = OutApp.CreateItem(0)

    On Error Resume Next
    With OutMail
        '.To = mailto
        '.CC = mailcc
        .Subject = " Soft count variance 04.27.2017"
        .HTMLBody = RangetoHTML(rng)
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
    
Next i
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
