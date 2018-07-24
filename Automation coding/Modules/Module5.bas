Attribute VB_Name = "Module5"
Sub Deposit()
Attribute Deposit.VB_ProcData.VB_Invoke_Func = " \n14"
'
' Deposit Macro
'

Dim rng, cl As Range
Dim sheet, sheet2, sheet3, sheet4, sheet5, sheet6 As Object
Dim wkb, wkb1 As Workbook
Dim dpapp, dpdoc, dpsheet, dbsheet1, dpdoc1, dpapp1 As Object
Dim shapp, shdoc, shsheet As Object
Dim cnt, m, n, new1 As Integer
Dim addr As String
new1 = 1
m = 2
n = 2
cnt = ActiveWorkbook.Sheets.count
'MsgBox cnt
Set dpapp = CreateObject("Excel.Application")
Set dpdoc = dpapp.Workbooks.Open("D:/Automation coding/Deposit/Nodeposit.xlsx")
Set dpsheet = dpapp.ActiveWorkbook.Worksheets("Sheet1")
Set shapp = CreateObject("Excel.Application")
Set shdoc = shapp.Workbooks.Open("D:/Automation coding/Deposit/variance.xlsx")
Set shsheet = shapp.ActiveWorkbook.ActiveSheet
dpapp.Visible = True
shapp.Visible = True
With dpapp
   dpapprow = .Cells(.Rows.count, "A").End(xlUp).Row
End With

With shapp
   shapprow = .Cells(.Rows.count, "A").End(xlUp).Row
End With
dpapprow = dpapprow + 1
shapprow = shapprow + 1
'MsgBox dpsheet.Name
For i = 2 To cnt - 3
With ActiveWorkbook.Sheets(i)
   lastRow = .Cells(.Rows.count, "A").End(xlUp).Row
End With




For j = 1 To lastRow
Set sheet = ActiveWorkbook.Worksheets(i)
'to check sheetwise not deposited value in H column
'--------------------------------------------------
 Set sheet2 = ActiveWorkbook.Worksheets(cnt - 1)
If sheet.Cells(j, 8) = "No Deposit Made" Then
'MsgBox i
'MsgBox j
 'MsgBox sheet2.Name
      'write the content into no deposite sheet
      '----------------------------------------
      sheet2.Cells(m, 1).value = sheet.Cells(j, 1).value
      sheet2.Cells(m, 2).value = sheet.Cells(j, 2).value
      sheet2.Cells(m, 3).value = sheet.Cells(j, 3).value
      sheet2.Cells(m, 4).value = sheet.Cells(j, 4).value
      sheet2.Cells(m, 5).value = sheet.Cells(j, 5).value
      sheet2.Cells(m, 6).value = "No Deposit made"
      sheet2.Cells(m, 7).value = sheet.Cells(j, 9).value
       'mysheet3.Range("C3").AutoFilter field:=3, Criteria1:="Patricia Lamas"
       
      dpapp.Cells(dpapprow, 1).value = sheet.Cells(j, 1).value
      dpapp.Cells(dpapprow, 2).value = sheet.Cells(j, 2).value
      dpapp.Cells(dpapprow, 3).value = sheet.Cells(j, 3).value
      dpapp.Cells(dpapprow, 4).value = sheet.Cells(j, 4).value
      dpapp.Cells(dpapprow, 5).value = sheet.Cells(j, 5).value
      dpapp.Cells(dpapprow, 6).value = "No Deposit made"
      dpapp.Cells(dpapprow, 7).value = sheet.Cells(j, 9).value

    m = m + 1
    dpapprow = dpapprow + 1
