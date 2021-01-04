//Syntaxe pour la classe valable avec ES6, voir compatibilité https://caniuse.com/#feat=es6-class
/**
 * @classdesc Jeu
 * @class
 */
class Game {
  constructor(affichage = true, plateau) {
    this.cases = [];
    //tableau qui représente le nombre de graines dans chaque case
    // [11] [10] [9] [8] [7] [6]  ligne de l'adversaire (joueur 1)
    //[0] [1] [2] [3] [4] [5]  ligne du joueur (joueur 0)
    this.plateau = plateau; //élément html contenant le plateau (<div id="plateau"></div>)
    this.affichage = affichage;
    for (var i = 0; i < 12; i++) {
      this.cases.push(4);
    }
    this.tour = 0; // tour du joueur 0 ou 1
    this.scores = [0, 0]; //nombre de graines prises par chacun des deux joueurs
    this.dernierCoupRightmost = [false, false]; // si le dernier coup effectué par chacun des joueurs était celui le plus à droite possible (pour la fct d'évaluation)
    this.over = false; //partie terminée ou non
    this.nbCoups = 0; //nombre de coups joués
    this.ordi = true; //faire jouer automatiquement l'ordi au nord
    this.difficulteOrdi = 3; //difficulté entre 0 et 4 
    this.coupesAdmissibles = this.getCoupesAdmissibles(this.tour);
    if (this.affichage) {
      this.initDisplay(); //initialisation de l'affichage graphique
      this.animationQueue = []; //initialisation de la file des animations (ajout/retrait des graines)
      this.animationOngoing = false; //si les animations sont en train d'être effectuées
      this.animationDelay = 500; //délai entre chaque animation (en ms)
    }
  }
  /**
   * Met à jour le score de joueur sur l'interface
   * @param {Int} joueur
   */
  setScore(joueur) {
    this.plateau
      .find(
        'div.infosJoueur[data-player-id="' + joueur + '"] span.score_value'
      )
      .text(this.scores[joueur]);
  }
  /**
   * Affiche un message sur l'interface du jeu
   * @param {String} msg Texte à afficher
   */
  afficherMessage(msg) {
    this.plateau.find("div#infosTour").text(msg);
  }
  /**
   * Affiche sur l'interface si c'est au tour du joueur ou de l'ordi de jouer.
   * Si c'est au tour de l'ordi de jouer, déclenche le coup de l'ordi après
   * un délai de this.animationDelay
   */
  afficherTour() {
    if (!this.over) {
      if (this.tour === 0) {
        this.afficherMessage("C'est à ton tour de jouer");
      } else {
        if (this.ordi) {
          this.afficherMessage("L'ordinateur est en train de jouer");
          var that = this;
          //lance le tour de l'ordi après this.animationDelay
          setTimeout(function () {
            that.tourOrdi();
          }, this.animationDelay);
        } else {
          this.afficherMessage("C'est à l'adversaire de jouer");
        }
      }
    }
  }
  /**
   * Initialise l'interface graphique
   */
  initDisplay() {
    //ajoute aux cases le bon nombre de graines initiales
    for (var i = 0; i < this.cases.length; i++) {
      this.plateau
        .find('div.case[data-case-id="' + i + '"] div.conteneur_graines')
        .html(new Array(this.cases[i] + 1).join('<div class="graine"></div>'));
    }
    //affiche les scores initiaux sur l'interface
    for (var j = 0; j < this.scores.length; j++) {
      this.setScore(j);
    }
    //affiche qui joue
    this.afficherTour();
    var that = this;
    //évènement au click sur un élément de classe "case"
    $("div.case").on("click", function () {
      //récupère l'id de la case sur laquelle on a cliqué
      var id_case = parseInt($(this).attr("data-case-id"));
      //jouer cette case
      that.jouer(id_case);
    });
  }
  /**
   * Retourne l'id de la coupe suivant idCoupe (suivant = sens trigo)
   * @param {Int} idCoupe
   * @return {Int} Id de la coupe suivant idCoupe
   */
  getCoupeSuivante(idCoupe) {
    if (idCoupe === 11) {
      return 0;
    } else {
      return idCoupe + 1;
    }
  }
  /**
   * Retourne l'id de la coupe précédant idCoupe (précédant = sens horaire)
   * @param {Int} idCoupe
   * @return {Int} Id de la coupe précédant idCoupe
   */
  getCoupePrecedente(idCoupe) {
    if (idCoupe === 0) {
      return 11;
    } else {
      return idCoupe - 1;
    }
  }
  /**
   * Retourne le joueur à qui appartient idCoupe
   * @param {Int} idCoupe
   * @return {Int} Joueur (0 ou 1)
   */
  getJoueur(idCoupe) {
    return idCoupe < 6 ? 0 : 1;
  }
  /**
   * Retourne l'id de la coupe la plus à gauche de joueur
   * @param {Int} joueur
   * @return {Int} id de la coupe
   */
  getLeftmostCoupe(joueur) {
    return 6 * joueur;
  }
  /**
   * Retourne l'id de la coupe la plus à droite de joueur
   * @param {Int} joueur
   * @return {Int} id de la coupe
   */
  getRightmostCoupe(joueur) {
    return 6 * (joueur + 1) - 1;
  }
  /** Retourne si la coupe idCoupe est prenable (2 ou 3 graines)
   * @param {Int} idCoupe
   * @return {Boolean}
   */
  isCoupePrenable(idCoupe) {
    return this.cases[idCoupe] === 2 || this.cases[idCoupe] === 3;
  }
  /** Retourne si la partie est finie ou non
   * @return {Boolean}
   */
  isPartieOver() {
    var limite = 24;
    return (
      this.getGrainesRestantes() === 0 ||
      this.scores[0] > limite ||
      this.scores[1] > limite
    );
  }
  /**
   * Retourne l'élément html correspondant à la coupe idCoupe
   * @param {int} idCoupe
   * @return Element html du plateau
   */
  getElCoupe(idCoupe) {
    return this.plateau.find('div.case[data-case-id="' + idCoupe + '"]');
  }
  /**
   * Traite la file des animations sur le plateau de jeu (récursivement)
   * @param {Int} index Position de l'animation à traiter dans la file
   */
  processAnimationQueue(index) {
    // on vérifie que la file contient bien un élément à la position index
    if (this.animationQueue[index]) {
      // si on vient de commencer à traiter la file (premier élément), on
      // retire d'abord les classes "taken" et "played" à toutes les cases
      if (index === 0) {
        this.animationOngoing = true; //la file est en train d'être traitée
        this.plateau.find("div.case.taken").removeClass("taken"); //retirer l'entourage rouge des cases prises au dernier coup
        this.plateau.find("div.case.played").removeClass("played"); //retirer l'entourage bleu de la case jouée au dernier coup
      }
      this.plateau.find("div.case.highlight").removeClass("highlight"); //retirer le petit entourage plus foncé
      var anim = this.animationQueue[index];
      switch (anim.type) {
        //si l'animation est du type "jouerCoupe", on ajoute l'entourage bleu
        //à cette case
        case "jouerCoupe":
          this.getElCoupe(anim.idCoupe).addClass("played");
          break;
        //si l'animation est du type "retirerGraines", on retire toutes les
        //graines de cette case
        case "retirerGraines":
          this.getElCoupe(anim.idCoupe).find("div.conteneur_graines").html("");
          break;
        //si l'animation est du type "ajouterGraine", on highlight cette case
        //et on ajoute une graine
        case "ajouterGraine":
          this.getElCoupe(anim.idCoupe).addClass("highlight");
          //s'il y a plus de 10 graines, afficher le nombre au lieu des graines
          if (anim.nbGraines > 10) {
            this.getElCoupe(anim.idCoupe)
              .find("div.conteneur_graines")
              .html(anim.nbGraines);
          } else {
            this.getElCoupe(anim.idCoupe)
              .find("div.conteneur_graines")
              .append('<div class="graine"></div>');
          }
          break;
        //si le type est "prendreCoupe", on entoure la case en rouge et on
        //retire les graines de la case
        case "prendreCoupe":
          this.getElCoupe(anim.idCoupe).addClass("taken");
          this.getElCoupe(anim.idCoupe).find("div.conteneur_graines").html("");
          break;
      }
      var that = this;
      //on appelle récursivement la fonction à l'animation à la position
      //suivante dans la file, après un délai de this.animationDelay ms
      setTimeout(function () {
        that.processAnimationQueue(index + 1);
      }, this.animationDelay);
    } else {
      //si l'animation à la position index n'existe pas, on a atteint la fin de la file
      this.animationQueue = []; //on la vide pour le prochain tour
      this.animationOngoing = false; //le traitement de la file est fini
      this.afficherTour(); //on affiche le prochain tour
    }
  }
  /** Joue la coupe idCoupe par joueur
   * @param {Int} joueur Joueur qui joue le coup
   * @param {Int} idCoupe Id de la coupe à jouer
   * @param {Boolean} affichage Afficher sur le plateau les animations,
   * messages lors du coup (false pour simuler un coup dans alphabeta sans
   * l'afficher)
   */
  deplacer(joueur, idCoupe, affichage = true) {
    if (this.affichage) {
      //on ajoute à la file des animations "joueurCoupe" et "retirerGraines"
      //pour la coupe choisie
      this.animationQueue.push({ type: "jouerCoupe", idCoupe: idCoupe });
      this.animationQueue.push({ type: "retirerGraines", idCoupe: idCoupe });
    }
    this.dernierCoupRightmost[joueur] =
      idCoupe === this.getRightmostCoupe(joueur);
    var nbGraines = this.cases[idCoupe];
    this.cases[idCoupe] = 0; //on retire les graines de la coupe jouée
    var coupeCourante = idCoupe;
    while (nbGraines > 0) {
      // on redistribue les graines de la coupe jouée
      coupeCourante = this.getCoupeSuivante(coupeCourante);
      if (coupeCourante != idCoupe) {
        //on ne redistribute pas dans la coupe jouée
        this.cases[coupeCourante] += 1;
        //ajoute l'animation d'ajouter une graine
        if (this.affichage) {
          this.animationQueue.push({
            type: "ajouterGraine",
            idCoupe: coupeCourante,
            nbGraines: this.cases[coupeCourante],
          });
        }
        nbGraines -= 1;
      }
    }
    var coupeFinale = coupeCourante;
    var joueurCoupeFinale = this.getJoueur(coupeFinale);
    //si on s'arrête sur une coupe qui n'est pas celle de celui qui a joué le
    //coup, on peut peut être prendre des graines
    if (joueur !== joueurCoupeFinale) {
      //vérifie si on va affamer l'adversaire, auquel cas on ne prend aucune
      //graine
      if (this.notAffameAdversaire(joueur, coupeFinale)) {
        //sinon on prend les graines normalement
        while (
          this.getJoueur(coupeCourante) === joueurCoupeFinale &&
          this.isCoupePrenable(coupeCourante)
        ) {
          this.scores[joueur] += this.cases[coupeCourante]; //ajoute les graines prises au score
          this.cases[coupeCourante] = 0;
          if (this.affichage) {
            this.setScore(joueur);
            this.animationQueue.push({
              type: "prendreCoupe",
              idCoupe: coupeCourante,
            });
          }
          this.plateau[coupeCourante];
          coupeCourante = this.getCoupePrecedente(coupeCourante);
        }
      }
    }
    this.over = this.isPartieOver(); //vérifie si la partie est finie
    if (this.over && this.affichage) {
      this.afficherMessage("La partie est terminée");
    } else if (!this.over) {
      //si la partie n'est pas finie, c'est à l'autre joueur de jouer et on
      //récupère les coups possibles
      this.tour = (this.tour + 1) % 2;
      this.coupesAdmissibles = this.getCoupesAdmissibles(this.tour);
    }
    this.nbCoups += 1;
    //on traite la file des animations sur l'interface graphique
    if (this.affichage) {
      this.processAnimationQueue(0);
    }
  }

