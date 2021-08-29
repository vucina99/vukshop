<?php

if($_SESSION['korisnik']){
    $session = intval($_SESSION['korisnik']->idKorisnika);
    $q = "SELECT * FROM korpa k inner join proizvod p on k.idproizvod = p.idproizvod
       inner join cena c ON p.idproizvod=c.idproizvod
       where idKorisnika =  $session AND kupljeno = 0";
    $queryTwo = $conn->prepare($q);
    $queryTwo->execute();
    $listPorizvoda = $queryTwo->fetchAll();
}else{
    header("Location: index.php?page=reg");

}


?>
<div style="min-height: 70vh">
<table width="100%">

    <tr>
        <th>Slika</th>
        <th>Naziv</th>
        <th>Kolicina</th>
        <th>Akcija</th>
    </tr>
    <?php foreach ($listPorizvoda as $p): ?>

    <tr>
        <td>  <img src="<?="assets/img/".$p->slikasrc?>" style="width:30%" alt="<?=$p->slikaalt?>">
        </td>
        <td><?= $p->naziv ?></td>
        <td><input type="text" class="<?= $p->id ?>"  id="kolicina" value="<?= $p->kolicina ?>"></td>
        <td><a href="index.php?page=ukloniKorpa&id=<?= $p->id ?>" class="ukloni">Ukloni </a></td>
    </tr>

        <?php var_dump($p->id) ?>
    <?php endforeach ?>
    <?php if(count($listPorizvoda) == 0): ?>
        <td colspan="4">
                <p align="center">Korpa je prazna, pronadjite proizvod</p>
        </td>
    <?php endif ?>
    <tr>
        <td colspan="4" class="bnesto">
            <?php if(count($listPorizvoda) > 0): ?>
            <input type="button" id="kupi" value="Potvrdi kopovinu" class="kupi">
            <?php endif ?>
        </td>
    </tr>
</table>
</div>