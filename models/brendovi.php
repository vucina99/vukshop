<?php
require_once "config/connection.php";

$kat=$_GET['kat'];
$dohvatiBrend="SELECT DISTINCT b.* FROM brendovi b INNER JOIN proizvod p ON p.idbrend=b.idbrend INNER JOIN meni m ON p.idmeni=m.idmeni WHERE m.naziv=:kat";
$priprema=$conn->prepare($dohvatiBrend);
$priprema->bindParam(":kat",$kat);
try{
    $priprema->execute();
    $brendovi=$priprema->fetchAll();
}
catch(PDOException $e){
    echo $e;
    zabeleziGresku($e);
}
?>