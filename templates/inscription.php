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
		
		<label for='nom_medecin'> Nom :</label><input id='nom_medecin' type="text" name="nom_medecin" maxlength="40" <?php if (isset($_COOKIE['nom_medecin'])) {echo "value=\"".$_COOKIE['nom_medecin']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";}?>/>
		
		<label for='prenom_medecin'>Prénom :</label><input id='prenom_medecin' type="text" name="prenom_medecin" maxlength="40" <?php if (isset($_COOKIE['prenom_medecin'])) {echo "value=\"".$_COOKIE['prenom_medecin']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";}?>/>
		</br>
		</br>
		
		Vos données médicales : </br>
		
		<label for='poids'> Votre poids (en kg) : </label><input id='poids' type='text' name='poids' maxlength='40' <?php if (isset($_COOKIE['poids'])) {echo "value=\"".$_COOKIE['poids']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";}?>/>
		<label for='taille'> Votre taille (en cm) : </label><input id='taille' type='text' name='taille' maxlength='40' <?php if (isset($_COOKIE['taille'])) {echo "value=\"".$_COOKIE['taille']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";}?>/>
		</br>
		
		<label for='antecedent_cv'> Avez-vous des antécédents de maladies cardio-vasculaire : </label><input id='ouicv' type='checkbox' name='antecedent_cv' value='1' <?php if (isset($_COOKIE['antecedent_cv']) AND $_COOKIE['antecedent_cv']) echo "checked"; ?>> <label for="ouicv">Oui</label>
																							          <input id='noncv' type='checkbox' name='antecedent_cv' value='0' <?php if (isset($_COOKIE['antecedent_cv']) AND !$_COOKIE['antecedent_cv']) echo "checked"; ?>> <label for="noncv">Non</label>
		</br>
		
		<label for='diabete'> Avez-vous du diabète : </label><input id='ouidiabete' type='checkbox' name='diabete' value='1' <?php if (isset($_COOKIE['diabete']) AND $_COOKIE['diabete']) echo "checked"; ?>> <label for="ouidiabete">Oui</label>
															 <input id='nondiabete' type='checkbox' name='diabete' value='0' <?php if (isset($_COOKIE['diabete']) AND !$_COOKIE['diabete']) echo "checked"; ?>> <label for="nondiabete">Non</label>
		</br>
		
		<label for='respiratoire_chronique'> Avez-vous des antécédents respiratoires : </label><input id='ouirc' type='checkbox' name='respiratoire_chronique' value='1' <?php if (isset($_COOKIE['respiratoire_chronique']) AND $_COOKIE['respiratoire_chronique']) echo "checked"; ?>> <label for="ouirc">Oui</label>
																							   <input id='nonrc' type='checkbox' name='respiratoire_chronique' value='0' <?php if (isset($_COOKIE['drespiratoire_chronique']) AND !$_COOKIE['respiratoire_chronique']) echo "checked"; ?>> <label for="nonrc">Non</label>
		</br>
		
		<label for='dialyse'> Etes-vous en dialyse : </label><input id='ouidialyse' type='checkbox' name='dialyse' value='1' <?php if (isset($_COOKIE['dialyse']) AND $_COOKIE['dialyse']) echo "checked"; ?>> <label for="ouidialyse">Oui</label>
															 <input id='nondialyse' type='checkbox' name='dialyse' value='0' <?php if (isset($_COOKIE['dialyse']) AND !$_COOKIE['dialyse']) echo "checked"; ?>> <label for="nondialyse">Non</label>
		</br>
		
		<label for='cancer'> Etes-vous atteint de cancer : </label><input id='ouicancer' type='checkbox' name='cancer' value='1' <?php if (isset($_COOKIE['cancer']) AND $_COOKIE['cancer']) echo "checked"; ?>> <label for="ouicancer">Oui</label>
															       <input id='noncancer' type='checkbox' name='cancer' value='0' <?php if (isset($_COOKIE['cancer']) AND !$_COOKIE['cancer']) echo "checked"; ?>> <label for="noncancer">Non</label>
		</br>
		</br>
		
		Vos symptômes : </br>
		
		<label for='perte_gout'> Avez-vous perdu le goût : </label><input id='ouiperte_gout' type='checkbox' name='perte_gout' value='1' <?php if (isset($_COOKIE['perte_gout']) AND $_COOKIE['perte_gout']) echo "checked"; ?>> <label for="ouiperte_gout">Oui</label>
															       <input id='nonperte_gout' type='checkbox' name='perte_gout' value='0' <?php if (isset($_COOKIE['perte_gout']) AND !$_COOKIE['perte_gout']) echo "checked"; ?>> <label for="nondperte_gout">Non</label>
		</br>
		
		<label for='perte_odorat'> Avez-vous perdu l'odorat : </label><input id='ouiperte_odorat' type='checkbox' name='perte_odorat' value='1' <?php if (isset($_COOKIE['perte_odorat']) AND $_COOKIE['perte_odorat']) echo "checked"; ?>> <label for="ouiperte_odorat">Oui</label>
															 <input id='nonperte_odorat' type='checkbox' name='perte_odorat' value='0' <?php if (isset($_COOKIE['perte_odorat']) AND !$_COOKIE['perte_odorat']) echo "checked"; ?>> <label for="nonperte_odorat">Non</label>
		</br>
		
		<label for='fievre'> Avez-vous de la fièvre : </label><input id='ouifievre' type='checkbox' name='fievre' value='1' <?php if (isset($_COOKIE['fievre']) AND $_COOKIE['fievre']) echo "checked"; ?>> <label for="ouifievre">Oui</label>
															 <input id='nondfievre' type='checkbox' name='fievre' value='0' <?php if (isset($_COOKIE['fievre']) AND !$_COOKIE['fievre']) echo "checked"; ?>> <label for="nonfievre">Non</label>
		</br>
		
		<label for='toux'> Avez-vous de la toux : </label><input id='ouitoux' type='checkbox' name='toux' value='1' <?php if (isset($_COOKIE['toux']) AND $_COOKIE['toux']) echo "checked"; ?>> <label for="ouitoux">Oui</label>
														  <input id='nontoux' type='checkbox' name='toux' value='0' <?php if (isset($_COOKIE['toux']) AND !$_COOKIE['toux']) echo "checked"; ?>> <label for="nontoux">Non</label>
		</br>
		
		<label for='date_symp'>Date de début des symptômes :</label><input id='date_symp' type="date" name="date_symp" <?php if (isset($_COOKIE['date_symp'])) {echo "value=\"".$_COOKIE['date_symp']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";}?>/>
		<br>
		
		<label for='date_depistage'>Date de dépistage :</label><input id='date_depistage' type="date" name="date_depistage" <?php if (isset($_COOKIE['date_depistage'])) {echo "value=\"".$_COOKIE['date_symp']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";}?>/>
		<br>
		
		<label for='autre'>Autre :</label><input id='autre' type="text" name="autre" <?php if (isset($_COOKIE['autre'])) {echo "value=\"".$_COOKIE['autre']."\"";} else {echo "style='background-color:rgba(255,0,0,0.6)'";}?>/>
		<br>
		
		
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
