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

        <a class="bouton">
            <p>En ligne</p>
        </a>

        <a id="jeu_ordi" href="index.php?view=jeu&diff=3" class="bouton">
            <p>Ordinateur</p>
        </a>
        
        <a class="bouton">
            <p>Grands joueurs</p>
        </a>

        <h2>Difficulté :</h2>
        
        <div id="difficulte">
            <div class="star">★</div>
            <div class="star">★</div>
            <div class="star">★</div>
            <div class="star selected">★</div>
            <div class="star">★</div>
        </div>
    </div>
</main>

<script>
var difficulte = 3;
$(function(){
 $('#difficulte .star').on('click',function(){
    difficulte = $(this).index();
    $('.star.selected').removeClass('selected');
    $(this).addClass('selected');
    $('.bouton#jeu_ordi').attr('href','index.php?view=jeu&diff='+difficulte);
 });
});
</script>
