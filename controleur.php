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
			if ($mail = valider("mail") AND $passe = valider("passe"))
			{
				// On verifie l'utilisateur, et on crée des variables de session si tout est OK
				// Cf. maLibSecurisation
				$register = verifUser($mail,$passe,valider("coche"));
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
			$qs = "?view=accueil";
		break;

		/* case "Inscription":
			if ($nom = valider('nom','POST') AND $prenom = valider('prenom','POST')
			AND $mail = valider('mail','POST') AND $tel = valider('tel','POST')
			AND $passe1 = valider('passe1','POST') AND $passe2 = valider('passe2','POST')
			AND $naissance = valider('naissance','POST') AND $secu = valider('secu','POST')
			AND $adresse = valider('adresse','POST') AND $code_postal = valider('code_postal','POST')
			AND $sexe = valider('sexe','POST') AND $nom_medecin = valider('nom_medecin','POST')
			AND $prenom_medecin = valider('prenom_medecin','POST'))
			{
				if ($passe1 == $passe2)
				{
					if(!findUser($mail))
					{
						$id_medecin = findMedecin($nom_medecin,$prenom_medecin);
						addUser($nom,$prenom,$mail,$tel,$passe1,$naissance,$secu,$adresse,$code_postal,$sexe,$id_medecin);
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
		break; */

		case "Inscription":
		
			$nom = validerPostCookie('nom');
			$prenom = validerPostCookie('prenom');
			$mail = validerPostCookie('mail');
			$tel = validerPostCookie('tel');
			$naissance = validerPostCookie('naissance');
			$secu = validerPostCookie('secu');
			$adresse = validerPostCookie('adresse');
			$code_postal = validerPostCookie('code_postal');
			$sexe = validerPostCookie('sexe');
			$nom_medecin = validerPostCookie('nom_medecin');
			$prenom_medecin = validerPostCookie('prenom_medecin');
			
			
			if ($nom = validerPostCookie('nom') AND $prenom = validerPostCookie('prenom')
			AND $mail = validerPostCookie('mail') AND $tel = validerPostCookie('tel')
			AND $passe1 = valider('passe1','POST') AND $passe2 = valider('passe2','POST')
			AND $naissance = validerPostCookie('naissance') AND $secu = validerPostCookie('secu')
			AND $adresse = validerPostCookie('adresse') AND $code_postal = validerPostCookie('code_postal')
			AND $sexe = validerPostCookie('sexe') AND $nom_medecin = validerPostCookie('nom_medecin')
			AND $prenom_medecin = validerPostCookie('prenom_medecin'))
			{
				if ($passe1 == $passe2)
				{
					if ($id_medecin = findMedecin($nom_medecin,$prenom_medecin))
					{
						if(!findUser($mail))
						{
							
							addUser($nom,$prenom,$mail,$tel,$passe1,$naissance,$secu,$adresse,$code_postal,$sexe,$id_medecin);
							$qs = "?view=accueil";
						}
						else
							$qs = "?view=inscription&info=4";
					}
					else
					{
						$qs = "?view=inscription&info=1";
					}
				}
				else
					$qs = "?view=inscription&info=2";
			}
			else
				$qs = "?view=inscription&info=3";
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
		
		case "Filter":
			if ($valueToSearch = valider('valueToSearch'))
			$qs = "?view=medecin&search=".$valueToSearch;
		
		case "Afficher":
			if ($id = valider('id'))
			$qs = "?view=fiche_patient&id=".$id;
	}
}
$urlBase = dirname($_SERVER["PHP_SELF"]) . "index.php";
header("Location:" . $urlBase . $qs);
//qs doit contenir le symbole '?'

// On écrit seulement après cette entête
ob_end_flush();
	
?>