<?php
require_once "config/connection.php";

$kat=$_GET['kat'];

$dohvatikat="SELECT DISTINCT k.* FROM kategorija k INNER JOIN proizvod p ON k.idkategorije=p.idkat INNER JOIN meni m ON p.idmeni=m.idmeni WHERE m.naziv=:kat";
$priprema=$conn->prepare($dohvatikat);
$priprema->bindParam(":kat",$kat);
try{
    $priprema->execute();
    $kategorije=$priprema->fetchAll();
}
catch(PDOException $e){
    echo "Nema veze sa serverom";
    zabeleziGresku($e);
}
?>