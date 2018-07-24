Attribute VB_Name = "Module15"
Sub Myperf_tio()
Attribute Myperf_tio.VB_ProcData.VB_Invoke_Func = " \n14"
'
' Myperf_tio Macro
'

'
Dim checked As Integer
checked = 0
Dim vu As Integer
Dim FindRow, rng, Cell As Range
Dim val1, val2 As Integer
Dim iVal, j, cnt, cnt1 As Integer
Dim exsheet, exdoc, exapp As Object
Dim exsheet1, exdoc1, exapp1 As Object
Dim srsheet, chsheet As Object
Dim count As Long
 Set exapp = CreateObject("Excel.Application")
 Set exdoc = exapp.Workbooks.Open("D:/Sales Bill pay count/05.05/tio.xls")
 exapp.Visible = True
 Set exsheet = exapp.ActiveWorkbook.ActiveSheet
 
 'MsgBox exsheet.Name
 With exsheet
   rowc = .Cells(.Rows.count, "A").End(xlUp).Row
End With
 cnt = ActiveWorkbook.Worksheets.count
 
     For j = 1 To cnt - 1

        Set srsheet = ActiveWorkbook.Worksheets(j)
        
   
       For x = 3 To 70
        
            If srsheet.Cells(x, 1).value <> "" And srsheet.Cells(x, 1).value <> "Location" And srsheet.Cells(x, 2).value <> "Total" Then

                If IsNumeric(Left(srsheet.Cells(x, 1).value, 3)) Then
                
                For i = 1 To rowc
                If InStr(1, Left(exsheet.Cells(i, "A").value, 3), Left(srsheet.Cells(x, 1).value, 3), vbTextCompare) > 0 Then
                srsheet.Cells(x, "C").value = exsheet.Cells(i, "B").value
                End If
                Next i
                End If
                If srsheet.Cells(x, 3).value = "" Then
                srsheet.Cells(x, 3).value = "0"
                End If
           End If
        Next x

    Next j
    
    exdoc.Save
    exapp.Quit
 Set exapp1 = CreateObject("Excel.Application")
 Set exdoc1 = exapp1.Workbooks.Open("D:/Sales Bill pay count/05.05/My Perf.xls")
 exapp1.Visible = True
 Set exsheet1 = exapp1.ActiveWorkbook.ActiveSheet
  With exsheet1
   rowc = .Cells(.Rows.count, "A").End(xlUp).Row
