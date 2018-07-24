Attribute VB_Name = "prime_color_time_variant"
Sub prime_color_time_variant()
Attribute prime_color_time_variant.VB_ProcData.VB_Invoke_Func = " \n14"
'
' prime_color_time_variant Macro
'

'
Dim row_count As Integer
Dim i As Integer
row_count = ActiveSheet.UsedRange.rows.Count
For i = 3 To row_count
    With ActiveSheet
    .Cells(i, 5).Value = .Cells(i, 4).Value - .Cells(i, 3).Value
    .Cells(i, 5).NumberFormat = "General"
    'MsgBox (.Cells(i, 5).Text)
    If .Cells(i, 5).Text > 0.0137 Then
        .Cells(i, 4).Interior.ColorIndex = 3
    'MsgBox (i)
    End If
    End With
Next i
End Sub
