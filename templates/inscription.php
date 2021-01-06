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
		<label for='nom'>Votre nom :</label><input id='nom' type="text" name="nom" maxlength="40"/><br>
		
		<label for='prenom'>Votre prénom :</label><input id='prenom' type="text" name="prenom" maxlength="40"/><br>
		
	    <label for='mail'>Votre adresse mail :</label><input id="mail" type="text" name="mail" maxlength="40" /><br>
		
		<label for='tel'>Votre numéro de téléphone :</label><input id='tel' type="text" name="tel" /><br>
	    
	    <label for='passe1'>Votre mot de passe :</label><input id='passe1' type="password" name="passe1" /><br>

	    <label for='passe2'>Confirmez votre mot de passe :</label><input id='passe2' type="password" name="passe2" /><br>
		
		Informations complémentaires : </br>
		
		<label for='naissance'>Votre date de naissance :</label><input id='naissance' type="text" name="naissance" /><br>
		
		<label for='secu'>Votre numéro de sécurité sociale :</label><input id='secu' type="text" name="secu" /><br>
		
		<label for='adresse'>Votre adresse postale :</label><input id='adresse' type="text" name="adresse" /> <label for='code_postal'>Votre code postal :</label><input id='code_postal' type="text" name="code_postal" /><br>
		
		<label for='sexe'>Votre sexe :</label>  <input type="checkbox" id="homme" name="sexe" value="M"> <label for="homme">Homme</label>
												<input type="checkbox" id="femme" name="sexe" value="F"> <label for="femme">Femme</label>
												<input type="checkbox" id="neutre" name="sexe" value="N"> <label for="neutre">Autre</label>
		</br></br>
		
		Votre Médecin traitant : </br>
		
		<label for='nom_medecin'> Nom :</label><input id='nom_medecin' type="text" name="nom_medecin" maxlength="40"/>
		
		<label for='prenom_medecin'>Prénom :</label><input id='prenom_medecin' type="text" name="prenom_medecin" maxlength="40"/></br>
		
	    Vous consentez à accepter l'utilisation de vos données dans le cadre de la RGPD : </br>
	    <!-- par défaut on considère que l'utilisateur valide l'utilisation de ses données personnelles -->
	    <input type="checkbox" name="coche" id="coche" checked="checked"/>
	    <label for="coche">J'autorise ce site à utiliser mes données personnelles</label><br>

		<input name="action" type="submit" value="Inscription"/><br>
	</form>
</main>
