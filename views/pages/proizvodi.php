<?php
include "models/proizvodi.php";
include "models/brendovi.php";
include "models/kategorije.php";

?>
<h1><?=$kat?> odeća</h1>
<form action="">

<div id="drzac">
<div id="filter">
<p>Filteri</p><hr><br>

<p>Pretraga:</p>
<input type="search" name="inpsearch" id="inpsearch" placeholder="Pretraži">
<br><br>
    <p>Brend:</p><hr>
<?php
foreach($brendovi as $b):
?>

<p class="brendovi brendFilter" style="cursor: pointer" data-id="<?=$b->idbrend?>"><?=$b->nazivbrend?></p>

<?php
endforeach;
?>
<br>
<p>Kategorije:</p><hr>

<?php
foreach($kategorije as $k):
?>
<p class="kategorije kategorijeFilter" style="cursor: pointer"  data-id="<?=$k->idkategorije?>,<?=$k->idkategorije?>"><?=$k->nazivkat?></p>
<?php
endforeach;
?>
<br>
    <div id="sort">
        <p>Sortiraj:</p>
        <select name="ddl" id="ddl">
            <option value="ASC">Izaberi</option>
            <option value="ASC">Po ceni rastuće</option>
            <option value="DESC">Po ceni opadajuće</option>
        </select>
    </div>
    <br>
<p><a href="models/cenovnik.php">Preuzmi cenovnik </a></p>
<hr>
</form>
</div>
<div class="proizvodi prflex">


<?php
    foreach($proizvod as $p):
?>
        <div class="proizvod" >
            <input type="hidden" value="<?=$p->idmeni?>" class="proizvodMeni">
        <a href="<?="index.php?page=proizvod&id=$p->idproizvod"?>">
            <div class="proizvoddrzac">
            <img src="<?="assets/img/".$p->slikasrc?>" alt="<?=$p->slikaalt?>">
            </div>
            <div class="tekstdrzac">
            <p><?=$p->naziv?></p>
            <p><?=$p->cena." RSD"?></p>
            </div>
            </a>
        </div>

<?php
endforeach;
?>
</div>
</div>