End If
If sheet.Cells(j, 8) = "2nd Deposit" Then
'MsgBox i
'MsgBox j

 'MsgBox sheet2.Name
      'write the content into no deposite sheet
      '----------------------------------------
      sheet2.Cells(m, 1).value = sheet.Cells(j, 1).value
      sheet2.Cells(m, 2).value = sheet.Cells(j, 2).value
      sheet2.Cells(m, 3).value = sheet.Cells(j, 3).value
      sheet2.Cells(m, 4).value = sheet.Cells(j, 4).value
      sheet2.Cells(m, 5).value = sheet.Cells(j, 5).value
      sheet2.Cells(m, 6).value = "2nd Deposit"
      sheet2.Cells(m, 7).value = sheet.Cells(j, 9).value
       'mysheet3.Range("C3").AutoFilter field:=3, Criteria1:="Patricia Lamas"
      dpapp.Cells(dpapprow, 1).value = sheet.Cells(j, 1).value
      dpapp.Cells(dpapprow, 2).value = sheet.Cells(j, 2).value
      dpapp.Cells(dpapprow, 3).value = sheet.Cells(j, 3).value
      dpapp.Cells(dpapprow, 4).value = sheet.Cells(j, 4).value
      dpapp.Cells(dpapprow, 5).value = sheet.Cells(j, 5).value
      dpapp.Cells(dpapprow, 6).value = "2nd Deposit"
      dpapp.Cells(dpapprow, 7).value = sheet.Cells(j, 9).value

    m = m + 1
    dpapprow = dpapprow + 1
End If
 Set sheet3 = ActiveWorkbook.Worksheets(cnt)
If sheet.Cells(j, 8) = "Shortage" Then
'MsgBox i
'MsgBox j

 'MsgBox sheet2.Name
      'write shortage value in shortage sheet
      '--------------------------------------
      sheet3.Cells(n, 1).value = sheet.Cells(j, 1).value
      sheet3.Cells(n, 2).value = sheet.Cells(j, 2).value
      sheet3.Cells(n, 3).value = sheet.Cells(j, 3).value
      sheet3.Cells(n, 4).value = sheet.Cells(j, 4).value
      sheet3.Cells(n, 5).value = sheet.Cells(j, 5).value
      sheet3.Cells(n, 6).value = sheet.Cells(j, 6).value
      sheet3.Cells(n, 7).value = sheet.Cells(j, 7).value
      sheet3.Cells(n, 8).value = "Shortage"
      sheet3.Cells(n, 9).value = sheet.Cells(j, 9).value
       'mysheet3.Range("C3").AutoFilter field:=3, Criteria1:="Patricia Lamas"
      shapp.Cells(shapprow, 1).value = sheet.Cells(j, 1).value
      shapp.Cells(shapprow, 2).value = sheet.Cells(j, 2).value
      shapp.Cells(shapprow, 3).value = sheet.Cells(j, 3).value
      shapp.Cells(shapprow, 4).value = sheet.Cells(j, 4).value
      shapp.Cells(shapprow, 5).value = sheet.Cells(j, 5).value
      shapp.Cells(shapprow, 6).value = sheet.Cells(j, 6).value
      shapp.Cells(shapprow, 7).value = sheet.Cells(j, 7).value
      shapp.Cells(shapprow, 8).value = "Shortage"
      shapp.Cells(shapprow, 9).value = sheet.Cells(j, 9).value

    n = n + 1
    shapprow = shapprow + 1
End If

Next j
Next i
sheet2.Columns("A:I").AutoFit
    sheet3.Columns("A:I").AutoFit
    sheet2.Columns("A:I").HorizontalAlignment = xlCenter
