$(document).ready(function(){
    $("#inpsearch").keyup(filter)
    $("#ddl").change(filter);
    $("#uspesno").hide();
    $("#postoji").hide();
    $(".prva").hide();
})
$("#sort").change(function(){
    var ddl=this.val()//2

    $.ajax({
        url:"obrada.php",
        method:"post",
        data:{
            "izabrano":ddl,
            "dugme":true
        }
    })
})

$(".prikaziprvi").click(function (){
    $(".druga").show();
    $(".prva").hide();
})
$(".prikazidrugi").click(function (){


    $(".prva").show();
    $(".druga").hide();

})
function filter(data){
    var kat=location.href.split("=")[2]
    var order=document.getElementById("ddl").value
    console.log(order)
    if(kat.indexOf("M")!=-1){
        kat="M"
    }
    else{
        kat="Z"
    }
    var val=document.getElementById('inpsearch').value
    $.ajax({
        url:"models/search.php",
        method:"post",
        dataType:"json",
        data:{
            search:val,
            kategorija:kat,
            sort:order,
            dugme:true
        },
        success:function(data){
            ispisfilter(data)
        },
        error:function(err){
            console.log(err)
        }
    })
}
window.setIdMan = "num"; //define a global variable

$(".kategorijeFilter").click(function (){
    let val = $(this).attr("data-id")
    if(window.setIdMan  == "num"){
        window.setIdMan  = $(".proizvodMeni").val();
    }

    $.ajax({
        url:"models/kataegorijaBrend.php",
        method:"post",
        dataType: "json",
        data: {kategorija: val , idMeni : window.setIdMan  },
        success:function(data){
            ispisfilter(data.podaci);
        },
        error:function(){
            console.log("nije ok")
        }
    })

})

$(".brendFilter").click(function (){
    let val = $(this).attr("data-id")
    if(window.setIdMan  == "num"){
        window.setIdMan  = $(".proizvodMeni").val();
    }

    $.ajax({
        url:"models/kataegorijaBrend.php",
        method:"post",
        dataType: "json",
        data: {brend: val , idMeni : window.setIdMan  },
        success:function(data){
            ispisfilter(data.podaci);
        },
        error:function(){
            console.log("nije ok")
        }
    })

})

function ispisfilter(data){
    var ispis=''
    for(let d in data){
        console.log(data)
        ispis+=`<div class="proizvod">
        <a href="index.php?page=proizvod&id=${data[d].idproizvod}">
            <div class="proizvoddrzac">
            <img src="assets/img/${data[d].slikasrc}" alt="${data[d].slikaalt}">
            </div>
            <div class="tekstdrzac">
            <p>${data[d].naziv}</p>
            <p>${data[d].cena} RSD</p>
            </div>
            </a>
        </div>`
    }
    var div=$(".proizvodi")[0]
    if(data.length=='0'){
        div.innerHTML="<h2>Trenutno nema proizvoda</h2>"
    }
    else{
        div.innerHTML=ispis;
    }
}


