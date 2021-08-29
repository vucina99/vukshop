<?php
session_start();
    if(isset($_POST["dugmeLog"])){
        session_destroy();
        $data="OK";
        $kod=200;
    }
    else{
        $kod=404;
        $data="Nemate pristup";
    }


    echo json_encode($data);
    http_response_code($kod);
?>