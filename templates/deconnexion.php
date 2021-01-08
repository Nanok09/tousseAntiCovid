<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=deconnexion");
    die("");
}
?>

<div class="container">
	<br>
	<br>
	<br>
	<div class="row">
	<main>
    <form action="controleur.php" method="POST">
    	<div class="container">
    		<div class="row">
    			<h5 class="col-8">Si vous souhaitez vous déconnecter de votre compte Tousse Anti Covid, cliquez sur le bouton suivant :</h5>
        		<button name="action" type="submit" value="Déconnexion" class="btn btn-primary col-4">Déconnexion</button>
        		<h5 class="col-12">Si vous ne souhaitez pas vous déconnecter, vous pouvez continuer à naviguer sur les pages du site.</h5>

    		</div>

    	</div>

    </form>
	</main>
	</div>

</div>
