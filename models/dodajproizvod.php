<?php
require_once "../config/connection.php";
    $upitbrend="SELECT * FROM brendovi";
    $upitboja="SELECT * FROM boja";
    $upitkat="SELECT * FROM kategorija";
    try{
        $brendovi=executeQuery($upitbrend);
        $boja=executeQuery($upitboja);
        $kat=executeQuery($upitkat);
        $poruka=['boja'=>$boja,'brendovi'=>$brendovi,'kategorija'=>$kat];
        $kod=200;
    }
    catch(PDOException $e){
        $poruka="Nema veze sa serverom";
        $kod=500;
        zabeleziGresku($e);
    }


echo json_encode($poruka);
http_response_code($kod);
?>