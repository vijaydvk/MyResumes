Attribute VB_Name = "Module4"
Sub cash_audit_draft()
Attribute cash_audit_draft.VB_ProcData.VB_Invoke_Func = " \n14"
'
' cash_audit_draft Macro
'

'
    Dim rngFilter As Range
    Dim r As Long, f As Long
    Dim strbody, loc, strsub As String
    Dim rng As Range
    Dim OutApp As Object
    Dim OutMail As Object
    Dim mailapp, maildoc, mailsheet As Object
    Dim mailto, mailcc As String
    Set mailapp = CreateObject("Excel.Application")
    On Error Resume Next
    Set maildoc = mailapp.Workbooks.Open("G:\Automation\Cash_Audit\Cash audit mails.xlsx")
    mailapp.Visible = True
    Set mailsheet = mailapp.ActiveWorkbook.ActiveSheet
    Set rng = Nothing
   
    On Error Resume Next
    For i = 1 To ActiveWorkbook.Sheets.Count
   ' Sheets(i).Range("A2:A50").Merge
    Set rng = Sheets(i).Range("A1:K41").SpecialCells(xlCellTypeVisible)
    'Sheets(i).Range.SpecialCells(xlCellTypeVisible).Copy
    'onedata.Worksheets(1).PasteSpecial xlPasteAll
    On Error GoTo 0
    'MsgBox (Sheets(i).UsedRange.Rows.Count)
    If rng Is Nothing Then
        MsgBox "The selection is not a range or the sheet is protected" & _
               vbNewLine & "please correct and try again.", vbOKOnly
        Exit Sub
    End If
    
    If Sheets(i).UsedRange.rows.Count > 1 Then
    
        With Application
            .EnableEvents = False
            .ScreenUpdating = False
        End With
        
        mailto = ""
        mailcc = ""
                
        Set OutApp = CreateObject("Outlook.Application")
        Set OutMail = OutApp.CreateItem(0)
        With mailsheet
               RowCount = .Cells(.rows.Count, "A").End(xlUp).row
            End With
            'MsgBox (RowCount)
            For x = 1 To RowCount
                 If Replace(LCase(mailsheet.Cells(x, 2).Value), " ", "") = Replace(LCase(ActiveWorkbook.Sheets(i).Name), " ", "") Then
                  'MsgBox ("Found")
                  mailto = mailsheet.Cells(x, 3).Value
                  mailcc = mailsheet.Cells(x, 4).Value
                  strbody = mailsheet.Cells(x, 2).Value & ",<br><br>" & "Good Morning. For the below listed locations, they haven't perform the cash out properly. Can you please assist them to perform the cash out properly." & "<br><br><br>"
                  strsub = mailsheet.Cells(x, 2).Value & ", for below locations they haven't cash out properly yesterday, please ask them to cash out properly"
                 End If
            Next x
    
        On Error Resume Next
        With OutMail
            .To = mailto
            .CC = mailcc
            .Subject = strsub
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
    End If
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
         filename:=TempFile, _
         Sheet:=TempWB.Sheets(1).Name, _
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
    TempWB.Close SaveChanges:=False

    'Delete the htm file we used in this function
    Kill TempFile

    Set ts = Nothing
    Set fso = Nothing
    Set TempWB = Nothing
End Function

