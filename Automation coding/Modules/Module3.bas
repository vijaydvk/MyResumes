Attribute VB_Name = "Module3"
Sub Checklist()
Attribute Checklist.VB_ProcData.VB_Invoke_Func = " \n14"

' checklist Macro
' Opening and closing check lists
'

'

Dim opsheet, clsheet, opoutput, cloutput As Object
Dim i, j, x, y As Integer
Set opsheet = ActiveWorkbook.Worksheets("Sheet1")
Set clsheet = ActiveWorkbook.Worksheets("Sheet2")
Set opoutput = ActiveWorkbook.Worksheets("Opening Checklist")
Set cloutput = ActiveWorkbook.Worksheets("Closing Checklist")
Dim col
col = 0
'MsgBox opoutput.Cells(1, 1).Value

'MsgBox clsheet.Cells(1, 4).Value

lastRow = opoutput.Cells(opoutput.Rows.count, "A").End(xlUp).Row
lastcolumn = opoutput.Cells(1, opoutput.Columns.count).End(xlToLeft).column
lastrow1 = opsheet.Cells(opoutput.Rows.count, "A").End(xlUp).Row
lastcolumn1 = opsheet.Cells(1, opoutput.Columns.count).End(xlToLeft).column
lastrow2 = clsheet.Cells(opoutput.Rows.count, "A").End(xlUp).Row
lastcolumn2 = clsheet.Cells(1, opoutput.Columns.count).End(xlToLeft).column
lastrow3 = cloutput.Cells(opoutput.Rows.count, "A").End(xlUp).Row
lastcolumn3 = cloutput.Cells(1, opoutput.Columns.count).End(xlToLeft).column
'MsgBox lastrow1
For i = 1 To lastrow1
    
    For j = 1 To lastcolumn1
            opsheet.Cells(i, j).RowHeight = 20
    Next j
Next i
For i = 1 To lastrow2
    
    For j = 1 To lastcolumn2
            clsheet.Cells(i, j).RowHeight = 20
    Next j
Next i
'MsgBox lastrow
'MsgBox lastcolumn
For i = 2 To lastRow
    
    For j = 2 To lastcolumn
          opoutput.Cells(i, j).value = ""
          opoutput.Cells(i, j).Interior.ColorIndex = 0
          opoutput.Cells(i, j).Borders.LineStyle = xlContinuous
          opoutput.Cells(i, j).ColumnWidth = 25
          
    Next j
Next i
For i = 2 To lastrow3
    
    For j = 2 To lastcolumn3
          cloutput.Cells(i, j).value = ""
          cloutput.Cells(i, j).Interior.ColorIndex = 0
          cloutput.Cells(i, j).Borders.LineStyle = xlContinuous
          cloutput.Cells(i, j).ColumnWidth = 25
          
    Next j
Next i
'opoutput.Columns("A:Z").ColumnWidth = 25
'opsheet.Rows(1).RowHeight = 25
'MsgBox opsheet.Cells(1, 3).Value
'MsgBox opoutput.Cells(2, 1).Value
For i = 2 To lastRow
  For j = 1 To lastrow1
  If Replace(opoutput.Cells(i, 1).value, " ", "") = Replace(opsheet.Cells(j, 3).value, " ", "") Then
  opsheet.Cells(j, 7).value = "checked"
            For x = 2 To lastcolumn - 3
                If InStr(1, opsheet.Cells(j, 5), opoutput.Cells(1, x).value, vbTextCompare) > 0 Then
                    opoutput.Cells(i, x).value = "Done"
                Else
                    opoutput.Cells(i, x).value = "Missed"
                    opoutput.Cells(i, x).Interior.ColorIndex = 40
                    'opoutput.Cells(i, x).Interior.color = 3
                    opoutput.Cells(i, x).Borders.LineStyle = xlContinuous
                End If
            Next x
            
            opoutput.Cells(i, 24).value = Replace(SuperMid(opsheet.Cells(j, 5), "Notes:", "Thank"), vbLf, "")
            opoutput.Cells(i, 25).value = opsheet.Cells(j, 4).value
            If Replace(opoutput.Cells(i, 25).value, " ", "") = "" Then
            opoutput.Cells(i, 25).value = opsheet.Cells(j, 2).value
            End If
            opoutput.Cells(i, 26).value = opsheet.Cells(j, 6).value
            'opoutput.Cells(i, 1).Interior.ColorIndex = 33
            col = 1
  End If
  Next j
  'MsgBox opoutput.Cells(i, 1).Value
    If col = 0 Then
    opoutput.Cells(i, 2).value = "They haven't sent checklist"
        For x = 2 To lastcolumn
            opoutput.Cells(i, x).Interior.ColorIndex = 33
        Next x
    End If
    col = 0
