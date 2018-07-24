Attribute VB_Name = "Module9"
Sub Find_replace()
Attribute Find_replace.VB_ProcData.VB_Invoke_Func = " \n14"
'
' Find_replace Macro
'

'


Dim sht As Worksheet
Dim fndList As Variant
Dim rplcList As Variant
Dim x As Long

fndList = Array("harmony", "galaxy s 8", "galaxy s8", "lg lg harmony", "gray", "samsung samsung galaxy s8", "samsung galaxy amp prime 2", "Grand X 4", "grand x4", "galaxy amp prime 2", "samsung amp prime 2", "lg fortune", "grand x 3", "grand x", "ZTE Gtand X", "LG G Hormony", "LG X Power", "ZTE Sonata 3", "Alcatel Streak", "Iphone 7+ 32GB black", "Iphone 7+ 32GB rose gold", "Iphone 7 128 GB BLACK", "GALAXY S 7", "Samsung galaxy s7", "Samsung galaxy s7", "GALAXY S 6", "Samsung galaxy s6", "Samsung galaxy s6", "lg stylo 2", "ALCATEL IDOL 3", "ALCATEL IDOL 4", "HTC 626S", "HTC 520", "LG ESCAPE GOLD", "galaxy s", "Amp Prime2", "Galaxy X8")
rplcList = Array("LG Harmony", "Samsung Galaxy S8", "Samsung Galaxy S8", "LG Harmony", "grey", "Samsung Galaxy S8", "Amp Prime 2", "ZTE Grand X 4", "ZTE Grand X 4", "Amp Prime 2", "Amp Prime 2", "Fortune", "ZTE Grand X 3", "ZTE Grand X", "ZTE Grand X", "LG Harmony", "X Power", "Sonata 3", "Streak", "iPhone 7 Plus 32GB Black", "iPhone 7 Plus 32GB Rose Gold", "iPhone 7 128GB Jet Black", "Galaxy S7", "Galaxy S7", "Galaxy S7", "Galaxy S6", "Galaxy S6", "Galaxy S6", "Stylo 2", "Alcatel OneTouch Idol 3", "Alcatel OneTouch Idol 4", "HTC Desire 626s", "HTC Desire 520", "Escape 3 Gold", "Galaxy S 8", "Amp Prime 2", "Galaxy S 8")

'Loop through each item in Array lists
  For x = LBound(fndList) To UBound(fndList)
    'Loop through each worksheet in ActiveWorkbook
      For Each sht In ActiveWorkbook.Worksheets
        sht.Cells.Replace What:=fndList(x), Replacement:=rplcList(x), _
          LookAt:=xlWhole, SearchOrder:=xlByRows, MatchCase:=False, _
          SearchFormat:=False, ReplaceFormat:=False
      Next sht
  
  Next x

End Sub


