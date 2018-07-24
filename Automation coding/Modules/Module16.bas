Attribute VB_Name = "Module16"
Sub Softcount_onebook_data()
Attribute Softcount_onebook_data.VB_ProcData.VB_Invoke_Func = " \n14"
'
' Softcount_onebook_data Macro
'

'
Dim cursheet As Object
Dim onedata As Workbook
Set cursheet = ActiveWorkbook
Set onedata = Workbooks.add
cnt = ActiveWorkbook.Worksheets.count
shapprow = 0
For i = 2 To cnt
If i = 2 Then
cursheet.Worksheets(i).Range("A1:E60").SpecialCells(xlCellTypeVisible).Copy
onedata.Worksheets(1).Paste
rowz = cursheet.Worksheets(i).AutoFilter.Range.Columns(1).SpecialCells(xlCellTypeVisible).Cells.count - 1
Else
shapprow = shapprow + 1
cursheet.Worksheets(i).Range("A2:E60").Copy
'onedata.Worksheets(1).Range("A5:E65").Paste
onedata.Worksheets(1).Range("A" & shapprow).Select
Selection.PasteSpecial
End If
With onedata.Worksheets(1)
   shapprow = .Cells(.Rows.count, "A").End(xlUp).Row
End With
Next i

onedata.Worksheets(1).Columns("A:E").AutoFit
onedata.Worksheets(1).Columns("A:E").HorizontalAlignment = xlCenter

End Sub
