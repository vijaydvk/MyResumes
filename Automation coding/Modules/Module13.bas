Attribute VB_Name = "Module13"
Sub Schedule_split_notepad()
Attribute Schedule_split_notepad.VB_ProcData.VB_Invoke_Func = " \n14"
'
' Schedule_split_notepad Macro
'

'

Dim FilePath, temps, tempe, temp1 As String
Dim splitword
Dim x, chk, k As Integer
Dim temp As String
Dim chkcount As Integer
chkcount = 0
x = 1
chk = 1
Dim leng As Integer
Dim start, endd As Integer
endd = 1
Dim sheet2, sheet1 As Object
Dim rng As Range
Dim cellvalue
Dim col, dat, dat1 As String
col = "V"
dat = "05-Mar"
dat1 = "Fri"
Set rng = Selection
FilePath = Application.DefaultFilePath & "\auth.txt"

'MsgBox ActiveWorkbook.Worksheets.count

'MsgBox ActiveWorkbook.Worksheets(1).Name

Set sheet2 = ActiveWorkbook.Worksheets(1)
             With sheet2
                      lastrow11 = .Cells(.Rows.count, "A").End(xlUp).Row
             End With
             sheet2.Cells(2, col).value = dat1
             sheet2.Cells(2, col).Font.Bold = True
             sheet2.Cells(2, col).HorizontalAlignment = xlCenter
             sheet2.Cells(2, col).Font.Name = "Book Antiqua"
             sheet2.Cells(3, col).value = dat
             sheet2.Cells(3, col).Font.Bold = True
             sheet2.Cells(3, col).HorizontalAlignment = xlCenter
             sheet2.Cells(3, col).Font.Name = "Book Antiqua"
             With ActiveSheet
                      lastrow1 = .Cells(.Rows.count, "A").End(xlUp).Row
             For i = 1 To lastrow1
             If InStr(1, .Cells(i, 1).value, "Total", vbTextCompare) = 0 And InStr(1, .Cells(i, 1).value, "Note :", vbTextCompare) = 0 Then
             If .Cells(i, 1).value = "WeekOff" Then
             splitword = Split(.Cells(i + 1, 1).value, ",", -1, vbTextCompare)
             For j = 0 To UBound(splitword)
             For m = 4 To lastrow11
                        temps = Replace(sheet2.Cells(m, 1).value, " ", "")
                        tempe = Replace(Split(splitword(j), "(", -1, vbTextCompare)(0), " ", "")
                        If LCase(temps) = LCase(tempe) Then
                        sheet2.Cells(m, col).value = "OFF"
                        End If
             Next m
             Next j
             i = i + 3
             
             Else
             start = endd
             If InStr(1, .Cells(i, 1).value, "AM", vbTextCompare) > 0 Then
             splitword = Split(.Cells(i, 1).value, ",", -1, vbTextCompare)
                For j = 0 To UBound(splitword)
                leng = Len(splitword(j))
                'MsgBox splitword(j)
                temp = Left(splitword(j), leng - 10)
                ' If (InStr(1, temp, "09:", vbTextCompare) > 0 Or InStr(1, temp, "10:", vbTextCompare) > 0 Or InStr(1, temp, "08:", vbTextCompare) > 0) Then
                    If InStr(splitword(j), "PM") > 0 Or InStr(splitword(j), "AM") > 0 Then
                    chk = 0
                    'MsgBox splitword(j)
                   ' MsgBox Split(splitword(j), "(", -1, vbTextCompare)(0)
                        For m = 4 To lastrow11
                        temps = Replace(sheet2.Cells(m, 1).value, " ", "")
                        tempe = Replace(Split(splitword(j), "(", -1, vbTextCompare)(0), " ", "")
                       ' MsgBox temps
                       ' MsgBox tempe
                        'temps = temps.tolowercase()
                        'tempe = tempe.tolowercase()
                         If LCase(temps) = LCase(tempe) Then
                          'MsgBox m
                          'MsgBox Replace(sheet2.Cells(m, 1).value, " ", "")
                          'MsgBox Replace(Split(splitword(j), "(", -1, vbTextCompare)(0), " ", "")
                          sheet2.Cells(m, 200).value = Left(Split(splitword(j), ")(", -1, vbTextCompare)(1), 8)
                          sheet2.Cells(m, 201).value = Left(Split(splitword(j), " -", -1, vbTextCompare)(1), 8)
                          sheet2.Cells(m, col).value = sheet2.Cells(m, 201).value - sheet2.Cells(m, 200).value
                          sheet2.Cells(m, col).Font.Name = "Book Antiqua"
                          sheet2.Cells(m, col).HorizontalAlignment = xlCenter
                          'sheet2.Cells(m, col).NumberFormat = "hh:mm"
                          new1 = Split(Format(sheet2.Cells(m, col).value, "HH:MM"), ":", -1, vbTextCompare)(0)
                          'MsgBox Split(Format(sheet2.Cells(m, col).value, "HH:MM"), ":", -1, vbTextCompare)(1)
                          If Split(Format(sheet2.Cells(m, col).value, "HH:MM"), ":", -1, vbTextCompare)(1) <> "00" Then
                          new1 = new1 + ".5"
                          End If
                          sheet2.Cells(m, col).value = new1
                          'MsgBox Split(Format(sheet2.Cells(m, col).value, "HH:MM"), ":", -1, vbTextCompare)(0)
                          Dim rng1 As Range
                          Set rng1 = sheet2.Range(col & m)
                          rng1.ClearComments
                          rng1.AddComment "" & Format(sheet2.Cells(m, 200).value, "HH:MM AM/PM") & "/" & Format(sheet2.Cells(m, 201).value, "HH:MM AM/PM") & vbCrLf & Left(.Cells(i - 1, 1).value, 3)

                          
                          End If
                          

                          
                         'sheet2.Cells(x, 1).value = Split(splitword(j), "(", -1, vbTextCompare)(0)
                         'sheet2.Cells(x, 2).value = Left(Split(splitword(j), ")(", -1, vbTextCompare)(1), 8)
                         'sheet2.Cells(x, 3).value = Left(Split(splitword(j), " -", -1, vbTextCompare)(1), 8)
                         'sheet2.Cells(x, 4).value = sheet2.Cells(x, 3).value - sheet2.Cells(x, 2).value
                         'sheet2.Columns("D").NumberFormat = "hh:mm"
                         'sheet2.Cells(x, 5).value = Split(Split(splitword(j), "-", -1, vbTextCompare)(1), ")", -1, vbTextCompare)(0)
                         'sheet2.Cells(x, 6).value = Left(.Cells(i - 1, 1).value, 3)
                         'x = x + 1
                         Next m
                    End If
                ' End If
                Next j

             
             End If
             
             End If
     
     End If
             
             Next i
             
                                       
                          For m = 4 To lastrow11
                          If sheet2.Cells(m, col).value = "OFF" Then
                          'sheet2.Cells(m, col).value = "OFF"
                          sheet2.Cells(m, col).HorizontalAlignment = xlCenter
                          sheet2.Cells(m, col).Font.color = RGB(51, 51, 51)
                          sheet2.Cells(m, col).Interior.ColorIndex = 40
                          sheet2.Cells(m, col).Font.Name = "Book Antiqua"
                          End If
                          Next m
             

          End With



End Sub
