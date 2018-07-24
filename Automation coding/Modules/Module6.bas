Attribute VB_Name = "Module6"
Sub time_duplication_deletion()
Attribute time_duplication_deletion.VB_ProcData.VB_Invoke_Func = " \n14"
'
' time_duplication_deletion Macro
'

'

Dim sheet1 As Object
Set sheet1 = ActiveWorkbook.Worksheets("Sheet1")
With sheet1
   dpapprow = .Cells(.Rows.count, "A").End(xlUp).Row
End With
MsgBox dpapprow
For i = 2 To dpapprow
    For j = 1 To dpapprow
    If sheet1.Cells(i, 1).value = sheet1.Cells(j, 1).value Then
        If sheet1.Cells(i, 8).value = sheet1.Cells(j, 8).value Then
        If sheet1.Cells(j, 5).value = "" Then
        sheet1.Cells(j, 5).value = "11:59 PM"
        End If
        If sheet1.Cells(i, 5).value <= sheet1.Cells(j, 5).value Then
        sheet1.Cells(i, 5).value = Format(sheet1.Cells(j, 5).value, "HH:MM AM/PM")
        'sheet1.Rows(j).EntireRow.Delete
        'dpapprow = dpapprow - 1
        End If
        
        End If
    End If
    Next j
Next i

End Sub
