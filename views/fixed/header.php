<?php
session_start();
require "config/connection.php";

$prikaz=0;
if(isset($_SESSION['korisnik'])){
    $korisnik=$_SESSION['korisnik'];
    $uloga=$korisnik->nazivuloge;
    $imePrezime=$korisnik->ime.' '.$korisnik->prezime;
    if($uloga=='Admin'){
        $prikaz=1;
    }
}
?>

<header id="header" style="background-color:#a1a1a1">
<div id="logo">
    <a href="index.php">vukshop</a>
</div>
<nav >
    <ul>
<?php
    if($prikaz==0){
        $dohvatimeni="SELECT * FROM meni WHERE prikaz=0";
        $meni=executeQuery($dohvatimeni);
    }
    else{
        $dohvatimeni="SELECT * FROM meni ";
        $meni=executeQuery($dohvatimeni);
    }
    //var_dump($meni);
    foreach($meni as $m):
?>
    <li>
        <a href="<?=$m->putanja?>"><?=$m->naziv?></a>
    </li>

<?php
    endforeach;
?>

        <?php
        if(!isset($_SESSION['korisnik'])):
        ?>

        <li>
            <a href="index.php?page=reg">Uloguj se</a>
        </li>

        <?php
        endif
        ?>

        <?php
        if(isset($_SESSION['korisnik'])):
            ?>

        <li>


                <a href="#" id="odjava">Odjavi se ( <span><?=$imePrezime?></span>) </a>

        </li>
        <?php
        else:
            ?>
            <div></div>

        <?php
        endif;
        ?>

</ul>
</nav>
</header>
<br><br><br><br><br><br>