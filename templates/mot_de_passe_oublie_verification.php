<?php
// on démarre une session pour le statut des erreurs :
session_start();

// on récupère les fonctions de vérifications :
include("fonction_verification.php");

// on neutralise les balises potentiellement rentrées par l'utilisateur :
$pseudo=htmlspecialchars($_POST['pseudo']);
$email=htmlspecialchars($_POST['email']);

// on vérifie que l'email rentrée est bien correcte :
if (testEmailCorrecte($email))
{
	// on se connecte à la base de données du site :
	$bdd = new PDO('mysql:host=localhost;dbname=awale;charset=utf8', 'root', '');

	// on va chercher dans la base de donnée l'email qui corresponde à ce pseudo :
	$req = $bdd->prepare('SELECT email FROM membres WHERE pseudo = ?');
	$req->execute(array($pseudo));
	$reponse=$req->fetch();

	// on vérifie que l'utilisateur a rentré la bonne email pour son pseudo :
	if ($email == $reponse['email'])
	{
		// on envoie un mail avec un lien pour réinitialiser son mot de passe :
		$message=
		"Bonjour,\r\n
		Vous avez demandé à réinitialiser votre mot de passe pour accéder à votre compte sur le site Awalé.\r\n
		Si vous êtes bien à l'origine de cette demande, cliquez sur le lien suivant et suivez la procédure :\r\n
		<a href='reinitialisation_mot_de_passe.php'>Réinitialiser mon mot de passe</a>";

		$envoie=mail($email, "Réinitialisation de votre mot de passe Awalé", $message);
		$_SESSION['statut']="Vous avez reçu un mail pour réinitialiser votre mot de passe : " . $envoie .;
		header("Location: connexion");
	}
	// sinon on demande l'adresse mail qui correspond vraiment au pseudo :
	else
	{
		$_SESSION['statut']="L'adresse email saisie ne correspond pas au pseudo saisi";
		header("Location: mot_de_passe_oublie.php");
	}
}
// sinon on demande une autre adresse email :
else
{
	$_SESSION['statut']="L'adresse email saisie est incorrecte";
	header("Location: mot_de_passe_oublie.php");
}













?>