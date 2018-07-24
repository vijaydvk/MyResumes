Attribute VB_Name = "Module5"
Sub prime_open_close()
Attribute prime_open_close.VB_ProcData.VB_Invoke_Func = " \n14"
'
' prime_open_close Macro
'
'
Dim myTime As Date, myStrTime As String
Dim wb As Workbook
Dim myPath As String
Dim myFile As String
Dim myExtension As String
Dim FldrPicker As FileDialog
Dim location_name As Variant
Dim ws_new As Worksheet
Dim newsheet As Integer
Dim print_day_row, row_inc, col_inc As Integer
Dim print_day_col As Integer
Dim day_split As Variant
Dim sat_open, sun_open, mon_open, tue_open, wed_open, thu_open, fri_open As String
Dim sat_open_split, sun_open_split, mon_open_split, tue_open_split, wed_open_split, thu_open_split, fri_open_split As Variant
Dim sat_close, sun_close, mon_close, tue_close, wed_close, thu_close, fri_close As String
Dim sat_close_split, sun_close_split, mon_close_split, tue_close_split, wed_close_split, thu_close_split, fri_close_split As Variant
'Optimize Macro Speed
  Application.ScreenUpdating = False
  Application.EnableEvents = False
  Application.Calculation = xlCalculationManual

'Retrieve Target Folder Path From User
  Set FldrPicker = Application.FileDialog(msoFileDialogFolderPicker)

    With FldrPicker
      .Title = "Select A Target Folder"
      .AllowMultiSelect = False
        If .Show <> -1 Then GoTo NextCode
        myPath = .SelectedItems(1) & "\"
    End With

'In Case of Cancel
NextCode:
  myPath = myPath
  If myPath = "" Then GoTo ResetSettings

'Target File Extension (must include wildcard "*")
  myExtension = "*.xls*"

'Target Path with Ending Extention
  myFile = Dir(myPath & myExtension)