$("#btnPotvrdiReg").click(function(){
    var ime=document.getElementById("ime").value;
    var prezime=document.getElementById("prezime").value;
    var mail=document.getElementById("mail").value;
    var pass=document.getElementById("pass").value;
    var passConf=document.getElementById("passConf").value;

    var regIme=/^[A-Z][a-z]{2,29}$/;
    var regPrezime=/^[A-Z][a-z]{2,49}$/;
    var regEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    var regPass=/^.{8,50}$/;

    var fajl=document.getElementById("file").files[0]
    //console.log(fajl)

    var podaciZaSlanje= new FormData();
    podaciZaSlanje.append("slika",fajl)
    podaciZaSlanje.append("dugme",true)

    var greske=0;
    if(!regIme.test(ime)){
        $("#greskaime").html("Ime mora početi velikim slovom");
        greske++;
        
    }
    else{
        $("#greskaime").html("");
        podaciZaSlanje.append("ime",ime)
    }
    if(!regPrezime.test(prezime)){
        $("#greskaprezime").html("Prezime mora početi velikim slovom");
        greske++;
    }
    else{
        $("#greskaprezime").html("");
        podaciZaSlanje.append("prezime",prezime)
    }
    if(!regEmail.test(mail)){
        $("#greskamail").html("Format e-maila: vuk.zdravkovic.53.18@ict.edu.rs");
        greske++;
    }
    else{
        $("#greskamail").html("");
        podaciZaSlanje.append("mail",mail)
    }
    if(!regPass.test(pass)){
        $("#greskapass").html("Lozinka mora imati barem 8 karaktera");
        greske++;
    }
    else{
        $("#greskapass").html("");
        podaciZaSlanje.append("pass",pass)
    }
    if(passConf!=pass){
        $("#greskapassconf").html("Lozinke se ne poklapaju");
        greske++;
    }
    else{
        $("#greskapassconf").html("");
        podaciZaSlanje.append("passConf",passConf)
    }
    if(fajl==undefined){
        $("#greskaslika").html("Morata izabrati fotografiju");
        greske++
    }
    else{
        $("#greskaslika").html("");
        podaciZaSlanje.append("slika",fajl)
    }
    if(greske==0){
        $.ajax({
            url:"models/registracija.php",
            method:"post",
            processData:false,
            contentType:false,
            data:podaciZaSlanje,
            success:function(data){
                $("#regUspeh").html(data)
            },
            error:function(){
                console.log("nije ok")
            }
        })
    }
})

$("#btnLog").click(function(){
    var mail=$("#mailLog").val()
    var pass=$("#passLog").val()

    var regEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    var regPass=/^.{8,50}$/;

    if(!regEmail.test(mail)){
        document.getElementById("greskaporukaLog").innerHTML="E-mail nije u dobrom formatu"
        return false
    }
    else{
        document.getElementById("greskaporukaLog").innerHTML=""
    }
    if(!regPass.test(pass)){
        document.getElementById("greskaporukaLog").innerHTML="Lozinka nije u dobrom formatu"
        return false
    }
    else{
        document.getElementById("greskaporukaLog").innerHTML=""
    }
    $.ajax({
        url:'models/logovanje.php',
        method:"POST",
        dataType:"json",
        data:{
            "mail":mail,
            "pass":pass,
            "dugmeLog":true
        },
        success:function(data){
            if(data.error == "sesija"){
                alert("Molimo vas probajte kasnije");
            }else{
                console.log("usao");
                document.getElementById("greskaporukaLog").innerHTML=data;
                window.location="index.php";
            }

        },
        error:function(xhr){
            if(xhr.status=='422'){
                document.getElementById("greskaporukaLog").innerHTML="Korisnik nije pronadjen";
            }
            console.log(xhr)
        }
    })
})

$("#odjava").click(function(){
    $.ajax({
        url:'models/odjava.php',
        method:"POST",
        dataType:"json",
        data:{
            "dugmeLog":true
        },
        success:function(data){
            window.location="index.php?page=reg";
        },
        error:function(xhr){
            console.log(xhr)
        }
    })
})

$("#navigacija a").click(function(e){
    e.preventDefault()
    var radnja=this.dataset.name
    var obrada='models/'+radnja+".php"
    if(radnja=="dodajBrend"){
        dodajBrend()
    }
    if(radnja=="dodajBoju"){
        dodajBoju()
    }
    if(radnja=="dodajKategoriju"){
        dodajKategoriju()
    }
    if(radnja!=undefined && radnja!='dodajBrend' && radnja!='dodajBoju' && radnja!='dodajKategoriju'){
        $.ajax({
            url:obrada,
            method:"POST",
            dataType:"json",
            data:{
                "dugme":true
            },
            success:function(data){
                if(radnja=='korisnici'){
                    ispisKorisnika(data)
                }
                if(radnja=='poruke'){
                    prikazPoruka(data)
                }
                if(radnja=='pristup'){
                    prikazPristup(data)
                }
                if(radnja=='prikazi'){
                    var pr=''
                    for(let d in data){
                        console.log(data)
                        pr+=`<div class="proizvod">
                        <a href="index.php?page=proizvod&id=${data[d].idproizvod}">
                            <div class="proizvoddrzac">
                            <img src="assets/img/${data[d].slikasrc}" alt="${data[d].slikaalt}">
                            </div>
                            <div class="tekstdrzac">
                            <p>${data[d].naziv}</p>
                            <p>${data[d].cena} RSD</p>
                            </div>
                            </a>
                            <p>
                            <a class="delete" href="#" data-id='${data[d].idproizvod}'>Izbriši </a>
                            </p>
                            <p>
                            <a class="update" href="#" data-id='${data[d].idproizvod}'>Izmeni </a>
                            </p>
                        </div>`
                    }
                    $("#naslov").html("Proizvodi")
                    $("#drzacadmin").html(pr)

                    $(".delete").click(izbrisi)
                    $(".update").click(update)
                }
                if(radnja=='dodajproizvod'){
                    formaInsert(data);
                }
            },
            error:function(xhr){
                console.log(xhr)
            }
        })
    }
})

