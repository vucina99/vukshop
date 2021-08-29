<?php
require_once "../config/connection.php";
$proizvod="SELECT * FROM proizvod p INNER JOIN brendovi b ON p.idbrend=b.idbrend INNER JOIN cena c ON p.idproizvod=c.idproizvod INNER JOIN boja bo on p.idboja=bo.idboja";
try{
    $products=$conn->query($proizvod)->fetchAll();
}
catch(PDOException $e){
    echo "Nema veze sa serverom";
    die("Nesto nije uredu");
    zabeleziGresku($e);
}
$excel_file = new COM("Excel.Application") or die("Nije moguče otvoriti excel aplikaciju");
 $excel_file->Visible = true;
 $excel_file->DisplayAlerts = 1;
 $workbook = $excel_file->Workbooks -> Add();
 $worksheet = $excel_file->Worksheets("Sheet1");
 $worksheet->activate;
 $name = $worksheet->Range("A1");
 $name->activate;
 $name->Value = "Naziv";
 $price = $worksheet->Range("B1");
 $price->activate;
 $price->Value = "Cena";
 $brend = $worksheet->Range("C1");
 $brend->activate;
 $brend->Value = "Brend";
 $color = $worksheet->Range("D1");
 $color->activate;
 $color->Value = "Boja";
 $counter = 2;
 foreach($products as $p)
 {
    $name = $worksheet->Range("A{$counter}");
    $name->activate;
    $name->Value = $p->naziv;
    $price = $worksheet->Range("B{$counter}");
    $price->activate;
    $price->Value = $p->cena;
    $brend = $worksheet->Range("C{$counter}");
    $brend->activate;
    $brend->Value = $p->nazivbrend;
    $color = $worksheet->Range("D{$counter}");
    $color->activate;
    $color->Value = $p->vrednost;

 $counter++;
 }
 $count_products = $worksheet->Range("F1");
 $count_products->activate;
 $count_products->Value = $counter-1;
$filename = tempnam(sys_get_temp_dir(), "excel");
$workbook->_SaveAs($filename);
$workbook->Saved = true;
$workbook->Save();
$workbook->Close;
$excel_file->Workbooks->Close();
$excel_file->Quit();
unset($workbook);
unset($worksheet);
unset($excel_file);



header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=cenovnik.xsl");

readfile($filename);
unlink($filename);

?>