<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->
<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Awalé</title>

	<link rel="icon" type="image/png" href="images/logo.png">

	<link rel="stylesheet" type="text/css" href="css/swiper.css">
	<link rel="stylesheet" type="text/css" href="css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/jeu.css">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/classement.css">
	<link rel="stylesheet" type="text/css" href="css/jouer.css">
	<link rel="stylesheet" type="text/css" href="css/compte.css">
	<link rel="stylesheet" type="text/css" href="css/forum.css">
	<link rel="stylesheet" type="text/css" href="css/connexion.css">

	<script type="text/javascript" src="js/swiper.js"></script>
	<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script type="text/javascript" src="js/game.js"></script>
</head>
<!-- **** F I N **** H E A D **** -->


<!-- **** B O D Y **** -->
<body>

<div id="en_tete">
	<header>
	    <img src="images/logo_club_1.jpg" alt="Club Awale" class="logo"><br>

	    <div id="titre">
		    <h1>Site du club Awalé</h1>
		    <p id="message bienvenue">
		    	"Bienvenue sur le site du club Awale où vous allez pouvoir découvrir et jouer à l'Awalé"
		    </p>
	    </div>

	    <img src="images/logo_club_2.jpg" alt="Club Awale" class="logo"><br>

	    <div id="compte">
	    	<?php
	    	if (!isset($_SESSION['isConnected']) OR $_SESSION['isConnected'] != true)
			{
				echo '<div id="connexion" class="cadre"><a href="index.php?view=connexion">Connexion</a></div>';
			}
			else
			{
				echo '<div id="deconnexion" class="cadre"><a href="index.php?view=deconnexion">Déconnexion</a></div>';
			}
			?>

			<div id="inscription" class="cadre">
				<a href="index.php?view=inscription">Inscription</a>
			</div>
		</div>
	</header>

	<nav>
	    <ul>
	        <li><a href="index.php?view=accueil">Accueil</a></li>
	        <li><a href="index.php?view=jouer">Jouer</a></li>
	        <li><a href="index.php?view=apprendre">Apprendre</a></li>
	        <li><a href="index.php?view=exercices">Exercices</a></li>
	        <li><a href="index.php?view=decouverte">Découverte</a></li>
	        <li><a href="index.php?view=forum">Forum</a></li>
	        <li><a href="index.php?view=compte">Compte</a></li>
	        <li><a href="index.php?view=classement">Classement</a></li>
	    </ul>
	</nav>
</div>