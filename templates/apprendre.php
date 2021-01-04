<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
  header("Location:../index.php?view=login");
  die("");
}
?>

<main>
    <div>
        <h2>Règles du jeu</h2>

        <hr>

        <p>On s'intéressera ici à décrire les règles de l'awalé.
        L'awalé se joue sur un plateau composé de 2 rangées de 6 trous chacune; chaque trou recevant 4 graines au début du jeu.
        Le but du jeu est de récolter plus de graines que son adversaire.</p>

        <p>Chaque joueur se place devant une rangée de 6 cases, qui deviennent alors son camp.
        Afin de faciliter les explications, on note généralement chaque case par une lettre : de « A » à « F » pour le joueur du bas, appelé « Sud » et de « a » à « f » pour le joueur du haut, appelé Nord.</p>
      
        <img src="images/awale_1.jpg">
      
        <p>Chacun son tour, un joueur prend toutes les graines d'une des cases de son camp et les sèment une par une dans les cases suivantes dans le sens inverse de celui des aiguilles d'une montre.</p>
      
        <img src="images/awale_2.jpg">
      
        <p>Dans l’exemple ci-dessus, au premier coup, en jouant d, le joueur Nord distribue une à une les graines dans les cases e, f, A et B. Au cours de cette opération, on ne doit jamais remettre de graine dans le trou de départ. Si le nombre de graines prises dans un trou excède 11, on sème pendant un tour complet, on saute le trou de départ, puis on continue à semer dans les autres trous suivants.</p>

        <p>Si la dernière graine semée est déposée dans une case du camp adverse, dans laquelle il n'y a, avant qu'il ne la pose, qu'une ou 2 graines, le joueur ramasse toutes les graines de ce trou (y compris celle qu’il vient de semer). De même, il ramasse les graines des cases précédentes du camp adverse si elles sont au nombre de 2 ou 3. En revanche, il ne récolte rien s'il sème sa dernière graine dans une case vide ou dotée de plus de 3 graines après son semage.</p>

        <p>Dans l’exemple suivant, si le joueur Sud joue D, il sème ses graines dans les cases E, F, a, b, c, d et e.</p>
      
        <img src="images/awale_3.jpg">
      
        <p>La case e ayant 2 graines et se trouvant dans le camp adverse, celles-ci sont ramassées par le joueur. La case d ayant 3 graines et la case c ayant 2 graines, elles sont aussi ramassées. On s’arrête à la case b, qui a 4 graines et qui ne peuvent donc être ramassées.</p>
        
        <p>L'awalé est un jeu tactique. Un des éléments importants de ce jeu est de pouvoir construire des « greniers » par accumulation de graines dans un seul trou afin de faire plus d’un tour du plateau de jeu. Les « geniers » ont pour effet de dégarnir le camp de l’adversaire, ce qui permettra, une fois les graines de la maison semées, de prendre plusieurs graines en une fois.</p>

        <p>Dans l’exemple suivant, Sud joue D.</p>
      
        <img src="images/awale_4.jpg">
      
        <p>Sa dernière graine semée est dans la case d (on ne sème pas de graine dans la case de départ, à savoir D). La case d et c ayant alors 2 graines, les cases b et a en ayant 3, elles sont toutes ramassées.</p>
        
        <p>Dernière règle, un joueur est obligé de « nourrir » son adversaire, ce qui veut dire qu'il doit jouer de manière à laisser au moins une graine dans le camp adverse. Si un joueur ne peut nourrir son adversaire ou ne peut plus jouer, la partie s’arrête. Il est possible d’arrêter une partie si le nombre de graines sur le plateau de jeu soit trop faible pour pouvoir permettre des prises (on peut considérer qu’à partir de 3 graines ou moins la partie peut s’arrêter).</p>

        <p>Chacun compte alors ses graines et le joueur en ayant le plus a gagné.</p>

        <p>Et pour finir, un problème : c'est à Sud de jouer. Comment doit-il jouer pour assurer une prise importante de graines ?</p>  
      
        <img src="images/awale_5.jpg">
    </div>
</main>