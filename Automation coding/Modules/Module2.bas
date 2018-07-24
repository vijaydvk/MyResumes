Attribute VB_Name = "Module2"
Sub Macro2()
Attribute Macro2.VB_Description = "mail"
Attribute Macro2.VB_ProcData.VB_Invoke_Func = " \n14"
'
' Macro2 Macro
' mail
'run this macro from book 2
'--------------------------
Dim sht As Worksheet
Dim fndList As Variant
Dim rplcList As Variant
Dim i As Integer
Dim wdapp, wddoc, mysheet, wdapp1, wdapp2, wdapp3, wdapp4 As Object
Dim mysheet1 As Object
Dim sh() As String
Dim mailsheet, individualsheet As Object
Dim row1, col1 As Integer
Dim x, y As Integer
Dim it As Integer
Dim add As Integer
add = 2
Dim book1 As Workbook
Dim FindRow As Range
Dim temp As String
Set mailsheet = ActiveSheet
     Set book1 = Workbooks(3)
     'MsgBox book1.Name
     temp = ""
                     With ActiveSheet
                      lastrow1 = .Cells(.Rows.count, "A").End(xlUp).Row
                     End With
                    Set wkb = Workbooks.add
                         For i = 1 To lastrow1
                         Set wdapp = CreateObject("Excel.Application")
                         On Error Resume Next
                         Set wddoc = wdapp.Workbooks.Open(mailsheet.Cells(i, 6))
                                wdapp.Visible = True
                                On Error Resume Next
                                Set mysheet = wdapp.ActiveWorkbook.ActiveSheet
                                Row = mysheet.UsedRange.Rows.count
                                wkb.Sheets.add(After:=Worksheets(i)).Name = Left(mailsheet.Cells(i, 5).value, 3)
                                Application.Wait (Now + TimeValue("0:00:01"))
                                Application.DisplayAlerts = bSwitch
                                Set individualsheet = ActiveSheet
                                mysheet.Columns("A:B").Copy
                                individualsheet.Columns("B:C").PasteSpecial xlPasteValues
                                individualsheet.Cells(1, 1).value = "Location Names"
                                individualsheet.Cells(1, 2).value = "Phone List"
                                individualsheet.Cells(1, 3).value = "Quantity"
                                individualsheet.Cells(1, 4).value = "RQ4 Count"
                                individualsheet.Cells(1, 5).value = "Variance"
                                individualsheet.Cells(2, 1).value = mailsheet.Cells(i, 5).value
                                individualsheet.Cells(1, 1).Interior.ColorIndex = 33
                                individualsheet.Cells(1, 1).Borders.LineStyle = xlContinuous
                                individualsheet.Cells(1, 2).Interior.ColorIndex = 33
                                individualsheet.Cells(1, 2).Borders.LineStyle = xlContinuous
                                individualsheet.Cells(1, 3).Interior.ColorIndex = 33
                                individualsheet.Cells(1, 3).Borders.LineStyle = xlContinuous
                                individualsheet.Cells(1, 4).Interior.ColorIndex = 33
                                individualsheet.Cells(1, 4).Borders.LineStyle = xlContinuous
                                individualsheet.Cells(1, 5).Interior.ColorIndex = 33
                                individualsheet.Cells(1, 5).Borders.LineStyle = xlContinuous
                                individualsheet.Columns("A:I").AutoFit
                                row1 = individualsheet.UsedRange.Rows.count
                                col1 = individualsheet.UsedRange.Columns.count
                                For x = 1 To row1
                                For y = 1 To col1
                                individualsheet.Cells(x, y).Borders.LineStyle = xlContinuous
                                Next y
                                If x > 2 Then
                                individualsheet.Cells(x, 1).value = mailsheet.Cells(i, 5).value
                                End If
                                Next x
                                                               
                     wddoc.Save
                     wdapp.Quit
                     Next i
                        Set wdapp2 = CreateObject("Excel.Application")
                        On Error Resume Next
                        Set wdapp3 = wdapp2.Workbooks.Open("d:\Pivot table.xls")
                        wdapp2.Visible = True
                        Set mysheet1 = wdapp2.ActiveWorkbook.ActiveSheet
                     For i = 2 To lastrow1 + 1
                     Set individualsheet = wkb.Worksheets(i)
                     row1 = individualsheet.UsedRange.Rows.count
                     With mysheet1
                      row2 = .Cells(.Rows.count, "A").End(xlUp).Row
                     End With
                     row2 = mysheet1.UsedRange.Rows.count
                     col2 = mysheet1.UsedRange.Columns.count
                     row2 = row2 + 1
                     col2 = col2 - 1
                     For x = 2 To col2
                     If mysheet1.Cells(4, x) = individualsheet.Cells(2, 1).value Then
                     column = x
                     Exit For
                     End If
                     Next x

                       For j = 2 To row1
                       
                       temp = Application.WorksheetFunction.VLookup(individualsheet.Cells(j, 2).value, book1.ActiveSheet.Range("A:B"), 2, False)

                       If temp = "" Then
                       
                       Set FindRow = mysheet1.Range("A:FV").Find(What:=individualsheet.Cells(j, 2).value, LookIn:=xlValues, MatchCase:=False, LookAt:=xlWhole)
                        'MsgBox individualsheet.Cells(j, 2).value
                        'MsgBox temp
                        individualsheet.Cells(j, 4).value = mysheet1.Cells(FindRow.Row, column).value
                        individualsheet.Cells(j, "E").value = individualsheet.Cells(j, "D").value - individualsheet.Cells(j, "C").value
                        If mysheet1.Cells(FindRow.Row, column).value = "" Then
                           individualsheet.Cells(j, 4).value = "N/A"
                        End If
                        
                      Else
                        individualsheet.Cells(j, 2).value = temp
                        Set FindRow = mysheet1.Range("A:FV").Find(What:=temp, LookIn:=xlValues, MatchCase:=False, LookAt:=xlWhole)
                        'MsgBox temp
                        individualsheet.Cells(j, 4).value = mysheet1.Cells(FindRow.Row, column).value
                        individualsheet.Cells(j, "E").value = individualsheet.Cells(j, "D").value - individualsheet.Cells(j, "C").value
                        If mysheet1.Cells(FindRow.Row, column).value = "" Then
                           individualsheet.Cells(j, 4).value = "N/A"
                        End If
                    End If
                        
                        temp = ""
                        Next j

                     Next i
                     
                     

                     
End Sub


