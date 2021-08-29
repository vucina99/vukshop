<?php
header('Content-Type:application/json');
require_once "../config/connection.php";
    if(isset($_POST['dugme'])){
        $kat=$_POST['kategorija'];
        $val=strtoupper($_POST['search']);
        $order=$_POST['sort'];
        $like="%$val%";
        if($kat=="M"){
            $kat="Muška";
        }
        else{
            $kat="Ženska";
        }
             
$upit="SELECT idmeni from meni WHERE naziv=:kat";
$priprema=$conn->prepare($upit);
$priprema->bindParam(":kat",$kat);
try{
    $priprema->execute();
    $rez=$priprema->fetch();
    $idmeni=$rez->idmeni;
    $dohvatiProzivode="SELECT p.*,c.cena FROM proizvod p INNER JOIN cena c ON p.idproizvod=c.idproizvod WHERE p.idmeni=:id AND UPPER(p.naziv) LIKE'".$like."' ORDER BY c.cena $order";
    $priprema2=$conn->prepare($dohvatiProzivode);
    $priprema2->bindParam(":id",$idmeni);
    try{
        $priprema2->execute();
        $proizvod=$priprema2->fetchAll();
        echo json_encode($proizvod);
        http_response_code(200);
    }
    catch(PDOException $e){
        echo json_encode("Nema veze sa serverom");
        http_response_code(200);
        zabeleziGresku($e);
    }
}
catch(PDOException $e){
    echo json_encode("Nema veze sa serverom");
        http_response_code(200);
        zabeleziGresku($e);
}
    }
    else{
        echo json_encode("Nema prozivoda");
        http_response_code(200);
    }
?>