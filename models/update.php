<?php
    require_once "../config/connection.php";

    if(isset($_POST['dugmeUpdate'])){
        $id=$_POST['proizvodId'];

        $upit="SELECT * FROM proizvod p INNER JOIN cena c ON p.idproizvod=c.idproizvod WHERE p.idproizvod=:id";
        $priprema=$conn->prepare($upit);
        $priprema->bindParam(":id",$id);
        try{
            $priprema->execute();
            $proizvod=$priprema->fetch();
            $poruka=$proizvod;
            $kod=200;
        }
        catch(PDOException $e){
            $kod=500;
            zabeleziGresku($e);
            $poruka="Nema veze sa serverom";
        }
    }
    else{
        $kod=404;
        $poruka="Nemate pristup";
    }


    echo json_encode($poruka);
    http_response_code($kod);
?>