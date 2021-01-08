<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}




  $query = "SELECT * FROM `test`";

  
  $PDO = SQLSelect($query);
  $data = parcoursRs($PDO);


?>


<div class="container">
	<br>
	<br>
	<div class="row">
		<div class="col">
			<h3>
				Bonjour, voici la page statistiques. Ici, vous pouvez accéder aux différentes visualisations des données obtenues par le vetement connecté.
			</h3>
		</div>
	</div>
	<div class="row">
		
	</div>
</div>