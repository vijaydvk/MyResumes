Attribute VB_Name = "Module4"
Sub Sales()
Attribute Sales.VB_ProcData.VB_Invoke_Func = " \n14"
'
' Sales Macro
'

'
Dim pos As Integer
Dim chkk As String
Dim lRow As Long
Dim lCol As Long
Dim strArray() As String
Dim intCount As Integer
    
  '  MsgBox "Last Row: " & lRow

Dim shcnt, i, j As Integer
Dim wb As Workbook
Dim wbs As Workbooks
Dim sheet, sheet1, sheet2 As Object
Dim app, doc, srsheet As Object
Dim x, y As Integer

Set wbs = Application.Workbooks
Dim msm, m As String
Set sheet1 = ActiveWorkbook.Worksheets("Sheet1")
With sheet1
   dpapprow = .Cells(.Rows.count, "A").End(xlUp).Row
End With

'MsgBox dpapprow
 Set app = CreateObject("Excel.Application")
 Set doc = app.Workbooks.Open("D:/Time and attendence/5.03/Sales report.xlsx")
 app.Visible = True
 cnt = app.ActiveWorkbook.Worksheets.count
 
     For j = 1 To cnt - 1

        Set srsheet = app.Worksheets(j)
        
        For x = 1 To 100
        If srsheet.Cells(x, 2).value <> "Employees name" And srsheet.Cells(x, 2).value <> "Total" Then
        srsheet.Cells(x, 2).value = ""
        srsheet.Cells(x, 2).Interior.ColorIndex = 0
        End If
        Next x
    Next j
 
    For j = 1 To cnt - 1

        Set srsheet = app.Worksheets(j)
        
        For x = 1 To 100
        
        'MsgBox srsheet.Cells(x, 1).Value

        If srsheet.Cells(x, 1).value <> "" And srsheet.Cells(x, 1).value <> "Location" Then

            If IsNumeric(Left(srsheet.Cells(x, 1).value, 3)) Then

                    For i = 2 To dpapprow
                        If InStr(1, Left(sheet1.Cells(i, 8), 3), Left(srsheet.Cells(x, 1).value, 3), vbTextCompare) > 0 Then
                        If InStr(1, srsheet.Cells(x, 2).value, sheet1.Cells(i, 1), vbTextCompare) > 0 Then
                        'srsheet.Cells(x, 2).Value = srsheet.Cells(x, 2).Value + sheet1.Cells(i, 1) & "(" & Format(sheet1.Cells(i, 3), "HH:MM AM/PM") & "/" & Format(sheet1.Cells(i, 5), "HH:MM AM/PM") & ")"
                        'srsheet.Cells(x, 2).Interior.ColorIndex = 35
                        Else
                        If srsheet.Cells(x, 2).value <> "" Then
                        srsheet.Cells(x, 2).value = srsheet.Cells(x, 2).value + " , " & sheet1.Cells(i, 1) & "(" & Format(sheet1.Cells(i, 3), "HH:MM AM/PM") & "/" & Format(sheet1.Cells(i, 5), "HH:MM AM/PM") & ")"
                        Else
                        srsheet.Cells(x, 2).value = sheet1.Cells(i, 1) & "(" & Format(sheet1.Cells(i, 3), "HH:MM AM/PM") & "/" & Format(sheet1.Cells(i, 5), "HH:MM AM/PM") & ")"
                        End If
                        End If
                        
                        End If


                    Next i
                
            End If
        End If
        Next x
    Next j
    
        For j = 1 To cnt - 1
            Set srsheet = app.Worksheets(j)
            For x = 1 To 100
                srsheet.Cells(x, 2).value = Replace(srsheet.Cells(x, 2).value, "11:59 PM", "Close")
                srsheet.Cells(x, 2).value = Replace(srsheet.Cells(x, 2).value, "/)", "/Close)")
            Next x
        Next j

End Sub


