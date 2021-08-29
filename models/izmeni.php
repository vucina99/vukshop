<?php
require_once "../config/connection.php";
    if(isset($_POST['dugmeIzmeni'])){
        $cena=$_POST['cena'];
        $id=$_POST['id'];
        $upit="UPDATE cena SET cena=:cena WHERE idproizvod=:id";
        $priprema=$conn->prepare($upit);
        $priprema->bindParam(":cena",$cena);
        $priprema->bindParam(":id",$id);
        try{
            $priprema->execute();
            $kod=200;
            $poruka="Urađen update";
        }
        catch(PDOException $e){
            $kod=500;
            $poruka="Nema veze sa serverom";
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