  /** Retourne si joueur finit son coup sur coupeFinale et prend toutes les
   * graines possibles, son adversaire sera affamé
   * @param {Int} joueur
   * @param {Int} coupeFinale
   * @return {Boolean} Le coup va affamer l'adversaire de joueur
   */
  notAffameAdversaire(joueur, coupeFinale) {
    var adversaire = (joueur + 1) % 2;
    var admissible = false;
    var coupeCourante = this.getRightmostCoupe(adversaire);
    while (this.getJoueur(coupeCourante) === adversaire) {
      //si l'adversaire a une coupe non vide "suivant" celle sur laquelle on
      //s'est arrêté, il ne sera pas affamé
      if (coupeCourante > coupeFinale && this.cases[coupeCourante] !== 0) {
        admissible = true;
        //si l'adversaire a une coupe "précédant" celle sur laquelle on s'est
        //arrếté qui n'est pas prenable, il ne sera pas affamé
      } else if (
        coupeCourante <= coupeFinale &&
        !this.isCoupePrenable(coupeCourante)
      ) {
        admissible = true;
      }
      coupeCourante = this.getCoupePrecedente(coupeCourante);
    }
    return admissible;
  }
  /** Retourne la liste des coupes admissibles que peut jouer joueur pour
   * nourrir son adversaire
   * @param {Int} joueur
   * @return {array} Liste des ids des coupes possibles
   */
  getCoupesAdmissiblesNourrir(joueur) {
    var coupesAdmissibles = [];
    var coupeCourante = this.getRightmostCoupe(joueur);
    var distance = 1;
    while (this.getJoueur(coupeCourante) === joueur) {
      //pour qu'une coupe soit admissible elle doit contenir plus de graines
      //que sa "distance" à la coupe la plus proche de l'adversaire
      if (this.cases[coupeCourante] >= distance) {
        coupesAdmissibles.push(coupeCourante);
      }
      coupeCourante = this.getCoupePrecedente(coupeCourante);
      distance += 1;
    }
    return coupesAdmissibles;
  }
  /** Retourne la somme des graines que contiennent les coupes de joueur
   * @param {Int} joueur
   * @return {Int} Graines restantes dans les coupes de joueur
   */
  getGrainesRestantesJoueur(joueur) {
    var somme = 0;
    for (var i = 0; i < 6; i++) {
      var idCoupe = this.getLeftmostCoupe(joueur) + i;
      somme += this.cases[idCoupe];
    }
    return somme;
  }
  /** Retourne le nombre de coupes non vides que possède joueur
   * @param {Int} joueur
   * @return {Int} Nombre de coupes non vides
   */
  getNbCoupesNonVidesJoueur(joueur) {
    var nb = 0;
    for (var i = 0; i < 6; i++) {
      var idCoupe = this.getLeftmostCoupe(joueur) + i;
      nb += this.cases[idCoupe] === 0 ? 0 : 1;
    }
    return nb;
  }
  /** Retourne le nombre de graines restantes sur le plateau
   * @return {Int} Graines restantes
   */
  getGrainesRestantes() {
    var somme = 0;
    for (var i = 0; i < 12; i++) {
      somme += this.cases[i];
    }
    return somme;
  }
  /** Retourne la liste des coupes que peut jouer joueur
   * @param {Int} joueur
   * @return {array} liste des ids des coupes admissibles
   */
  getCoupesAdmissibles(joueur) {
    var adversaire = (joueur + 1) % 2;
    var coupesAdmissibles = [];
    //si l'adversaire n'a plus de graines dans ses coupes
    //les coupes admissibles sont celles qui permettent de le nourrir
    if (this.getGrainesRestantesJoueur(adversaire) === 0) {
      coupesAdmissibles = this.getCoupesAdmissiblesNourrir(joueur);
      //si aucun coup ne permet de le nourrir, toutes les graines restantes vont
      //à l'adversaire et la partie est terminée
      if (coupesAdmissibles.length === 0) {
        this.scores[adversaire] += this.getGrainesRestantes();
        this.over = true;
      }
    } else {
      //sinon toutes les coupes non vides peuvent être jouées
      for (var i = 0; i < 6; i++) {
        var idCoupe = this.getLeftmostCoupe(joueur) + i;
        if (this.cases[idCoupe] > 0) {
          coupesAdmissibles.push(idCoupe);
        }
      }
    }
    return coupesAdmissibles;
  }
  /** Clone l'objet Game et ses propriétés et retourne la copie
   * @return {Game}
   */
  clone() {
    var clone = new Game(false, this.plateau);
    clone.cases = [...this.cases];
    clone.scores = [...this.scores];
    clone.dernierCoupRightmost = [...this.dernierCoupRightmost];
    clone.tour = this.tour;
    clone.over = this.over;
    clone.nbCoups = this.nbCoups;
    clone.ordi = this.ordi;
    clone.difficulteOrdi= this.difficulteOrdi;
    return clone;
  }
  /** Evalue la situation de jeu pour joueur (différence des scores)
   * @param {int} joueur
   * @return {Number} Différence des scores entre joueur et son adversaire
   */
  evaluation(joueur) {
    var adversaire = (joueur + 1) % 2;
    return this.scores[joueur] - this.scores[adversaire];
  }
  /** Evalue la situation pour joueur (avec des heuristiques)
   * @param {int} joueur
   * @return {Number} valeur de la situation
   */
  evaluationHeuristique(joueur) {
    var adversaire = (joueur + 1) % 2;
    var h1 = this.cases[this.getLeftmostCoupe(joueur)];
    var h2 = this.getGrainesRestantesJoueur(joueur);
    var h3 = this.getNbCoupesNonVidesJoueur(joueur);
    var h4 = this.scores[joueur];
    var h5 = this.dernierCoupRightmost[joueur] ? 1 : 0;
    var h6 = this.scores[adversaire];
    return 0.199 * h1 + 0.19 * h2 + 0.37 * h3 + h4 + 0.42 * h5 - 0.56 * h6;
  }
  /** Affiche le graphe (tronqué) produit par l'algo alphabeta sur l'interface graphique
   * via la bibliothèque vis.js
   */
  showGraph() {
    const container = document.getElementById("graph");
    var DOTstring = "digraph G {\n" + this.toDot() + "\n}";
    var parsedData = vis.networkDOTParser.DOTToGraph(DOTstring);
    var data = {
      nodes: parsedData.nodes,
      edges: parsedData.edges,
    };
    var network = new vis.Network(container, data, {
      layout: { hierarchical: { direction: "UD", sortMethod: "directed" } },
    });
  }
  /** Retourne la représentation DOT du graphe produit par alphabeta pour
   * l'afficher
   */
  toDot() {
    this.node = {
      id: "node" + this.cases.join(""),
      label:
        this.cases.slice(6, 12).reverse().join("-") +
        "\n" +
        this.cases.slice(0, 6).join("-") +
        "\n(Value :" +
        this.value.toFixed(2) +
        ")",
    };
    var res = this.node.id + ' [label="' + this.node.label + '"];\r\n';
    if (this.arbreFils) {
      for (var coupe in this.arbreFils) {
        res += this.arbreFils[coupe].toDot();
        res +=
          this.node.id +
          " -> " +
          this.arbreFils[coupe].node.id +
          ' [label="' +
          coupe +
          '"];\r\n';
      }
    }
    return res;
  }
  /** Algo minimax avec élagage alphabeta pour l'ordi (fct récursive)
   * @param {Int} joueurMaximisant id du joueur dont le score est à maximiser
   * @param {Number} alpha Valeur alpha pour l'élagage
   * @param {Number} beta Valeur beta pour l'élagage
   * @param {Int} profondeurMax profondeur de recherche de l'algo minimax
   * @param {int} profondeurArbre profondeur à laquelle tronquer l'arbre pour
   * l'affichage (une profondeur de 1 est nécessaire pour déterminer le
   * meilleur coup par la suite)
   */
  alphabeta(
    joueurMaximisant,
    alpha,
    beta,
    profondeurMax,
    profondeurArbre = 2
  ) {
    //initialisation de l'arbre des parties "filles"
    this.arbreFils = {};

    var coupesPossibles = this.getCoupesAdmissibles(this.tour);
    //si on a atteint la profondeur max ou que la partie est terminée, on
    //l'évalue avec la fct d'évaluation et on retourne la valeur
    if (this.profondeur === profondeurMax || this.over) {
      this.value = this.evaluationHeuristique(joueurMaximisant);
      return this.value;
    }
    if (this.tour === joueurMaximisant) {
      var fctComparaison = Math.max;
      this.value = -Infinity;
    } else {
      var fctComparaison = Math.min;
      this.value = Infinity;
    }

    //on simule tous les coups possibles en clonant la partie
    for (var i = 0; i < coupesPossibles.length; i++) {
      var idCoupe = coupesPossibles[i];
      var fils = this.clone();
      fils.affichage = false;
      fils.profondeur = this.profondeur + 1;
      fils.deplacer(fils.tour, idCoupe);
      //on appelle récursivement alphabeta sur les fils
      fils.value = fils.alphabeta(
        joueurMaximisant,
        alpha,
        beta,
        profondeurMax,
        profondeurArbre
      );

      if (this.profondeur < profondeurArbre) {
        this.arbreFils[idCoupe] = fils;
      }
      //on met à jour la valeur
      this.value = fctComparaison(this.value, fils.value);
      //élagage alphabeta
      if (this.tour === joueurMaximisant) {
        if (this.value >= beta) {
          return this.value;
        }
        alpha = fctComparaison(alpha, this.value);
      } else {
        if (alpha >= this.value) {
          return this.value;
        }
        beta = fctComparaison(beta, this.value);
      }
    }
    return this.value;
  }
  /** Essaye de jouer la coupe idCoupe pour le joueur humain
   * @param {Int} idCoupe
   */
  jouer(idCoupe) {
    if (!this.over) {
      if (!this.animationOngoing) {
        if (
          this.getJoueur(idCoupe) === this.tour &&
          this.coupesAdmissibles.indexOf(idCoupe) !== -1
        ) {
          //si la coup fait partie de ceux possibles, on le joue !
          this.deplacer(this.tour, idCoupe);
        } else {
          console.log("coup impossible");
          this.afficherMessage("Tu ne peux pas jouer ce coup");
        }
      } else {
        //si des animations sont encore en train d'être faites, on attend...
        this.afficherMessage("Un coup est en cours...");
      }
    }
  }
  /** Fait jouer l'ordinateur
   */
  tourOrdi() {
    var profondeurs = {0:2,1:3,2:4,3:6,4:8};//profondeur en fonction de la difficulté, par ex profondeur 8 pour la difficulté 4
    //la profondeur de l'état actuel du jeu est nulle
    this.profondeur = 0;
    //alphabeta avec une profondeur
    this.alphabeta(this.tour, -Infinity, Infinity, profondeurs[this.difficulteOrdi]);
    //on récupère le coup dont la valeur est maximale
    var max = -Infinity;
    var meilleurCoup = -1;
    for (var coup in this.arbreFils) {
      if (this.arbreFils[coup].value > max) {
        meilleurCoup = coup;
        max = this.arbreFils[coup].value;
      }
    }
    console.log("ordi jouer " + meilleurCoup);
    //afficher le graph
    this.showGraph();
    //jouer le meilleur coup
    this.deplacer(this.tour, parseInt(meilleurCoup));
  }
}
//charger la bibliothèque vis.js pour l'affichage du graph
$.getScript("https://unpkg.com/vis-network/standalone/umd/vis-network.min.js");
var partie;
//lorsque la page est chargée, créer une partie avec l'élément html #jeu
$(function () {
  partie = new Game(true, $("#jeu"));
  var urlParams = new URLSearchParams(window.location.search);
  var difficulte = parseInt(urlParams.get('diff'));
  partie.difficulteOrdi = difficulte;
  $('#difficulte .star:nth-child('+(difficulte+1)+')').addClass('selected');
});
