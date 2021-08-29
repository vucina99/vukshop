<?php
if(isset($_GET['id']) && $_SESSION['korisnik']){
    $id = $_GET['id'];
    $sess =  $_SESSION['korisnik']->idKorisnika;
    $query = $conn->prepare("DELETE FROM korpa where id= $id AND idKorisnika = $sess");
    $query->execute();

    header("Location: index.php?page=korpa");

}
else{
    header("Location: index.php?page=reg");

}