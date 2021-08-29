<?php

define("BASE_URL","http://127.0.0.1/vukshop/");
define("ABSOLUTE_PATH",$_SERVER["DOCUMENT_ROOT"]."/vukshop");


define("ENV_FAJL", ABSOLUTE_PATH."/config/.env");
define("LOG_FAJL", ABSOLUTE_PATH."/data/log.txt");
define("ERROR_FAJL", ABSOLUTE_PATH."/data/error_log.txt");

define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));


function env($naziv){
    $podaci = file(ENV_FAJL);
    $vrednost = "";
    foreach($podaci as $key=>$value){
    $konfig = explode("=", $value);
    if($konfig[0]==$naziv){
    $vrednost = trim($konfig[1]);
    }
    }
    return $vrednost;
   }
   

?>