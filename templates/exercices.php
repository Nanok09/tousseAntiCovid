<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=exercices");
    die("");
}
?>
<main>
    <div>
        <h2>Exercices</h2>

        <hr>
        
        <p>Tu as le Sud, au nord de jouer.</p>
        <p>Gagne la partie en un coup</p>
        
        <img src="images/awale_5.jpg"/><br>

        <p>Gagne la partie en deux coups</p>
        
        <img src="images/awale_5.jpg"/>
    </div>
</main>
