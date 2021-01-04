<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=login");
    die("");
}
?>

<main id="content">
<span>Difficulté :</span>
<div id="difficulte">
    <div class="star">★</div>
    <div class="star">★</div>
    <div class="star">★</div>
    <div class="star">★</div>
    <div class="star">★</div>
</div>
<div id="jeu">
    <div class="infosJoueur" data-player-id="1">
    <div class="nom">Ordinateur</div>
    <div class="score"><div class="graine"></div> Score : <span class="score_value"></span></div>
    </div>
        <div id="jeuPlateau">

            <div id="terrain1" class="terrain">
                <div class="case" data-case-id="11">
                    <div class="conteneur_graines"></div>
                </div>
                <div class="case" data-case-id="10">
                    <div class="conteneur_graines"></div>
                </div>
                <div class="case" data-case-id="9">
                    <div class="conteneur_graines"></div>
                </div>
                <div class="case" data-case-id="8">
                    <div class="conteneur_graines"></div>
                </div>
                <div class="case" data-case-id="7">
                    <div class="conteneur_graines"></div>
                </div>
                <div class="case" data-case-id="6">
                    <div class="conteneur_graines"></div>
                </div>
            </div>

            <div id="terrain0" class="terrain">
                <div class="case" data-case-id="0">
                    <div class="conteneur_graines"></div>
                </div>
                <div class="case" data-case-id="1">
                    <div class="conteneur_graines"></div>
                </div>
                <div class="case" data-case-id="2">
                    <div class="conteneur_graines"></div>
                </div>
                <div class="case" data-case-id="3">
                    <div class="conteneur_graines"></div>
                </div>
                <div class="case" data-case-id="4">
                    <div class="conteneur_graines"></div>
                </div>
                <div class="case" data-case-id="5">
                    <div class="conteneur_graines"></div>
                </div>
            </div>

        </div>
    <div id="infosTour"></div>
    <div class="infosJoueur" data-player-id="0">
    <div class="nom">Toi</div>
    <div class="score"><div class="graine"></div> Score : <span class="score_value"></span></div>
    </div>
    </div>
    <div id="graph"></div>
    <div id="tchat">
        <input type="text" id="jeuMessage" placeholder="Message">
        <input type="submit" name="action" value="Envoyer" id="submitMessage">
    </div>
</main>
