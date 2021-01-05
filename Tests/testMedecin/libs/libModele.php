<?php

// Dans ce fichier, on définit diverses fonctions permettant de récupérer des données utiles
// inclure ici la librairie faciliant les requêtes SQL (en veillant à interdire les inclusions multiples)

include_once("libRequest.php");

/*** Fonctions pour l'interface d'inscription : ***/

function addUser($pseudo,$pass,$email)
{
	$SQL = "INSERT INTO membres (pseudo,pass,email) VALUES ('".$pseudo."','".$pass."','".$email."')";
	return SQLInsert($SQL);
}

function findUser($pseudo)
{
	$SQL = "SELECT id FROM membres WHERE pseudo='".$pseudo."'";
	return SQLGetCHamp($SQL);
}

/*** Fonctions pour l'interface de compte : ***/

function infoUser($id)
{
	$SQL = "SELECT pseudo,email,date_naissance,pays,bio,photo FROM membres WHERE id=".$id;
	$info_user = parcoursRs(SQLSelect($SQL));
	if (count($info_user) == 0) 
		return false;
	else 
		return $info_user[0];
}

function modifyUser($modif)
{
	$SQL = "UPDATE membres SET 
	pseudo = ".$modif['pseudo'].",
	pass = ".$modif['pass'].", 
	email = ".$modif['email'].",
	date_naissance = ".$modif['date_naissance'].",
	bio = ".$modif['bio'].",
	pays = ".$modif['pays'].",
	photo = ".$modif['photo']."
	WHERE id = ".$modif['id'];
	return SQLUpdate($SQL);
}

/*** Fonctions pour l'affichage du classement : ***/

function trancheClassement($start,$end)
{
	$SQL = "SELECT pseudo,pays,rang FROM membres ORDER BY rang LIMIT ".$start.",".$end;
	return parcoursRs(SQLSelect($SQL));
}

/*** Fonctions pour l'interface forum : ***/

function listerConversations($mode="tout")
{
	// Liste toutes les conversations ($mode="tout")
	// OU uniquement celles actives  ($mode="actives"), ou inactives  ($mode="inactives")
	if ($mode == "actives")
		$SQL = "SELECT * FROM conversations WHERE active=1";
	else if($mode == "inactives")
		$SQL = "SELECT * FROM conversations WHERE active=0";
	else
		$SQL = "SELECT * FROM conversations";
	return parcoursRs(SQLSelect($SQL));
}

function archiverConversation($idConversation)
{
	// rend une conversation inactive
	$SQL = "UPDATE conversations SET active = 0 WHERE id=".$idConversation;
	return SQLUpdate($SQL);
}

function reactiverConversation($idConversation)
{
	// rend une conversation active
	$SQL = "UPDATE conversations SET active = 1 WHERE id=".$idConversation;
	return SQLUpdate($SQL);
}

function creerConversation($theme,$id_createur)
{
	// crée une nouvelle conversation et renvoie son identifiant
	$SQL = "INSERT INTO conversations (theme,id_createur,date_creation,active) VALUES (\"".$theme."\",".$id_createur.",CURDATE(),1)";
	return SQLInsert($SQL);
}

function supprimerConversation($idConv)
{
	// supprime une conversation et ses messages
	// Utiliser pour cela des mises à jour en cascade en appliquant l'intégrité référentielle
	$SQL = "DELETE FROM conversations WHERE id=".$idConv;
	return SQLDelete($SQL);
}

function enregistrerMessage($idConversation, $idAuteur, $contenu)
{
	// Enregistre un message dans la base en encodant les caractères spéciaux HTML : <, > et & 
	// pour interdire les messages HTML
	$SQL = "INSERT INTO messages (id_conversation,id_user,contenu) VALUES (".$idConversation.",".$idAuteur.",'".$contenu."')";
	return SQLInsert($SQL);
}

