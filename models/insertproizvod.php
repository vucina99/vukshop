<?php
require_once "../config/connection.php";
if(isset($_POST['dugme'])){
    $nazivProizvoda=$_POST['naziv'];
    $cena=$_POST['cena'];
    $pol=$_POST['pol'];
    $brend=$_POST['brend'];
    $kategorija=$_POST['kategorija'];
    $boja=$_POST['boja'];
    $slika=$_FILES['slika'];
    //var_dump($slika);

    $tmpPutanja=$slika['tmp_name'];
    $naziv=time().'_'.$slika['name'];
    //echo $naziv;
    $tip=$slika['type'];
    $velicina=$slika['size'];
    $upload=move_uploaded_file($tmpPutanja,"../assets/img/$naziv");
    $putanja="$naziv";

    $upit="INSERT INTO proizvod VALUES(null,:naziv,:slikasrc,:slikaalt,:idBrend,:idMeni,:idKat,:idBoja)";
    $priprema=$conn->prepare($upit);
    $priprema->bindParam(":naziv",$nazivProizvoda);
    $priprema->bindParam(":slikasrc",$putanja);
    $priprema->bindParam(":slikaalt",$nazivProizvoda);
    $priprema->bindParam(":idBrend",$brend);
    $priprema->bindParam(":idMeni",$pol);
    $priprema->bindParam(":idKat",$kategorija);
    $priprema->bindParam(":idBoja",$boja);

    try{
        $priprema->execute();
        $datum=date("Y-m-d H:i:s");
        $ind=$conn->lastInsertId();
        $upit2="INSERT INTO cena VALUES(null,:id,:cena,:datum)";
        $priprema2=$conn->prepare($upit2);
        $priprema2->bindParam(":id",$ind);
        $priprema2->bindParam(":cena",$cena);
        $priprema2->bindParam(":datum",$datum);
        try{
            $priprema2->execute();
            $kod=200;
            $poruka="Uspešno dodat proizvod";
        }
        catch(PDOException $e){
            $kod=500;
            $poruka="Nema veze sa serverom";
            zabeleziGresku($e);
        }
    }
    catch(PDOException $e){
        $kod=500;
        $poruka="Nema veze sa serverom";
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