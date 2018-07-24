Attribute VB_Name = "Module8"
Sub Softcount_status_report()
Attribute Softcount_status_report.VB_ProcData.VB_Invoke_Func = " \n14"
'
' Softcount_status_report Macro
'

'
Dim stat As Integer
Dim column, date1 As String
column = "J"
date1 = "04/26/2017"
Dim wdapp2, wdapp3, mysheet1, status As Object
Set wdapp2 = CreateObject("Excel.Application")
Set wdapp3 = wdapp2.Workbooks.Open("d:\Soft Count (Status).xls")
wdapp2.Visible = True
stat = 0
'Set mysheet1 = wdapp2.ActiveWorkbook.ActiveSheet
For i = 1 To 9
Set status = wdapp2.Worksheets(i)
'Row = status.UsedRange.Rows.count
'MsgBox Row

status.Cells(3, column).value = date1
For j = 4 To 100

If status.Cells(j, 2).value <> "" And status.Cells(j, 2).value <> "Store Number" Then

For x = 1 To 139

With ActiveSheet
If InStr(1, Cells(x, 5).value, status.Cells(j, 2).value, vbTextCompare) > 0 Then


'MsgBox Cells(1, 5).value
stat = 1
status.Cells(j, column).value = "Yes"
status.Cells(j, column).HorizontalAlignment = xlCenter
status.Cells(j, column).Borders.LineStyle = xlContinuous
status.Cells(j, column).ClearComments
If Cells(x, 2).value < 0.7083 Then
status.Cells(j, column).AddComment "They Send " & Format(Cells(x, 2), "HH:MM AM/PM")
End If
End If
End With

Next x

If stat = 0 Then
status.Cells(j, column).value = "No"
status.Cells(j, column).HorizontalAlignment = xlCenter
status.Cells(j, column).Borders.LineStyle = xlContinuous
End If

End If
stat = 0

Next j



Next i
End Sub