function listerMessages($idConv)
{
	// Liste les messages de cette conversation
	// Champs à extraire : contenu, auteur 
	$SQL = "SELECT m.contenu,u.pseudo,m.date_envoi FROM messages m INNER JOIN membres u ON m.id_user=u.id WHERE m.id_conversation =".$idConv;
	return parcoursRs(SQLSelect($SQL));
}

function compterMessages($idConv)
{
	$SQL = "SELECT COUNT(id_message) FROM messages WHERE id_conversation=".$idConv;
	return SQLGetCHamp($SQL);
}

function listerMessagesFromIndex($idConv,$index)
{
	// Liste les messages de cette conversation, 
	// dont l'id est superieur à l'identifiant passé
	// Champs à extraire : contenu, auteur, couleur 
	// en ne renvoyant pas les utilisateurs blacklistés
	$SQL = "SELECT contenu,pseudo,couleur FROM messages m INNER JOIN membres u ON m.idAuteur=u.id WHERE blacklist = 0 AND m.id>".$index;
	return SQLSelect($SQL);
}

function getConversation($idConv)
{	
	// Récupère les données de la conversation (theme, active)
	$SQL = "SELECT theme, active FROM conversations WHERE id='$idConv'";
	$listConversations = parcoursRs(SQLSelect($SQL));

	// Attention : parcoursRS nous renvoie un tableau contenant potentiellement PLUSIEURS CONVERSATIONS
	// Il faut renvoyer uniquement la première case de ce tableau, c'est à dire la case 0 
	// OU false si la conversation n'existe pas
	 
	if (count($listConversations) == 0) 
		return false;
	else 
		return $listConversations[0];
}

/*** Fonctions de gestion des utilisateurs : ***/

function listerUtilisateurs($classe="both")
{
	// Cette fonction liste les utilisateurs de la base de données 
	// et renvoie un tableau d'enregistrements. 
	// Chaque enregistrement est un tableau associatif contenant les champs 
	// id,pseudo,blacklist,couleur
	switch($classe)
	{
		// Lorsque la variable $classe vaut "both", elle renvoie tous les utilisateurs
		case "both":
			$SQL = "select id,pseudo,blacklist,couleur from users";
		break;
		// Lorsqu'elle vaut "bl", elle ne renvoie que les utilisateurs blacklistés
		case "bl":
			$SQL = "select id,pseudo,blacklist,couleur from users where blacklist = 1";
		break;
		// Lorsqu'elle vaut "nbl", elle ne renvoie que les utilisateurs non blacklistés
		case "nbl":
			$SQL = "select id,pseudo,blacklist,couleur from users where blacklist = 0";
		break;
	}
	return parcoursRs(SQLSelect($SQL));
}

function interdireUtilisateur($idUser)
{
	// cette fonction affecte le booléen "blacklist" à vrai
	$SQL = "UPDATE users SET blacklist = 1 WHERE id =".$idUser; 
	SQLUpdate($SQL);
}

function autoriserUtilisateur($idUser)
{
	// cette fonction affecte le booléen "blacklist" à faux 
	$SQL = "UPDATE users SET blacklist = 0 WHERE id =".$idUser; 
	SQLUpdate($SQL);
}

/*** Fonctions de vérification : ***/

function verifUserBdd($login,$passe)
{
	// Vérifie l'identité d'un utilisateur 
	// dont les identifiants sont passes en paramètre
	// renvoie faux si user inconnu
	// renvoie l'id de l'utilisateur si succès
	// On utilise SQLGetCHamp
	// si on avait besoin de plus d'un champ
	// on aurait du utiliser SQLSelect
	$SQL = "SELECT id FROM membres WHERE pseudo='".$login."' AND pass='".$passe."'";
	return SQLGetCHamp($SQL);
}

function isAdmin($idUser)
{
	// vérifie si l'utilisateur est un administrateur
	$SQL = "SELECT admin FROM membres WHERE id=".$idUser;
	return SQLGetCHamp($SQL);
}

?>