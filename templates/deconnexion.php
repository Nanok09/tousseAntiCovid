<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=deconnexion");
    die("");
}
?>

<main>
    <form action="controleur.php" method="POST">
        <p>Si vous souhaitez vous déconnecter de votre compte Awalé, cliquez sur le bouton suivant :</p>
        <input name="action" type="submit" value="Déconnexion">
        <p>Si vous ne souhaitez pas vous déconnecter, vous pouvez continuer à naviguer sur les pages du site.</p>
    </form>
</main>