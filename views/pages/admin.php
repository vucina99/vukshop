<?php
if(isset($_SESSION['korisnik'])){
    if($_SESSION['korisnik']->nazivuloge=="Admin"):
        include "adminpanel.php";
    else:
        echo "<h1>NEMATE PRISTUP</h1>";
        //include error page

    endif;
}
else{
    echo "<h1>NEMATE PRISTUP</h1>";
    //include error page
}



?>