<?php
require_once "../config/connection.php";
header('Content-Type:application/json');
if(isset($_POST['dugme'])){
    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $mail=$_POST['mail'];
    $pass=$_POST['pass'];
    $passConf=$_POST['passConf'];
    
    $regIme="/^[A-Z][a-z]{2,29}$/";
    $regPrezime="/^[A-Z][a-z]{2,49}$/";
    $regEmail="/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/";
    $regPass="/^.{4,50}$/";
    $greske=[];
    if(!preg_match($regIme,$ime)){
        array_push($greske,"Ime mora početi velikim slovom");
    }
    if(!preg_match($regPrezime,$prezime)){
        array_push($greske,"Prezime mora početi velikim slovom");
    }
    if(!preg_match($regEmail,$mail)){
        array_push($greske,"Format e-maila: vuk.zdravkovic.53.18@ict.edu.rs");
    }
    if(!preg_match($regPass,$pass) && strlen($pass)<8){
        array_push($greske,"Lozinka mora imati barem 8 karaktera");
    }
    if($passConf!=$pass){
        array_push($greske,"Lozinke se ne poklapaju");
    }
    $slika=$_FILES['slika'];
    //var_dump($slika);

    $tmpPutanja=$slika['tmp_name'];
    $naziv=time().'_'.$slika['name'];
    //echo $naziv;
    $tip=$slika['type'];
    $velicina=$slika['size'];

    $dozvoljeniFormati=['image/png','image/jpeg','image/jpg'];

    $novaSirina=400;
    $uploadDir = "../assets/uploadimg";
    $novaPutanja = $uploadDir . "/nova_" . $naziv;
    $putanja="assets/uploadimg/nova_".$naziv;
    $rezultat = move_uploaded_file($tmpPutanja, $novaPutanja);

    if(in_array($tip,$dozvoljeniFormati)){
        if($rezultat) {
            // echo "<img src='$novaPutanja' />";

            list($sirina, $visina) = getimagesize($novaPutanja);

            $procenatPromene = $novaSirina / $sirina;

            $novaVisina = $visina * $procenatPromene;

            $malaSlika = imagecreatetruecolor($novaSirina, $novaVisina);

            $izvor = "";

            if($tip == "image/jpeg") {
                $izvor = imagecreatefromjpeg($novaPutanja);
            } else {
                $izvor = imagecreatefrompng($novaPutanja);
            }

            imagecopyresized($malaSlika, $izvor, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);

            imagejpeg($malaSlika, $novaPutanja);

        } else {
            echo "Neuspesan move";
        }
        //$putanja="assets/uploadimg/$naziv";
    }
    else{
        array_push($greske, "Fotografija moze biti samo u formatu png,jpeg i jpg");
    }
    $mailProvera="SELECT email FROM korisnik WHERE email=:mail";
    $priprema=$conn->prepare($mailProvera);
    $priprema->bindParam(":mail",$mail);
    try{
        $priprema->execute();
        $rez=$priprema->fetch();
        if($priprema->rowCount()==1){
            $poruka="Već postoji korisnik sa tom e-mail adresom";
            $kod=200;
        }
        else{
            if(count($greske)==0){

                $insert="INSERT INTO korisnik VALUES(NULL,:ime,:prezime,:mail,:pass,:idUloge,:datum,:slika)";
                $pass=md5($pass);
                $datum=date("Y-m-d H:i:s");
                $uloga=1;
                $kod=md5(time().md5($mail));
                $priprema2=$conn->prepare($insert);
                $priprema2->bindParam(":ime",$ime);
                $priprema2->bindParam(":prezime",$prezime);
                $priprema2->bindParam(":mail",$mail);
                $priprema2->bindParam(":pass",$pass);
                $priprema2->bindParam(":datum",$datum);
                $priprema2->bindParam(":idUloge",$uloga);
                $priprema2->bindParam(":slika",$putanja);
                try{
                    $uspesno=$priprema2->execute();
                    $kod=201;
                    $poruka="Uspešno ste se registrovali";
                }
                catch(PDOException $e){
                    $kod=200;
                    $poruka=$e->getMessage();
                }
            }
            else{
                $poruka="Nisu ispravno popunjeni svi podaci";
                $kod=422;
            }
        }
    }
    catch(PDOException $e){
        array_push($greske, "Nema veze sa serverom");
        $kod=500;
        zabeleziGresku($e);
    }
    
}
else{
    $poruka="Stranica nije pronadjena";
    $kod=404;
}
echo json_encode($poruka);
http_response_code($kod);
?>