sheet3.Columns("A:I").HorizontalAlignment = xlCenter
sheet2.Cells(1, 1).value = "Location"
      sheet2.Cells(1, 1).Interior.ColorIndex = 37
      sheet2.Cells(1, 1).Borders.LineStyle = xlContinuous
      sheet2.Cells(1, 2).value = "Location-Suncom"
      sheet2.Cells(1, 2).Interior.ColorIndex = 37
      sheet2.Cells(1, 2).Borders.LineStyle = xlContinuous
      sheet2.Cells(1, 3).value = "DM"
      sheet2.Cells(1, 3).Interior.ColorIndex = 37
      sheet2.Cells(1, 3).Borders.LineStyle = xlContinuous
      sheet2.Cells(1, 4).value = "Date"
      sheet2.Cells(1, 4).Interior.ColorIndex = 37
      sheet2.Cells(1, 4).Borders.LineStyle = xlContinuous
      sheet2.Cells(1, 5).value = "RQ4 Amount"
      sheet2.Cells(1, 5).Interior.ColorIndex = 37
      sheet2.Cells(1, 5).Borders.LineStyle = xlContinuous
      sheet2.Cells(1, 6).value = "Final Comments"
      sheet2.Cells(1, 6).Interior.ColorIndex = 37
      sheet2.Cells(1, 6).Borders.LineStyle = xlContinuous
      sheet2.Cells(1, 7).value = "DM Comments"
      sheet2.Cells(1, 7).Interior.ColorIndex = 37
      sheet2.Cells(1, 7).Borders.LineStyle = xlContinuous
      sheet3.Cells(1, 1).value = "Location"
      sheet3.Cells(1, 1).Interior.ColorIndex = 37
      sheet3.Cells(1, 1).Borders.LineStyle = xlContinuous
      sheet3.Cells(1, 2).value = "Location-Suncom"
      sheet3.Cells(1, 2).Interior.ColorIndex = 37
      sheet3.Cells(1, 2).Borders.LineStyle = xlContinuous
      sheet3.Cells(1, 3).value = "DM"
      sheet3.Cells(1, 3).Interior.ColorIndex = 37
      sheet3.Cells(1, 3).Borders.LineStyle = xlContinuous
      sheet3.Cells(1, 4).value = "Date"
      sheet3.Cells(1, 4).Interior.ColorIndex = 37
      sheet3.Cells(1, 4).Borders.LineStyle = xlContinuous
      sheet3.Cells(1, 5).value = "RQ4 Amount"
      sheet3.Cells(1, 5).Interior.ColorIndex = 37
      sheet3.Cells(1, 5).Borders.LineStyle = xlContinuous
      sheet3.Cells(1, 6).value = "Bank Amount"
      sheet3.Cells(1, 6).Interior.ColorIndex = 37
      sheet3.Cells(1, 6).Borders.LineStyle = xlContinuous
      sheet3.Cells(1, 7).value = "Variance"
      sheet3.Cells(1, 7).Interior.ColorIndex = 37
      sheet3.Cells(1, 7).Borders.LineStyle = xlContinuous
      sheet3.Cells(1, 8).value = "Final Comments"
      sheet3.Cells(1, 8).Interior.ColorIndex = 37
      sheet3.Cells(1, 8).Borders.LineStyle = xlContinuous
      sheet3.Cells(1, 9).value = "DM Comments"
      sheet3.Cells(1, 9).Interior.ColorIndex = 37
      sheet3.Cells(1, 9).Borders.LineStyle = xlContinuous
      Set wkb = Workbooks.add
'      wkb.Add.Name = "no deposite"
      Set sheet5 = wkb.Worksheets(1)
      With sheet2
      lastRow = .Cells(.Rows.count, "A").End(xlUp).Row
      End With
     sheet2.Range("A:G").Sort Key1:=sheet2.Range("D1:D65536"), Order1:=xlDescending, Orientation:=xlTopToBottom, DataOption1:=xlSortNormal
sheet2.Range("C1:C65536").AdvancedFilter Action:=xlFilterCopy, CopyToRange:=sheet2.Range("H1"), Unique:=True
With sheet2
   lastrow1 = .Cells(.Rows.count, "H").End(xlUp).Row
End With
For x = 2 To lastrow1
      sheet5.Cells(new1, 1).value = "Location"
      sheet5.Cells(new1, 1).Interior.ColorIndex = 37
      sheet5.Cells(new1, 1).Borders.LineStyle = xlContinuous
      sheet5.Cells(new1, 2).value = "Location-Suncom"
      sheet5.Cells(new1, 2).Interior.ColorIndex = 37
      sheet5.Cells(new1, 2).Borders.LineStyle = xlContinuous
      sheet5.Cells(new1, 3).value = "DM"
      sheet5.Cells(new1, 3).Interior.ColorIndex = 37
      sheet5.Cells(new1, 3).Borders.LineStyle = xlContinuous
      sheet5.Cells(new1, 4).value = "Date"
      sheet5.Cells(new1, 4).Interior.ColorIndex = 37
      sheet5.Cells(new1, 4).Borders.LineStyle = xlContinuous
      sheet5.Cells(new1, 5).value = "RQ4 Amount"
      sheet5.Cells(new1, 5).Interior.ColorIndex = 37
      sheet5.Cells(new1, 5).Borders.LineStyle = xlContinuous
      sheet5.Cells(new1, 6).value = "Final Comments"
      sheet5.Cells(new1, 6).Interior.ColorIndex = 37
      sheet5.Cells(new1, 6).Borders.LineStyle = xlContinuous
      sheet5.Cells(new1, 7).value = "DM Comments"
      sheet5.Cells(new1, 7).Interior.ColorIndex = 37
      sheet5.Cells(new1, 7).Borders.LineStyle = xlContinuous
      new1 = new1 + 1
      
    For i = 2 To lastRow
        If sheet2.Cells(x, 8) = sheet2.Cells(i, 3) Then
        sheet5.Cells(new1, 1).value = sheet2.Cells(i, 1).value
        sheet5.Cells(new1, 2).value = sheet2.Cells(i, 2).value
        sheet5.Cells(new1, 3).value = sheet2.Cells(i, 3).value
        sheet5.Cells(new1, 4).value = sheet2.Cells(i, 4).value
        sheet5.Cells(new1, 5).value = sheet2.Cells(i, 5).value
        sheet5.Cells(new1, 6).value = sheet2.Cells(i, 6).value
        sheet5.Cells(new1, 7).value = sheet2.Cells(i, 7).value
        
        new1 = new1 + 1
        
        End If
      
    Next i
     new1 = new1 + 2
