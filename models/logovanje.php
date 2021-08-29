<?php
session_start();
require_once "../config/connection.php";
header('Content-Type:application/json');
if(isset($_POST['dugmeLog'])){
    $mail=$_POST['mail'];
    $pass=$_POST['pass'];

    $regEmail="/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/";
    $regPass="/^.{4,50}$/";
    $greske=[];
        if(!preg_match($regEmail,$mail)){
            array_push($greske,"Format e-maila: vuk.zdravkovic.53.18@ict.edu.rs");
        }
        if(!preg_match($regPass,$pass) && strlen($pass)<8){
            array_push($greske,"Lozinka mora imati barem 8 karaktera");
        }


    if(count($greske)==0){

        if(isset($_SESSION['neuspesnoLogovanje']) && $_SESSION['neuspesnoLogovanje'][0] == 3){
            $date = $_SESSION['neuspesnoLogovanje'][1];
            $currentDate = strtotime($date);
            $futureDate = $currentDate+(60*1);
            $formatDate = date("Y-m-d H:i:s", $futureDate);

            if($formatDate < date('Y-m-d H:i:s')){
                $_SESSION['neuspesnoLogovanje'] = [  0 , date("H:i:s")];
            }else{
                echo json_encode(['error' => "sesija"]);
                die();
            }

        }



        $upit="SELECT * FROM korisnik k INNER JOIN uloga u ON k.iduloga=u.iduloga WHERE email=:mail AND lozinka=:pass";
        $pass=md5($pass);
        $priprema=$conn->prepare($upit);
        $priprema->bindParam(":mail",$mail);
        $priprema->bindParam(":pass",$pass);
        try{
            $priprema->execute();
            if($priprema->rowCount()==1){
                $korisnik=$priprema->fetch();
                $_SESSION['korisnik']=$korisnik;
                $kod=201;
                $data="OK";
            }
            else{
                if(isset($_SESSION['neuspesnoLogovanje'])){
                    $_SESSION['neuspesnoLogovanje'] = [  $_SESSION['neuspesnoLogovanje'][0] + 1 , date('Y-m-d H:i:s')];
                }else{
                    $_SESSION['neuspesnoLogovanje'] = [ 1 , date('Y-m-d H:i:s')];
                }
                $kod=422;
                $data = "Korisnik nije pronadjen!";
                mail($mail, "Obaveštenje", "Neko je probao da se uloguje sa Vasom e-mail adresom", "Prodavnica vukshop");
            }
        }
        catch(PDOException $e){
            $kod=500;
            $data = "Doslo je do greske sa serverom";
            zabeleziGresku($e);
        }
        
    }
}   
else{
    $kod=404;
    $poruka="Stranica nije pronadjena";
}

echo json_encode($data);
http_response_code($kod);
?>