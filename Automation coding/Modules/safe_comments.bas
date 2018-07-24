Attribute VB_Name = "Module6"
Sub safe_comments()
Attribute safe_comments.VB_ProcData.VB_Invoke_Func = " \n14"
'
' safe_comments Macro
'
'
Dim TheString As String, TheDate As Date
Dim cnt_date, update_flag, color_flag As Integer
Dim ws As Worksheet
Dim wb As Workbook
Dim myPath As String
Dim myFile As String
Dim myExtension As String
Dim row1 As Integer
Dim FldrPicker As FileDialog
Dim filename As String
Dim my_FileName As Variant
Dim date_string As String, date_date(100) As Variant
update_flag = 0
color_flag = 0
  Application.ScreenUpdating = False
  Application.EnableEvents = False
  Application.Calculation = xlCalculationManual
'Retrieve Target Folder Path From User
  Set FldrPicker = Application.FileDialog(msoFileDialogFolderPicker)

    With FldrPicker
      .Title = "Select A Target Folder"
      .AllowMultiSelect = False
        If .Show <> -1 Then GoTo NextCode
        myPath = .SelectedItems(1) & "\"
    End With

'In Case of Cancel
NextCode:
  myPath = myPath
  If myPath = "" Then GoTo ResetSettings

'Target File Extension (must include wildcard "*")
  myExtension = "*.xls*"

'Target Path with Ending Extention
  myFile = Dir(myPath & myExtension)
row1 = 1
'Loop through each Excel file in folder
  Do While myFile <> ""
  Set wb = Workbooks.Open(filename:=myPath & myFile)
      filename = wb.Name
      'MsgBox (wb.Sheets.Count)
       For i = 2 To wb.Sheets.Count
        'MsgBox (wb.Sheets(i).Name)
        'Set FindRow = wb.Sheets(i).Range("A:FV").Find(What:="DM Comments", LookIn:=xlValues, MatchCase:=False, LookAt:=xlWhole)
        'MsgBox (FindRow.Column)
        For j = 2 To wb.Sheets(i).UsedRange.rows.Count
            If wb.Sheets(i).Cells(j, 9).Value <> "" Then
                 Workbooks(2).Sheets(1).Cells(row1, 1).Value = filename
                 Workbooks(2).Sheets(1).Cells(row1, 2).Value = Left(wb.Sheets(i).Cells(j, 1).Value, 3)
                 Workbooks(2).Sheets(1).Cells(row1, 3).Value = wb.Sheets(i).Cells(j, 4).Value
                 Workbooks(2).Sheets(1).Cells(row1, 4).Value = wb.Sheets(i).Cells(j, 9).Value
                 Workbooks(2).Sheets(1).Cells(row1, 5).Value = wb.Sheets(i).Cells(j, 8).Value
                 row1 = row1 + 1
            End If
            If wb.Sheets(i).Cells(j, 9).Value = "" Then
                If wb.Sheets(i).Cells(j, 8).Value <> "Deposited" And wb.Sheets(i).Cells(j, 8).Value <> "" Then
                    Workbooks(2).Sheets(1).Cells(row1, 1).Value = filename
                    Workbooks(2).Sheets(1).Cells(row1, 2).Value = Left(wb.Sheets(i).Cells(j, 1).Value, 3)
                    Workbooks(2).Sheets(1).Cells(row1, 3).Value = wb.Sheets(i).Cells(j, 4).Value
                    Workbooks(2).Sheets(1).Cells(row1, 4).Value = wb.Sheets(i).Cells(j, 9).Value
                    Workbooks(2).Sheets(1).Cells(row1, 5).Value = wb.Sheets(i).Cells(j, 8).Value
                    row1 = row1 + 1
                End If
            End If
            
        Next j
        'MsgBox (wb.Sheets(i).UsedRange.Rows.Count)
       Next i
      'Save and Close Workbook
      wb.Close SaveChanges:=True

    'Ensure Workbook has closed before moving on to next line of code
      DoEvents
    'Get next file name
      myFile = Dir
  Loop
