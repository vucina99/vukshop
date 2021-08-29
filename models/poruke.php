<?php
    require_once "../config/connection.php";

    if(isset($_POST['dugme'])){
        
        $dohvatiPoruke="SELECT * FROM poruke";
        try{
            $korisnici=executeQuery($dohvatiPoruke);
            $kod=200;
            $data=$korisnici;
        }
        catch(PDOException $e){
            $kod=500;
            $data='Nema veze sa serverom';
            zabeleziGresku($e);
        }
    }
    else{
        $data="NEMATE PRISTUP";
        $kod=404;
    }

echo json_encode($data);
http_response_code($kod);
?>