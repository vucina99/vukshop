<?php
require_once "../config/connection.php";
if(isset($_POST['dugme'])){
    $slikanaziv=$_POST['naziv'];
    $slika=$_FILES['slika'];
    //var_dump($slika);
    $alt=$slikanaziv.' logo';

    $tmpPutanja=$slika['tmp_name'];
    $naziv=time().'_'.$slika['name'];
    //echo $naziv;
    $tip=$slika['type'];
    $velicina=$slika['size'];
    $upload=move_uploaded_file($tmpPutanja,"../assets/img/$naziv");
    $putanja="assets/img/$naziv";
    $upit="INSERT INTO brendovi VALUES(null,:naziv,:slikaalt,:slikasrc)";
    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":naziv",$slikanaziv);
    $priprema->bindParam(":slikaalt",$alt);
    $priprema->bindParam(":slikasrc",strtolower($naziv));
    try{
        $priprema->execute();
        $kod=200;
        $poruka="Brend je dodat";
    }
    catch(PDOException $e){
        $kod=500;
        $poruka="Nema veze sa serverom ili brend već postoji";
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