<?php 

include_once "libs/libUse.php";
include_once "libs/libRequest.php";
include_once "libs/libSecurity.php"; 
include_once "libs/libModele.php";

if ($nom=valider("nom", "POST")) {
	$SQL = "INSERT INTO test(nom) VALUES('".$nom."')";
	SQLInsert($SQL);
}

?>