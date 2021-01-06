<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=inscription");
	die("");
}

if ($info = valider('info'))
{
	$popup = true;
	if($info == 1)
	{
		$msg = "Le médecin renseigné n'est pas enregistré";
	}else if($info == 2)
	{
		$msg = 'Les mots de passe ne correspondent pas';
	}else if($info == 3)
	{
		$msg = 'Vos informations ne sont pas complètes !';
	}else if($info == 4)
	{
		$msg = 'Vous avez déjà un compte !';
	}
}

?> 

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<main>
	<h2>Vous pouvez vous inscrire gratuitement en remplissant le formulaire suivant :</h2>

    <!-- on rentre dans le formulaire pour s'inscrire et renseigner ses informations personnelles -->
	<form method="POST" action="controleur.php" id="formulaire">
		<label for='nom'>Votre nom :</label><input id='nom' type="text" name="nom" maxlength="40" <?php if (isset($_COOKIE['nom'])) {echo "value=\"".$_COOKIE['nom']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";} ?>/><br>
		
		<label for='prenom'>Votre prénom :</label><input id='prenom' type="text" name="prenom" maxlength="40" <?php if (isset($_COOKIE['prenom'])) {echo "value=\"".$_COOKIE['prenom']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";}?>/><br>
		
	    <label for='mail'>Votre adresse mail :</label><input id="mail" type="text" name="mail" maxlength="40" <?php if (isset($_COOKIE['mail'])) {echo "value=\"".$_COOKIE['mail']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";}?>/><br>
		
		<label for='tel'>Votre numéro de téléphone :</label><input id='tel' type="text" name="tel" <?php if (isset($_COOKIE['tel'])) {echo "value=\"".$_COOKIE['tel']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";}?>/><br>
	    
	    <label for='passe1'>Votre mot de passe :</label><input id='passe1' type="password" name="passe1" /><br>

	    <label for='passe2'>Confirmez votre mot de passe :</label><input id='passe2' type="password" name="passe2" /><br>
		
		Informations complémentaires : </br>
		
		<label for='naissance'>Votre date de naissance :</label><input id='naissance' type="date" name="naissance" <?php if (isset($_COOKIE['naissance'])) {echo "value=\"".$_COOKIE['naissance']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";}?>/><br>
		
		<label for='secu'>Votre numéro de sécurité sociale :</label><input id='secu' type="text" name="secu" <?php if (isset($_COOKIE['secu'])) {echo "value=\"".$_COOKIE['secu']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";}?>/><br>
		
		<label for='adresse'>Votre adresse postale :</label><input id='adresse' type="text" name="adresse" <?php if (isset($_COOKIE['adresse'])) {echo "value=\"".$_COOKIE['adresse']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";}?>/> 
		<label for='code_postal'>Votre code postal :</label><input id='code_postal' type="text" name="code_postal" <?php if (isset($_COOKIE['code_postal'])) {echo "value=\"".$_COOKIE['code_postal']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";}?>/><br>
		
		<label for='sexe' >Votre sexe :</label>  <input type="checkbox" id="homme" name="sexe" value="M" <?php if (isset($_COOKIE['sexe']) AND $_COOKIE['sexe']==="M") echo "checked"; ?>> <label for="homme">Homme</label>
												 <input type="checkbox" id="femme" name="sexe" value="F" <?php if (isset($_COOKIE['sexe']) AND $_COOKIE['sexe']==="F") echo "checked"; ?>> <label for="femme">Femme</label>
												 <input type="checkbox" id="neutre" name="sexe" value="N" <?php if (isset($_COOKIE['sexe']) AND $_COOKIE['sexe']==="N") echo "checked"; ?>> <label for="neutre">Autre</label>
		</br></br>
		
		Votre Médecin traitant : </br>
		
		<label for='nom_medecin'> Nom :</label><input id='nom_medecin' type="text" name="nom_medecin" maxlength="40" />
		
		<label for='prenom_medecin'>Prénom :</label><input id='prenom_medecin' type="text" name="prenom_medecin" maxlength="40" /></br>
		
	    Vous consentez à accepter l'utilisation de vos données dans le cadre de la RGPD : </br>
	    <!-- par défaut on considère que l'utilisateur valide l'utilisation de ses données personnelles -->
	    <input type="checkbox" name="coche" id="coche" checked="checked"/>
	    <label for="coche">J'autorise ce site à utiliser mes données personnelles</label><br>

		<input name="action" type="submit" value="Inscription"/><br>
	</form>
	
	
	
	<!-- Popup d'erreur de l'utilisateur -->
	
	<div class="hover_bkgr_fricc">
    <span class="helper"></span>
		<div>
			<div class="popupCloseButton">&times;</div>
			<p><?php echo $msg; ?></p>
		</div>
	</div>
	
	<style>
		/* Popup box BEGIN */
		.hover_bkgr_fricc{
			background:rgba(0,0,0,.4);
			cursor:pointer;
			display:none;
			height:100%;
			position:fixed;
			text-align:center;
			top:0;
			width:100%;
			z-index:10000;
		}
		.hover_bkgr_fricc .helper{
			display:inline-block;
			height:100%;
			vertical-align:middle;
		}
		.hover_bkgr_fricc > div {
			background-color: #fff;
			box-shadow: 10px 10px 60px #555;
			display: inline-block;
			height: auto;
			max-width: 551px;
			min-height: 100px;
			vertical-align: middle;
			width: 60%;
			position: relative;
			border-radius: 8px;
			padding: 15px 5%;
		}
		.popupCloseButton {
			background-color: #fff;
			border: 3px solid #999;
			border-radius: 50px;
			cursor: pointer;
			display: inline-block;
			font-family: arial;
			font-weight: bold;
			position: absolute;
			top: -20px;
			right: -20px;
			font-size: 25px;
			line-height: 30px;
			width: 30px;
			height: 30px;
			text-align: center;
		}
		.popupCloseButton:hover {
			background-color: #ccc;
		}
		.trigger_popup_fricc {
			cursor: pointer;
			font-size: 20px;
			margin: 20px;
			display: inline-block;
			font-weight: bold;
		}
		/* Popup box BEGIN */
	</style>
	
	<script>
	
		$(window).on('load',function () {
			
			if (<?php echo $info; ?>) {
				$('.hover_bkgr_fricc').show();
			}
			$('.hover_bkgr_fricc').click(function(){
				$('.hover_bkgr_fricc').hide();
			});
			$('.popupCloseButton').click(function(){
				$('.hover_bkgr_fricc').hide();
			});
		});
	</script>
	
</main>