'Message Box when tasks are completed

my_FileName = Application.GetOpenFilename(FileFilter:="Excel Files,*.xl*;*.xm*")

If my_FileName <> False Then

    Set wb = Workbooks.Open(filename:=my_FileName)

End If


wb.Sheets("Safe").Cells.ClearComments
wb.Sheets("Safe").Range("F2:AJ175").Interior.Color = xlNone
'MsgBox (Workbooks(2).ActiveSheet.UsedRange.Rows.Count)

For i = 1 To Workbooks(2).ActiveSheet.UsedRange.rows.Count
    'MsgBox (Workbooks(2).ActiveSheet.Cells(i, 2).Value)
    If Workbooks(2).ActiveSheet.Cells(i, 2).Value <> "130" And Workbooks(2).ActiveSheet.Cells(i, 2).Value <> "180" And Workbooks(2).ActiveSheet.Cells(i, 2).Value <> "143" And Workbooks(2).ActiveSheet.Cells(i, 2).Value <> "172" And Workbooks(2).ActiveSheet.Cells(i, 2).Value <> "160" Then
    Set FindRow = wb.Sheets("Safe").Range("E:E").Find(What:=Workbooks(2).ActiveSheet.Cells(i, 2).Value, LookIn:=xlValues, MatchCase:=True, LookAt:=xlPart)
    For j = 6 To 100
        exit_a = 0
        exit_b = 0
        'MsgBox j
        'MsgBox (Workbooks(2).ActiveSheet.Cells(i, 3).Value)
        If Workbooks(2).ActiveSheet.Cells(i, 3).Value = wb.Sheets("Safe").Cells(1, j).Value And Workbooks(2).ActiveSheet.Cells(i, 4).Value <> "" Then
            'MsgBox (i)
            wb.Sheets("Safe").Cells(FindRow.row, j).AddComment (Workbooks(2).ActiveSheet.Cells(i, 4).Value)
            exit_a = 1
        End If
        If Workbooks(2).ActiveSheet.Cells(i, 3).Value = wb.Sheets("Safe").Cells(1, j).Value And Workbooks(2).ActiveSheet.Cells(i, 5).Value = "No Deposit Made" Then
             wb.Sheets("Safe").Cells(FindRow.row, j).Interior.Color = RGB(255, 0, 0)
             exit_b = 1
        End If
        If Workbooks(2).ActiveSheet.Cells(i, 3).Value = wb.Sheets("Safe").Cells(1, j).Value And Workbooks(2).ActiveSheet.Cells(i, 5).Value = "Shortage" Then
             wb.Sheets("Safe").Cells(FindRow.row, j).Interior.Color = RGB(255, 192, 203)
             exit_b = 1
        End If
        If Workbooks(2).ActiveSheet.Cells(i, 3).Value = wb.Sheets("Safe").Cells(1, j).Value And Workbooks(2).ActiveSheet.Cells(i, 5).Value = "Shortage Reason" Then
             wb.Sheets("Safe").Cells(FindRow.row, j).Interior.Color = RGB(154, 205, 50)
             exit_b = 1
        End If
        If Workbooks(2).ActiveSheet.Cells(i, 3).Value = wb.Sheets("Safe").Cells(1, j).Value And InStr(1, LCase(Workbooks(2).ActiveSheet.Cells(i, 4).Value), "deposited in") <> 0 Then
             wb.Sheets("Safe").Cells(FindRow.row, j).Interior.Color = RGB(30, 144, 255)
             exit_b = 1
        End If
        If exit_a = 1 And exit_b = 1 Then
            Exit For
        End If
    Next j
    End If
Next i

cnt_date = Application.InputBox("No of days")
For i = 0 To cnt_date - 1
    date_string = Application.InputBox("Enter A Date")
    If IsDate(date_string) Then
        date_date(i) = DateValue(date_string)
    Else
        MsgBox "Invalid date"
    End If
Next i

'For i = 0 To cnt_date - 1
   ' MsgBox (date_date(i))