function ispisKorisnika(data){
    var ispis=''
    ispis+="<h1>Korisnici</h1>"
    ispis+="<table cellspacing='0'><thead><tr><th>Ime</th><th>Prezime</th><th>E-mail</th></tr></thead><tbody>"
    data.forEach(el => {
        ispis+=`<tr><td>${el.ime}</td><td>${el.prezime}</td><td>${el.email}</td></tr>`
    });

    ispis+="</tbody></table>"
    $("#drzacadmin").html(ispis)
}

function izbrisi(e){
    e.preventDefault()
    var id=this.dataset.id
    $.ajax({
        url:'models/obrisi.php',
        method:"POST",
        dataType:"json",
        data:{
            "proizvodId":id,
            "dugmeDelete":true
        },
        success:function(data){
            location.reload();
        },
        error:function(xhr){
            console.log(xhr)
        }
    })
}

function update(e){
    e.preventDefault()
    var id=this.dataset.id

    $.ajax({
        url:'models/update.php',
        method:"POST",
        dataType:"json",
        data:{
            "proizvodId":id,
            "dugmeUpdate":true
        },
        success:function(data){
            var ispis=''
            ispis+=`<form><div id="formaupdate">
                <img src='assets/img/${data.slikasrc}' alt="${data.slikaalt}">
                <p>${data.naziv}</p>
                <input type="text" placeholder="cena" id="cena" value="${data.cena}">
                <input type="hidden" value="${data.idproizvod}" id="hidden"><br><br>
                <p id="greskaPoruka"><p>
                <input type="button" value="Izmeni" id="btnUpdate">

            </form></div>`
            $("#drzacadmin").html(ispis)
            $("#btnUpdate").click(izmeni)
        },
        error:function(xhr){
            console.log(xhr)
        }
    })

}

function izmeni(){
    var cena=$("#cena").val()
    var id=$("#hidden").val()
    console.log(id)
    $.ajax({
        url:'models/izmeni.php',
        method:"POST",
        dataType:"json",
        data:{
            "cena":cena,
            "id":id,
            "dugmeIzmeni":true
        },
        success:function(data){
            $("#greskaPoruka").html(data)
        },
        error:function(xhr){
            console.log(xhr)
        }
    })
}

function formaInsert(data){
    var brend=data.brendovi
    var boja=data.boja
    var kat=data.kategorija
    console.log(data.brendovi)
    var ispis=`<form enctype="multipart/form-data">
        <p>Naziv proizvoda:</p>
        <input type="text" id="nazivProizvoda">
        <p>Cena:</p>
        <input type="text" id="cenaProizvoda">
        <p>Pol:</p>
        <input type="radio" name="pol" value="3"><span>Muški</span>
        <input type="radio" name="pol" value="4"><span>Ženski</span>
        <br><br>
        <input type="file" id="slikaProizvoda"><br><br>
        <p>Brend:<p>
        <select id='ddlBrend'><option value='0'>Izaberi</option>`
        brend.forEach(el=>{
            ispis+=`<option value='${el.idbrend}'>${el.nazivbrend}</option>`
        })
    ispis+=`</select><br><br>
    <p>Kategorija:<p>
        <select id="ddlKategorija"><option value='0'>Izaberi</option>`
        kat.forEach(el=>{
            ispis+=`<option value='${el.idkategorije}'>${el.nazivkat}</option>`
        })
    ispis+=`</select><br><br>
    <p>Boja:</p><select id='ddlBoja'><option value='0'>Izaberi</option>`
        boja.forEach(el=>{
            ispis+=`<option value='${el.idboja}'>${el.vrednost}</option>`
        })
    ispis+=`</select><br><br>
    <p id='greskainsert'><p>
    <input type="button" value="Dodaj" id="btnDodajProizvod"><br>
    </form>`

    $("#drzacadmin").html(ispis)
    $("#btnDodajProizvod").click(dodajProizvod)
}

