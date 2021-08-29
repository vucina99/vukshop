
<div id="logreg">
    <div class="reg prva">
        <h1>Registruj se   </h1>
        <a href="#"  style="margin-left:35%" class="prikaziprvi"  >Vec imate nalog?</a>

        <form enctype="multipart/form-data">
            <p>Ime:</p>
            <input type="text" name="ime" id="ime">
            <p id='greskaime'></p>
            <p>Prezime:</p>
            <input type="text" name="prezime" id="prezime">
            <p id='greskaprezime'></p>
            <p>E-mail:</p>
            <input type="text" name="mail" id="mail">
            <p id='greskamail'></p>
            <p>Lozinka:</p>
            <input type="password" name="pass" id="pass">
            <p id='greskapass'></p>
            <p>Potvrdi lozinku:</p>
            <input type="password" name="passConf" id="passConf">
            <p id='greskapassconf'></p>
            <p>Profilna fotografija:</p>
            <input type="file" name="file" id="file"><br><br>
            <p id='greskaslika'></p>
            <input type="button" id="btnPotvrdiReg" value="Potvrdi">
            <p id="regUspeh"></p>

        </form><br><br><br>
    </div>


    <div class="reg druga">
        <br><br><br>
        <h1>Uloguj se</h1>
        <a href="#"  style="margin-left:35%" class="prikazidrugi"   >Nemate nalog?</a>

        <form>
            <p>E-mail:</p>
            <input type="text" name="mailLog" id="mailLog">
            <p>Lozinka:</p>
            <input type="password" name="passLog" id="passLog"><br><br>
            <input type="button" value="Potvrdi" id="btnLog">
            <p id="greskaporukaLog"></p>
        </form><br><br><br><br><br><br><br><br><br>
    </div>

</div>