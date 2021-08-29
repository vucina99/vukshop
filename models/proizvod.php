<?php
require_once "config/connection.php";
if(isset($_GET['id'])){
    $id=$_GET['id'];
}
$proizvod="SELECT * FROM proizvod p INNER JOIN brendovi b ON p.idbrend=b.idbrend INNER JOIN cena c ON p.idproizvod=c.idproizvod INNER JOIN boja bo on p.idboja=bo.idboja WHERE p.idproizvod=:id";
$priprema=$conn->prepare($proizvod);
$priprema->bindParam(":id",$id);
try{
    $priprema->execute();
    $proizvodjedan=$priprema->fetch();
}
catch(PDOException $e){
    echo "Nema veze sa serverom";
    zabeleziGresku($e);
}


?>
