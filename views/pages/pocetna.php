<?php
    require "models/pocetna.php";
?>
<div  style="min-height:65vh"><br>
<h2>SAMO KOD NAS</h2>
<hr><br><br>
<div class="tekst">
<?php
        foreach($text2 as $ind=>$t):
    ?>

        <div class="blok drugi">
                <i class="fas <?=$t['ico']?>"></i>
                <h3><?=$t['naslov']?></h3>
                <p><?=$t['tekst']?></p>

        </div>

    <?php
        endforeach;
    ?>
</div>
</div>