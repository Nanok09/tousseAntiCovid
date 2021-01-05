<?php
/**
 * @file maLibUtils.php
 * Ce fichier définit des fonctions d'accès ou d'affichage pour les tableaux superglobaux
 */

/**
 * Vérifie l'existence (isset) et la taille (non vide) d'un paramètre dans un des tableaux GET, POST, COOKIES, SESSION
 * Renvoie false si le paramètre est vide ou absent
 * @note l'utilisation de empty est critique : 0 est empty !!
 * Lorsque l'on teste, il faut tester avec un ===
 * @param string $nom
 * @param string $type
 * @return string|boolean
 */
function valider($nom,$type="REQUEST")
{	
	switch($type)
	{
		case 'REQUEST': 
		if(isset($_REQUEST[$nom]) && !($_REQUEST[$nom] == "")) 	
			return proteger($_REQUEST[$nom]); 	
		break;
		case 'GET': 	
		if(isset($_GET[$nom]) && !($_GET[$nom] == "")) 			
			return proteger($_GET[$nom]); 
		break;
		case 'POST': 	
		if(isset($_POST[$nom]) && !($_POST[$nom] == "")) 	
			return proteger($_POST[$nom]); 		
		break;
		case 'COOKIE': 	
		if(isset($_COOKIE[$nom]) && !($_COOKIE[$nom] == "")) 	
			return proteger($_COOKIE[$nom]);	
		break;
		case 'SESSION': 
		if(isset($_SESSION[$nom]) && !($_SESSION[$nom] == "")) 	
			return $_SESSION[$nom]; 		
		break;
		case 'SERVER': 
		if(isset($_SERVER[$nom]) && !($_SERVER[$nom] == "")) 	
			return $_SERVER[$nom]; 		
		break;
	}
	return false; // Si pb pour récupérer la valeur 
}


/**
 * Vérifie l'existence (isset) et la taille (non vide) d'un paramètre dans un des tableaux GET, POST, COOKIE, SESSION
 * Prend un argument définissant la valeur renvoyée en cas d'absence de l'argument dans le tableau considéré

 * @param string $nom
 * @param string $defaut
 * @param string $type
 * @return string
*/
function getValue($nom,$defaut=false,$type="REQUEST")
{
	// NB : cette commande affecte la variable resultat une ou deux fois
	if (($resultat = valider($nom,$type)) === false)
		$resultat = $defaut;
	return $resultat;
}

/**
*
* Evite les injections SQL en protegeant les apostrophes par des '\'
* Attention : SQL server utilise des doubles apostrophes au lieu de \'
* ATTENTION : LA PROTECTION N'EST EFFECTIVE QUE SI ON ENCADRE TOUS LES ARGUMENTS PAR DES APOSTROPHES
* Y COMPRIS LES ARGUMENTS ENTIERS !!
* @param string $str
*/
function proteger($str)
{
	// attention au cas des select multiples !
	// On pourrait passer le tableau par référence et éviter la création d'un tableau auxiliaire
	if (is_array($str))
	{
		$nextTab = array();
		foreach($str as $cle => $val)
		{
			$nextTab[$cle] = addslashes($val);
		}
		return $nextTab;
	}
	else 	
		return addslashes($str);
	//return str_replace("'","''",$str); 	//utile pour les serveurs de bdd Crosoft
}

/*** Fonctions pour l'affichage du classement : ***/
function affichageClassement($tab)
{
	echo "<table>";
	echo "<thead><th>Rang</th><th>Pseudo</th><th>Pays</th></thead>";
	echo "<tbody>";
	foreach ($tab as $data) 
	{
		switch($data['rang'])
		{
			case '1':
				echo "<tr id=\"first\">";
				echo "<td>".$data['rang']."</td><td>".$data['pseudo']."</td><td>".$data['pays']."</td>";
				echo "</tr>";
			break;

			case '2':
				echo "<tr id=\"second\">";
				echo "<td>".$data['rang']."</td><td>".$data['pseudo']."</td><td>".$data['pays']."</td>";
				echo "</tr>";
			break;

			case '3':
				echo "<tr id=\"third\">";
				echo "<td>".$data['rang']."</td><td>".$data['pseudo']."</td><td>".$data['pays']."</td>";
				echo "</tr>";
			break;

			default :
				echo "<tr>";
				echo "<td>".$data['rang']."</td><td>".$data['pseudo']."</td><td>".$data['pays']."</td>";
				echo "</tr>";
		}
	}
	echo "</tbody>";
	echo "</table>";	
}

function rediriger($url,$qs="",$message="")
{
	// if ($qs != "")	 $qs = urlencode($qs);	
	// Il faut respecter l'encodage des caractères dans les chaînes de requêtes
	// NB : Pose des problèmes en cas de valeurs multiples
	// TODO: Passer un tabAsso en paramètres

	if ($qs != "") 
		$qs = "?$qs";
 
	header("Location:$url$qs"); // envoi par la méthode GET
	die($message); // interrompt l'interprétation du code 

	// TODO: on pourrait passer en parametre le message servant au die...
}

// TODO: intégrer les redirections vers la page index dans une fonction :

/*
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}
*/

/*** Traitement de la demande de modification de compte : ***/
function traitement($tab)
{
	$modif = [
	'id' => "null",
	'pseudo' => "null",
	'pass' => "null",
	'email' => "null",
	'date_naissance' => "null",
	'pays' => "null",
	'bio' => "null",
	'photo' => "null"];

	if (findUser($tab['pseudo']) != false)
		if (verifUserBDD($tab['pseudo'],$tab['pass_1']) != false)
		{
			$modif['id'] = $tab['id'];
			$modif['pseudo'] = "\"".$tab['pseudo']."\"";
			if ($tab['email'] != false)
				$modif['email'] = "\"".$tab['email']."\"";
			if ($tab['date_naissance'] != false)
				$modif['date_naissance'] = "\"".$tab['date_naissance']."\"";
			if ($tab['pays'] != false)
				$modif['pays'] = "\"".$tab['pays']."\"";
			if ($tab['bio'] != false)
				$modif['bio'] = "\"".$tab['bio']."\"";
			if ($tab['photo'] != false)
				$modif['photo'] = "\"".$tab['photo']."\"";

			if ($tab['pass_2'] != false AND $tab['pass_2'] == $tab['pass_3'])
				$modif['pass'] = "\"".$tab['pass_2']."\"";
			else
				$modif['pass'] = "\"".$tab['pass_1']."\"";
			return $modif;
		}
		else
			return false;
	else 
		return false;
}

?>