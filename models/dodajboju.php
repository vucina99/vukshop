<?php
require_once "../config/connection.php";
if(isset($_POST['dugme'])){
    $boja=$_POST['boja'];
    $upit="INSERT INTO boja VALUES(null,:boja)";
    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":boja",$boja);
    try{
        $priprema->execute();
        $kod=200;
        $poruka="Boja je dodata";
    }
    catch(PDOException $e){
        $kod=500;
        $poruka="Nema veze sa serverom ili boja već postoji";
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