End With
      For j = 1 To cnt - 1

        Set srsheet = ActiveWorkbook.Worksheets(j)
        
   
       For x = 3 To 75
        
            If srsheet.Cells(x, 1).value <> "" And srsheet.Cells(x, 1).value <> "Location" And srsheet.Cells(x, 2).value <> "Total" Then

                If IsNumeric(Left(srsheet.Cells(x, 1).value, 3)) Then
                
                For i = 1 To rowc
                If InStr(1, Left(exsheet1.Cells(i, "A").value, 3), Left(srsheet.Cells(x, 1).value, 3), vbTextCompare) > 0 Then
                val2 = 0
                srsheet.Cells(x, "E").value = exsheet1.Cells(i, "H").value - exsheet1.Cells(i, "G").value
                If exsheet1.Cells(i, "H").value < exsheet1.Cells(i, "G").value Then
                srsheet.Cells(x, "E").Interior.ColorIndex = 37
                srsheet.Cells(x, "E").Borders.LineStyle = xlContinuous
                End If
                checked = 1
                'MsgBox Left(srsheet.Cells(x, 1).value, 3)
                'MsgBox srsheet.Cells(x, "E").value
                srsheet.Cells(x, "K").value = exsheet1.Cells(i, "O").value
                srsheet.Cells(x, "G").value = exsheet1.Cells(i, "U").value
                srsheet.Cells(x, "F").value = exsheet1.Cells(i, "G").value
                val1 = Replace(exsheet1.Cells(i, "R").value, "$", "")
                On Error Resume Next
                val2 = Replace(exsheet1.Cells(i, "S").value, "$", "")
                srsheet.Cells(x, "I").value = val1 + val2
                srsheet.Cells(x, "D").Formula = "=+H" & x & "/C" & x
                srsheet.Cells(x, "H").Formula = "=SUM(E" & x & ":G" & x & " )"
                srsheet.Cells(x, "J").Formula = "=+I" & x & "/H" & x
                srsheet.Cells(x, "L").Formula = "=+K" & x & "/H" & x
                End If
                Next i
                End If
           End If
          'srsheet.Cells.Replace What:="#DIV/0!", Replacement:="0", LookAt:=xlWhole, SearchOrder:=xlByRows, MatchCase:=False, SearchFormat:=False, ReplaceFormat:=False
          If srsheet.Cells(x, 2).value = "Total" Then
          
          
            If j = 1 Then
          
                srsheet.Cells(x, "C").Formula = "=SUM(C3:C26)"
                srsheet.Cells(x, "E").Formula = "=SUM(E3:E26)"
                srsheet.Cells(x, "F").Formula = "=SUM(F3:F26)"
                srsheet.Cells(x, "G").Formula = "=SUM(G3:G26)"
                srsheet.Cells(x, "I").Formula = "=SUM(I3:I26)"
                srsheet.Cells(x, "K").Formula = "=SUM(K3:K26)"
                srsheet.Cells(x, "D").Formula = "=+H27/C27"
                srsheet.Cells(x, "H").Formula = "=SUM(E27:G27 )"
                srsheet.Cells(x, "J").Formula = "=+I27/H27"
                srsheet.Cells(x, "L").Formula = "=+K27/H27"
                
            ElseIf j = 2 Then
                If x = 8 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C3:C7)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E3:E7)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F3:F7)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G3:G7)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I3:I7)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K3:K7)"
                    srsheet.Cells(x, "D").Formula = "=+H8/C8"
                    srsheet.Cells(x, "H").Formula = "=SUM(E8:G8)"
                    srsheet.Cells(x, "J").Formula = "=+I8/H8"
                    srsheet.Cells(x, "L").Formula = "=+K8/H8"
                    
                ElseIf x = 19 Then
                
                    srsheet.Cells(x, "C").Formula = "=SUM(C12:C18)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E12:E18)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F12:F18)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G12:G18)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I12:I18)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K12:K18)"
                    srsheet.Cells(x, "D").Formula = "=+H19/C19"
                    srsheet.Cells(x, "H").Formula = "=SUM(E19:G19)"
                    srsheet.Cells(x, "J").Formula = "=+I19/H19"
                    srsheet.Cells(x, "L").Formula = "=+K19/H19"
                    
                End If
            ElseIf j = 3 Then
                If x = 44 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C3:C43)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E3:E43)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F3:F43)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G3:G43)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I3:I43)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K3:K43)"
                    srsheet.Cells(x, "D").Formula = "=+H44/C44"
                    srsheet.Cells(x, "H").Formula = "=SUM(E44:G44)"
                    srsheet.Cells(x, "J").Formula = "=+I44/H44"
                    srsheet.Cells(x, "L").Formula = "=+K44/H44"
                End If
            ElseIf j = 4 Then
                If x = 9 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C3:C8)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E3:E8)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F3:F8)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G3:G8)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I3:I8)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K3:K8)"
                    srsheet.Cells(x, "D").Formula = "=+H9/C9"
                    srsheet.Cells(x, "H").Formula = "=SUM(E9:G9)"
                    srsheet.Cells(x, "J").Formula = "=+I9/H9"
                    srsheet.Cells(x, "L").Formula = "=+K9/H9"
                ElseIf x = 19 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C13:C18)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E13:E18)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F13:F18)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G13:G18)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I13:I18)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K13:K18)"
                    srsheet.Cells(x, "D").Formula = "=+H19/C19"
                    srsheet.Cells(x, "H").Formula = "=SUM(E19:G19)"
                    srsheet.Cells(x, "J").Formula = "=+I19/H19"
                    srsheet.Cells(x, "L").Formula = "=+K19/H19"
                End If
            ElseIf j = 5 Then
                If x = 11 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C3:C10)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E3:E10)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F3:F10)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G3:G10)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I3:I10)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K3:K10)"
                    srsheet.Cells(x, "D").Formula = "=+H11/C11"
                    srsheet.Cells(x, "H").Formula = "=SUM(E11:G11)"
                    srsheet.Cells(x, "J").Formula = "=+I11/H11"
                    srsheet.Cells(x, "L").Formula = "=+K11/H11"
                ElseIf x = 24 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C16:C23)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E16:E23)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F16:F23)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G16:G23)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I16:I23)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K16:K23)"
                    srsheet.Cells(x, "D").Formula = "=+H24/C24"
                    srsheet.Cells(x, "H").Formula = "=SUM(E24:G24)"
                    srsheet.Cells(x, "J").Formula = "=+I24/H24"
                    srsheet.Cells(x, "L").Formula = "=+K24/H24"
                ElseIf x = 35 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C30:C34)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E30:E34)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F30:F34)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G30:G34)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I30:I34)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K30:K34)"
                    srsheet.Cells(x, "D").Formula = "=+H35/C35"
                    srsheet.Cells(x, "H").Formula = "=SUM(E35:G35)"
                    srsheet.Cells(x, "J").Formula = "=+I35/H35"
                    srsheet.Cells(x, "L").Formula = "=+K35/H35"
                ElseIf x = 49 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C41:C48)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E41:E48)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F41:F48)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G41:G48)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I41:I48)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K41:K48)"
                    srsheet.Cells(x, "D").Formula = "=+H49/C49"
                    srsheet.Cells(x, "H").Formula = "=SUM(E49:G49)"
                    srsheet.Cells(x, "J").Formula = "=+I49/H49"
                    srsheet.Cells(x, "L").Formula = "=+K49/H49"
                ElseIf x = 57 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C54:C56)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E54:E56)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F54:F56)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G54:G56)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I54:I56)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K54:K56)"
                    srsheet.Cells(x, "D").Formula = "=+H57/C57"
                    srsheet.Cells(x, "H").Formula = "=SUM(E57:G57)"
                    srsheet.Cells(x, "J").Formula = "=+I57/H57"
                    srsheet.Cells(x, "L").Formula = "=+K57/H57"
                ElseIf x = 72 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C62:C71)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E62:E71)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F62:F71)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G62:G71)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I62:I71)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K62:K71)"
                    srsheet.Cells(x, "D").Formula = "=+H72/C72"
                    srsheet.Cells(x, "H").Formula = "=SUM(E72:G72)"
                    srsheet.Cells(x, "J").Formula = "=+I72/H72"
                    srsheet.Cells(x, "L").Formula = "=+K72/H72"
                End If
            ElseIf j = 6 Then
            
                If x = 7 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C4:C6)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E4:E6)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F4:F6)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G4:G6)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I4:I6)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K4:K6)"
                    srsheet.Cells(x, "D").Formula = "=+H7/C7"
                    srsheet.Cells(x, "H").Formula = "=SUM(E7:G7)"
                    srsheet.Cells(x, "J").Formula = "=+I7/H7"
                    srsheet.Cells(x, "L").Formula = "=+K7/H7"
                End If
            ElseIf j = 7 Then
            
                If x = 6 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C3:C5)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E3:E5)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F3:F5)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G3:G5)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I3:I5)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K3:K5)"
                    srsheet.Cells(x, "D").Formula = "=+H6/C6"
                    srsheet.Cells(x, "H").Formula = "=SUM(E6:G6)"
                    srsheet.Cells(x, "J").Formula = "=+I6/H6"
                    srsheet.Cells(x, "L").Formula = "=+K6/H6"
                End If
            
            ElseIf j = 8 Then
                If x = 9 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C3:C8)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E3:E8)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F3:F8)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G3:G8)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I3:I8)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K3:K8)"
                    srsheet.Cells(x, "D").Formula = "=+H9/C9"
                    srsheet.Cells(x, "H").Formula = "=SUM(E9:G9)"
                    srsheet.Cells(x, "J").Formula = "=+I9/H9"
                    srsheet.Cells(x, "L").Formula = "=+K9/H9"
                End If
            ElseIf j = 9 Then
            
                If x = 6 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C3:C5)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E3:E5)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F3:F5)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G3:G5)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I3:I5)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K3:K5)"
                    srsheet.Cells(x, "D").Formula = "=+H6/C6"
                    srsheet.Cells(x, "H").Formula = "=SUM(E6:G6)"
                    srsheet.Cells(x, "J").Formula = "=+I6/H6"
                    srsheet.Cells(x, "L").Formula = "=+K6/H6"
                End If
            ElseIf j = 10 Then
            
                If x = 7 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C3:C6)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E3:E6)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F3:F6)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G3:G6)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I3:I6)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K3:K6)"
                    srsheet.Cells(x, "D").Formula = "=+H7/C7"
                    srsheet.Cells(x, "H").Formula = "=SUM(E7:G7)"
                    srsheet.Cells(x, "J").Formula = "=+I7/H7"
                    srsheet.Cells(x, "L").Formula = "=+K7/H7"
                End If
            ElseIf j = 11 Then
            
                If x = 11 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C3:C10)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E3:E10)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F3:F10)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G3:G10)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I3:I10)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K3:K10)"
                    srsheet.Cells(x, "D").Formula = "=+H11/C11"
                    srsheet.Cells(x, "H").Formula = "=SUM(E11:G11)"
                    srsheet.Cells(x, "J").Formula = "=+I11/H11"
                    srsheet.Cells(x, "L").Formula = "=+K11/H11"
                End If
            
            ElseIf j = 12 Then
            
                If x = 13 Then
                    srsheet.Cells(x, "C").Formula = "=SUM(C3:C12)"
                    srsheet.Cells(x, "E").Formula = "=SUM(E3:E12)"
                    srsheet.Cells(x, "F").Formula = "=SUM(F3:F12)"
                    srsheet.Cells(x, "G").Formula = "=SUM(G3:G12)"
                    srsheet.Cells(x, "I").Formula = "=SUM(I3:I12)"
                    srsheet.Cells(x, "K").Formula = "=SUM(K3:K12)"
                    srsheet.Cells(x, "D").Formula = "=+H13/C13"
                    srsheet.Cells(x, "H").Formula = "=SUM(E13:G13)"
                    srsheet.Cells(x, "J").Formula = "=+I13/H13"
                    srsheet.Cells(x, "L").Formula = "=+K13/H13"
                End If
            End If
            
          
          End If
          If checked = 0 Then
              If srsheet.Cells(x, 1).value <> "" And srsheet.Cells(x, 1).value <> "Location" And srsheet.Cells(x, 2).value <> "Total" And srsheet.Cells(x, 1).value <> " " Then
                srsheet.Cells(x, "D").value = "0"
                srsheet.Cells(x, "E").value = "0"
                srsheet.Cells(x, "F").value = "0"
                srsheet.Cells(x, "G").value = "0"
                srsheet.Cells(x, "H").value = "0"
                srsheet.Cells(x, "I").value = "0"
                srsheet.Cells(x, "J").value = "0"
                srsheet.Cells(x, "K").value = "0"
                srsheet.Cells(x, "L").value = "0"
             End If
         Else
         checked = 0
         End If
        Next x
        

    Next j
    
    
