<?php
session_start();
require_once "../config/connection.php";
header('Content-Type:application/json');
if(isset($_POST['idProizvoda'])){




    if(!$_SESSION['korisnik']){
        echo json_encode(["message" =>"notsuccess"]);
    }else{
        $id = intval($_POST['idProizvoda']);
        $session = intval($_SESSION['korisnik']->idKorisnika);


        $query = $conn->prepare("SELECT * FROM korpa where idproizvod = $id AND idKorisnika =  $session AND kupljeno = 0");
        $query->execute();
        $sviproizvodi = $query->fetchAll();

        if(count($sviproizvodi) >0){
            echo json_encode(["message" => "isset"]);
            die();
        }

        $query = "INSERT INTO korpa values (null ,:idproizvod ,1,:idKorisnika, false)";

       $priprema = $conn->prepare($query);

       $priprema->bindParam(":idproizvod" , $id);
        $priprema->bindParam(":idKorisnika" ,  $session);
        $priprema->execute();

        echo json_encode(["message" => "success"]);
    }

}

if(isset($_POST['updateValue'])) {
    if($_SESSION['korisnik']){
        $kolicina = $_POST['updateValue'];
        $id = $_POST['id'];
       $query = $conn->prepare("UPDATE korpa SET kolicina = $kolicina WHERE id=$id ");
       $query->execute();
        echo json_encode(["message" => "uspesno"]);

    }
}


if(isset($_POST['kupljeno'])) {
    if($_SESSION['korisnik']){
        $id = $_SESSION['korisnik']->idKorisnika;
        $queryFirst = $conn->prepare("SELECT * FROM korpa WHERE idKorisnika = $id && kupljeno = 0 ");
        $queryFirst->execute();
       // mail("vuk.zdravkovic.53.18@ict.edu.rs" , "shop" , print_r($queryFirst->fetchAll() , 1));
        $query = $conn->prepare("UPDATE korpa SET kupljeno = 1 WHERE idKorisnika = $id ");
        $query->execute();
        echo json_encode(["message" => "uspesno"]);

    }else{
        echo json_encode(["message" => "error"]);
    }
}

