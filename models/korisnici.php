<?php
    require_once "../config/connection.php";

    if(isset($_POST['dugme'])){
        $upit="SELECT * FROM korisnik";
        $korisnici=executeQuery($upit);
        $kod=200;
        $data=$korisnici;
    }
    else{
        $data="NEMATE PRISTUP";
        $kod=404;
    }

echo json_encode($data);
http_response_code($kod);
?>