'Next i

wb.Sheets("BANK").Cells.ClearComments
wb.Sheets("BANK").Range("F2:AJ175").Interior.Color = xlNone
'wb.Sheets("BANK").Cells.Interior.ColorIndex = xlColorIndexNone
'MsgBox (Workbooks(2).ActiveSheet.UsedRange.Rows.Count)

For i = 1 To Workbooks(2).ActiveSheet.UsedRange.rows.Count
    'MsgBox (Workbooks(2).ActiveSheet.Cells(i, 2).Value)
    If Workbooks(2).ActiveSheet.Cells(i, 2).Value <> "130" And Workbooks(2).ActiveSheet.Cells(i, 2).Value <> "180" And Workbooks(2).ActiveSheet.Cells(i, 2).Value <> "143" And Workbooks(2).ActiveSheet.Cells(i, 2).Value <> "172" And Workbooks(2).ActiveSheet.Cells(i, 2).Value <> "160" Then
    Set FindRow = wb.Sheets("BANK").Range("E:E").Find(What:=Workbooks(2).ActiveSheet.Cells(i, 2).Value, LookIn:=xlValues, MatchCase:=True, LookAt:=xlPart)
    For j = 6 To 100
        'MsgBox j
        'MsgBox (Workbooks(2).ActiveSheet.Cells(i, 3).Value)
        update_flag = 0
        exit_a = 0
        exit_b = 0
        For x = 0 To cnt_date - 1
          If Workbooks(2).ActiveSheet.Cells(i, 3).Value = date_date(x) Then
            update_flag = 1
          End If
        Next x
        If update_flag = 0 Then
            If Workbooks(2).ActiveSheet.Cells(i, 3).Value = wb.Sheets("BANK").Cells(1, j).Value And Workbooks(2).ActiveSheet.Cells(i, 4).Value <> "" Then
                'MsgBox (i)
                wb.Sheets("BANK").Cells(FindRow.row, j).AddComment (Workbooks(2).ActiveSheet.Cells(i, 4).Value)
                exit_a = 1
            End If
            If Workbooks(2).ActiveSheet.Cells(i, 3).Value = wb.Sheets("BANK").Cells(1, j).Value And Workbooks(2).ActiveSheet.Cells(i, 5).Value = "No Deposit Made" Then
                 wb.Sheets("BANK").Cells(FindRow.row, j).Interior.Color = RGB(255, 0, 0)
                 exit_b = 1
            End If
            If Workbooks(2).ActiveSheet.Cells(i, 3).Value = wb.Sheets("Safe").Cells(1, j).Value And Workbooks(2).ActiveSheet.Cells(i, 5).Value = "Shortage" Then
                 wb.Sheets("BANK").Cells(FindRow.row, j).Interior.Color = RGB(255, 192, 203)
                 exit_b = 1
            End If
            If Workbooks(2).ActiveSheet.Cells(i, 3).Value = wb.Sheets("BANK").Cells(1, j).Value And Workbooks(2).ActiveSheet.Cells(i, 5).Value = "Shortage Reason" Then
                 wb.Sheets("BANK").Cells(FindRow.row, j).Interior.Color = RGB(154, 205, 50)
                 exit_b = 1
            End If
            If Workbooks(2).ActiveSheet.Cells(i, 3).Value = wb.Sheets("BANK").Cells(1, j).Value And InStr(1, LCase(Workbooks(2).ActiveSheet.Cells(i, 4).Value), "deposited in") <> 0 Then
                 wb.Sheets("BANK").Cells(FindRow.row, j).Interior.Color = RGB(30, 144, 255)
                 exit_b = 1
            End If
            If exit_a = 1 And exit_b = 1 Then
                Exit For
            End If
        End If
    Next j
    End If
Next i

ResetSettings:
  'Reset Macro Optimization Settings
    Application.EnableEvents = True
    Application.Calculation = xlCalculationAutomatic
    Application.ScreenUpdating = True
MsgBox "Task Complete!"
End Sub
