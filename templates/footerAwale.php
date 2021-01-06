<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}
?>

<footer>
	<div class="section" id="bas_1">
		<ul>
			<li>Mieux nous connaître</li>
			<li><a href="#">Notre équipe</a></li>
			<li><a href="#">Le club Awalé</a></li>
			<li><a href="#">Centrale Lille</a></li>
		</ul>

		<ul>
			<li>Gestion de projet</li>
			<li><a href="#">Notre organisation</a></li>
			<li><a href="#">Le déroulement</a></li>
			<li><a href="#">Nos sources</a></li>
		</ul>

		<ul>
			<li>Vous avez besoin d'aide</li>
			<li><a href="#">Assistance</a></li>
			<li><a href="#">Application</a></li>
			<li><a href="#">Service Client</a></li>
		</ul>

		<ul>
			<li>Nous retrouver sur les réseaux sociaux</li>
			<li><a href="#">Facebook</a></li>
			<li><a href="#">Tweeter</a></li>
			<li><a href="#">LinkedIn</a></li>
		</ul>
	</div>

	<div class="section" id="bas_2">
		<p><img src="images/logo.png"></p>
		<p><span>@2020-2021 École Centrale de Lille</p>
		<p><a href="#">Mentions légales</a></p>
		<p><a href="#">Nous écrire</a></p>
		<p><a href="#">Statistiques</a></p>
		<p><a href="#">Données et cookies</a></p>
		<p><a href="#">Version mobile</a></p>
	</div>
</footer>

</body>
</html>