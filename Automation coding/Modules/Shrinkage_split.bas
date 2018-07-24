Attribute VB_Name = "Shrinkage_split"
Sub Shrinkage_split()
Attribute Shrinkage_split.VB_ProcData.VB_Invoke_Func = " \n14"
'
' shrinkage_split Macro
'

'
Dim new_sheetlist As Variant
Dim row As Integer
Dim sheetlist_index As Integer
Dim bucket_amt As Integer
new_sheetlist = Array("Supplies", "Refunds", "Employee's Missing", "Missing Deposit Shirnkage", "Cash in Change", "Credit card charged", "New opening", "Robbery Stolen")
new_sheetlist1 = Array("Supplies", "Refunds", "Employee's Missing", "Missing Deposit Shirnkage", "Cash in Change", "Credit card charged", "New opening", "Robbery/Stolen")
For i = 0 To UBound(new_sheetlist)
    ActiveWorkbook.Sheets.add(After:=ActiveWorkbook.Sheets(ActiveWorkbook.Sheets.Count)).Name = new_sheetlist(i)
Next i
sheetlist_index = 0
For i = 2 To UBound(new_sheetlist) + 2
    'MsgBox (ActiveWorkbook.Sheets(1).UsedRange.rows.Count)
    'MsgBox (ActiveWorkbook.Sheets(i).Name)
    bucket_amt = 0
    row = 2
    ActiveWorkbook.Sheets(i).Cells(1, 1).Value = "Market"
    ActiveWorkbook.Sheets(i).Cells(1, 2).Value = "Location"
    ActiveWorkbook.Sheets(i).Cells(1, 3).Value = "Location ID"
    ActiveWorkbook.Sheets(i).Cells(1, 4).Value = "Date"
    ActiveWorkbook.Sheets(i).Cells(1, 5).Value = "Actual Diff"
    ActiveWorkbook.Sheets(i).Cells(1, 6).Value = "Bucket amt"
    ActiveWorkbook.Sheets(i).Cells(1, 7).Value = "Particulars"
    ActiveWorkbook.Sheets(i).Cells(1, 8).Value = "Approved by"
    ActiveWorkbook.Sheets(i).Cells(1, 9).Value = "Mail date & Time"
    ActiveWorkbook.Sheets(i).Cells(1, 10).Value = "Buckets"
    
    ActiveWorkbook.Sheets(i).Cells(1, 1).Interior.ColorIndex = 37
    ActiveWorkbook.Sheets(i).Cells(1, 2).Interior.ColorIndex = 37
    ActiveWorkbook.Sheets(i).Cells(1, 3).Interior.ColorIndex = 37
    ActiveWorkbook.Sheets(i).Cells(1, 4).Interior.ColorIndex = 37
    ActiveWorkbook.Sheets(i).Cells(1, 5).Interior.ColorIndex = 37
    ActiveWorkbook.Sheets(i).Cells(1, 6).Interior.ColorIndex = 37
    ActiveWorkbook.Sheets(i).Cells(1, 7).Interior.ColorIndex = 37
    ActiveWorkbook.Sheets(i).Cells(1, 8).Interior.ColorIndex = 37
    ActiveWorkbook.Sheets(i).Cells(1, 9).Interior.ColorIndex = 37
    ActiveWorkbook.Sheets(i).Cells(1, 10).Interior.ColorIndex = 37
    
    ActiveWorkbook.Sheets(i).Cells(1, 1).Borders.LineStyle = xlContinuous
    ActiveWorkbook.Sheets(i).Cells(1, 2).Borders.LineStyle = xlContinuous
    ActiveWorkbook.Sheets(i).Cells(1, 3).Borders.LineStyle = xlContinuous
    ActiveWorkbook.Sheets(i).Cells(1, 4).Borders.LineStyle = xlContinuous
    ActiveWorkbook.Sheets(i).Cells(1, 5).Borders.LineStyle = xlContinuous
    ActiveWorkbook.Sheets(i).Cells(1, 6).Borders.LineStyle = xlContinuous
    ActiveWorkbook.Sheets(i).Cells(1, 7).Borders.LineStyle = xlContinuous
    ActiveWorkbook.Sheets(i).Cells(1, 8).Borders.LineStyle = xlContinuous
    ActiveWorkbook.Sheets(i).Cells(1, 9).Borders.LineStyle = xlContinuous
    ActiveWorkbook.Sheets(i).Cells(1, 10).Borders.LineStyle = xlContinuous
    
    For j = 1 To ActiveWorkbook.Sheets(1).UsedRange.rows.Count
        If InStr(Replace(LCase(ActiveWorkbook.Sheets(1).Cells(j, 8)), " ", ""), Replace(LCase(new_sheetlist1(sheetlist_index)), " ", "")) > 0 Then
      
            ActiveWorkbook.Sheets(i).Cells(row, 1).Value = ActiveWorkbook.Sheets(1).Cells(j, 1).Value
            ActiveWorkbook.Sheets(i).Cells(row, 2).Value = ActiveWorkbook.Sheets(1).Cells(j, 2).Value
            ActiveWorkbook.Sheets(i).Cells(row, 3).Value = ActiveWorkbook.Sheets(1).Cells(j, 3).Value
            ActiveWorkbook.Sheets(i).Cells(row, 4).Value = ActiveWorkbook.Sheets(1).Cells(j, 4).Value
            ActiveWorkbook.Sheets(i).Cells(row, 5).Value = ActiveWorkbook.Sheets(1).Cells(j, 5).Value
            ActiveWorkbook.Sheets(i).Cells(row, 6).Value = ActiveWorkbook.Sheets(1).Cells(j, 6).Value
            ActiveWorkbook.Sheets(i).Cells(row, 7).Value = ActiveWorkbook.Sheets(1).Cells(j, 7).Value
            ActiveWorkbook.Sheets(i).Cells(row, 8).Value = ""
            ActiveWorkbook.Sheets(i).Cells(row, 9).Value = ""
            ActiveWorkbook.Sheets(i).Cells(row, 10).Value = ActiveWorkbook.Sheets(1).Cells(j, 8).Value
            
            ActiveWorkbook.Sheets(i).Cells(row, 1).Borders.LineStyle = xlContinuous
            ActiveWorkbook.Sheets(i).Cells(row, 2).Borders.LineStyle = xlContinuous
            ActiveWorkbook.Sheets(i).Cells(row, 3).Borders.LineStyle = xlContinuous
            ActiveWorkbook.Sheets(i).Cells(row, 4).Borders.LineStyle = xlContinuous
            ActiveWorkbook.Sheets(i).Cells(row, 5).Borders.LineStyle = xlContinuous
            ActiveWorkbook.Sheets(i).Cells(row, 6).Borders.LineStyle = xlContinuous
            ActiveWorkbook.Sheets(i).Cells(row, 7).Borders.LineStyle = xlContinuous
            ActiveWorkbook.Sheets(i).Cells(row, 8).Borders.LineStyle = xlContinuous
            ActiveWorkbook.Sheets(i).Cells(row, 9).Borders.LineStyle = xlContinuous
            ActiveWorkbook.Sheets(i).Cells(row, 10).Borders.LineStyle = xlContinuous
            
            row = row + 1
            
            bucket_amt = bucket_amt + ActiveWorkbook.Sheets(1).Cells(j, 6).Value
        End If
    Next j
    ActiveWorkbook.Sheets(i).Cells(row + 1, 4).Value = "Total"
    ActiveWorkbook.Sheets(i).Cells(row + 1, 5).Value = bucket_amt
    ActiveWorkbook.Sheets(i).Cells(row + 3, 4).Value = "As Per CSR"
    ActiveWorkbook.Sheets(i).Cells(row + 3, 5).Value = bucket_amt
    sheetlist_index = sheetlist_index + 1
Next i
MsgBox ("Completed")
End Sub
