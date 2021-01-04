<?php
session_start();

include_once "libs/libUse.php";
include_once "libs/libRequest.php";
include_once "libs/libSecurity.php"; 
include_once "libs/libModele.php"; 

$addArgs = "";

if ($action = valider("action"))
{
	ob_start();

	echo "Action = '$action' <br />";

	// ATTENTION : le codage des caractères peut poser PB 
	// si on utilise des actions comportant des accents... 
	// A EVITER si on ne maitrise pas ce type de problématiques

	if ($action != "Connexion") 
		if ($action != "Inscription")
			securiser("Connexion");

	// Un paramètre action a été soumis, on fait le boulot...
	switch($action)
	{
		case 'Connexion':
			// On verifie la presence des champs login et passe
			if ($pseudo = valider("pseudo") AND $pass = valider("pass"))
			{
				// On verifie l'utilisateur, et on crée des variables de session si tout est OK
				// Cf. maLibSecurisation
				$register = verifUser($pseudo,$pass,valider("coche"));
				if ($register)
					$qs = "?view=accueil";
				else
					$qs = "?view=connexion"; 	
			}
			else
				$qs = "?view=connexion";
		break;

		case 'Déconnexion':
			session_destroy();
			$qs = "?view=connexion";
		break;

		case "Inscription":
			if ($pseudo = valider('pseudo','POST') AND $email = valider('email','POST')
			AND $pass1 = valider('pass1','POST') AND $pass2 = valider('pass2','POST'))
			{
				if ($pass1 == $pass2)
				{
					if(!findUser($pseudo))
					{
						addUser($pseudo,$pass1,$email);
						$qs = "?view=accueil";
					}
					else
						$qs = "?view=inscription&info=0";
				}
				else
					$qs = "?view=inscription&info=1";
			}
			else
				$qs = "?view=inscription&info=2";
		break;

		case "Modifier":
			$user = infoUser($_SESSION['id']);
			if (valider('photo','POST') == false AND $user['photo'] != null)
				$photo = $user['photo'];
			else
				$photo = valider('photo','POST');

			$modif1 = [
			'id' => $_SESSION['id'],
			'pseudo' => valider("pseudo","POST"),
			'pass_1' => valider("pass_1","POST"),
			'pass_2' => valider("pass_2","POST"),
			'pass_3' => valider("pass_3","POST"),
			'email' => valider("email","POST"),
			'date_naissance' => valider("date_naissance","POST"),
			'pays' => valider("pays","POST"),
			'bio' => valider("bio","POST"),
			'photo' => $photo];
			
			$modif = traitement($modif1);
			if ($modif != false)
			{
				modifyUser($modif);
				$qs = "?view=compte&".$modif1['email']."&".$modif['email'];
			}
			else
				$qs = "?view=compte&error";
		break;

		case "Créer":
			if ($theme = valider('theme'))
				creerConversation($theme,$_SESSION['id']);
			$qs = "?view=forum";
		break;

		case "Envoyer":
			if ($contenu = valider('contenu','POST') AND $id_conversation = valider('idConv','POST'))
				enregistrerMessage($id_conversation,$_SESSION['id'],$contenu);
			$qs = "?view=conversation&idConv=".$id_conversation;
		break;

		case "Réinitialiser":
			if ($pseudo = valider('pseudo') AND $email = valider('email'))
			$qs = "?view=connexion";
		break;
	}
}
$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
header("Location:" . $urlBase . $qs);
//qs doit contenir le symbole '?'

// On écrit seulement après cette entête
ob_end_flush();
	
?>