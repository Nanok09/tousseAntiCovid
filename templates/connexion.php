<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=connexion");
    die("");
}
?>

<main>
	<h2>Connectez vous pour jouer en remplissant les champs suivants :</h2>

	<form method="GET" action="controleur.php" id="formulaire">  
        <div>       
    	    <label for='pseudo'>Votre pseudo :</label>
    	    <input id='pseudo' type="text" name="pseudo" <?php if (isset($_COOKIE['pseudo'])) echo "value=\"".$_COOKIE['pseudo']."\""; ?> />
        </div>
        <br>

        <div>
    	    <label for='pass'>Votre mot de passe :</label>
    	    <input id='pass' type="password" name="pass" value=<?php if (isset($_COOKIE['pass'])) {echo $_COOKIE['pass'];} else {echo '""';}?> />
        </div>
        <br>

        <a href="index.php?view=forgotten_password">Mot de passe oublié</a>
        <br>

        <div>
            <label for='coche'>Connexion automatique :</label>
            <input type="checkbox" name="coche" id="coche" <?php if (isset($_COOKIE['coche'])) {echo $_COOKIE['coche'];} else {echo '';}?> />
        </div>
        <br>

		<input name="action" type="submit" value="Connexion"/>
	</form>
</main>