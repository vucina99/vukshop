<?php
    require_once "../config/connection.php";

    if(isset($_POST['dugme'])){
        $dohvatiProzivode="SELECT p.*,c.cena FROM proizvod p INNER JOIN cena c ON p.idproizvod=c.idproizvod";
    try{
        $proizvodi=executeQuery($dohvatiProzivode);
        $data=$proizvodi;
        $kod=200;
    }
    catch(PDOEXception $e){
        $data="GRESKA";
        $kod=404;
        zabeleziGresku($e);
    }
    }
    else{
        $data="NEMATE PRISTUP";
        $kod=404;
    }

echo json_encode($data);
http_response_code($kod);
?>