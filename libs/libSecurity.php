<?php
include_once "libUse.php";	// Car on utilise la fonction valider()
include_once "libModele.php";	// Car on utilise la fonction connecterUtilisateur()

/**
 * @file login.php
 * Fichier contenant des fonctions de vérification de logins
 */

/**
 * Cette fonction vérifie si le login/passe passés en paramètre sont légaux
 * Elle stocke les informations sur la personne dans des variables de session : session_start doit avoir été appelé...
 * Infos à enregistrer : pseudo, idUser, heureConnexion, isAdmin
 * Elle enregistre l'état de la connexion dans une variable de session "connecte" = true
 * L'heure de connexion doit être stockée au format date("H:i:s") 
 * @pre pseudo et pass ne doivent pas être vides
 * @param string $pseudo
 * @param string $pass
 * @return false ou true ; un effet de bord est la création de variables de session
 */
function verifUser($mail,$passe,$check=off)
{
	$res = verifUserBDD($mail,$passe);
	if ($res != false)
	{
		$_SESSION['mail']=$mail;
		$_SESSION['id']=$res;
		$_SESSION['heureConnexion']=date("H:i:s");
	//	$_SESSION['isAdmin']=isAdmin($res);
		$_SESSION['isConnected']=true;

		if ($check == "on")
		{
			setcookie('mail',$mail,time() + 30*24*3600,null,null,false,true);
            setcookie('passe',$passe,time() + 30*24*3600,null,null,false,true);
            setcookie('coche','checked',time() + 30*24*3600,null,null,false,true);
		}
		else
		{
			setcookie('mail');
            setcookie('passe');
            setcookie('coche');
		}

		return true;
	}
	else
	{
		$_SESSION['isConnected']=false;
		return false;
	}
}

/**
 * Fonction à placer au début de chaque page privée
 * Cette fonction redirige vers la page $urlBad en envoyant un message d'erreur 
	et arrête l'interprétation si l'utilisateur n'est pas connecté
 * Elle ne fait rien si l'utilisateur est connecté, et si $urlGood est faux
 * Elle redirige vers urlGood sinon
 */
function securiser($urlBad,$urlGood=false)
{
	if ($_SESSION['isConnected'] == true)
	{
		if ($urlGood == false)
		{}
		else
			header("Location:".$urlGood);
	}
	else
		header("Location:index.php?view=".$urlBad);
}

function securiserAdmin($urlBad,$urlGood=false)
{
	if ($_SESSION['isAdmin'] == 1 AND $_SESSION['isConnected'] == true)
	{
		if ($urlGood == false)
		{}
		else
			header("Location:".$urlGood);
	}
	else
		header("Location:index.php?view=".$urlBad);
}
?>