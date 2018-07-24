Attribute VB_Name = "Module10"


Sub Soft_count_draft()
Attribute Soft_count_draft.VB_ProcData.VB_Invoke_Func = " \n14"
'
' Soft_count_draft Macro
'
    Dim rngFilter As Range
    Dim r As Long, f As Long
    Dim strbody, loc As String
    Dim rng As Range
    Dim OutApp As Object
    Dim OutMail As Object
    Dim mailapp, maildoc, mailsheet As Object
    strbody = "Hello team," & "<br>" & "Can you please let us know the reason for the variances/excess for the below." & "<br><br><br>"
    Set rng = Nothing
    Set mailapp = CreateObject("Excel.Application")
    On Error Resume Next
    Set maildoc = mailapp.Workbooks.Open("D:\Automation coding\FIFO\FIFO and Soft count.xlsx")
    mailapp.Visible = True
    Set mailsheet = mailapp.ActiveWorkbook.ActiveSheet
   
    On Error Resume Next
    For i = 2 To 2 'workbooks.Count
   ' Sheets(i).Range("A2:A50").Merge
    Set rng = Sheets(i).Range("A1:E41").SpecialCells(xlCellTypeVisible)
            Set FindRow = mailsheet.Range("E:E").Find(What:=Sheets(i).Cells(2, 1).value, LookIn:=xlValues, MatchCase:=False, LookAt:=xlPart)
            If (Not FindRow Is Nothing) Then
            mailto = mailsheet.Cells(FindRow.Row, "M")
            mailcc = mailsheet.Cells(FindRow.Row, "N")
            loc = mailsheet.Cells(FindRow.Row, "D")
            End If
    'Sheets(i).Range.SpecialCells(xlCellTypeVisible).Copy
    'onedata.Worksheets(1).PasteSpecial xlPasteAll
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
        .To = mailto
        .CC = mailcc
        .Subject = loc & " Soft count variance 04.27.2017"
        .HTMLBody = strbody & RangetoHTML(rng)
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
'Else
'MsgBox Sheets(i).Name
'End If
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


Sub Fifo_draft()
Attribute Fifo_draft.VB_ProcData.VB_Invoke_Func = " \n14"
'
' Fifo_draft Macro
'

'
    Dim mailto, mailcc As String
    Dim strbody As String
    Dim rng As Range
    Dim OutApp As Object
    Dim OutMail As Object
    strbody = "Hello team," & "<br>" & "Please arrange the below listed phones in first in first out policy." & "<br><br><br>"
    Set rng = Nothing
    On Error Resume Next
 Dim wkb, individualsheet As Object
 Dim filterstr() As String
 Dim z As Integer
 Dim mailapp, maildoc, mailsheet As Object
 z = 1
 Dim asheet As Object
Set asheet = ActiveSheet

                        Set mailapp = CreateObject("Excel.Application")
                        On Error Resume Next
                        Set maildoc = mailapp.Workbooks.Open("D:\Automation coding\FIFO\FIFO and Soft count.xlsx")
                        mailapp.Visible = True
                        Set mailsheet = mailapp.ActiveWorkbook.ActiveSheet
             With ActiveSheet
                      lastrow1 = .Cells(.Rows.count, "K").End(xlUp).Row
             End With
            'i takes minimum value as 3
            For i = 4 To 4
            Set FindRow = mailsheet.Range("E:E").Find(What:=asheet.Cells(i, "K").value, LookIn:=xlValues, MatchCase:=False, LookAt:=xlWhole)
            If (Not FindRow Is Nothing) Then
            mailto = mailsheet.Cells(FindRow.Row, "M")
            mailcc = mailsheet.Cells(FindRow.Row, "N")
            asheet.Range("$A$4:$F$16556").AutoFilter Field:=1, Criteria1:=asheet.Cells(i, "K").value
            Set rng = asheet.Range("$A$3:$F$16556").SpecialCells(xlCellTypeVisible) '.Copy

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
        .To = mailto
        .CC = mailcc
        '.BCC = ""
        .Subject = "FIFO-" & Split(asheet.Cells(i, "K").value, "-")(1)
        .HTMLBody = strbody & RangetoHTML(rng)
        .Display
        '.Save
        '.Close olPromtForSave
        '.Send
    Application.Wait (Now + TimeValue("0:00:01"))
    End With
    On Error GoTo 0

    With Application
        .EnableEvents = True
        .ScreenUpdating = True
    End With

    Set OutMail = Nothing
    Set OutApp = Nothing
                                     
             End If
            
            Next i
            'asheet.Columns("K").ClearContents
           ' MsgBox filterstr().Item(1).value
           If AdvancedFilter = Active Then
            On Error Resume Next
            ActiveSheet.ShowAllData
           End If
           Application.Wait (Now + TimeValue("0:00:01"))
           
End Sub