function dodajBrend(){
    var ispis=`<form enctype="multipart/form-data">
        <p>Naziv brenda:</p>
        <input type="text" id="brendNaziv">
        <p>Fotografija:</p>
        <input type="file" id="slikabrendInsert"><br><br>
        <input type="button" value="Dodaj" id="btnDodajBrend">
        <p id="greskaBrend"></p>
    </form>`
    $("#drzacadmin").html(ispis)
    $("#btnDodajBrend").click(function(){
        var fajl=document.getElementById("slikabrendInsert").files[0]
    //console.log(fajl)
    var naziv=$("#brendNaziv").val()
    console.log(naziv)
    var podaciZaSlanje= new FormData();
    podaciZaSlanje.append("slika",fajl)
    podaciZaSlanje.append("dugme",true)
    podaciZaSlanje.append("naziv",naziv)
    $.ajax({
        url:'models/dodajbrend.php',
        method:"POST",
        processData:false,
        contentType:false,
        dataType:"json",
        data:podaciZaSlanje,
        success:function(data){
            $("#greskaBrend").html(data)
            location.reload();
        },
        error:function(xhr){
            console.log(xhr)
        }
    })
    })
}


function DodajUKorpu(id){

    $.ajax({
        method : "post",
        url: "models/dodajKorpu.php",
        dataType: "json",
        data:{
            "idProizvoda":id,
        },
        success:function(data){
            if(data.message == "success"){
                $("#uspesno").show();
                setTimeout(function(){ $("#uspesno").hide(); }, 1000);
            }
            else if(data.message == "isset"){
                $("#postoji").show();
                setTimeout(function(){ $("#postoji").hide(); }, 1000);
            }
            else{
                window.location = 'index.php?page=reg';

            }



        },
        error:function(status, xhr, error){
            console.log(status)
        }
    })


}




function dodajBoju(){
    var ispis=`<form>
        <p>Dodaj boju:</p>
        <input type="text" id="boja"><br><br>
        <input type="button" id="btnDodajBoju" value="Dodaj">
        <p id="greskaBoja"></p>
    </form>`
    $("#drzacadmin").html(ispis)

    $("#btnDodajBoju").click(function(){
        var boja=$("#boja").val()
        $.ajax({
            url:'models/dodajboju.php',
            method:"POST",
            dataType:"json",
            data:{
                "dugme":true,
                "boja":boja
            },
            success:function(data){
                $("#greskaBoja").html(data)
                location.reload()
            },
            error:function(xhr){
                console.log(xhr)
            }
        })
    })
}


function dodajKategoriju(){
    var ispis=`<form>
        <p>Dodaj kategoriju:</p>
        <input type="text" id="kat"><br><br>
        <input type="button" id="btnDodajKat" value="Dodaj">
        <p id="greskaKat"></p>
    </form>`
    $("#drzacadmin").html(ispis)

    $("#btnDodajKat").click(function(){
        var kat=$("#kat").val()
        $.ajax({
            url:'models/dodajkat.php',
            method:"POST",
            dataType:"json",
            data:{
                "dugme":true,
                "kat":kat
            },
            success:function(data){
                $("#greskaKat").html(data)
                location.reload()
            },
            error:function(xhr){
                console.log(xhr)
            }
        })
    })
}

