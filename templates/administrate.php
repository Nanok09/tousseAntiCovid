<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
  header("Location:../index.php?view=administrate");
  die("");
}
?>

<main id="acceuilAdministrate">
	<h2>Vous êtes sur l'interface d'administration du site Awalé</h2>

	<p>Vous allez pouvoir gérer l'ensemble des comptes utilisateurs, ainsi que les conversations du forum. Vous disposerez également d'un outil pour publier de nouvelles actualités sur la page d'accueil. Pour finir, vous pourrez accéder à toutes les statistiques concernant l'utilisation de votre site.</p>

	<nav>
		<ul>
			<li>Utilisateurs</li>
			<li>Conversations</li>
			<li>Statitstiques</li>
			<li>Actualités</li>
		</ul>
	</nav>
</main>