Set srsheet = ActiveWorkbook.Worksheets(cnt)
vu = 2
For j = 1 To cnt - 1

Set chsheet = ActiveWorkbook.Worksheets(j)

For x = 3 To 75

If chsheet.Cells(x, 8).value = "0" Then
srsheet.Cells(vu, 1).value = chsheet.Name
srsheet.Cells(vu, 2).value = chsheet.Cells(x, 1).value
srsheet.Cells(vu, 3).value = chsheet.Cells(x, 2).value
srsheet.Cells(vu, 4).value = chsheet.Cells(x, 3).value
srsheet.Cells(vu, 5).value = chsheet.Cells(x, 4).value
srsheet.Cells(vu, 6).value = chsheet.Cells(x, 5).value
srsheet.Cells(vu, 7).value = chsheet.Cells(x, 6).value
srsheet.Cells(vu, 8).value = chsheet.Cells(x, 7).value
srsheet.Cells(vu, 9).value = chsheet.Cells(x, 8).value
srsheet.Cells(vu, 10).value = chsheet.Cells(x, 9).value
srsheet.Cells(vu, 11).value = chsheet.Cells(x, 10).value
srsheet.Cells(vu, 12).value = chsheet.Cells(x, 11).value
srsheet.Cells(vu, 13).value = chsheet.Cells(x, 12).value
vu = vu + 1
End If

Next x

Next j

End Sub