Next i
col = 0
For i = 1 To lastrow1
  For x = 2 To lastRow
  If Replace(opsheet.Cells(i, 3).value, " ", "") = Replace(opoutput.Cells(x, 1).value, " ", "") Then
            opsheet.Cells(i, 3).Interior.ColorIndex = 1
            opsheet.Cells(i, 3).Borders.LineStyle = xlContinuous
  col = 1
  End If
  If col = 1 Then
  opsheet.Cells(i, 3).Interior.ColorIndex = 2
  End If
  Next x
  col = 0
  'MsgBox opoutput.Cells(i, 1).Value
Next i


col = 0

For i = 2 To lastrow3
  For j = 1 To lastrow2
  If Replace(cloutput.Cells(i, 1).value, " ", "") = Replace(clsheet.Cells(j, 3).value, " ", "") Then
  clsheet.Cells(j, 7).value = "checked"
            For x = 2 To lastcolumn - 3
                If InStr(1, clsheet.Cells(j, 5), cloutput.Cells(1, x).value, vbTextCompare) > 0 Then
                    cloutput.Cells(i, x).value = "Done"
                Else
                    cloutput.Cells(i, x).value = "Missed"
                    cloutput.Cells(i, x).Interior.ColorIndex = 40
                    'cloutput.Cells(i, x).Interior.color = 22
                    cloutput.Cells(i, x).Borders.LineStyle = xlContinuous
                End If
            Next x
            cloutput.Cells(i, 24).value = Replace(SuperMid(clsheet.Cells(j, 5).value, "Notes:", "Thank"), vbLf, "")
            cloutput.Cells(i, 25).value = clsheet.Cells(j, 4).value
            cloutput.Cells(i, 26).value = clsheet.Cells(j, 6).value
            'opoutput.Cells(i, 1).Interior.ColorIndex = 33
            col = 1
  End If
  Next j
   If col = 0 Then
        cloutput.Cells(i, 2).value = "They haven't sent checklist"
        For x = 2 To lastcolumn
            cloutput.Cells(i, x).Interior.ColorIndex = 33
        Next x
    End If
    col = 0
  'MsgBox opoutput.Cells(i, 1).Value
Next i
col = 0
For i = 1 To lastrow2
  For x = 2 To lastrow3
  If Replace(clsheet.Cells(i, 3).value, " ", "") = Replace(cloutput.Cells(x, 1).value, " ", "") Then
            clsheet.Cells(i, 3).Interior.ColorIndex = 1
            clsheet.Cells(i, 3).Borders.LineStyle = xlContinuous
  col = 1
  End If
  If col = 1 Then
  clsheet.Cells(i, 3).Interior.ColorIndex = 2
  End If
  Next x
  col = 0
  'MsgBox opoutput.Cells(i, 1).Value
Next i





End Sub
Public Function SuperMid(ByVal strMain As String, str1 As String, str2 As String, Optional reverse As Boolean) As String

Dim i As Integer, j As Integer, temp As Variant
On Error GoTo errhandler:
If reverse = True Then
    i = InStrRev(strMain, str1)
    j = InStrRev(strMain, str2)
    If i = j Then
        j = InStrRev(strMain, str2, i - 1)
    End If
Else
'MsgBox strMain
    i = InStr(1, strMain, str1)
    j = InStr(1, strMain, str2)
    If i = j Then
        j = InStr(i + 1, strMain, str2)
    End If
End If
If i = 0 And j = 0 Then GoTo errhandler:
If j = 0 Then j = Len(strMain) + Len(str2)
If i = 0 Then i = Len(strMain) + Len(str1)
If i > j And j <> 0 Then 'swap order
    temp = j
    j = i
    i = temp
    temp = str2
    str2 = str1
    str1 = temp
End If
i = i + Len(str1)
SuperMid = Mid(strMain, i, j - i)
Exit Function
errhandler:
MsgBox "Error extracting strings. Check your input" & vbNewLine & vbNewLine & "Aborting", , "Strings not found"
End
End Function
