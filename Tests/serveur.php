<?php 
	include_once "libs/libUse.php";
	include_once "libs/libRequest.php";
	include_once "libs/libSecurity.php"; 
	include_once "libs/libModele.php"; 	
	
	if ($accel = valider('accel','POST')) {
		
		$date = date("d-m-Y ");
		$heure = date("H:i");
		$sql = "INSERT INTO test(accel,date) VALUES ('".$accel."','".$date.$heure."')";
		SQLInsert($sql)
	}
	
?>