function dodajProizvod(){
    var naziv=$("#nazivProizvoda").val()
    var cena=$("#cenaProizvoda").val()
    var pol=$('input[name="pol"]:checked').val()
    var fajl=document.getElementById("slikaProizvoda").files[0]
    var brend=$("#ddlBrend").val()
    var kateogrija=$("#ddlKategorija").val()
    var boja=$("#ddlBoja").val()

    var podaciZaSlanje= new FormData();
    podaciZaSlanje.append("slika",fajl)
    podaciZaSlanje.append("naziv",naziv)
    podaciZaSlanje.append("cena",cena)
    podaciZaSlanje.append("pol",pol)
    podaciZaSlanje.append("brend",brend)
    podaciZaSlanje.append("kategorija",kateogrija)
    podaciZaSlanje.append("boja",boja)
    podaciZaSlanje.append("dugme",true)


    $.ajax({
        url:"models/insertproizvod.php",
        method:"post",
        processData:false,
        contentType:false,
        data:podaciZaSlanje,
        success:function(data){
            $("#greskaBrend").html(data)
            location.reload()
        },
        error:function(){
            console.log("nije ok")
        }
    })
}

$("#kolicina").blur(function (){

    let val = $(this).val();
    let id =  $(this).attr("class")
    console.log(id);
    $.ajax({
        method: "post",
        url : "models/dodajKorpu.php",
        dataType: "json",
        data : {updateValue : val , id: id},
        success : function (data){
            console.log(data.message)
        },
        error : function (error){
            console.log(error);
        }

    })
});

$("#kupi").click(function (){


    $.ajax({
        method: "post",
        url : "models/dodajKorpu.php",
        dataType: "json",
        data : {kupljeno : "kupljeno"},
        success : function (data){
            if(data.message == "uspesno"){
                alert("Uspesno ste kupili proizvode");
                window.location = "index.php";
            }
        },
        error : function (error){
            console.log(error);
        }

    })
});

$(".fa-star").click(function(){
    var ocena=this.dataset.id
    var proizvod=this.dataset.proizvod
    $.ajax({
        url:"models/oceni.php",
        method:"post",
        dataType:"json",
        data:{
            "proizvod":proizvod,
            "ocena":ocena,
            "dugme":true
        },
        success:function(data){
            console.log(data.length)
            if(data=='ok'){
                location.reload();
            }
            else{
                $("#greskaOcena").html(data)
            }
        },
        error:function(){
            console.log("nije ok")
        }
    })
})

$("#posaljiPoruku").click(function(){
    var mail=$("#mailPor").val();
    var naslov=$("#tekstPoru").val()
    var poruka=$("#por").val()
    var regEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    var regNaslov=/^[\w\s]+$/;
    var greska=0;
    if(!regEmail.test(mail)){
        $("#greskePor").html("E-mail nije u dobrom formatu");
        greska++;
    }
    else{
        $("#greskePor").html()
    }
    if(!regNaslov.test(naslov)){
        $("#greskePor").html("Naslov nije u dobrom formatu");
        greska++;
    }
    else{
        $("#greskePor").html()
    }
    poruka=poruka.split(" ")
    console.log(poruka)
    if(poruka.length<2){
        $("#greskePor").html("Poruka mora imati barem 3 reci");
        greska++;
    }
    if(greska==0){
        $.ajax({
            url:'models/unesiPoruku.php',
            method:"POST",
            dataType:"json",
            data:{
                "mail":mail,
                "poruka":poruka,
                "naslov":naslov,
                "unesiPitanje":true
            },
            success:function(data){
                location.reload()
                $("#greskePor").html(data);

            },
            error:function(xhr){
                if(xhr.status == 500) {
                    $("#greskePor").html("Nema veze sa serverom,pokušajte kasnije")
                }
            }
        })
    }
})

function prikazPoruka(data){
    var ispis=''
    ispis+="<h1>Poruke</h1>"
    ispis+="<table cellspacing='0'><thead><tr><th>Naslov</th><th>E-mail</th><th>Poruka</th></tr></thead><tbody>"
    data.forEach(el => {
        ispis+=`<tr><td>${el.naslov}</td><td>${el.email}</td><td>${el.tekst}</td></tr>`
    });

    ispis+="</tbody></table>"
    $("#drzacadmin").html(ispis)
}

function prikazPristup(data){
    let ispis="<table cellspacing='0'><thead><tr>"
    for(let d in data){
        ispis+=`<th>${d}</th>`
    }
    ispis+=`</tr></thead><tbody><tr>`
    for(let d in data){
        ispis+=`<td>${data[d]}</td>`
    }
    ispis+="</tr></tbody></table>"
    $("#drzacadmin").html(ispis)
}