'Loop through each Excel file in folder
  Do While myFile <> ""
    'Set variable equal to opened workbook
      Set wb = Workbooks.Open(filename:=myPath & myFile)
      sat_open = ""
      sun_open = ""
      mon_open = ""
      tue_open = ""
      wed_open = ""
      thu_open = ""
      fri_open = ""
      sat_close = ""
      sun_close = ""
      mon_close = ""
      tue_close = ""
      wed_close = ""
      thu_close = ""
      fri_close = ""
    newsheet = 1
    'Ensure Workbook has opened before moving on to next line of code
      DoEvents
        'MsgBox (wb.Name)
        'MsgBox (wb.ActiveSheet.UsedRange.Rows.Count)
        'MsgBox (wb.ActiveSheet.UsedRange.Columns.Count)
        location_name = Split(wb.ActiveSheet.Cells(1, 1).Value, ":")
        'MsgBox (location_name(0))
        'MsgBox (Workbooks(2).Name)
        Workbooks(2).Sheets.add(After:=Worksheets(newsheet)).Name = location_name(0)
        Workbooks(2).Sheets(newsheet + 1).Cells(1, 1).Value = "DAY"
        Workbooks(2).Sheets(newsheet + 1).Cells(1, 2).Value = "OPEN"
        Workbooks(2).Sheets(newsheet + 1).Cells(1, 3).Value = "CLOSE"
        print_day_row = 2
        For i = 3 To wb.ActiveSheet.UsedRange.rows.Count
            For j = 3 To wb.ActiveSheet.UsedRange.Columns.Count
                'MsgBox (wb.ActiveSheet.Cells(i, j).Value)
                If i = 3 Then
                    day_split = Split(wb.ActiveSheet.Cells(i, j).Value, vbLf)
                    Workbooks(2).Sheets(newsheet + 1).Cells(print_day_row, 1).Value = day_split(0)
                    print_day_row = print_day_row + 1
                Else
                   If j = 3 Then
                        If sat_open = "" Then
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                                sat_open_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(2, 5).Value = sat_open_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(2, 6).Value = sat_open_split(1)
                                If Workbooks(2).Sheets(newsheet + 1).Cells(2, 5).Value < Workbooks(2).Sheets(newsheet + 1).Cells(2, 6).Value Then
                                    sat_open = sat_open_split(0)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value = sat_open
                                Else
                                    sat_open = sat_open_split(1)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value = sat_open
                                End If
                            End If
                        Else
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                            'MsgBox (Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value)
                                sat_open_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(2, 5).Value = sat_open_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(2, 6).Value = sat_open_split(1)
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(2, 5).Value < Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value Then
                                        sat_open = sat_open_split(0)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value = sat_open
                                    End If
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(2, 6).Value < Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value Then
                                        sat_open = sat_open_split(1)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value = sat_open
                                    End If
                            End If
                        End If
                        If sat_close = "" Then
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                                sat_close_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(2, 8).Value = sat_close_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(2, 9).Value = sat_close_split(1)
                                If Workbooks(2).Sheets(newsheet + 1).Cells(2, 8).Value > Workbooks(2).Sheets(newsheet + 1).Cells(2, 9).Value Then
                                    sat_close = sat_close_split(0)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(2, 7).Value = sat_close
                                Else
                                    sat_close = sat_close_split(1)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(2, 7).Value = sat_close
                                End If
                            End If
                        Else
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                            'MsgBox (Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value)
                                sat_close_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(2, 8).Value = sat_close_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(2, 9).Value = sat_close_split(1)
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(2, 8).Value > Workbooks(2).Sheets(newsheet + 1).Cells(2, 7).Value Then
                                        sat_close = sat_close_split(0)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(2, 7).Value = sat_close
                                    End If
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(2, 9).Value > Workbooks(2).Sheets(newsheet + 1).Cells(2, 7).Value Then
                                        sat_close = sat_close_split(1)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(2, 7).Value = sat_close
                                    End If
                            End If
                        End If
                    End If
                    
                    
                    If j = 4 Then
                        If sun_open = "" Then
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                                sun_open_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(3, 5).Value = sun_open_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(3, 6).Value = sun_open_split(1)
                                If Workbooks(2).Sheets(newsheet + 1).Cells(3, 5).Value < Workbooks(2).Sheets(newsheet + 1).Cells(3, 6).Value Then
                                    sun_open = sun_open_split(0)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(3, 4).Value = sun_open
                                Else
                                    sun_open = sun_open_split(1)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(3, 4).Value = sun_open
                                End If
                            End If
                        Else
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                            'MsgBox (Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value)
                                sun_open_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(3, 5).Value = sun_open_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(3, 6).Value = sun_open_split(1)
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(3, 5).Value < Workbooks(2).Sheets(newsheet + 1).Cells(3, 4).Value Then
                                        sun_open = sun_open_split(0)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(3, 4).Value = sun_open
                                    End If
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(3, 6).Value < Workbooks(2).Sheets(newsheet + 1).Cells(3, 4).Value Then
                                        sun_open = sun_open_split(1)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(3, 4).Value = sun_open
                                    End If
                            End If
                        End If
                        If sun_close = "" Then
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                                sun_close_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(3, 8).Value = sun_close_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(3, 9).Value = sun_close_split(1)
                                If Workbooks(2).Sheets(newsheet + 1).Cells(3, 8).Value > Workbooks(2).Sheets(newsheet + 1).Cells(3, 9).Value Then
                                    sun_close = sun_close_split(0)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(3, 7).Value = sun_close
                                Else
                                    sun_close = sun_close_split(1)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(3, 7).Value = sun_close
                                End If
                            End If
                        Else
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                            'MsgBox (Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value)
                                sun_close_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(3, 8).Value = sun_close_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(3, 9).Value = sun_close_split(1)
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(3, 8).Value > Workbooks(2).Sheets(newsheet + 1).Cells(3, 7).Value Then
                                        sun_close = sun_close_split(0)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(3, 7).Value = sun_close
                                    End If
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(3, 9).Value > Workbooks(2).Sheets(newsheet + 1).Cells(3, 7).Value Then
                                        sun_close = sun_close_split(1)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(3, 7).Value = sun_close
                                    End If
                            End If
                        End If
                    End If
                    
                    If j = 5 Then
                        If mon_open = "" Then
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                                mon_open_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(4, 5).Value = mon_open_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(4, 6).Value = mon_open_split(1)
                                If Workbooks(2).Sheets(newsheet + 1).Cells(4, 5).Value < Workbooks(2).Sheets(newsheet + 1).Cells(4, 6).Value Then
                                    mon_open = mon_open_split(0)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(4, 4).Value = mon_open
                                Else
                                    mon_open = mon_open_split(1)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(4, 4).Value = mon_open
                                End If
                            End If
                        Else
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                            'MsgBox (Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value)
                                mon_open_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(4, 5).Value = mon_open_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(4, 6).Value = mon_open_split(1)
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(4, 5).Value < Workbooks(2).Sheets(newsheet + 1).Cells(4, 4).Value Then
                                        mon_open = mon_open_split(0)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(4, 4).Value = mon_open
                                    End If
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(4, 6).Value < Workbooks(2).Sheets(newsheet + 1).Cells(4, 4).Value Then
                                        mon_open = mon_open_split(1)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(4, 4).Value = mon_open
                                    End If
                            End If
                        End If
                        If mon_close = "" Then
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                                mon_close_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(4, 8).Value = mon_close_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(4, 9).Value = mon_close_split(1)
                                If Workbooks(2).Sheets(newsheet + 1).Cells(4, 8).Value > Workbooks(2).Sheets(newsheet + 1).Cells(4, 9).Value Then
                                    mon_close = mon_close_split(0)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(4, 7).Value = mon_close
                                Else
                                    mon_close = mon_close_split(1)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(4, 7).Value = mon_close
                                End If
                            End If
                        Else
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                            'MsgBox (Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value)
                                mon_close_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(4, 8).Value = mon_close_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(4, 9).Value = mon_close_split(1)
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(4, 8).Value > Workbooks(2).Sheets(newsheet + 1).Cells(4, 7).Value Then
                                        mon_close = mon_close_split(0)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(4, 7).Value = mon_close
                                    End If
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(4, 9).Value > Workbooks(2).Sheets(newsheet + 1).Cells(4, 7).Value Then
                                        mon_close = mon_close_split(1)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(4, 7).Value = mon_close
                                    End If
                            End If
                        End If
                    End If
                                        
                     If j = 6 Then
                        If tue_open = "" Then
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                                tue_open_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(5, 5).Value = tue_open_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(5, 6).Value = tue_open_split(1)
                                If Workbooks(2).Sheets(newsheet + 1).Cells(5, 5).Value < Workbooks(2).Sheets(newsheet + 1).Cells(5, 6).Value Then
                                    tue_open = tue_open_split(0)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(5, 4).Value = tue_open
                                Else
                                    tue_open = tue_open_split(1)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(5, 4).Value = tue_open
                                End If
                            End If
                        Else
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                            'MsgBox (Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value)
                                tue_open_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(5, 5).Value = tue_open_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(5, 6).Value = tue_open_split(1)
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(5, 5).Value < Workbooks(2).Sheets(newsheet + 1).Cells(5, 4).Value Then
                                        tue_open = tue_open_split(0)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(5, 4).Value = tue_open
                                    End If
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(5, 6).Value < Workbooks(2).Sheets(newsheet + 1).Cells(5, 4).Value Then
                                       tue_open = tue_open_split(1)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(5, 4).Value = tue_open
                                    End If
                            End If
                        End If
                        If tue_close = "" Then
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                                tue_close_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(5, 8).Value = tue_close_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(5, 9).Value = tue_close_split(1)
                                If Workbooks(2).Sheets(newsheet + 1).Cells(5, 8).Value > Workbooks(2).Sheets(newsheet + 1).Cells(5, 9).Value Then
                                    tue_close = tue_close_split(0)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(5, 7).Value = tue_close
                                Else
                                    tue_close = tue_close_split(1)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(5, 7).Value = tue_close
                                End If
                            End If
                        Else
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                            'MsgBox (Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value)
                                tue_close_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(5, 8).Value = tue_close_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(5, 9).Value = tue_close_split(1)
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(5, 8).Value > Workbooks(2).Sheets(newsheet + 1).Cells(5, 7).Value Then
                                        tue_close = tue_close_split(0)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(5, 7).Value = tue_close
                                    End If
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(5, 9).Value > Workbooks(2).Sheets(newsheet + 1).Cells(5, 7).Value Then
                                        tue_close = tue_close_split(1)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(5, 7).Value = tue_close
                                    End If
                            End If
                        End If
                    End If
                    
                      If j = 7 Then
                        If wed_open = "" Then
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                                wed_open_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(6, 5).Value = wed_open_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(6, 6).Value = wed_open_split(1)
                                If Workbooks(2).Sheets(newsheet + 1).Cells(6, 5).Value < Workbooks(2).Sheets(newsheet + 1).Cells(6, 6).Value Then
                                    wed_open = wed_open_split(0)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(6, 4).Value = wed_open
                                Else
                                    wed_open = wed_open_split(1)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(6, 4).Value = wed_open
                                End If
                            End If
                        Else
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                            'MsgBox (Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value)
                                wed_open_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(6, 5).Value = wed_open_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(6, 6).Value = wed_open_split(1)
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(6, 5).Value < Workbooks(2).Sheets(newsheet + 1).Cells(6, 4).Value Then
                                        wed_open = wed_open_split(0)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(6, 4).Value = wed_open
                                    End If
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(6, 6).Value < Workbooks(2).Sheets(newsheet + 1).Cells(6, 4).Value Then
                                        wed_open = wed_open_split(1)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(6, 4).Value = wed_open
                                    End If
                            End If
                        End If
                        If wed_close = "" Then
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                                wed_close_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(6, 8).Value = wed_close_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(6, 9).Value = wed_close_split(1)
                                If Workbooks(2).Sheets(newsheet + 1).Cells(6, 8).Value > Workbooks(2).Sheets(newsheet + 1).Cells(6, 9).Value Then
                                    wed_close = wed_close_split(0)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(6, 7).Value = wed_close
                                Else
                                    wed_close = wed_close_split(1)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(6, 7).Value = wed_close
                                End If
                            End If
                        Else
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                            'MsgBox (Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value)
                            wed_close_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(6, 8).Value = wed_close_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(6, 9).Value = wed_close_split(1)
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(6, 8).Value > Workbooks(2).Sheets(newsheet + 1).Cells(6, 7).Value Then
                                        wed_close = wed_close_split(0)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(6, 7).Value = wed_close
                                    End If
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(6, 9).Value > Workbooks(2).Sheets(newsheet + 1).Cells(6, 7).Value Then
                                        wed_close = wed_close_split(1)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(6, 7).Value = wed_close
                                    End If
                            End If
                        End If
                    End If
                    
                      If j = 8 Then
                        If thu_open = "" Then
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                                thu_open_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(7, 5).Value = thu_open_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(7, 6).Value = thu_open_split(1)
                                If Workbooks(2).Sheets(newsheet + 1).Cells(7, 5).Value < Workbooks(2).Sheets(newsheet + 1).Cells(7, 6).Value Then
                                    thu_open = thu_open_split(0)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(7, 4).Value = thu_open
                                Else
                                    thu_open = thu_open_split(1)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(7, 4).Value = thu_open
                                End If
                            End If
                        Else
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                            'MsgBox (Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value)
                                thu_open_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(7, 5).Value = thu_open_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(7, 6).Value = thu_open_split(1)
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(7, 5).Value < Workbooks(2).Sheets(newsheet + 1).Cells(7, 4).Value Then
                                        thu_open = thu_open_split(0)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(7, 4).Value = thu_open
                                    End If
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(7, 6).Value < Workbooks(2).Sheets(newsheet + 1).Cells(7, 4).Value Then
                                        thu_open = thu_open_split(1)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(7, 4).Value = thu_open
                                    End If
                            End If
                        End If
                        If thu_close = "" Then
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                                thu_close_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(7, 8).Value = thu_close_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(7, 9).Value = thu_close_split(1)
                                If Workbooks(2).Sheets(newsheet + 1).Cells(7, 8).Value > Workbooks(2).Sheets(newsheet + 1).Cells(7, 9).Value Then
                                    thu_close = thu_close_split(0)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(7, 7).Value = thu_close
                                Else
                                    thu_close = thu_close_split(1)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(7, 7).Value = thu_close
                                End If
                            End If
                        Else
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                            'MsgBox (Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value)
                            thu_close_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(7, 8).Value = thu_close_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(7, 9).Value = thu_close_split(1)
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(7, 8).Value > Workbooks(2).Sheets(newsheet + 1).Cells(7, 7).Value Then
                                        thu_close = thu_close_split(0)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(7, 7).Value = thu_close
                                    End If
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(7, 9).Value > Workbooks(2).Sheets(newsheet + 1).Cells(7, 7).Value Then
                                        thu_close = thu_close_split(1)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(7, 7).Value = thu_close
                                    End If
                            End If
                        End If
                    End If
                                                        
                      If j = 9 Then
                        If fri_open = "" Then
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                                fri_open_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(8, 5).Value = fri_open_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(8, 6).Value = fri_open_split(1)
                                If Workbooks(2).Sheets(newsheet + 1).Cells(8, 5).Value < Workbooks(2).Sheets(newsheet + 1).Cells(8, 6).Value Then
                                    fri_open = fri_open_split(0)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(8, 4).Value = fri_open
                                Else
                                    fri_open = fri_open_split(1)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(8, 4).Value = fri_open
                                End If
                            End If
                        Else
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                            'MsgBox (Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value)
                                fri_open_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(8, 5).Value = fri_open_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(8, 6).Value = fri_open_split(1)
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(8, 5).Value < Workbooks(2).Sheets(newsheet + 1).Cells(8, 4).Value Then
                                        fri_open = fri_open_split(0)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(8, 4).Value = fri_open
                                    End If
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(8, 6).Value < Workbooks(2).Sheets(newsheet + 1).Cells(8, 4).Value Then
                                        fri_open = fri_open_split(1)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(8, 4).Value = fri_open
                                    End If
                            End If
                        End If
                        If fri_close = "" Then
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                                fri_close_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(8, 8).Value = fri_close_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(8, 9).Value = fri_close_split(1)
                                If Workbooks(2).Sheets(newsheet + 1).Cells(8, 8).Value > Workbooks(2).Sheets(newsheet + 1).Cells(8, 9).Value Then
                                    fri_close = fri_close_split(0)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(8, 7).Value = fri_close
                                Else
                                    fri_close = fri_close_split(1)
                                    Workbooks(2).Sheets(newsheet + 1).Cells(8, 7).Value = fri_close
                                End If
                            End If
                        Else
                            If wb.ActiveSheet.Cells(i, j).Value <> "" Then
                            'MsgBox (Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value)
                            fri_close_split = Split(wb.ActiveSheet.Cells(i, j).Value, " -")
                                Workbooks(2).Sheets(newsheet + 1).Cells(8, 8).Value = fri_close_split(0)
                                Workbooks(2).Sheets(newsheet + 1).Cells(8, 9).Value = fri_close_split(1)
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(8, 8).Value > Workbooks(2).Sheets(newsheet + 1).Cells(8, 7).Value Then
                                        fri_close = fri_close_split(0)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(8, 7).Value = fri_close
                                    End If
                                    If Workbooks(2).Sheets(newsheet + 1).Cells(8, 9).Value > Workbooks(2).Sheets(newsheet + 1).Cells(8, 7).Value Then
                                        fri_close = fri_close_split(1)
                                        Workbooks(2).Sheets(newsheet + 1).Cells(8, 7).Value = fri_close
                                    End If
                            End If
                        End If
                    End If
                    
                End If
            Next j
        Next i
        Workbooks(2).Sheets(newsheet + 1).Cells(2, 2).Value = sat_open
        Workbooks(2).Sheets(newsheet + 1).Cells(2, 3).Value = sat_close
        Workbooks(2).Sheets(newsheet + 1).Cells(2, 4).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(2, 5).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(2, 6).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(2, 7).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(2, 8).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(2, 9).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(3, 2).Value = sun_open
        Workbooks(2).Sheets(newsheet + 1).Cells(3, 3).Value = sun_close
        Workbooks(2).Sheets(newsheet + 1).Cells(3, 4).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(3, 5).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(3, 6).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(3, 7).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(3, 8).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(3, 9).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(4, 2).Value = mon_open
        Workbooks(2).Sheets(newsheet + 1).Cells(4, 3).Value = mon_close
        Workbooks(2).Sheets(newsheet + 1).Cells(4, 4).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(4, 5).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(4, 6).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(4, 7).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(4, 8).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(4, 9).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(5, 2).Value = tue_open
        Workbooks(2).Sheets(newsheet + 1).Cells(5, 3).Value = tue_close
        Workbooks(2).Sheets(newsheet + 1).Cells(5, 4).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(5, 5).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(5, 6).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(5, 7).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(5, 8).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(5, 9).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(6, 2).Value = wed_open
        Workbooks(2).Sheets(newsheet + 1).Cells(6, 3).Value = wed_close
        Workbooks(2).Sheets(newsheet + 1).Cells(6, 4).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(6, 5).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(6, 6).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(6, 7).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(6, 8).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(6, 9).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(7, 2).Value = thu_open
        Workbooks(2).Sheets(newsheet + 1).Cells(7, 3).Value = thu_close
        Workbooks(2).Sheets(newsheet + 1).Cells(7, 4).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(7, 5).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(7, 6).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(7, 7).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(7, 8).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(7, 9).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(8, 2).Value = fri_open
        Workbooks(2).Sheets(newsheet + 1).Cells(8, 3).Value = fri_close
        Workbooks(2).Sheets(newsheet + 1).Cells(8, 4).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(8, 5).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(8, 6).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(8, 7).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(8, 8).Value = ""
        Workbooks(2).Sheets(newsheet + 1).Cells(8, 9).Value = ""
        newsheet = newsheet + 1
    'Change First Worksheet's Background Fill Blue
      'wb.Worksheets(1).Range("A1:Z1").Interior.Color = RGB(51, 98, 174)
    'Save and Close Workbook
      wb.Close SaveChanges:=True
    'Ensure Workbook has closed before moving on to next line of code
      DoEvents
    'Get next file name
      myFile = Dir
  Loop
