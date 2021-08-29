<?php
require_once "config/connection.php";
if(isset($_GET['kat'])){
    $kat=$_GET['kat'];
    if($_GET['kat']=="Ženska" || $_GET['kat']=="Muška"){
        $kat=$_GET['kat'];
       
$upit="SELECT idmeni from meni WHERE naziv=:kat";
$priprema=$conn->prepare($upit);
$priprema->bindParam(":kat",$kat);
try{
    $priprema->execute();
    $rez=$priprema->fetch();
    $idmeni=$rez->idmeni;
    $dohvatiProzivode="SELECT p.*,c.cena FROM proizvod p INNER JOIN cena c ON p.idproizvod=c.idproizvod WHERE p.idmeni=:id";
    $priprema2=$conn->prepare($dohvatiProzivode);
    $priprema2->bindParam(":id",$idmeni);
    try{
        $priprema2->execute();
        $proizvod=$priprema2->fetchAll();
    }
    catch(PDOException $e){
        echo "Nema veze sa serverom";
        zabeleziGresku($e);
    }
}
catch(PDOException $e){
    echo "Nema veze sa serverom";
    zabeleziGresku($e);
}
    }
    else{
        echo 'greska';
    }
}

?>