<?php
    require_once "config/connection.php";
    $id=$_GET['id'];
    $upit="SELECT AVG(ocena) AS ocena,COUNT(*) AS broj FROM ocena WHERE idproizvod=:id";
    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id",$id);
    try{
        $priprema->execute();
        $ocena=$priprema->fetch();
        $ocenaround=round($ocena->ocena);
        $broj=$ocena->broj;
    }
    catch(PDOException $e){
        echo "Došlo je do greške";
        zabeleziGresku($e);
    }
?>