'Message Box when tasks are completed
  MsgBox "Task Complete!"
ResetSettings:
  'Reset Macro Optimization Settings
    Application.EnableEvents = True
    Application.Calculation = xlCalculationAutomatic
    Application.ScreenUpdating = True
    MsgBox (Workbooks(2).Sheets.Count)
     Workbooks(2).Sheets(1).Cells(1, 1).Value = "Store Name"
     Workbooks(2).Sheets(1).Cells(1, 2).Value = "SATURDAY"
     Workbooks(2).Sheets(1).Cells(1, 4).Value = "SUNDAY"
     Workbooks(2).Sheets(1).Cells(1, 6).Value = "MONDAY"
     Workbooks(2).Sheets(1).Cells(1, 8).Value = "TUESDAY"
     Workbooks(2).Sheets(1).Cells(1, 10).Value = "WEDNESDAY"
     Workbooks(2).Sheets(1).Cells(1, 12).Value = "THURSDAY"
     Workbooks(2).Sheets(1).Cells(1, 14).Value = "FRIDAY"
     Workbooks(2).Sheets(1).Cells(2, 2).Value = "OPEN"
     Workbooks(2).Sheets(1).Cells(2, 3).Value = "CLOSE"
     Workbooks(2).Sheets(1).Cells(2, 4).Value = "OPEN"
     Workbooks(2).Sheets(1).Cells(2, 5).Value = "CLOSE"
     Workbooks(2).Sheets(1).Cells(2, 6).Value = "OPEN"
     Workbooks(2).Sheets(1).Cells(2, 7).Value = "CLOSE"
     Workbooks(2).Sheets(1).Cells(2, 8).Value = "OPEN"
     Workbooks(2).Sheets(1).Cells(2, 9).Value = "CLOSE"
     Workbooks(2).Sheets(1).Cells(2, 10).Value = "OPEN"
     Workbooks(2).Sheets(1).Cells(2, 11).Value = "CLOSE"
     Workbooks(2).Sheets(1).Cells(2, 12).Value = "OPEN"
     Workbooks(2).Sheets(1).Cells(2, 13).Value = "CLOSE"
     Workbooks(2).Sheets(1).Cells(2, 14).Value = "OPEN"
     Workbooks(2).Sheets(1).Cells(2, 15).Value = "CLOSE"
     row_inc = 3
    For i = 2 To Workbooks(2).Sheets.Count
        Workbooks(2).Sheets(1).Cells(row_inc, 1).Value = Workbooks(2).Sheets(i).Name
        Workbooks(2).Sheets(1).Cells(row_inc, 2).Value = Workbooks(2).Sheets(i).Cells(2, 2).Value
        Workbooks(2).Sheets(1).Cells(row_inc, 3).Value = Workbooks(2).Sheets(i).Cells(2, 3).Value
        Workbooks(2).Sheets(1).Cells(row_inc, 4).Value = Workbooks(2).Sheets(i).Cells(3, 2).Value
        Workbooks(2).Sheets(1).Cells(row_inc, 5).Value = Workbooks(2).Sheets(i).Cells(3, 3).Value
        Workbooks(2).Sheets(1).Cells(row_inc, 6).Value = Workbooks(2).Sheets(i).Cells(4, 2).Value
        Workbooks(2).Sheets(1).Cells(row_inc, 7).Value = Workbooks(2).Sheets(i).Cells(4, 3).Value
        Workbooks(2).Sheets(1).Cells(row_inc, 8).Value = Workbooks(2).Sheets(i).Cells(5, 2).Value
        Workbooks(2).Sheets(1).Cells(row_inc, 9).Value = Workbooks(2).Sheets(i).Cells(5, 3).Value
        Workbooks(2).Sheets(1).Cells(row_inc, 10).Value = Workbooks(2).Sheets(i).Cells(6, 2).Value
        Workbooks(2).Sheets(1).Cells(row_inc, 11).Value = Workbooks(2).Sheets(i).Cells(6, 3).Value
        Workbooks(2).Sheets(1).Cells(row_inc, 12).Value = Workbooks(2).Sheets(i).Cells(7, 2).Value
        Workbooks(2).Sheets(1).Cells(row_inc, 13).Value = Workbooks(2).Sheets(i).Cells(7, 3).Value
        Workbooks(2).Sheets(1).Cells(row_inc, 14).Value = Workbooks(2).Sheets(i).Cells(8, 2).Value
        Workbooks(2).Sheets(1).Cells(row_inc, 15).Value = Workbooks(2).Sheets(i).Cells(8, 3).Value
        row_inc = row_inc + 1
    Next i
End Sub