Next x
For x = 1 To lastrow1
    sheet2.Cells(x, 8) = ""
Next x
    sheet5.Columns("A:I").AutoFit
    sheet5.Columns("A:I").HorizontalAlignment = xlCenter
    
    
    
 new1 = 1
    
      Set wkb1 = Workbooks.add
'      wkb1.Add.Name = "shortage"
      Set sheet6 = wkb1.Worksheets(1)
      With sheet3
      lastRow = .Cells(.Rows.count, "A").End(xlUp).Row
      End With
sheet3.Range("A:I").Sort Key1:=sheet3.Range("D1:D65536"), Order1:=xlDescending, Orientation:=xlTopToBottom, DataOption1:=xlSortNormal
sheet3.Range("C1:C65536").AdvancedFilter Action:=xlFilterCopy, CopyToRange:=sheet3.Range("J1"), Unique:=True
With sheet3
   lastrow1 = .Cells(.Rows.count, "J").End(xlUp).Row
End With
For x = 2 To lastrow1
      sheet6.Cells(new1, 1).value = "Location"
      sheet6.Cells(new1, 1).Interior.ColorIndex = 37
      sheet6.Cells(new1, 1).Borders.LineStyle = xlContinuous
      sheet6.Cells(new1, 2).value = "Location-Suncom"
      sheet6.Cells(new1, 2).Interior.ColorIndex = 37
      sheet6.Cells(new1, 2).Borders.LineStyle = xlContinuous
      sheet6.Cells(new1, 3).value = "DM"
      sheet6.Cells(new1, 3).Interior.ColorIndex = 37
      sheet6.Cells(new1, 3).Borders.LineStyle = xlContinuous
      sheet6.Cells(new1, 4).value = "Date"
      sheet6.Cells(new1, 4).Interior.ColorIndex = 37
      sheet6.Cells(new1, 4).Borders.LineStyle = xlContinuous
      sheet6.Cells(new1, 5).value = "RQ4 Amount"
      sheet6.Cells(new1, 5).Interior.ColorIndex = 37
      sheet6.Cells(new1, 5).Borders.LineStyle = xlContinuous
      sheet6.Cells(new1, 6).value = "Bank Amount"
      sheet6.Cells(new1, 6).Interior.ColorIndex = 37
      sheet6.Cells(new1, 6).Borders.LineStyle = xlContinuous
      sheet6.Cells(new1, 7).value = "Variance"
      sheet6.Cells(new1, 7).Interior.ColorIndex = 37
      sheet6.Cells(new1, 7).Borders.LineStyle = xlContinuous
      sheet6.Cells(new1, 8).value = "Final Comments"
      sheet6.Cells(new1, 8).Interior.ColorIndex = 37
      sheet6.Cells(new1, 8).Borders.LineStyle = xlContinuous
      sheet6.Cells(new1, 9).value = "DM Comments"
      sheet6.Cells(new1, 9).Interior.ColorIndex = 37
      sheet6.Cells(new1, 9).Borders.LineStyle = xlContinuous
      new1 = new1 + 1
      
    For i = 2 To lastRow
        If sheet3.Cells(x, 10) = sheet3.Cells(i, 3) Then
        sheet6.Cells(new1, 1).value = sheet3.Cells(i, 1).value
        sheet6.Cells(new1, 2).value = sheet3.Cells(i, 2).value
        sheet6.Cells(new1, 3).value = sheet3.Cells(i, 3).value
        sheet6.Cells(new1, 4).value = sheet3.Cells(i, 4).value
        sheet6.Cells(new1, 5).value = sheet3.Cells(i, 5).value
        sheet6.Cells(new1, 6).value = sheet3.Cells(i, 6).value
        sheet6.Cells(new1, 7).value = sheet3.Cells(i, 7).value
        sheet6.Cells(new1, 8).value = sheet3.Cells(i, 8).value
        sheet6.Cells(new1, 9).value = sheet3.Cells(i, 9).value
        
        new1 = new1 + 1
        
        End If
      
    Next i
     new1 = new1 + 2
