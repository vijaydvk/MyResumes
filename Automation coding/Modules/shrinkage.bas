Attribute VB_Name = "Module8"
Sub delete_num()
Attribute delete_num.VB_ProcData.VB_Invoke_Func = " \n14"
'
' delete_num Macro
'

'
Dim ws As Worksheet
Dim mailapp, maildoc, mailsheet As Object
Dim i As Integer
Dim rows, cols, dispcol As Integer
Dim sheetlist, new_sheetlist As Variant
'new_sheetlist = Array("Supplies", "Refunds", "Employee's Missing ", "Missing Deposit Shirnkage", "Cash in Change", "Credit card charged", "New opening", "Robbery Stolen")
sheetlist = Array("Dallas", "Houston", "Austin", "N & S Florida", "N & S Carolina", "Alabama", "Kentucky,Tennessee & Georgia", "San Antonio")
dispcol = 2
Set mailapp = CreateObject("Excel.Application")
On Error Resume Next
Set maildoc = mailapp.Workbooks.Open("G:\Automation\Monthly shrinking\12Dec Cash Status Report - New shrinkage.xlsx")
mailapp.Visible = True
'MsgBox (mailsheet.Cells(4, 4).Value)
With Application
    .EnableEvents = False
    .ScreenUpdating = False
End With
ActiveWorkbook.ActiveSheet.Cells(1, 1).Value = "Market"
ActiveWorkbook.ActiveSheet.Cells(1, 2).Value = "Location"
ActiveWorkbook.ActiveSheet.Cells(1, 3).Value = "Location ID"
ActiveWorkbook.ActiveSheet.Cells(1, 4).Value = "Date"
ActiveWorkbook.ActiveSheet.Cells(1, 5).Value = "Actual Diff"
ActiveWorkbook.ActiveSheet.Cells(1, 6).Value = "Bucket amt"
ActiveWorkbook.ActiveSheet.Cells(1, 7).Value = "Particulars"
ActiveWorkbook.ActiveSheet.Cells(1, 8).Value = "Buckets"

ActiveWorkbook.ActiveSheet.Cells(1, 1).Interior.ColorIndex = 37
ActiveWorkbook.ActiveSheet.Cells(1, 2).Interior.ColorIndex = 37
ActiveWorkbook.ActiveSheet.Cells(1, 3).Interior.ColorIndex = 37
ActiveWorkbook.ActiveSheet.Cells(1, 4).Interior.ColorIndex = 37
ActiveWorkbook.ActiveSheet.Cells(1, 5).Interior.ColorIndex = 37
ActiveWorkbook.ActiveSheet.Cells(1, 6).Interior.ColorIndex = 37
ActiveWorkbook.ActiveSheet.Cells(1, 7).Interior.ColorIndex = 37
ActiveWorkbook.ActiveSheet.Cells(1, 8).Interior.ColorIndex = 37

ActiveWorkbook.ActiveSheet.Cells(1, 1).Borders.LineStyle = xlContinuous
ActiveWorkbook.ActiveSheet.Cells(1, 2).Borders.LineStyle = xlContinuous
ActiveWorkbook.ActiveSheet.Cells(1, 3).Borders.LineStyle = xlContinuous
ActiveWorkbook.ActiveSheet.Cells(1, 4).Borders.LineStyle = xlContinuous
ActiveWorkbook.ActiveSheet.Cells(1, 5).Borders.LineStyle = xlContinuous
ActiveWorkbook.ActiveSheet.Cells(1, 6).Borders.LineStyle = xlContinuous
ActiveWorkbook.ActiveSheet.Cells(1, 7).Borders.LineStyle = xlContinuous
ActiveWorkbook.ActiveSheet.Cells(1, 8).Borders.LineStyle = xlContinuous
'ActiveWorkbook.ActiveSheet.Columns(5).NumberFormat = "0"
ActiveWorkbook.ActiveSheet.Columns("A:I").AutoFit
For i = 0 To UBound(sheetlist)
  'Debug.Print sAnimal(i)
  'MsgBox sheetlist(i)
  Set mailsheet = mailapp.ActiveWorkbook.Sheets(sheetlist(i))
  'MsgBox (mailsheet.Cells(4, 4).Value)
  'MsgBox (mailsheet.UsedRange.rows.Count)
  'MsgBox (mailsheet.UsedRange.Columns.Count)
  For rows = 4 To mailsheet.UsedRange.rows.Count
            cols = 5
            For cols = 5 To mailsheet.UsedRange.Columns.Count
                If mailsheet.Cells(rows, cols).Interior.Color = RGB(146, 208, 80) Then
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 1).Value = mailsheet.Cells(rows, 1).Value
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 2).Value = Replace(Replace(Replace(mailsheet.Cells(rows, 3).Value, " (S)", ""), " Rd", ""), "(S)", "")
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 3).Value = mailsheet.Cells(rows, 4).Value
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 4).Value = mailsheet.Cells(2, cols).Value
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 5).Value = mailsheet.Cells(rows, cols).Value
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 5).NumberFormat = "#,##0;(#,##0);0"
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 6).Value = ""
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 7).Value = Replace(Replace(mailsheet.Cells(rows, cols).Comment.Text, "Night Shift:" & Chr(10), ""), Chr(10), "")
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 7).ColumnWidth = 50
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 7).RowHeight = 20
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 8).Value = " "
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 1).Borders.LineStyle = xlContinuous
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 2).Borders.LineStyle = xlContinuous
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 3).Borders.LineStyle = xlContinuous
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 4).Borders.LineStyle = xlContinuous
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 5).Borders.LineStyle = xlContinuous
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 6).Borders.LineStyle = xlContinuous
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 7).Borders.LineStyle = xlContinuous
                    ActiveWorkbook.ActiveSheet.Cells(dispcol, 8).Borders.LineStyle = xlContinuous
                    dispcol = dispcol + 1
                End If
                If InStr(1, LCase(mailsheet.Cells(2, cols).Value), "total", vbTextCompare) > 0 Then
                    'MsgBox (cols)
                    Exit For
                End If
            Next cols
    If InStr(1, LCase(mailsheet.Cells(rows + 2, 3).Value), "total", vbTextCompare) > 0 Then
        'MsgBox (rows)
        Exit For
    End If
  Next rows
Next i
maildoc.Close
'For i = 0 To UBound(new_sheetlist)
        'Set ws = ActiveWorkbook.Sheets.add(After:= _
             'ActiveWorkbook.Sheets(ThisWorkbook.Sheets.Count))
    'ws.Name = new_sheetlist(i)
'Next i

MsgBox ("Completed")
End Sub
