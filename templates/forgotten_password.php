<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=forgotten_password");
    die("");
}
?>

<main>
	<h2>Vous avez oublié votre mot de passe pour accéder à votre compte Awale</h2>

	<p>Remplissez les champs suivant pour procéder à la réinitialisation de votre mot de passe :</p>
    
    <!-- on rentre dans le formulaire pour se connecter avec ses identifiants -->
	<form method="POST" action="controleur.php" id="formulaire">
	    <label for='pseudo'>Votre pseudo : </label><input id='pseudo' type="text" name="pseudo" <?php if (isset($_COOKIE['pseudo'])) echo "value=\"".$_COOKIE['pseudo']."\""; ?> />
	    <br>

	    <label for='email'>Votre adresse email : </label><input id='email' type="email" name="email"/>
	    <br>

		<input type="submit" name="action" value="Réinitisaliser"/>
	</form>
</main>