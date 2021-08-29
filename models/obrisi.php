<?php
require_once "../config/connection.php";
if(isset($_POST['dugmeDelete'])){
    $id=$_POST['proizvodId'];
    $upit="DELETE FROM cena WHERE idproizvod=:id";
    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":id",$id);
    try{
        $priprema->execute();
        $upit2="DELETE FROM proizvod WHERE idproizvod=:id";
        $priprema2=$conn->prepare($upit2);
        $priprema2->bindParam(":id",$id);
        try{
            $priprema2->execute();
            $kod=204;
            $data="Uspesno obrisan";
        }
        catch(PDOException $e){
            $kod=500;
            $data="Greska sa serverom";
            zabeleziGresku($e);
        }
    }
    catch(PDOException $e){
    $kod=500;
    $data=$e;
    }
}
else{
    $kod=404;
    $data="Nemate pristup";
}


echo json_encode($data);
http_response_code($kod);
?>