<?php
require_once "config.php";
zabeleziPristupStranici();
try {
 $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8",
 USERNAME, PASSWORD);
 $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
 echo $ex->getMessage();
 zabeleziGresku($ex -> getMessage());
}
function executeQuery($query){
 global $conn;
 return $conn->query($query)->fetchAll();
}
function executeQueryOneRow($query){
 global $conn;
 return $conn->query($query)->fetch();
}
function zabeleziPristupStranici(){
 $open = fopen(LOG_FAJL, "a");
 if($open){
 $date = date('Y-m-d H:i:s');
 fwrite($open, "{$_SERVER['REQUEST_URI']}\t{$date}\t{$_SERVER['REMOTE_ADDR']}\t\n");
 fclose($open);
 }
}
function zabeleziGresku($greska){
 $open = fopen(ERROR_FAJL, "a");
 if($open){
 $date = date('Y-m-d H:i:s');
 fwrite($open, "{$_SERVER['PHP_SELF']}\t{$date}\t{$greska}\t\n");
 fclose($open);
 }
}
?>
