<?php
require "views/fixed/head.php";
require "views/fixed/header.php";
?>
<main>
<?php
if(!isset($_GET['page'])){
    include "views/pages/pocetna.php";
}
else if(($_GET['page'])=="proizvodi"){
    include "views/pages/proizvodi.php";
}
else if(($_GET['page'])=="proizvod"){
    include "views/pages/proizvod.php";
}
else if(($_GET['page'])=="kontakt"){
    include "views/pages/kontakt.php";
}
else if(($_GET['page'])=="admin"){
    include "views/pages/admin.php";
}
else if(($_GET['page'])=="reg"){
    include "views/pages/reg.php";
}
else if(($_GET['page'])=="autor"){
    include "views/pages/autor.php";
}
else if(($_GET['page'])=="korpa"){
    include "views/pages/korpa.php";
}
else if(($_GET['page'])=="ukloniKorpa"){
    include "models/ukloniIzKorpe.php";
}
?>
</main>
<?php
require "views/fixed/footer.php";
?>