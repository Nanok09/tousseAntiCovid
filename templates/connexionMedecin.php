<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=connexionMedecin");
    die("");
}
?>

<main>


    <div class="container">

        <div class="row">
          <h2>Connectez vous pour accéder aux fonctionnalités :</h2>  
        </div>
        </br>
		<div class="row">
          <h2>Médecin</h2>  
        </div>
		
    <div class="row">
        
    <form method="GET" action="controleur.php" id="formulaire">  
        <div>       
            <label for='pseudo'>Votre adresse mail :</label>
            <input id='pseudo' type="text" name="mail" <?php if (isset($_COOKIE['mail'])) echo "value=\"".$_COOKIE['mail']."\""; ?> />
        </div>
        <br>

        <div>
            <label for='pass'>Votre mot de passe :</label>
            <input id='pass' type="password" name="passe" value=<?php if (isset($_COOKIE['passe'])) {echo $_COOKIE['passe'];} else {echo '""';}?> />
        </div>
        <br>
		
		<a href="index.php?view=connexion">Connexion mode Patient</a>
        <br>
		
        <a href="index.php?view=forgotten_password">Mot de passe oublié</a>
        <br>

        <div>
            <label for='coche'>Connexion automatique :</label>
            <input type="checkbox" name="coche" id="coche" <?php if (isset($_COOKIE['coche'])) {echo $_COOKIE['coche'];} else {echo '';}?> />
        </div>
        <br>

		<button type="submit" name="action" value="ConnexionMedecin">Connexion</button>
    </form>
    </div>



    </div>

</main>