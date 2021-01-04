<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=inscription");
	die("");
}
?>

<main>
	<h2>Vous pouvez vous inscrire gratuitement en remplissant le formulaire suivant :</h2>

    <!-- on rentre dans le formulaire pour s'inscrire et renseigner ses informations personnelles -->
	<form method="POST" action="controleur.php" id="formulaire">
	    <label for='pseudo'>Votre pseudo :</label><input id="pseudo" type="text" name="pseudo" placeholder="Gold Roger" maxlength="30" /><br>
	    
	    <label for='pass1'>Votre mot de passe :</label><input id='pass1' type="password" name="pass1" /><br>

	    <label for='pass2'>Confirmez votre mot de passe :</label><input id='pass2' type="password" name="pass2" /><br>

	    <label for='email'>Votre adresse email :</label><input id='email' type="email" name="email" placeholder="martin.martin@martin.com" size="40" /><br>
		
	    Vous consentez à accepter l'utilisation de vos données dans le cadre de la RGPD :
	    <!-- par défaut on considère que l'utilisateur valide l'utilisation de ses données personnelles -->
	    <input type="checkbox" name="coche" id="coche" checked="checked"/>
	    <label for="coche">J'autorise ce site à utiliser mes données personnelles</label><br>

		<input name="action" type="submit" value="Inscription"/><br>
	</form>
</main>
