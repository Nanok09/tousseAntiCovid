<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=login");
    die("");
}
?>

<link rel="stylesheet" type="text/css" href="css/decouverte.css">


    
<main>



    <div class="decouverteContainer">
        <div class="decouverteContainerEnfant">
            <h2 class="titre">Origines de l'Awalé</h2>

            <hr>

            <p class="descriptif">L'Awalé est un jeu Akan, une des principales ethnies de Côte d'Ivoire. Il fait partie de la famille des jeux de semailles, caractérisée par le déplacement de graines dans des trous. Ces jeux se retrouvent essentiellement en Afrique et dans les diasporas africaines, et suscitent de nombreuses légendes quant à leurs origines. Les Masaï par exemple disent que leur jeu de semailles a été inventé par Sindillo, le fils du premier homme, Maitoumbe, et était à l'origine appelé Geshe. L'Awalé et sa fratrie constitue une famille qui se compte en centaines de membres sur tous les continents !</p>

        </div>


        <div class="decouverteContainerEnfant">
            <h2 class="titre">Ses valeurs</h2>

            <hr>

            <p class="descriptif">La pratique de ce jeu développe des vertus morales, intellectuelles et des liens sociaux. C'est un jeu de stratégie à part :</p>
            
            <ul class="listeVertus">
                <li>toutes les graines sont égales (pas de discrimination colorée)</li>
                <li>les graines n'appartiennent à aucun des joueurs</li>
                <li>il est interdit d'affamer son adversaire</li>
                <li>il est obligatoire de le nourrir si celui-ci s'affame</li>
                <li>on récolte ce qu'on sème</li>
                <li>on perd toujours des graines mais il faut en gagner davantage</li>
                <li>on ne cherche pas à détruire l'adversaire, mais juste à gagner plus de graines que lui</li>
                <li>l'union des graines fait leur force...</li>
            </ul>            


        </div>

        
    </div>
</main>


