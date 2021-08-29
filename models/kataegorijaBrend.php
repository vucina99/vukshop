<?php
header('Content-Type:application/json');
require_once "../config/connection.php";
if(isset($_POST['kategorija'])) {
    $kat = (int) $_POST['kategorija'];
    $idMeni =  (int) $_POST['idMeni'];
    $query = $conn->prepare("SELECT * FROM proizvod INNER JOIN cena  ON proizvod.idproizvod=cena.idproizvod where idkat = $kat and idmeni = $idMeni");
    $query->execute();

    echo json_encode(["podaci" => $query->fetchAll()]);
}else if(isset($_POST['brend'])) {
    $brand = (int) $_POST['brend'];
    $idMeni =  (int) $_POST['idMeni'];
    $query = $conn->prepare("SELECT * FROM proizvod INNER JOIN cena  ON proizvod.idproizvod=cena.idproizvod where idbrend = $brand and idmeni = $idMeni");
    $query->execute();

    echo json_encode(["podaci" => $query->fetchAll()]);
}

?>