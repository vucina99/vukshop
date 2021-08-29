<?php
require_once "../config/connection.php";
if(isset($_POST['dugme'])){
    $kat=$_POST['kat'];
    $upit="INSERT INTO kategorija VALUES(null,:kat)";
    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":kat",$kat);
    try{
        $priprema->execute();
        $kod=200;
        $poruka="Kategorija je dodata";
    }
    catch(PDOException $e){
        $kod=500;
        $poruka="Nema veze sa serverom ili kategorija već postoji";
        zabeleziGresku($e);
    }
}       
else{
    $kod=404;
    $poruka="Nemate pristup stranici";
}

echo json_encode($poruka);
http_response_code($kod);
?>