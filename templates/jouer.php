<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=login");
    die("");
}
?>

<main>
    <div id="jouer">
        <h1>Jouer</h1>

        <h2>Choisis ton adversaire :</h2>

        <div class="bouton">
            <a href="index.php?view=jeu">En ligne</a>
        </div>

        <div class="bouton">
            <p>Ordinateur</p>
        </div>
        
        <div class="bouton">
            <p>Grands joueurs</p>
        </div>

        <h2>Difficulté :</h2>
        
        <div id="difficulte">
            <div class="star">★</div>
            <div class="star">★</div>
            <div class="star">★</div>
            <div class="star">★</div>
            <div class="star">★</div>
        </div>
    </div>
</main>