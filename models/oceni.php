<?php
session_start();
    require_once "../config/connection.php";
    if(isset($_POST['dugme'])){
        if(isset($_SESSION['korisnik'])){
            $ocena=$_POST['ocena'];
            $korisnik=$_SESSION['korisnik']->idKorisnika;
            $proizvod=$_POST['proizvod'];
            $upit="SELECT * FROM ocena WHERE idkorisnik=:id AND idproizvod=:idpr";
            $priprema=$conn->prepare($upit);
            $priprema->bindParam(":id",$korisnik);
            $priprema->bindParam(":idpr",$proizvod);
            try{
                $priprema->execute();
                $rezultat=$priprema->fetch();
                if($rezultat){
                    $update="UPDATE ocena SET ocena=:ocena WHERE idkorisnik=:id AND idproizvod=:idpr";
                    $priprema2=$conn->prepare($update);
                    $priprema2->bindParam(":ocena",$ocena);
                    $priprema2->bindParam(":id",$korisnik);
                    $priprema2->bindParam(":idpr",$proizvod);
                    try{
                        $priprema2->execute();
                        $poruka='ok';
                        $kod=200;
                    }
                    catch(PDOException $e){
                        $poruka="Greska sa serverom";
                        $kod=500;
                        zabeleziGresku($e);
                    }
                }
                else{
                    //insert
                    $insert="INSERT INTO ocena VALUES(null,:idpr,:idkor,:ocena)";
                    $priprema3=$conn->prepare($insert);
                    $priprema3->bindParam(":ocena",$ocena);
                    $priprema3->bindParam(":idkor",$korisnik);
                    $priprema3->bindParam(":idpr",$proizvod);
                    try{
                        $priprema3->execute();
                        $poruka='ok';
                        $kod=200;
                    }
                    catch(PDOException $e){
                        $poruka="Greska sa serverom";
                        $kod=500;
                        zabeleziGresku($e);
                    }
                }
            }
            catch(PDOException $e){
                $poruka="Greska sa serverom";
                $kod=500;
                zabeleziGresku($e);
            }
        }
        else{
            $poruka="Morate se ulogovati da biste ocenili proizvod";
            $kod=200;
        }
    }



echo json_encode($poruka);
http_response_code($kod);
?>