Next x
For x = 1 To lastrow1
sheet3.Cells(x, 10) = ""
Next x
sheet6.Columns("A:I").AutoFit
sheet6.Columns("A:I").HorizontalAlignment = xlCenter
With sheet2
   dpdm = .Cells(.Rows.count, "A").End(xlUp).Row
End With
Set dpsheet1 = dpapp.ActiveWorkbook.Worksheets("Sheet2")
With dpsheet1
   dpdm1 = .Cells(.Rows.count, "A").End(xlUp).Row
End With








'dpdm1 = dpdm1 + 1
'i = 2
'For i = 2 To dpdm
 'For j = i + 1 To dpdm
 'If sheet2.Cells(i, 2).Value = sheet2.Cells(j, 2).Value Then
 'If sheet2.Cells(i, 3).Value = sheet2.Cells(j, 3).Value Then
  'If sheet2.Cells(j, 8).Value <> "match" Then
   'sheet2.Cells(j, 8).Value = "match"
   'dpsheet.cells(dpdm1,1).value=
  'End If
  'End If
 'End If
 'Next j
'Next i
 sheet2.Range("B1:C65536").AdvancedFilter Action:=xlFilterCopy, CopyToRange:=sheet2.Range("K1"), Unique:=True
 sheet2.Range("C1:C65536").AdvancedFilter Action:=xlFilterCopy, CopyToRange:=sheet2.Range("L1"), Unique:=True
With sheet2
   lastrow1 = .Cells(.Rows.count, "K").End(xlUp).Row
End With
With sheet2
   lastrow2 = .Cells(.Rows.count, "L").End(xlUp).Row
End With

dpdm1 = dpdm1 + 2

For i = 2 To lastrow2
For j = 2 To lastrow1
'MsgBox sheet2.Cells(i, 12).Value
sheet2.Range("A:G").AutoFilter Field:=2, Criteria1:=sheet2.Cells(j, 11).value
sheet2.Range("A:G").AutoFilter Field:=3, Criteria1:=sheet2.Cells(i, 12).value



rowz = sheet2.AutoFilter.Range.Columns(1).SpecialCells(xlCellTypeVisible).Cells.count
'MsgBox rowz
 If rowz >= 3 Then
 Set rng = sheet2.Range("A2:A62536")
                    For Each cl In rng.SpecialCells(xlCellTypeVisible)
                    addr = Replace(cl.Address, "$A$", "")
                    If sheet2.Cells(addr, 2).value = "" Then
                    Exit For
                    End If
                    dpsheet1.Cells(dpdm1, 1).value = sheet2.Cells(addr, 1).value
                    dpsheet1.Cells(dpdm1, 2).value = sheet2.Cells(addr, 2).value
                    dpsheet1.Cells(dpdm1, 3).value = sheet2.Cells(addr, 3).value
                    dpsheet1.Cells(dpdm1, 4).value = sheet2.Cells(addr, 4).value
                    dpsheet1.Cells(dpdm1, 5).value = sheet2.Cells(addr, 5).value
                    dpsheet1.Cells(dpdm1, 6).value = sheet2.Cells(addr, 6).value
                    dpsheet1.Cells(dpdm1, 7).value = sheet2.Cells(addr, 7).value
                    'MsgBox addr
                    dpdm1 = dpdm1 + 1
                    
                    Next cl
                    dpdm1 = dpdm1 + 1
 End If

Next j
Next i
sheet2.AutoFilterMode = False
dpdoc.Save
dpapp.Quit
shdoc.Save
shapp.Quit

End Sub

